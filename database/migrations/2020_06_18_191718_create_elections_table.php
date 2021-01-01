<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->string('slug', 250)->unique();
            $table->string('token', 30);
            $table->string('name', 250);
            $table->text('description')->nullable();
            $table->text('imprint')->nullable();
            $table->boolean('nominations')->default(false);
            $table->boolean('shuffle_manifestos')->default(false);
            $table->boolean('shuffle_candidates')->default(false);
            $table->boolean('description_home')->default(true);
            $table->boolean('description_nomination')->default(true);
            $table->json('nomination_contact')->nullable();
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
        Schema::dropIfExists('elections');
    }
}
