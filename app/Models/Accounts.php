<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    protected $fillable = ['username', 'password', 'token', 'role', 'info', 'is_deleted'];
    public $timestamps = true;
    
}
