<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public $timestamps = false;


    protected $fillable = ['urun_adı', 'urun_fiyatı', 'urun_açıklaması'];
}
