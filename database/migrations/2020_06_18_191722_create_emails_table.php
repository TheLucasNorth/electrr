<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('voter_id');
            $table->string('message_id');
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
        Schema::dropIfExists('emails');
    }
}
