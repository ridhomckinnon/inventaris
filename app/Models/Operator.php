<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Operator extends Model
{
    use HasFactory;
    protected $fillable = ['username', 'name', 'email', 'password'];

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
