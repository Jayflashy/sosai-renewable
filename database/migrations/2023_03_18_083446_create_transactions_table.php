<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->double('amount',20,2);
            $table->string('meter')->nullable();
            $table->string('name')->nullable();
            $table->string('merchant')->nullable();
            $table->string('phone')->nullable();
            $table->string('message')->nullable();
            $table->double('oldbal',20,2)->nullable();
            $table->double('newbal',20,2)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->longText('response')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
