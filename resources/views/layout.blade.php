<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="description" content="{{$meta_desc}}"/>
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="index, follow"> 
    <link rel="canonical" href="{{$url_canonical}}" />
    <!------Share------->
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$title}}" />
    <meta property="og:description" content="{{$meta_desc}}" />
    @if($og_image != '')
        <meta property="og:image" content="{{$og_image}}" />
    @endif
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:site_name" content="Motsach.com"/>
    @if($link_icon != '')
        <link rel="icon" href="{{$link_icon}}" type="image/gif" sizes="20x20">
    @endif
    <title>{{$title}}</title>
    <!-- Styles -->
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">

    <style type="text/css">
        h5{
            font-weight: bold;
            line-height: 25px;
        }
        .switch_color{
            background:#333;
            color:#fff;
        }
        .switch_color_light{
            background: #333 !important;
            color: #333;
        }
        .nodung_color{
            color: #333;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    {{-- Boxicon link --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
    <!------------Menu---------->
    <div class="nav-container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light none-background" style="padding: 0">
                {{-- <div class="container-fluid"> --}}
                    <a href="{{url('/')}}"><img alt="Logo" src="{{asset('uploads/logo/LOGO2.png')}}" width="250px"></a>
                    <style>
                        ul.navbar-nav.mr-auto li a{
                            font-size:20px;
                        }
                        .card.mb-3.box-shadow img{
                            height: 320px;
                            border:3px solid #000;
                            padding: 5px;
                        }
                        .item h5{
                            margin: 10px 0;
                        }
                    </style>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" aria-current="page" href="{{url('/')}}">Trang chủ<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-list-ul"></i> Danh mục
                                </a>
                                <ul class="dropdown-menu list1" aria-labelledby="navbarDropdown">
                                    {{-- <script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://iclickcdn.com/tag.min.js',423051, document.body || document.documentElement)</script> --}}
                                    @foreach($danhmuc as $key =>$danh)
                                        <li class="item-list1"><a class="dropdown-item " href="{{url('danh-muc/'.$danh->slug_danhmuc)}}"> {{$danh->tendanhmuc}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item dropdown list">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-tags"></i> Thể loại</a>
                                <ul class="dropdown-menu">
                                    {{-- <script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://iclickcdn.com/tag.min.js',423051, document.body || document.documentElement)</script> --}}
                                    
                                    @foreach($theloai as $key =>$loai)
                                        <a class="dropdown-item item-list" href="{{url('the-loai/'.$loai->slug_theloai)}}"> {{$loai->tentheloai}}</a>
                                    @endforeach
                                </ul>
                            </li>
                            <li style="display:flex; justify-content: center; align-items: center; cursor: pointer;">
                                <form class="form-icon" autocomplete="off" action="">
                                            
                                            <script>
                                                if(localStorage.getItem("switch_color") == null) {
                                                    document.querySelector('.form-icon').innerHTML = `<i class="fa-solid fa-sun icon sun none-icon"></i>
                                                    <i class="fa fa-moon icon moon"></i>`
                                                } else {
                                                    document.querySelector('.form-icon').innerHTML = `<i class="fa-solid fa-sun icon sun"></i>
                                                    <i class="fa fa-moon icon moon none-icon"></i>`
                                                }
                                            </script>
                                </form>
                            </li>
                        </ul>
                        <form autocomplete="off" id="search-box" class="d-flex" action="{{url('tim-kiem')}}" method="POST">
                            @csrf
                            <input class="search-text" type="search" id="keywords" name="tukhoa" placeholder="Tìm kiếm sách, tác giả...." aria-label="Search" required>
                            <div class="menu-search" id="search_ajax"></div>
                            <button class="search-btn my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
            </nav>
        </div>
        <!-- Slide -->
        @yield('slide')
        <!------------Sách mới---------->
        @yield('content')
        <footer>
            <div class="row ft-container">
                    <div class="col footer-content">
                         <img clas="logo2" src="{{asset('uploads/logo/LOGO2.png')}}" alt="logo2" style="margin-bottom: 30px;" width="250px">
                         <p>{{$info->tieude_footer}}</p>
                    </div>
                    <div class="col footer-content">
                        <h3>Sách mới <div class="underline"><span></span></div> </h3>
                        <li><a href="{{url('danh-muc/ton-giao-va-tam-linh')}}">Sách tôn giáo</a></li>
                        <li><a href="{{url('danh-muc/phap-luat')}}">Sách pháp luật</a></li>
                        <li><a href="{{url('danh-muc/y-hoc-va-suc-khoe')}}">Sách y học</a></li>
                        <li><a href="{{url('danh-muc/self-help-va-phat-trien-ban-than')}}">Sách self-help</a></li>
                        <li><a href="{{url('danh-muc/sach-thieu-nhi')}}">Sách thiếu nhi</a></li>
                    </div>
                    <div class="col footer-content">
                        <h3>Thông tin <div class="underline"><span></span></div> </h3>
                        <p class="email-id">motsach@gmail.com</p>
                        <p><i class='bx bxs-phone-call'></i> 84+ - 0866.222.900</p>
                        <li><a href="#">Điều khoản sử dụng</a></li>
                        <li><a href="">Vấn đề bản quyền</a></li>
                        <li><a href="">Chính sách bảo mật</a></li>
                    </div>
                    <div class="col footer-content">
                        <h3>Newsletter <div class="underline"><span></span></div></h3>
                        <form class="f-footer" action="">
                            <i class="fa-solid fa-envelope"></i>
                            <input class="f-input" type="email" name="" id="" placeholder="Enter your email id" required>
                            <button class="f-btn" type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                        </form>
                        <div class="social-icons">
                            <a href=""><i class='bx bxl-facebook-circle'></i></a>
                            <a href=""><i class='bx bxl-twitter'></i></a>
                            <a href=""><i class='bx bxl-instagram'></i></a>
                            <a href="https://www.youtube.com/channel/UCqZsLb1UZJ9SJlZmF-puo1w" target="_blank"><i class='bx bxl-youtube'></i></a>
                        </div>
                    </div>  
            </div>
            <hr class="f-hr">
            <div class="bottom-bar">
                <p><span>{{$info->copyright}}</span> - All Rights Reserved</p>
            </div>
        </footer>
    </div>
    {{-- JS --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script>
       
    </script>
    <script type="text/javascript">
        $(document).on('click','.xempdf',function(){
            var sach_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/xem-pdf')}}',
                method:"POST",
                dataType:"JSON",
                data:{sach_id:sach_id,_token:_token},
                success:function(data){
                    $('#tieude_sach').html(data.tieude_sach);
                    $('#noidung_sach').html(data.noidung_sach);
                }
            }); 
        });
    </script>
   <script>
        show_wishlist();
    
        function show_wishlist() {
            if (localStorage.getItem('wishlist_sach') != null) {
                var data = JSON.parse(localStorage.getItem('wishlist_sach'));
                data.reverse();
                for (i = 0; i < data.length; i++) {
                    var title = data[i].title;
                    var img = data[i].img;
                    var id = data[i].id;
                    var url = data[i].url;
                    $('#yeuthich').append(`
                    <div class="row mt-2">
                        <div class="col-md-5">
                            <img class="img img-responsive" width="100%" class="card-img top" src="${img}" alt="${title}">
                        </div>
                        <div class="col-md-7 sidebar">
                            <a href="${url}">
                                <p>${title}</p>
                            </a>
                        </div>
                    </div>
                    `);
                }
            }
        }
    
        $('.btn-thich_sach').click(function () {
            $('.fa .fa-heart').css('color', '#fac');
            const id = $('.wishlist_id').val();
            const title = $('.wishlist_title').val();
            const img = $('.card-img-top').attr('src');
            const url = $('.wishlist_url').val()
            const item = {
                'id': id,
                'title': title,
                'img': img,
                'url': url,
            }
            if (localStorage.getItem('wishlist_sach') == null) {
                localStorage.setItem('wishlist_sach', '[]');
            }
            var old_data = JSON.parse(localStorage.getItem('wishlist_sach'));
            var matches = $.grep(old_data, function (obj) {
                return obj.id == id;
            })
            if (matches.length) {
                alert('Sách đã có trong danh sách yêu thích');
            } else {
                if (old_data.length <= 5) {
                    old_data.push(item);
                } else {
                    // alert('Đã đạt tới giới hạn lưu ưu thích');
                    old_data.shift();
                    old_data.push(item);
                }
                $('#yeuthich').append(`
                <div class="row mt-2">
                    <div class="col-md-5">
                        <img class="img img-responsive" width="100%" class="card-img-top" src="${img}" alt="${title}">
                    </div>
                    <div class="col-md-7 sidebar">
                        <a href ="${url}">
                            <p style="color:#666">${title}</p>
                        </a>
                    </div>
                </div>
                `);
                localStorage.setItem('wishlist_sach', JSON.stringify(old_data));
                alert('Đã lưu vào danh sách truyện yêu thích');
            }
            localStorage.setItem('wishlist_sach', JSON.stringify(old_data));
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            if (localStorage.getItem('switch_color')!==null){
                const data = localStorage.getItem('switch_color');
                const data_obj = JSON.parse(data);
                $(document.body).addClass(data_obj.class_1);
                $('.album').addClass(data_obj.class_2);
                $('.card-body').addClass(data_obj.class_1);
                $('ul.muclucsach > li > a').css('color','#fff');
                $('.sidebar > a').css('color','#fff');
                $("select option[value='den']").attr("selected","selected");
            }
        })
        $(".icon").click(function() {
            const moon = document.querySelector(".moon")
            const sun = document.querySelector(".sun")
            if(moon.classList.length == 4) {
                moon.classList.add("none-icon")
                sun.classList.remove('none-icon')
            } else {
                moon.classList.remove("none-icon")
                sun.classList.add("none-icon")
            }
            
            $(document.body).toggleClass('switch_color');
            $('.album').toggleClass('switch_color_light');
            $('.card-body').toggleClass('switch_color');
            $('.noidungchuong').addClass('noidung_color');
            $('ul.muclucsach > li >a').css('color','#fff');
            $('.sidebar > a').css('color','#fff');
            $('.breadcrumb-item > a').css('color','#fff');
            $('.breadcrumb-item.active').css('color','#fff');

            document.documentElement.style.setProperty('--bs-secondary-color', '#fff !important')
            $('.nav1-container').addClass('dis-tran')

            if(moon.classList.length == 5){
                var item = {
                    'class_1':'switch_color',
                    'class_2':'switch_color_light'
                }
                localStorage.setItem('switch_color',JSON.stringify(item));
            }
            else if (moon.classList.length  == 4){
                localStorage.removeItem('switch_color');
                $('ul.muclucsach > li > a').css('color','#000');
                $('.breadcrumb-item > a').css('color','#333');
                $('.breadcrumb-item.active').css('color','#333');   
                $('.nav1-container').removeClass('dis-tran')
            }
        })
    </script>
    <script type = "text/javascript" >
        $(document).ready(function() {
            var color = $('#change-color :selected').val();
            var font = $('#change-font :selected').val();
            var lineheight = $('#change-lineheight :selected').val();
            if (localStorage.getItem("chapter_style") === null) {
                $('.noidungchuong').css({
                    'background': '#fff',
                    'line-height': '40px',
                    'font-size': '25px',
                    'font-family': '"Palatino Linotype","Arial"'
                });
            } else if (localStorage.getItem("chapter_style") !== null) {
                const data = localStorage.getItem('chapter_style');
                const data_obj = JSON.parse(data);
                $("select option[value='" + data_obj.color + "']").attr("selected", "selected");
                $("select option[value='" + data_obj.font + "']").attr("selected", "selected");
                $("select option[value='" + data_obj.lineheight + "']").attr("selected", "selected");
                $('.noidungchuong').css({
                    'background': '#' + data_obj.color,
                    'line-height': data_obj.lineheight + 'px',
                    'font-family': data_obj.font,
                    'font-size': data_obj.font_size 
                });
            }
            $('#change-color,#change-font,#change-lineheight').on('change', function() {
                var color = $('#change-color :selected').val();
                var font = $('#change-font :selected').val();
                var lineheight = $('#change-lineheight :selected').val();
                //localstorage
                localStorage.setItem('chapter_style', '[]');
                var newItem = {
                    'color': color,
                    'font': font,
                    'lineheight': lineheight,
                    'font_size': 25,
                }
                localStorage.setItem('chapter_style', JSON.stringify(newItem));
                // var old_data = JSON.parse(localStorage.getItem('chapter_style'));
                const data = localStorage.getItem('chapter_style');
                const data_obj = JSON.parse(data);
                if (color != '' || font != '' || lineheight != '') {
                    $('.noidungchuong').css({
                        'background': '#' + data_obj.color,
                        'line-height': data_obj.lineheight + 'px',
                        'font-family': data_obj.font,
                        'font-size': data_obj.font_size
                         
                    });
                }
            });
            var $affectedElements = $('.noidungchuong');
            $('.size-increment').click(function() {
                changeFontSize(2);
            })
            $('.size-decrement').click(function() {
                changeFontSize(-2);
            })
            $(".size-orig").click(function() {
                $affectedElements.each(function() {
                    var $this = $(this);
                    $this.css("font-size", $('.size-orig').data('orig_size'));
                    // Get the existing data
                });
                if (localStorage.getItem("chapter_style") === null) {
                    var newItem = {
                        'color': color,
                        'font': font,
                        'lineheight': lineheight,
                        'font_size': parseInt($('.size-orig').data('orig_size'))
                        
                    }
                } else if (localStorage.getItem("chapter_style") !== null) {
                    const data = localStorage.getItem('chapter_style');
                    const data_obj = JSON.parse(data);
                    var newItem = {
                        'color': data_obj.color,
                        'font': data_obj.font,
                        'lineheight': data_obj.lineheight,
                        'font_size': parseInt($('.size-orig').data('orig_size'))
                        
                    }
                }                
                // Save back to localStorage
                localStorage.setItem('chapter_style', JSON.stringify(newItem));
            })
            function changeFontSize(direction) {
                $affectedElements.each(function() {
                    var $this = $(this);
                    $this.css("font-size", parseInt($this.css("font-size")) + direction);
                    // Get the existing data
                });
                if (localStorage.getItem("chapter_style") === null) {
                    var newItem = {
                        'color': color,
                        'font': font,
                        'lineheight': lineheight,
                        'font_size': parseInt($affectedElements.css("font-size")) + direction
                        
                    }
                } else if (localStorage.getItem("chapter_style") !== null) {
                    const data = localStorage.getItem('chapter_style');
                    const data_obj = JSON.parse(data);
                    var newItem = {
                        'color': data_obj.color,
                        'font': data_obj.font,
                        'lineheight': data_obj.lineheight,
                        'font_size': parseInt($affectedElements.css("font-size")) + direction
                       
                    }
                }
    
    
                // Save back to localStorage
                localStorage.setItem('chapter_style', JSON.stringify(newItem));
    
            }
    
        })
    
        </script>
    <script type="text/javascript">
        $('#keywords').keyup(function(){
            var keywords = $(this).val();
            if(keywords != ''){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/timkiem-ajax')}}",
                    method: "POST",
                    data:{keywords:keywords,_token:_token},
                    success:function(data){
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
            });
            }else{
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click','.li_timkiem_ajax', function(){
            $('#keywords').vaul($(this).text());
            $('#search_ajax').fadeOut();
                
        });
    </script>
    <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        // nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
        600:{
            items:3
            },
        1000:{
            items:5
            }
        }
    })
    </script>
    <script>$('.select-chapter').on('change', function(){
        var url = $(this).val();
        if(url){
            window.location = url;
        }
        return false;
    });
    current_chapter();
    function current_chapter(){
        var url = window.location.href;
        $('.select-chapter option[value="'+url+'"]').attr("selected", true);
    }
    </script>
     <script type="text/javascript">
        $('.select-chapter').on('change',function(){
           $('.waiting').text('Đang chuyển chương vui lòng chờ xíu....');
           var url = $(this).val();
           if(url){
             window.location = url;
           }
           return false;
        });
        current_chapter();
        function current_chapter(){
           var url  = window.location.href; 
           $('.select-chapter').find('option[value="'+url+'"]').attr("selected",true);
        }
      </script>
    <script type="text/javascript">
        $(".xemmucluc").click(function() {
           $('html, body').animate({
               scrollTop: $(".muclucsach").offset().top
           }, 1000);
       });
      </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="LU16yXU8"></script>
</body>
</html>

