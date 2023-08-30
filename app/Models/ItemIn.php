<?php

namespace App\Models;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemIn extends Model
{
    use HasFactory;
    protected $table = 'item_in';
    protected $fillable = [

        'item_id',
        'supplier_id',
        'place',
        'quantity',
        'quantity_unit',
        'status',
        'cost_price',
        'sell_price',
        'no_in',
        'date_in',
        'date_expired',
    ];

    public function items(){
        return $this->belongsTo(Item::class,"item_id");
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
