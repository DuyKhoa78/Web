<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DanhmucSach;
use App\Models\Sach;
use App\Models\Theloai;
use App\Models\Thuocdanh;
use App\Models\Thuocloai;
class SachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('permission:publish articles|edit articles|delete articles|add articles',['only' => ['index','show']]);
    //     $this->middleware('permission:add articles', ['only' => ['create','store']]);
    //     $this->middleware('permission:edit articles', ['only' => ['edit','update']]);
    //     $this->middleware('permission:delete articles', ['only' => ['destroy']]);
    // }
    public function index()
    {
        $list_sach = Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->orderBy('id','DESC')->paginate(5);
        $sach = Sach::with('thuocnhieudanhmucsach','thuocnhieutheloaisach')->orderBy('id','DESC')->get();
        $count=$sach->count();
        return view("admincp.sach.index",compact('list_sach','count'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc= DanhmucSach::orderBy('id','DESC')->get();
        $theloai=Theloai::orderBy('id','DESC')->get();
        return view("admincp.sach.create")->with(compact('danhmuc','theloai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'tensach'=> 'required|unique:sach|max:255',
            'slug_sach'=> 'required|unique:sach|max:255',
            'tacgia' => 'required| unique:sach|max:255',
            'tomtat'=> 'required',
            'hinhanh'=> 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=2000',
            'kichhoat'=>'required',
            'danhmuc'=> 'required',
            'theloai'=> 'required',
            'tukhoa' => 'required',
            'sach_hot'=>'required',
            'dichgia'=>'nullable|max:30',
            'namxb' => 'required',
            'nxb'=>'required',
            'sotrang'=>'required',
            'file_pdf'=>'nullable'
        ],
        [
            'tensach.unique'=> 'Tên sách đã tồn tại!',
            'slug_sach.unique'=> 'Slug sách đã tồn tại!',
            'tensach.required'=> 'Tên sách phải có nhé!',
            'tacgia.required'=>'Tên tác giả phải có!',
            'tomtat.required'=> 'Tóm tắt sách phải có nhé!',
            'slug_sach.required'=>'Slug sách phải có!',
            'tukhoa.required' =>'Từ khóa not null',
            'hinhanh.required' =>'Hình ảnh phải có!',
            'sotrang.required' =>'Số trang phải có!',
            'nxb.required' =>'Nhà xuất bản phát hành phải có!',
            'namxb.required' =>'Nhà xuất bản phải có!',
        ]
        );
        $sach = new Sach();
        $sach->tensach=$data['tensach'];
        $sach->slug_sach=$data['slug_sach'];
        $sach->tacgia=$data['tacgia'];
        $sach->tomtat=$data['tomtat'];
        $sach->kichhoat=$data['kichhoat'];
        $sach->tukhoa=$data['tukhoa'];
        $sach->file_pdf=$data['file_pdf'];
        $sach->sach_hot=$data['sach_hot'];
        $sach->dichgia=$data['dichgia'];
        $sach->sotrang=$data['sotrang'];
        $sach->namxb=$data['namxb'];
        $sach->nxb=$data['nxb'];
        $sach->view=0;
        $sach->created_at=Carbon::now('Asia/Ho_Chi_Minh'); //Sử dụng ngày tháng theo múi gì VN
        //Thêm ảnh vào folder
        foreach($data['danhmuc'] as $key=>$danh){
            $sach->danhmuc_id=$danh[0];
        }
        foreach($data['theloai'] as $key => $the){
            $sach->theloai_id= $the[0];
        }
        $get_image= $request->hinhanh;
        $path='uploads/sach';
        $get_name_image=$get_image->getClientOriginalName(); //Lấy tên hình ảnh Eg: hinh.jpg
        $name_image=current(explode('.',$get_name_image)); //Tách tên lấy phân tên
        $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//Eg: hinh20.jpg
        $get_image->move($path,$new_image);
        $sach->hinhanh=$new_image;
        $sach->save();
        $sach->thuocnhieudanhmucsach()->attach($data['danhmuc']);
        $sach->thuocnhieutheloaisach()->attach($data['theloai']);
        return redirect()->back()->with('status','Thêm sách thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sach=Sach::find($id);
        $thuocdanhmuc = $sach->thuocnhieudanhmucsach;
        $thuoctheloai = $sach->thuocnhieutheloaisach;
        $theloai=Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucSach::orderBy('id','DESC')->get();
        return view("admincp.sach.edit")->with(compact('sach','danhmuc','theloai','thuocdanhmuc','thuoctheloai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'tensach'=> 'required|max:255',
            'slug_sach'=> 'required|max:255',
            'tacgia'=> 'required|max:30',
            'tomtat'=> 'required',
            'kichhoat'=>'required',
            'danhmuc'=> 'required',
            'view' => 'required',
            'theloai'=>'required',
            'tukhoa'=>'required',
            'sach_hot'=>'required',
            'hinhanh'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=2000',
            'dichgia'=>'nullable|max:30',
            'namxb' => 'required',
            'nxb'=>'required',
            'sotrang'=>'required',
            'file_pdf'=>'nullable'
        ],
        [
            'tensach.required'=> 'Tên sách phải có nhé!',
            'tomtat.required'=> 'Tóm tắt sách phải có nhé!',
            'slug_sach.required'=>'Slug sách phải có!',
            'tacgia.required'=>'Tên tác giả phải có!',
            'tukhoa.required' =>'Từ khóa not null!',
            'view.required' =>'Lượt xem not null!',
            'nxb.required'=>'Năm xuất bản phải có!',
            'namxb.required'=>'Năm xuất bản phải có!',
            'sotrang.required'=>'Số trang phải có!'
        ]
        );
        $sach = Sach::find($id);
        $sach->thuocnhieudanhmucsach()->sync($data['danhmuc']);
        $sach->thuocnhieutheloaisach()->sync($data['theloai']);
        $sach->tensach=$data['tensach'];
        $sach->slug_sach=$data['slug_sach'];
        $sach->tacgia=$data['tacgia'];
        $sach->tomtat=$data['tomtat'];
        $sach->kichhoat=$data['kichhoat'];
        $sach->danhmuc_id=$data['danhmuc'];
        $sach->theloai_id=$data['theloai'];
        $sach->tukhoa=$data['tukhoa'];
        $sach->dichgia=$data['dichgia'];
        $sach->sotrang=$data['sotrang'];
        $sach->file_pdf=$data['file_pdf'];
        $sach->namxb=$data['namxb'];
        $sach->nxb=$data['nxb'];
        $sach->view=$data['view'];
        $sach->sach_hot=$data['sach_hot'];
        foreach($data['danhmuc'] as $key=>$danh){
            $sach->danhmuc_id=$danh[0];
        }
        foreach($data['theloai'] as $key => $the){
            $sach->theloai_id= $the[0];
        }
        $sach->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
        //Thêm ảnh vào folder
        $get_image= $request->hinhanh;
        if ($get_image){
            $path="uploads/sach".$sach->hinhanh;
            if (file_exists($path)){
                unlink($path.$sach->hinhanh);
            }
            $path='uploads/sach';
            $get_name_image=$get_image->getClientOriginalName(); //Lấy tên hình ảnh Eg: hinh.jpg
            $name_image=current(explode('.',$get_name_image)); //Tách tên lấy phân tên
            $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//Eg: hinh20.jpg
            $get_image->move($path,$new_image);
            $sach->hinhanh=$new_image;
        }
        $sach->save();
        return redirect()->back()->with('status','Cập nhật sách thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sach=Sach::find($id);
        $path="uploads/sach".$sach->hinhanh;
        if (file_exists($path)){
            unlink($path.$sach->hinhanh);
        }
        $sach->thuocnhieudanhmucsach()->detach($sach->danhmuc_id);
        $sach->thuocnhieutheloaisach()->detach($sach->theloai_id);
        Sach::find($id)->delete();
        return redirect()->back()->with('status','Xóa sách thành công');
    }
    public function sach_hot(Request $request){
        $data = $request->all();
        $sach = Sach::find($data['sach_id']);
        $sach->sach_hot = $data['sachnoibat'];
        $sach->save();
    }
}
