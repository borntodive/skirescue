<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Skiarea extends Model
{
    use HasFactory;
    public function opscentral()
    {
        return $this->belongsTo(Opscentral::class);
    }
    public function skiruns()
    {
        return $this->hasMany(Skirun::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
