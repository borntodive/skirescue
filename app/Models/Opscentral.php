<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Opscentral extends Model
{
    use HasFactory;
    public function skiareas()
    {
        return $this->hasMany(Skiarea::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
