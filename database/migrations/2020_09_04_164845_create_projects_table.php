<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('icon_url')->nullable();
            $table->date('deadline')->nullable();
            $table->unsignedBigInteger('price')->nullable();
            $table->foreignId('creator_id')->references('id')->on('users');
            $table->foreignId('completor_id')->nullable()->references('id')->on('users');
            $table->date('completed_at')->nullable();
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
