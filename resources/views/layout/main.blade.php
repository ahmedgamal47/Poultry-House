<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

  <title>@yield('title') | {{ Config('app.name') }}</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!------ bootstrap rtl css------>
  <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}"/>

  <!------ font awesome css ------>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <!------ sidebar css ------>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css"/>

  <!------custom --------->
  <link rel="stylesheet" href="<?php echo e(asset('css/slick.css')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(asset('css/slick-theme.css')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/animate.css')); ?>"/>

</head>
<body>

@section('header')
  <!----Start Navbar------>
  <nav class="navbar navbar-default myNavbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="{{ asset('img/logo.png') }}">
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <div class="header-social-login-div pc-div">
          <div class="header-social-div">
            <a><i class="fab fa-linkedin-in"></i></a>
            <a><i class="fab fa-twitter"></i></a>
            <a><i class="fab fa-facebook-f"></i></a>
          </div>
          <div class="header-login-div">
            @guest
              <a class="btn register-now-btn" href="{{ route('register') }}">سجل الان</a>
              <a class="btn login-btn" href="{{ route('login') }}">دخول</a>
            @endguest
            @auth
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                    <i class="fa fa-caret-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if(Auth::user()->isCompany())
                      <a class="dropdown-item" href="{{ route('company.account') }}">بيانات الحساب</a>
                      <a class="dropdown-item" href="{{ route('company.orders') }}">طلبات الشراء</a>
                    @endif
                    @if(Auth::user()->isPoultryJam())
                      <a class="dropdown-item" href="{{ route('poultry-jam.account') }}">بيانات الحساب</a>
                      <a class="dropdown-item" href="{{ route('poultry-jam.orders') }}">طلبات الشراء</a>
                    @endif
                    @if(Auth::user()->isAdmin())
                      <a class="dropdown-item" href="{{ route('admin.index') }}">لوحة التحكم</a>
                      <a class="dropdown-item" href="{{ route('admin.profile') }}">بيانات الحساب</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"
                       onclick="document.getElementById('logout-form').submit();">الخروج</a>
                  </div>
                </li>
              </ul>
            @endauth
          </div>
        </div>
        <div class="myNavbar-right">
          <ul class="nav navbar-nav navbar-right">
            <li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
              <a href="{{ route('home') }}">الرئيسيه</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'who-we-are' ? 'active' : '' }}">
              <a href="{{ route('who-we-are') }}">من نحن</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'experts' ? 'active' : '' }}">
              <a href="{{ route('experts') }}">الخبراء</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'poultry-jams' ? 'active' : '' }}">
              <a href="{{ route('poultry-jams') }}">المربيين</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'companies' ? 'active' : '' }}">
              <a href="{{ route('companies') }}">الشركات</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'products' ? 'active' : '' }}">
              <a href="{{ route('products') }}">المنتجات</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'contact-us' ? 'active' : '' }}">
              <a href="{{ route('contact-us') }}">اتصل بنا</a>
            </li>
            <li><a data-toggle="modal" data-target="#myModal"><i class="fas fa-search"></i></a></li>
          </ul>
        </div>
        <div class="header-social-login-div mobile-div">
          <div class="header-social-div">
            <a><i class="fab fa-linkedin-in"></i></a>
            <a><i class="fab fa-twitter"></i></a>
            <a><i class="fab fa-facebook-f"></i></a>
          </div>
          <div class="header-login-div">
            @guest
              <a class="btn register-now-btn" href="{{ route('register') }}">سجل الان</a>
              <a class="btn login-btn" href="{{ route('login') }}">دخول</a>
            @endguest
            @auth
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if(Auth::user()->isCompany())
                      <a class="dropdown-item" href="{{ route('company.account') }}">بيانات الحساب</a>
                      <a class="dropdown-item" href="{{ route('company.orders') }}">طلبات الشراء</a>
                    @endif
                    @if(Auth::user()->isPoultryJam())
                      <a class="dropdown-item" href="{{ route('poultry-jam.account') }}">بيانات الحساب</a>
                      <a class="dropdown-item" href="{{ route('poultry-jam.orders') }}">طلبات الشراء</a>
                    @endif
                    @if(Auth::user()->isAdmin())
                      <a class="dropdown-item" href="{{ route('admin.profile') }}">بيانات الحساب</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"
                       onclick="document.getElementById('logout-form').submit();">الخروج</a>
                  </div>
                </li>
              </ul>
            @endauth
          </div>
        </div>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content footer-mail-form nav-search-form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h2>البحث</h2>
        </div>
        <div class="modal-body nav-search-form-body">
          <form action="{{ route('products') }}">
            <input class="form-control" name="productName" placeholder="البحــث عن">
            <input type="submit" class="btn btn-orange btn-full" value="ابحـــث">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!----End Navbar------>
  <form action="{{ route('logout') }}" method="post" class="hidden" id="logout-form">
    @csrf
  </form>
@show

@yield('content')

@section('footer')
  <!----Start Footer------>
  <div class="container-fluid footer-container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="row footer-title-list">
          <h3>عناوين الرئيسيه</h3>
          <div class="col-md-3">
            <ul>
              <li>
                <a href="{{ route('home') }}">
                  <span><i class="fas fa-angle-left"></i></span>
                  <p>الرئيسية</p>
                </a>
              </li>
              <li>
                <a href="{{ route('who-we-are') }}">
                  <span><i class="fas fa-angle-left"></i></span>
                  <p>من نحن</p>
                </a>
              </li>
              <li>
                <a href="{{ route('poultry-jams') }}">
                  <span><i class="fas fa-angle-left"></i></span>
                  <p>المربيين</p>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <ul>
              <li>
                <a href="{{ route('companies') }}">
                  <span><i class="fas fa-angle-left"></i></span>
                  <p>الشركات</p>
                </a>
              </li>
              <li>
                <a href="{{ route('products') }}">
                  <span><i class="fas fa-angle-left"></i></span>
                  <p>المنتجات</p>
                </a>
              </li>
              <li>
                <a href="{{ route('contact-us') }}">
                  <span><i class="fas fa-angle-left"></i></span>
                  <p>اتصل بنا</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="footer-mail-form">
          <h2>القائمه البريديه</h2>
          <input class="form-control" placeholder="البريد الالكتروني">
          <a href="#">ارسال</a>
        </div>
      </div>
    </div>
  </div>

  <div class="">
    <div class="copyright-div">
      <h4>جميع الحقوق محفظه لدي شركه دواجن مصر</h4>
    </div>
  </div>
  <!----End Footer------>
@show

<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/wow.min.js')); ?>"></script>

<!--- bootstrap js file ------>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>

<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>

@yield('script')
</body>
</html>