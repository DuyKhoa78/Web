<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\DanhmucSach;
use App\Models\Sach;
use App\Models\Chapter;
use App\Models\Info;
use App\Models\Theloai;
use App\Models\Thuocdanh;
use App\Models\Thuocloai;
use Storage;
class IndexController extends Controller
{
    public function timkiem_ajax(Request $request){
        $data = $request->all();
        if ($data['keywords']){
            $sach = Sach::where('kichhoat',0)-> where('tensach','LIKE','%'.$data['keywords'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;">';
            foreach($sach as $key=>$st){
                $output .= '<li class="li_timkiem_ajax"><a href="' . url('xem-sach/' . $st->slug_sach) . '">' . $st->tensach . '</a></li>';
            }
            $output .='</ul>';
            echo $output;
        }
    }
    public function home(){
        $info = Info::find(1);
        $title = $info->tieude;
        //seo
        $meta_desc = $info->mota;
        $meta_keywords = 'motsach, doc sach online';
        $url_canonical = url()->current();
        $og_image = url('uploads/logo/'.$info->logo);
        $link_icon = url('uploads/logo/'.$info->logo);
        //endseo
        $sachhay = Sach::where('sach_hot',2)->take(10)->get();
        $theloai=Theloai::orderBy('id','DESC')->where('kichhoat',0)->get();
        $danhmuc=DanhmucSach::orderBy('id','ASC')->where('kichhoat',0)->get();
        $sach=Sach::orderBy('id','DESC')->where('kichhoat',0)->paginate(12);
        return view('pages.home')->with(compact('danhmuc','sach','theloai','sachhay','info','title','meta_desc','meta_keywords','url_canonical','link_icon','og_image'));
    }
    public function danhmuc($slug){
        $info = Info::find(1);

        $theloai=Theloai::orderBy('id','DESC')->where('kichhoat',0)->get();
        $danhmuc=DanhmucSach::orderBy('id','ASC')->where('kichhoat',0)->get();
        $slide_sach=Sach::with('thuocnhieudanhmucsach', 'thuocnhieutheloaisach')->orderBy('id','DESC')->where('kichhoat',0)->take(10)->get();
        $danhmuc_id=DanhmucSach::where('slug_danhmuc',$slug)->first();
        
        $danhmucsach= DanhmucSach::find($danhmuc_id->id);
        $nhiusach = [];
        foreach($danhmucsach->nhieusach as $danh){
            $nhiusach[] = $danh->id;
        }
        //seo
        $meta_desc = $danhmuc_id->mota;
        $meta_keywords = $danhmuc_id->tukhoa;
        $url_canonical = url()->current();
        $og_image = url('uploads/logo/'.$info->logo);
        $link_icon = url('uploads/logo/'.$info->logo);
        //end seo
        $title = $danhmuc_id->tendanhmuc;

    	$tendanhmuc = $danhmuc_id->tendanhmuc;
        $sach=Sach::with('thuocnhieudanhmucsach', 'thuocnhieutheloaisach')->orderBy('id','DESC')->where('kichhoat',0)->whereIn('id',$nhiusach)->paginate(12);
        return view('pages.danhmuc')->with(compact('danhmuc','sach','tendanhmuc','theloai','slide_sach', 'info','title','slide_sach','info','title','meta_desc','meta_keywords','url_canonical','link_icon','og_image'));
    }
    public function theloai($slug){
        $info = Info::find(1);
        $theloai = Theloai::orderBy('id','DESC')->where('kichhoat',0)->get();
        $danhmuc=DanhmucSach::orderBy('id','ASC')->where('kichhoat',0)->get();
        $slide_sach=Sach::with('thuocnhieudanhmucsach', 'thuocnhieutheloaisach')->orderBy('id','DESC')->where('kichhoat',0)->take(10)->get();
        $theloai_id=Theloai::where('slug_theloai',$slug)->first();
        $theloaisach = Theloai::find($theloai_id->id);
        $nhiusach = [];
        foreach($theloaisach->nhieutheloaisach as $the){
            $nhiusach[] = $the->id;
        }
        //seo
        $meta_desc = $theloai_id->mota;
        $meta_keywords = $theloai_id->tukhoa;
        $url_canonical = url()->current();
        $og_image = url('uploads/logo/'.$info->logo);
        $link_icon = url('uploads/logo/'.$info->logo);
        //end seo
    	$tentheloai = $theloai_id->tentheloai;
        $title = $theloai_id->tentheloai;

    	$sach = Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->orderBy('id','DESC')->where('kichhoat',0)->whereIn('id',$nhiusach)->paginate(12);

        return view('pages.theloai')->with(compact('danhmuc','sach','tentheloai','theloai','slide_sach','info','title','slide_sach','info','title','meta_desc','meta_keywords','url_canonical','link_icon','og_image'));
    }
    public function xemsach($slug){
        $info = Info::find(1);
        $theloai=Theloai::orderBy('id','DESC')->get();
        $danhmuc=DanhmucSach::orderBy('id','ASC')->get();
        $sach=Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->where('slug_sach',$slug)->where('kichhoat',0)->first();
        $sachnoibat = Sach::where('sach_hot',1)->take(7)->get();
        
        $nhiusach = '';
        $sachmoi=Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->orderBy('id','DESC')->where('kichhoat',0)->take(20)->get();
        foreach($sach->thuocnhieudanhmucsach as $danh){
            $nhiusach = $danh->id;
        }
        //seo
        $meta_desc = $sach->tomtat;
        $meta_keywords = $sach->tukhoa;
        $url_canonical = url()->current();
        $og_image = url('uploads/sach/'.$sach->hinhanh);
        $link_icon = url('uploads/sach/'.$sach->hinhanh);
        //end seo
        $title = $sach->tensach;
        $chapter=Chapter::with('sach')->orderBy('id','ASC')->where('sach_id',$sach->id)->get();
        $chapter_dau=Chapter::with('sach')->orderBy('id','ASC')->where('sach_id',$sach->id)->first();
        $cungdanhmuc=DanhmucSach::with('nhieusach')->where('id',$nhiusach)->take(16)->get();
        $sach->view = $sach->view+1;
        $sach->save();
        return view('pages.sach')->with(compact('danhmuc','sach','chapter','cungdanhmuc','chapter_dau','theloai','sachmoi','info','title','sachnoibat','meta_desc','meta_keywords','url_canonical','og_image','link_icon'));
    }
    public function xempdf(Request $request){
        $sach_id = $request->sach_id;
        $sach=Sach::find($sach_id);
        $output['tieude_sach']=$sach->tensach;
        $output['noidung_sach']=$sach->file_pdf;
        $sach->view = $sach->view+1;
        $sach->save();
        echo json_encode($output);
    }
    public function xemchapter($slug_sach,$slug){
        $info = Info::find(1);
        $slide_sach=Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->orderBy('id','DESC')->where('kichhoat',0)->take(10)->get();
        $theloai=Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucSach::orderBy('id','ASC')->get();
        
        $sach=Chapter::where('slug_chapter',$slug)->first();
        //breachcrumb
        $sach_breadcrumb=Sach::with('danhmucsach','theloai')->where('id',$sach->sach_id)->first();
        //end breachcrumb
        $chapter = Chapter::with(('sach'))->where('slug_chapter',$slug)->where('sach_id',$sach->sach_id)->first();
        $all_chapter=Chapter::with('sach')->orderBy('id','ASC')->where('sach_id',$sach->sach_id)->get();
        $title = $chapter->tieude;
        //seo
        $meta_desc = $chapter->tomtat;
        $meta_keywords = '';
        $url_canonical = url()->current();
        $og_image = url('uploads/sach/'.$sach_breadcrumb->hinhanh);
        $link_icon = url('uploads/sach/'.$sach_breadcrumb->hinhanh);
        //end seo
        $next_chapter=Chapter::where('sach_id',$sach->sach_id)->where("id",'>',$chapter->id)->min('slug_chapter');
        $max_id=Chapter::where('sach_id',$sach->sach_id)->orderBy('id','DESC')->first();
        $min_id=Chapter::where('sach_id',$sach->sach_id)->orderBy('id','ASC')->first();
        $previous_chapter=Chapter::where('sach_id',$sach->sach_id)->where("id",'<',$chapter->id)->max('slug_chapter');
        return view ('pages.chapter')->with(compact('danhmuc','chapter','all_chapter','next_chapter','previous_chapter','max_id','min_id','theloai','sach_breadcrumb','slide_sach','info','title','meta_desc','meta_keywords','url_canonical','link_icon','og_image'));
    }
    public function timkiem(Request $request){
        $info = Info::find(1);
        $title = 'Tìm kiếm sách';
        $data = $request->all();
        //seo
        $meta_desc = 'Tìm kiếm sách';
        $meta_keywords = 'Tìm kiếm sách';
        $url_canonical = url()->current();
        $og_image = url('uploads/logo/'.$info->logo);
        $link_icon = url('uploads/logo/'.$info->logo);
        //end seo
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc=DanhmucSach::orderBy('id','DESC')->get();
        $tukhoa = Str::slug($data['tukhoa']);
        $slide_sach = Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        $sach=Sach::with('danhmucsach','theloai')->where('tensach','LIKE','%'.$tukhoa.'%')->orWhere('tomtat','LIKE','%'.$tukhoa.'%')->orWhere('tacgia','LIKE','%'.$tukhoa.'%')->get();
        return view('pages.timkiem')->with(compact('danhmuc','sach','theloai','slide_sach','tukhoa','info','title','meta_desc','meta_keywords','url_canonical','link_icon','og_image'));
    }
    public function tag($tag){
        $info = Info::find(1);
        $title = 'Tìm kiếm tags';
        // seo
        $meta_desc = 'Tìm kiếm tags';
        $meta_keywords = 'Tìm kiếm tags';
        $url_canonical = url()->current();
        $og_image = url('uploads/logo/'.$info->logo);
        $link_icon = url('uploads/logo/'.$info->logo);
        // end seo
        
        $slide_sach = Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucSach::orderBy('id','ASC')->get();
        $tags = explode("-", $tag);
       
        $sach = Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->where(
            function ($query) use($tags) {
            for ($i = 0; $i < count($tags); $i++){
                $query->orwhere('tukhoa', 'like',  '%' . $tags[$i] .'%');
            }
            })->paginate(12);

        return view('pages.tag')->with(compact('danhmuc','sach','theloai','slide_sach','tag','info','title','meta_desc','meta_keywords','url_canonical','link_icon','og_image'));
    }
}
