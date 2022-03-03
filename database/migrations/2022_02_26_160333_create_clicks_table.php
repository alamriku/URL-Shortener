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
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained('links')->cascadeOnDelete();
            $table->string('ip');
            $table->string('location');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('referer')->nullable();
            $table->string('browser')->nullable();
            $table->string('os_platform')->nullable();
            $table->string('device');

            $table->index('ip');
            $table->index('referer');

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
        Schema::table('clicks',function(Blueprint $table){
            $table->dropConstrainedForeignId('link_id');
        });

        Schema::dropIfExists('clicks');
    }
};
