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
            $table->uuid('id')->primary();
            $table->foreignIdFor(\AmuzPackages\DeepLink\Models\LinkContext::class);

            $table->string('ip_address', 45); // IPv4 및 IPv6 지원
            $table->text('user_agent');
            $table->string('os')->nullable();
            $table->string('browser')->nullable();
            $table->timestamp('accessed_at');
            $table->text('referrer')->nullable();
            $table->string('device_type')->nullable();

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
