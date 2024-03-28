<?php

namespace AmuzPackages\DeepLink\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DeepLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'target_url',

        'aos_package',
        'aos_install_url',

        'ios_bundle',
        'ios_install_url',
        'context_data'
    ];
    protected $casts = ['context_data' => 'array'];

    protected static function boot()
    {
        parent::boot();
        self::creating(function(DeepLink $deepLink){
            $isUnique = false;
            $slug = '';
            while(!$isUnique){
                $slug = Str::random(10);
                $isUnique = !DeepLink::query()->where('slug', $slug)->exists();
            }
            $deepLink->setAttribute('slug',$slug);
        });
    }
}
