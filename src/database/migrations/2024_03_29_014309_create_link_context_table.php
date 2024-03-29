<?php

use AmuzPackages\DeepLink\Models\DeepLink;
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
        Schema::create('link_contexts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DeepLink::class);
            $table->text('short_link')->index();
            $table->json('context_data')->nullable();
            $table->timestamps();
        });


        /** @var DeepLink $deepLink */
        $deepLink = DeepLink::query()->create([
            'slug' => 'install',
            'target_url' => env('APP_URL'),
            'aos_package' => 'kr.amuz.' . strtolower(env('APP_NAME')),
            'ios_bundle' => 'kr.amuz.' . strtolower(env('APP_NAME')),
            'aos_install_url' => env('APP_URL') . '/app/install/android',
            'ios_install_url' => env('APP_URL') . '/app/install/ios',
        ]);
        $deepLink->linkContexts()->create([
            'context_data' => [
                "user_id" =>  "583c3ac3f38e84297c002546",
                "email" =>  "test@test.com",
                "name" =>  "test@test.com",
                "given_name" =>  "Hello",
                "family_name" =>  "Test",
                "nickname" =>  "test",
                "last_ip" =>  "94.121.163.63",
                "logins_count" =>  15,
                "email_verified" =>  true
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_contexts');
    }
};
