<?php

namespace App\Models;

use App\Models\Operator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function operator(){
        return $this->belongsTo(Operator::class);
    }
}
