<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('times');
            $table->bigIncrements('user_id');
            $table->date('date');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE free_record AUTO_INCREMENT=1");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('free_record');
    }
}
