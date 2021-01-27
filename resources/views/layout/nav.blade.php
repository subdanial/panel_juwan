<nav class="navbar navbar-expand navbar-dark bg-dark">

    @auth
    <?php    
    $view_user = json_decode(Auth::user()->no_access)->view_user;
    $view_clients = json_decode(Auth::user()->no_access)->view_clients;
    $view_category = json_decode(Auth::user()->no_access)->view_category;
    $view_products = json_decode(Auth::user()->no_access)->view_products;
    $view_orders = json_decode(Auth::user()->no_access)->view_orders;
    ?>
    @endauth


    <span class="navbar-brand">JUWAN 2.5.0 </span>

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

            @if ($view_clients == 0)
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('clients.index')}}"><i class="fas fa-user"></i>
                    مشتری ها </a>
            </li>
            @endif


            @if (auth()->user()->role == 1)
            @if ($view_user == 0)

            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('marketers.index')}}"><i class="fas fa-user-tag "></i>
                    کاربر ها </a>
            </li>

            @endif
            @endif
            @if (auth()->user()->role == 2 || auth()->user()->role == 1)
            @if ($view_category == 0)

            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('categories.index')}}"><i class="fas fa-boxes    "></i>
                    دسته بندی </a>
            </li>
            @endif
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

            @if ($view_orders == 0)

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#"><i
                        class="fa fa-list"></i> سفارشات</a>
                <div class="dropdown-menu  dropdown-menu-right rounded-0 ">
                    <a class="nav-link text-dark border-bottom" href="{{route('orders.index')}}"> <i
                            class="fas fa-briefcase"></i>

                        سفارشات اصلی </a>
                    <a class="nav-link text-dark" href="{{route('orders.index_pre_invoice')}}"> <i
                            class="fas fa-clipboard-check"></i>
                        پیش فاتکور ها</a>

                </div>
            </li>
            @endif


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
                    <a class="nav-link text-dark" href="{{route('orders.index_temporary')}}"> <i
                            class="fas fa-shopping-bag"></i>
                        سبد خرید موقت </a>

                </div>
            </li>
            @endif

            @endif
        </ul>

    </div>
</nav>