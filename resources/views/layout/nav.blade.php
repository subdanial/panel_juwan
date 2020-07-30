

<nav class="navbar navbar-expand navbar-dark bg-dark">



{{-- @if(auth()->user() && (auth()->user()->role == 1 || auth()->user()->role == 2))
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
@endif --}}

{{-- @if(auth()->user() && auth()->user()->role == 3)
<nav class="navbar navbar-expand navbar-dark bg-dark">
@endif  --}}



    <span class="navbar-brand">JUWAN 2.0.2</span>
        
    <button class="btn navbar-toggler nav-full-open">
        <span class="text-white"><i class="fas fa-th-large"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                @auth
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="nav-link text-white btn btn-link"><i class="fas fa-key"></i> خروج </button>
                </form>
                @else
                <a class="nav-link text-white" href="{{route('home')}}"><i class="fas fa-key"></i> ورود </a>
                @endauth
            </li>


            @if(auth()->user())

            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('clients.index')}}"><i class="fas fa-user"></i>
                    مشتری ها </a>
            </li>
            @if (auth()->user()->role == 1)
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('marketers.index')}}"><i class="fas fa-user-tag "></i>
                    فروشنده ها </a>
            </li>
            @endif
            @if (auth()->user()->role == 2 || auth()->user()->role == 1)
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('categories.index')}}"><i class="fas fa-boxes    "></i>
                    دسته بندی </a>
            </li>
            @endif

            @if (auth()->user()->role == 2 || auth()->user()->role == 1)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#"><i
                        class="fa fa-tshirt"></i> محصولات</a>
                <div class="dropdown-menu  dropdown-menu-right rounded-0 ">
                    <a class="nav-link text-dark border-bottom" href="{{route('products.create')}}"> <i
                            class="fa fa-plus"></i> افزودن
                        محصول </a>
                    <a class="nav-link text-dark" href="{{route('products.index')}}"> <i class="fas fa-list"></i> لیست
                        محصولات</a>
                </div>
            </li>
            @endif
            @if(auth()->user()->role == 3)

            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('orders.create')}}"><i class="fa fa-shipping-fast"
                        aria-hidden="true"></i>
                    خرید </a>
            </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#"><i
                        class="fa fa-list"></i> سفارشات</a>
                <div class="dropdown-menu  dropdown-menu-right rounded-0 ">
                    <a class="nav-link text-dark border-bottom" href="{{route('orders.index')}}"> <i
                            class="fas fa-briefcase"></i>

                        سفارشات اصلی </a>
                    <a class="nav-link text-dark" href="{{route('orders.index_pre_invoice')}}"> <i class="fas fa-clipboard-check"></i>
                         پیش فاتکور ها</a>

                </div>
            </li>
          

            @if (auth()->user()->role == 4)
            <li class="nav-item">
                <a class="nav-link text-white" href="#"><i class="fa fa-chart-pie"></i> گزارشات</a>
            </li>
            @endif
            @if(auth()->user()->role == 3)

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#"><i
                        class="fa fa-shopping-cart"></i> سبد خرید</a>
                <div class="dropdown-menu  dropdown-menu-right rounded-0 ">
                    <a class="nav-link text-dark border-bottom" href="{{route('orders.cart')}}"> <i
                            class="fas fa-shopping-cart"></i>
                      سبد خرید اصلی </a>
                    <a class="nav-link text-dark" href="{{route('orders.index_temporary')}}"> <i class="fas fa-shopping-bag"></i>
                        سبد خرید موقت </a>

                </div>
            </li>
            @endif

            @endif
        </ul>

    </div>
</nav>


{{-- <div class="nav-full">

    <div class="container-fluid">
        <div class="nav-full-close text-white">
            &times;
        </div>

        <div class="d-flex justify-content-center">

            <div class="nav-box text-center text-center border">
                @auth
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="text-white btn btn-link"><i class="fas d-block fa-key"></i> خروج </button>
                </form>
                @else
                <a class="text-white" href="{{route('home')}}"><i class="fas d-block fa-user"></i> ورود </a>
                @endauth
            </div>
            <div class="nav-box text-center border">
                <a class="text-white" href="{{route('clients.index')}}">
                    <i class="fas fa-user d-block mx-auto text-center"></i>
                    مشتری ها
                </a>
            </div>
            <div class="nav-box text-center border">
                <a class="nav-link text-white" href="{{route('marketers.index')}}"><i
                        class="fas d-block fa-user-tag"></i>
                    فروشنده ها </a>
            </div>
            <div class="nav-box text-center border">
                <a class="nav-link text-white" href="{{route('categories.index')}}"><i class="fas d-block fa-boxes"></i>
                    دسته بندی </a>
            </div>
            <div class="nav-box text-center border">
                <div class="nav-item dropdown text-center">
                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#"><i
                            class="fa d-block text-center fa-tshirt"></i> محصولات</a>
                    <div class="dropdown-menu dropdown-menu-box bg-dark  w-100 rounded-0 ">
                        <a class="nav-link  text-white text-center border-bottom" href="{{route('products.create')}}">
                            <i class="fa  fa-plus"></i> افزودن
                            محصول </a>
                        <a class="nav-link  text-white text-center" href="{{route('products.index')}}"> <i
                                class="fas fa-list"></i> لیست
                            محصولات</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="nav-box text-center border">
                <a class="nav-link text-white" href="{{route('orders.create')}}"><i class="fa d-block fa-shipping-fast"
                        aria-hidden="true"></i>
                    خرید </a>
            </div>
            <div class="nav-box text-center border">
                <div class="nav-item text-center dropdown">
                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#"><i
                            class="fa d-block fa-list"></i> سفارشات</a>
                    <div class="dropdown-menu dropdown-menu-box bg-dark w-100  rounded-0 ">
                        <a class="nav-link text-white text-center border-bottom" href="{{route('orders.index')}}"> <i
                                class="fas fa-business-time"></i>
                            سفارشات اصلی </a>
                        <a class="nav-link text-white text-center" href="#"> <i class="fas fa-clipboard-check"></i>
                            سفارشات موقت</a>
                    </div>
                </div>
            </div>
            <div class="nav-box text-center border">
                <a class="nav-link text-white" href="#"><i class="fa d-block     fa-shopping-cart" aria-hidden="true"></i> سبد خرید</a>
            </div>
            <div class="nav-box text-center border">
            </div>
            <div class="nav-box text-center border">
            </div>
        </div>


    </div>
</div> --}}
