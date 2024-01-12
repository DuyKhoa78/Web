<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thuocdanh extends Model
{
    use HasFactory;
    protected $fillable = [
        'danhmuc_id','sach_id'
    ];
    protected $table = 'thuocdanh';
}
