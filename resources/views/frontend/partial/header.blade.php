<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{route('frontend.home')}}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="{{route('search.product')}}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right d-flex align-items-center justify-content-end">
    <!-- Language Selector -->
    <select onchange="window.location.href=this.value;" name="language" id="language-selector" class="form-control" style="width: auto; margin-right: 10px;">
        <option @if(session()->get('locale')=='en') selected @endif value="{{route('change.lang','en')}}">EN</option>
        <option @if(session()->get('locale')=='bn') selected @endif value="{{route('change.lang','bn')}}">BN</option>
        <option @if(session()->get('locale')=='ar') selected @endif value="{{route('change.lang','ar')}}">AR</option>
    </select>

    <!-- Shopping Cart Button -->
    <a href="{{route('cart.view')}}" class="btn border">
        <i class="fas fa-shopping-cart text-primary"></i>
        <span class="badge">
        ({{session()->get('cart') ? count(session()->get('cart')) : 0}})
        </span>
    </a>
</div>


    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">

        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="{{route('frontend.home')}}" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('frontend.home')}}" class="nav-item nav-link active">{{__('Home')}}</a>
                        <a href="shop.html" class="nav-item nav-link">{{__('About')}}</a>
                       
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{__('Catagories')}}</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                @foreach($headerCategories as $category)
                                <a href="{{route('products.under.category',$category->id)}}" class="dropdown-item">{{$category->name}}</a>

                                @endforeach
                            </div>
                        </div>
                        <a href="{{route('sendEmail')}}" class="nav-item nav-link">{{__('Contact')}}</a>
                    </div>
                    @guest('customerGuard')
                    <div class="navbar-nav ml-auto py-0">
                        <a href="{{route('customer.login')}}" class="nav-item nav-link">{{__('Login')}}</a>
                        <a href="{{route('customer.registration')}}" class="nav-item nav-link">{{__('Register')}}</a>
                        @endguest
                        @auth('customerGuard')
                        <div class="navbar-nav ml-auto py-0">
                            <a href="{{route('customer.logout')}}" class="nav-item nav-link">Logout</a>
                            <a href="{{route('customer.profile')}}" class="nav-item nav-link">Profile|{{auth('customerGuard')->user()->name}}</a>

                            @endauth


                        </div>
                    </div>
            </nav>

        </div>
    </div>
</div>