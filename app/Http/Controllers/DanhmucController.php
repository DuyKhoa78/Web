<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucSach;
class DanhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmucsach=DanhmucSach::orderBy('id','DESC')->get();
        return view('admincp.danhmucsach.index')->with(compact('danhmucsach'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.danhmucsach.create');
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
            'tendanhmuc'=> 'required|unique:danhmuc|max:255',
            'slug_danhmuc'=> 'required|unique:danhmuc|max:255',
            'mota'=> 'required|max:255',
            'kichhoat'=>'required'
        ],
        [
            'tendanhmuc.unique'=> 'Tên danh mục đã tồn tại!',
            'slug_danhmuc.unique'=> 'Slug_danhmuc đã tồn tại!',
            'tendanhmuc.required'=> 'Tên danh mục phải có nhé!',
            'slug_danhmuc.required'=> 'Slug_danhmuc phải có nhé!',
            'mota.required'=> 'Mô tả phải có nhé!',
        ]
        );
        $danhmucsach = new DanhmucSach();
        $danhmucsach->tendanhmuc=$data['tendanhmuc'];
        $danhmucsach->slug_danhmuc=$data['slug_danhmuc'];
        $danhmucsach->mota=$data['mota'];
        $danhmucsach->kichhoat=$data['kichhoat'];
        $danhmucsach->save();
        return redirect()->back()->with('status','Thêm danh mục sách thành công!');
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
        $danhmuc=DanhmucSach::find($id);
        return view('admincp.danhmucsach.edit')->with(compact('danhmuc'));
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
            'tendanhmuc'=> 'required|max:255',
            'mota'=> 'required|max:255',
            'kichhoat'=>'required'
        ],
        [
            'tendanhmuc.required'=> 'Tên danh mục phải có nhé!',
            'mota.required'=> 'Mô tả phải có nhé!',
        ]
        );
        $danhmucsach =  DanhmucSach::find($id);
        $danhmucsach->tendanhmuc=$data['tendanhmuc'];
        $danhmucsach->mota=$data['mota'];
        $danhmucsach->kichhoat=$data['kichhoat'];
        $danhmucsach->save();
        return redirect()->back()->with('status','Cập nhật danh mục sách thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DanhmucSach::find($id)->delete();
        return redirect()->back()->with('status','Xóa danh mục thành công');
    }
}
