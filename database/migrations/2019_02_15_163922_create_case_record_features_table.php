<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseRecordFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_record_features', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('feature_id')->unsigned();
            $table->integer('case_record_id')->unsigned();
            $table->tinyInteger('value');

            $table->foreign('feature_id')
                ->references('id')
                ->on('features');

            $table->foreign('case_record_id')
                ->references('id')
                ->on('case_records');

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
        Schema::dropIfExists('case_record_features');
    }
}
