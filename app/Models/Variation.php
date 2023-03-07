<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $table = 'variations';
    protected $fillable = ['product_id', 'image', 'name', 'key', 'price', 'quantity'];
    public $timestamps = true;
}
