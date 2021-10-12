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
            // $table->foreignId('division_id')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreign('creator_id')->references('id')->on('users')->nullable();
            $table->string('name');
            $table->string('url')->default('');
            $table->boolean('allDay')->default(true);
            $table->string('target');
            $table->integer('tercapai')->default(0);
            $table->string('color')->default('#053742');
            $table->text('description');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->enum('status', ['on Progress', 'completed'])->default('on Progress');
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
        Schema::dropIfExists('projects');
    }
}
