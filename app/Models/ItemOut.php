<?php

namespace App\Models;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOut extends Model
{
    use HasFactory;
    protected $table = 'item_out';
    protected $fillable = [
        'item_id',
        'place',
        'quantity',
        'quantity_unit',
        'cost_price',
        'sell_price',
        'date_out',
        'date_expired',
    ];

    public function items(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
