<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id'); // 主キー: bigint unsigned, NOT NULL
            $table->unsignedBigInteger('category_id'); // 外部キー
            $table->string('first_name', 255);         // NOT NULL
            $table->string('last_name', 255);          // NOT NULL
            $table->tinyInteger('gender');             // NOT NULL, 1:男性 2:女性 3:その他
            $table->string('email', 255);              // NOT NULL
            $table->string('tel', 255);                // NOT NULL
            $table->string('address', 255);            // NOT NULL
            $table->string('building', 255)->nullable(); // NULL可
            $table->text('detail');                    // NOT NULL
            $table->timestamps();                      // created_at, updated_at
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
