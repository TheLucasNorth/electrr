<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('election_id');
            $table->unsignedBigInteger('role_id');
            $table->text('name');
            $table->text('manifesto')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('withdrawn')->default(false);
            $table->json('contact')->nullable();
            $table->text('image')->nullable();
            $table->json('custom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
