<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->enum('gender', ["Male","Female"]);
            $table->date('birth_day');
            $table->boolean('educated');
            $table->boolean('vaccinated');
            $table->foreignId('widow_id')->constrained();
            $table->foreignId('sponsor_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children');
    }
}
