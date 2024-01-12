<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps=false;//set time to false
    protected $fillable=[
        'sach_id', 'tieude','kichhoat','noidung','slug_chapter'
    ];
    protected $table='chapter';
    public function sach(){
        return $this->belongsTo('App\Models\Sach');
    }
    
}
