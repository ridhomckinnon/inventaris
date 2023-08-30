<?php

namespace App\Models;
use App\Models\Item;
use App\Models\ItemIn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['code','name', 'phone', 'address','logo'];

    public function itemIn(){
        return $this->hasMany(ItemIn::class);
    }
    public function item(){
        return $this->hasMany(Item::class);
    }
}
