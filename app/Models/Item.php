<?php

namespace App\Models;

use App\Models\ItemIn;
use App\Models\ItemOut;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'type',
        'description',
        'image',
        'quantity',
    ];

    public function itemIn(){
        return $this->hasMany(ItemIn::class);
    }
    public function itemOut(){
        return $this->HasMany(ItemOut::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
