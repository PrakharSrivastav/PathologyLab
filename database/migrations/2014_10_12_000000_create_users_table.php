<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     * Create the migrations for the user table.
     * Make sure the columns in the table can handle both the user and the operator
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->dateTime("dob");
            $table->enum("sex", ['0', '1', '2'])->default('2'); // 0->male , 1->female , 2->unknown
            $table->rememberToken();
            $table->timestamps();
            $table->enum('is_operator', ['0', '1'])->default('0');
            $table->string('passcode', 255);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
