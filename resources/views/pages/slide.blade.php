 <!------------Slide---------->

 <h3 class="sachhay">SÁCH HAY</h3>
 <style type="text/css">
       .item img {
               height: 250px;
               border: 3px solid #000;
               padding: 3px;
           }
</style>
<div class="owl-carousel owl-theme">
        @foreach($sachhay as $key => $slide )
       <div class="item"><img src="{{asset('uploads/sach/'.$slide->hinhanh)}}" alt="">
       <h4 class="sachhay-ten">{{$slide->tensach}}</h4>
       <p>
    		<a href="{{url('xem-sach/'.$slide->slug_sach)}}" class="btn btn-sm btn-danger">Đọc ngay</a>
            <i class="fas fa-eye slide-view"></i> {{$slide->view}}
        </p>
       </div>
       @endforeach
</div>