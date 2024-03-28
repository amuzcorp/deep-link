<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deep_links', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            $table->text('target_url')->nullable()->comment('PC 접속시 웹주소');

            $table->text('aos_package')->nullable();
            $table->text('aos_install_url')->nullable();

            $table->text('ios_bundle')->nullable();
            $table->text('ios_install_url')->nullable();

            $table->json('context_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deep_links');
    }
};
