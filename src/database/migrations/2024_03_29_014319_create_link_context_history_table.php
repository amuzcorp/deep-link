<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

return new class extends Migration
{
    use HasUuids;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('link_context_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\AmuzPackages\DeepLink\Models\LinkContext::class);

            $table->string('ip_address', 45); // IPv4 및 IPv6 지원

            $table->string('browser_engine')->nullable();
            $table->string('browser_name')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('device_family')->nullable();
            $table->string('device_model')->nullable();
            $table->string('device_type')->nullable();
            $table->string('platform_name')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('platform_family')->nullable();
            $table->string('browser_family')->nullable();

            $table->text('referrer')->nullable();
            $table->text('user_agent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_context_histories');
    }
};
