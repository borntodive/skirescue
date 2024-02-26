<?php

namespace App\Models;

use App\Events\SampleCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;
use MongoDB\Laravel\Eloquent\Model;
use function Illuminate\Events\queueable;

class Sample extends Model
{
    use HasFactory;


    protected $guarded = ['_id'];


    protected static function booted()
    {
        static::created(function ($sample) {
            SampleCreated::dispatch($sample);
            Log::info('Sample created');
        });
    }
}
