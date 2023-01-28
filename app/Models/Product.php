<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [

         'user_id',
         'name',
         'description',
         'price',
         'image'

    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
