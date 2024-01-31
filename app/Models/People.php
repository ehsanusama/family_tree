<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'last_name', 'dob'];
    // In your People model
    protected $primaryKey = 'id';
}
