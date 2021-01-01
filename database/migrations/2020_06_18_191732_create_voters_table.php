<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('election_id');
            $table->softDeletes();
            $table->string('username', 12);
            $table->string('password_plain', 6);
            $table->text('password');
            $table->text('email')->default('no-email');
            $table->boolean('voted')->default(false);
            $table->boolean('delivered')->nullable()->default(false);
            $table->boolean('opened')->nullable()->default(false);
            $table->boolean('unsubscribed')->nullable()->default(false);
            $table->boolean('complained')->nullable()->default(false);
            $table->boolean('bounced')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voters');
    }
}
