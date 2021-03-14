<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_levels', function (Blueprint $table) {
            $table->id();
            $table->string("access");
            $table->timestamps();
        });
        DB::table('access_levels')->insert([
            ['access' => 'viewer'],
            ['access' => 'worker'],
            ['access' => 'manager']
        ]);
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('contributor_id')->references('id')->on('users');
            $table->foreignId('project_id')->references('id')->on('projects');
            $table->foreignId('access_id')->references('id')->on('access_levels');
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
        Schema::dropIfExists('contributions');
        Schema::dropIfExists('access_levels');
    }
}
