<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            // $color = ['#053742', '#39A2DB', '#A2DBFA'];
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('signer_id');
            $table->string('name');
            $table->text('detail');
            $table->enum('status', ['todo', 'on progress', 'completed'])->default('todo');
            $table->timestamp('deadline')->nullable();
            $table->timestamp('complete_date')->nullable();
            $table->timestamps();


            $table->foreign('signer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
