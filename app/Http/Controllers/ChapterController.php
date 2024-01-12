<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Sach;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapter = Chapter::with('sach')->orderBy('id', 'DESC')->get();
        return view('admincp.chapter.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sach=Sach::orderBy('id','DESC')->get();
        return view('admincp.chapter.create')->with(compact('sach'));
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
            'tieude'=> 'required|unique:chapter|max:255',
            'slug_chapter'=> 'required|unique:chapter|max:255',
            'noidung'=>'required',
            'kichhoat'=>'required',
            'sach_id'=> 'required'
        ],
        [
            'tieude.unique'=> 'Tên chương đã tồn tại!',
            'slug_chapter.unique'=> 'Slug chương đã tồn tại!',
            'tieude.required'=> 'Tên chương phải có nhé!',
            'noidung.required'=>'Nội dung phải có!',
            'slug_chapter.required'=>'Slug chương phải có!',
        ]
        );
        $chapter = new Chapter();
        $chapter->tieude=$data['tieude'];
        $chapter->slug_chapter=$data['slug_chapter'];
        $chapter->noidung=$data['noidung'];
        $chapter->sach_id=$data['sach_id'];
        $chapter->kichhoat=$data['kichhoat'];
        $chapter->save();
        return redirect()->back()->with('status','Thêm chương thành công!');
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
        $chapter=Chapter::find($id);
        $sach=Sach::orderBy('id','ASC')->get();
        return view('admincp.chapter.edit')->with(compact('sach','chapter'));
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
            'tieude'=> 'required|max:255',
            'slug_chapter'=> 'required|max:255',
            'kichhoat'=>'required',
            'sach_id'=> 'required',
            'noidung'=>'required'
        ],
        [
            'tieude.required'=> 'Tên chương phải có nhé!',
            'slug_chapter.required'=>'Slug chương phải có!',
            'noidung.required' => 'Nội dung chapter phải có nhé',
        ]
        );
        $chapter = Chapter::find($id);
        $chapter->tieude=$data['tieude'];
        $chapter->slug_chapter=$data['slug_chapter'];
        $chapter->noidung = $data['noidung'];
        $chapter->sach_id=$data['sach_id'];
        $chapter->kichhoat=$data['kichhoat'];
        $chapter->save();
        return redirect()->back()->with('status','Cập nhật chương thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('status','Xóa chương thành công');
    }
}
