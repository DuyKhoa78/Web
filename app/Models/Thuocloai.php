<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thuocloai extends Model
{
    use HasFactory;
    protected $fillable = [
        'theloai_id','sach_id'
    ];
    protected $table = 'thuocloai';
}
