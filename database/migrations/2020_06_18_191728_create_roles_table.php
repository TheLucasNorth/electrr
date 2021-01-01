<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('voting_open');
            $table->string('voting_close');
            $table->string('nominations_open')->nullable();
            $table->string('nominations_close')->nullable();
            $table->boolean('nominations')->default(false);
            $table->boolean('ranked')->default(false);
            $table->unsignedInteger('seats');
            $table->boolean('ron')->default(false);
            $table->json('nomination_contact')->nullable();
            $table->json('custom')->nullable();
            $table->integer('election_id');
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
