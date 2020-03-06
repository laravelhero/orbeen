<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fl_id');
            $table->string('project_name')->nullable();
            $table->string('project_id')->nullable();
            $table->string('website');
            $table->string('da');
            $table->string('editorial_fee');
            $table->string('condition');
            $table->string('email');
            $table->string('link_insert_fee')->nullable();
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('final_leads');
    }
}
