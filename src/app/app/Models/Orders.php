<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function createOrder($order)
    {
        $insert = self::insert($order);
        return $insert;
    }
}
