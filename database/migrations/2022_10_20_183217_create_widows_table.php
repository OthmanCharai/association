<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cnss');
            $table->string('cin')->unique();
            $table->string('phone');
            $table->text('address');
            $table->boolean('priority');
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
        Schema::dropIfExists('widows');
    }
}
