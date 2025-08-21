<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    // 入力フォーム表示
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    // 確認画面表示
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->validated();

        // カテゴリー名を取得し表示用にセット
        $category = Category::find($inputs['category_id']);
        $inputs['category_content'] = $category ? $category->content : '';

    // tel1, tel2, tel3を結合してtelにする
    $inputs['tel'] = $inputs['tel1'].'-'.$inputs['tel2'].'-'.$inputs['tel3'];

        return view('confirm', compact('inputs'));
    }

    // DB保存とサンクス画面表示へ
    public function store(ContactRequest $request)
    {
        if ($request->input('action') === 'back') {
            // 戻るボタン押下時は入力画面に戻る
            return redirect()->route('contacts.index')->withInput();
        }

        $data = $request->validated();

        // ここでtelを結合
        $tel = $data['tel1'].'-'.$data['tel2'].'-'.$data['tel3'];

        Contact::create([
            'category_id' => $data['category_id'],
            'first_name'  => $data['first_name'],
            'last_name'   => $data['last_name'],
            'gender'      => $data['gender'],
            'email'       => $data['email'],
            'tel'         => $tel,
            'address'     => $data['address'],
            'building'    => $data['building'],
            'detail'      => $data['detail'],
        ]);

        return redirect()->route('contacts.thanks');
    }

    // サンクス画面表示
    public function thanks()
    {
        return view('thanks');
    }

    // 詳細データ取得API（モーダル用・管理画面用）
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.contact_modal_fragment', compact('contact'))->render();
    }

    // 管理画面・一覧表示
    public function admin(Request $request)
    {
        $query = Contact::with('category');

        // 名前・メール
        if ($request->has('keyword') && $request->input('keyword') !== '') {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
            $q->where('last_name', 'like', "%{$keyword}%")
            ->orWhere('first_name', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // お問い合わせの種類
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // 年月日
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // ページネーション
        $contacts = $query->latest()->paginate(7)->appends($request->query());

        // categoriesリストも渡す
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));

    }

    public function destroy($id)
    {
    Contact::findOrFail($id)->delete();
    return response()->json(['success'=>true]);
    }

    public function export(Request $request)
    {
        $query = Contact::with('category');
        // --- admin()と全く同じ検索条件をここにも適用 ---
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                ->orWhere('first_name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $contacts = $query->latest()->get(); // 検索結果を全件取得

        $filename = 'contacts_export.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function() use($contacts) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['名前', '性別', 'メール', '種類', '内容']); // 見出し
            foreach($contacts as $c){
                fputcsv($out, [
                    $c->last_name . ' ' . $c->first_name,
                    $c->gender == 1 ? '男性' : ($c->gender==2 ? '女性' : 'その他'),
                    $c->email,
                    $c->category->content ?? '',
                    $c->detail,
                ]);
            }
            fclose($out);
        };
        return response()->stream($callback,200,$headers);
    }
}