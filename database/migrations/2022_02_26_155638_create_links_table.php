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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clicks')->default(0);
            $table->string('short_url')->unique();
            $table->longText('long_url');
            $table->string('short_chars')->unique();
            $table->timestamp('expire_at')->nullable();
            $table->unsignedInteger('attempt')->default(3);
            $table->unsignedInteger('time_frame')->default(1)->comment('minutes');
            $table->unsignedInteger('block_duration')->default(5)->comment('minutes');
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
        Schema::dropIfExists('links');
    }
};
