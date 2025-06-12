<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'total_hpp'];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function target()
    {
        return $this->hasOne(Target::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

