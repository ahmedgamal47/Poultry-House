<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home') }}">بيت دواجن مصر</a>
  </div>
  <!-- /.navbar-header -->

  <ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-user">
        <li>
          <a href="#" onclick="document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out fa-fw"></i> الخــروج
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="post" class="hidden">
            @csrf
          </form>
        </li>
      </ul>
      <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
  </ul>
  <!-- /.navbar-top-links -->

  <div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
        <li>
          <a href="{{ route('admin.index') }}">
            <i class="fa fa-dashboard fa-fw"></i> الشاشة الرئيسية
          </a>
        </li>
        <li>
          <a href="{{ route('admin.config') }}">
            <i class="fa fa-dashboard fa-fw"></i>الاعدادات
          </a>
        </li>
        <li>
          <a href="{{ route('admin.category.index') }}">
            <i class="fa fa-users fa-fw"></i> التصنيفات
          </a>
        </li>
        <li>
          <a href="{{ route('admin.company.index') }}">
            <i class="fa fa-users fa-fw"></i> الشركات
          </a>
        </li>
        <li>
          <a href="{{ route('admin.product.index') }}">
            <i class="fa fa-cog fa-fw"></i> المنتجات
          </a>
        </li>
        <li>
          <a href="{{ route('admin.poultry-jam.index') }}">
            <i class="fa fa-car fa-fw"></i> المربيين
          </a>
        </li>
        <li>
          <a href="{{ route('admin.post.index') }}">
            <i class="fa fa-car fa-fw"></i> المقالات
          </a>
        </li>
        <li>
          <a href="{{ route('admin.order.index') }}">
            <i class="fa fa-car fa-fw"></i> طلبات الشراء
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
