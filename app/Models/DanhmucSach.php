<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhmucSach extends Model
{
    use HasFactory;
    public $timestamps=false;//set time to false
    protected $fillable=[
        'tendanhmuc', 'mota','kichhoat','slug_danhmuc'
    ];
    protected $table='danhmuc';
    public function sach(){
        return $this->hasMany('App\Models\Sach'); //Danh mục có nhiều sách 1,n
    }
    public function nhieusach(){
        return $this->belongsToMany(Sach::class,'thuocdanh','danhmuc_id','sach_id');
    }
}
