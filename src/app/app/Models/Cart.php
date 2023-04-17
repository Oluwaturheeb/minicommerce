<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(Items::class, 'item_id', 'id');
    }

    public function item()
    {
        return $this->hasOne(Items::class, 'id', 'item_id');
    }

    public function addItem($user, $item, $quantity)
    {
        $this->user_id = $user;
        $this->item_id = $item;
        $this->quantity = $quantity;

        $this->save();

        return $this;
    }
}
