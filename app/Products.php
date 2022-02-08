<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['id', 'name', 'price', 'quantity', 'shelf_life', 'description', 'available', 'image'];




    public function compradores()
    {
        return $this->belongsToMany(User::class);
    }
}

