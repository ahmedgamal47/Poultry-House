<!----Start Users------>
<div class="container-fluid home-users-container-fluid">
  <div class="row">
    <h3 class="home-users-title">سجل الان للحصول علي المزايا التاليه</h3>

    @if(!empty($companyServices))
      <div class="col-md-2 col-md-offset-1">
        <div class="">
          <h4 class="home-single-user-type-title">الشركات</h4>
          <div class="home-single-user-col-div">
            <div class="home-single-user-text-div">
              @foreach($companyServices as $service)
                <h4><span>{{ $service }}</span></h4>
              @endforeach
            </div>
            @guest
              <div class="home-single-user-sign-up-btn-div">
                <a href="{{ route('contact-us') }}">
                  <span>اشترك الان</span>
                  <span><i class="fas fa-plus"></i></span>
                </a>
              </div>
            @endguest
          </div>
        </div>
      </div>
    @endif

    @if(!empty($poultryJamServices))
      <div class="col-md-2">
        <div class="">
          <h4 class="home-single-user-type-title">المربيين</h4>
          <div class="home-single-user-col-div">
            <div class="home-single-user-text-div">
              @foreach($poultryJamServices as $service)
                <h4><span>{{ $service }}</span></h4>
              @endforeach
            </div>
            @guest
              <div class="home-single-user-sign-up-btn-div">
                <a href="#">
                  <span>قريبـــــا</span>
                  <span><i class="fas fa-plus"></i></span>
                </a>
              </div>
            @endguest
          </div>
        </div>
      </div>
    @endif

    @if(!empty($dealerServices))
      <div class="col-md-2">
        <div class="">
          <h4 class="home-single-user-type-title">التجار</h4>
          <div class="home-single-user-col-div">
            <div class="home-single-user-text-div">
              @foreach($dealerServices as $service)
                <h4><span>{{ $service }}</span></h4>
              @endforeach
            </div>
            @guest
              <div class="home-single-user-sign-up-btn-div">
                <a href="{{ route('register') }}">
                  <span>اشترك الان</span>
                  <span><i class="fas fa-plus"></i></span>
                </a>
              </div>
            @endguest
          </div>
        </div>
      </div>
    @endif

    @if(!empty($distributorServices))
      <div class="col-md-2">
        <div class="">
          <h4 class="home-single-user-type-title">الموزعين</h4>
          <div class="home-single-user-col-div">
            <div class="home-single-user-text-div">
              @foreach($distributorServices as $service)
                <h4><span>{{ $service }}</span></h4>
              @endforeach
            </div>
            @guest
              <div class="home-single-user-sign-up-btn-div">
                <a href="#">
                  <span>قريبـــــا</span>
                  <span><i class="fas fa-plus"></i></span>
                </a>
              </div>
            @endguest
          </div>
        </div>
      </div>
    @endif

    @if(!empty($vetServices))
      <div class="col-md-2">
        <div class="">
          <h4 class="home-single-user-type-title">الدكاتره البيطريين</h4>
          <div class="home-single-user-col-div">
            <div class="home-single-user-text-div">
              @foreach($vetServices as $service)
                <h4><span>{{ $service }}</span></h4>
              @endforeach
            </div>
            @guest
              <div class="home-single-user-sign-up-btn-div">
                <a href="#">
                  <span>قريبـــــا</span>
                  <span><i class="fas fa-plus"></i></span>
                </a>
              </div>
            @endguest
          </div>
        </div>
      </div>
    @endif

  </div>
  <br><br>
</div>
<!----End Users------>