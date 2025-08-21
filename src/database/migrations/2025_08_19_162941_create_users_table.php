<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('users', function (Blueprint $table) {
        $table->bigIncrements('id');             // 主キー: bigint unsigned, NOT NULL
        $table->string('name', 255);             // NOT NULL
        $table->string('email', 255)->unique();  // NOT NULL（重複禁止だとより安全）
        $table->string('password', 255);         // NOT NULL
        $table->timestamps();                    // created_at, updated_at（timestamp型）
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
