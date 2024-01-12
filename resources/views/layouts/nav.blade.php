<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @hasrole('Admin')
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Quản lí user
                    </a>
                    <ul class="dropdown-menu" aria-labelledby=  "navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('user.create')}}">Thêm user</a></li>
                        <li><a class="dropdown-item" href="{{route('user.index')}}">Liệt kê user</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Cập nhật thông tin website
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('information.create')}}">Cập nhật</a></li>
                    </ul>
                </li>
                @endhasrole
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Danh mục
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('danhmuc.create')}}">Thêm danh mục</a></li>
                        <li><a class="dropdown-item" href="{{route('danhmuc.index')}}">Liệt kê danh mục</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Thể loại
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('theloai.create')}}">Thêm thể loại</a></li>
                        <li><a class="dropdown-item" href="{{route('theloai.index')}}">Liệt kê thể loại</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sách mới
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('sach.create')}}">Thêm sách</a></li>
                        <li><a class="dropdown-item" href="{{route('sach.index')}}">Liệt kê sách</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Chương
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('chapter.create')}}">Thêm chương</a></li>
                        <li><a class="dropdown-item" href="{{route('chapter.index')}}">Liệt kê chương</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </div>
    </nav>
</div>