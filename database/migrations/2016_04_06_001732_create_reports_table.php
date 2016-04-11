<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->dateTime("test_date");
            $table->string("testing_lab", 255); // physician / lab / doctor
            $table->string("case_number", 255); // medical record number
            $table->string("report_name", 255); // the disease / report name
            $table->text("patient_history"); // history of the patient
            $table->text("description"); // details of the current report
            $table->enum("status", ['0', '1', '2']); //0->inProgress, 1->generated , 2->recieved
            $table->text("addition_details");
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('reports');
    }

}
