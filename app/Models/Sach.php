<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    use HasFactory;
    protected $dates=[
        'created_at',
        'updated_at'
    ];
    public $timestamps=false;//set time to false
    protected $fillable=[
        'tensach', 'tomtat','kichhoat','slug_sach','danhmuc_id','hinhanh', 'tacgia', 'theloai_id', 'view','tukhoa', 'created_at',
        'updated_at','sach_hot','dichgia','namxb','nxb','sotrang','file_pdf'
    ];
    protected $table='sach';
    public function danhmucsach(){
        return $this->belongsTo('App\Models\DanhmucSach','danhmuc_id','id'); //Sach có nhiều nhiều 1,n
    }
    public function theloai(){
        return $this->belongsTo('App\Models\Theloai','theloai_id','id'); //Sach có nhiều nhiều the loai 1,n
    }
    public function chapter(){
        return $this->hasMany('App\Models\Chapter','sach_id','id'); //Sach có nhiều nhiều 1,n
    }
    public function thuocnhieudanhmucsach(){
        return $this->belongsToMany(DanhmucSach::class,'thuocdanh','sach_id','danhmuc_id');
    }
    public function thuocnhieutheloaisach(){
        return $this->belongsToMany(Theloai::class,'thuocloai','sach_id','theloai_id');
    }
}
