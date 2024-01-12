<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    use HasFactory;
    public $timestamps=false;//set time to false
    protected $fillable=[
        'tentheloai','slug_theloai', 'mota','kichhoat'
    ];
    protected $table='theloai';
    public function sach(){
        return $this->hasMany('App\Models\Sach'); //Theloai có nhiều sách 1,n
    }
    public function nhieutheloaisach(){
        return $this->belongsToMany(Sach::class,'thuocloai','theloai_id','sach_id');
    }
}
