@extends('layout.main')

@section('title', $company->name)

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>{{ $company->name }}</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li><a href="{{ route('companies') }}">الشركات</a></li>
        <li>{{ $company->name }}</li>
      </ul>
    </div>
  </div>

  <div class="container-fluid inner-page-body-container company-page-body-container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="row company-img-social-info-div">
          <div class="col-md-3">
            <div class="company-profile-img-div">
              <img src="{{ asset('img/About Us.jpg') }}">
            </div>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-8">
                <h2 class="company-profile-title">{{ $company->name }}</h2>
              </div>
              <div class="col-md-4">
                <div class="header-social-login-div company-social-div">
                  <div class="header-social-div">
                    @if($company->company->facebookLink != null)
                      <a href="{{ $company->company->facebookLink }}" target="_blank"><i
                          class="fab fa-facebook"></i></a>
                    @endif
                    @if($company->company->twitterLink != null)
                      <a href="{{ $company->company->twitterLink }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if($company->company->googlePlusLink != null)
                      <a href="{{ $company->company->googlePlusLink }}" target="_blank"><i
                          class="fab fa-google-plus"></i></a>
                    @endif
                    @if($company->company->instagramLink != null)
                      <a href="{{ $company->company->instagramLink }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h4 class="company-info-data-div">
                  <i class="fas fa-map-marker-alt"></i>
                  <span>{{ $company->address }}</span>
                </h4>
                <h4 class="company-info-data-div">
                  <i class="fas fa-phone"></i>
                  <span><a href="tel:{{ $company->phone }}">{{ $company->phone }}</a></span>
                </h4>
                @if($company->company->website)
                  <h4 class="company-info-data-div">
                    <i class="fas fa-globe"></i>
                    <span><a href="{{ $company->company->website }}" target="_blank">زياره موقع الشركه</a></span>
                  </h4>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="company-divider-hr">
          <hr>
        </div>
        <div class="row about-company-div">
          <div class="col-md-12">
            <h3 class="about-company-div-title">عن الشركه</h3>
            <div><p>{!!  $company->company->description !!}</p></div>
          </div>
        </div>
        @if(count($products) > 0)
          <div class="row company-products">
            <div>
              <h3 class="company-products-title">المنتجات</h3>
              @foreach($products as $product)
                <div class="row company-single-product-row">
                  <div class="col-md-3 company-single-product-col">
                    <div class="company-products-img-div">
                      <img src="{{ $product->image->small->url }}">
                    </div>
                  </div>
                  <div class="col-md-6 company-single-product-col company-single-product-data-col">
                    <h3 class="company-single-product-title">{{ $product->name }}</h3>
                    <div><p>{{ $product->shortDescription }}</p></div>
                    <div>
                      <a href="{{ route('product', $product->id) }}">للمزيد من التفاصيل</a>
                    </div>
                  </div>
                  <div class="col-md-3 company-single-product-col">
                    <div class="company-single-product-price-col-div">
                      <h3 class="company-single-product-price-number">{{ $product->price }}</h3>
                      <h4 class="company-single-product-price-text">جنيــها</h4>
                      <div class="company-single-product-price-btn-div">
                        <a href="{{ route('product', $product->id) }}">شراء المنتج</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
              <br>
              {{ $products->links() }}
            </div>
          </div>
        @endif

        <div class="row company-distributors hidden">
          <div>
            <h3 class="distributors-title">البحث عن موزعين</h3>
            <div class="row distributors-select-div">
              <form>
                <div class="col-md-6 col-sm-6">
                  <select class="form-control company-distributors-select">
                    <option disabled selected>اختر المحافظه</option>
                    <option value="saab">القاهره</option>
                    <option value="mercedes">الاسكندريه</option>
                    <option value="audi">الجيزه</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-6">
                  <select class="form-control company-distributors-select">
                    <option disabled selected>اختر المركز</option>
                    <option value="saab">مركز1</option>
                    <option value="mercedes">مركز2</option>
                    <option value="audi">مركز3</option>
                  </select>
                </div>
              </form>
            </div>
            <div>
              <h4>المحافظه/ المركز :طوخ</h4>
            </div>
            <div class="row company-single-distributors-row">
              <div class="col-md-6">
                <div class="company-single-distributors-col-div">
                  <h3 class="company-single-distributor-title">مكتب لاشين الحديث للدواجن</h3>
                  <p>النشاط: لدينا توكيل اعلاف الوادي كل انواع اعلاف التسمين اعلاف ارانب اعلاف بط عمل كل انواع التركيبات
                    العلف وخلطات التسمين والبياض
                  </p>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>العنوان</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p>34شارع احمد فتحي - متفرع من شارع</p>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الموبيل</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p class="distributor-mobile"><a href="tel:#">0100 0151551</a></p>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الرقم الكودي</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p> 656</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="company-single-distributors-col-div">
                  <h3 class="company-single-distributor-title">مكتب لاشين الحديث للدواجن</h3>
                  <p>النشاط: لدينا توكيل اعلاف الوادي كل انواع اعلاف التسمين اعلاف ارانب اعلاف بط عمل كل انواع التركيبات
                    العلف وخلطات التسمين والبياض
                  </p>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>العنوان</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p>34شارع احمد فتحي - متفرع من شارع</p>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الموبيل</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p class="distributor-mobile"><a href="tel:#">0100 0151551</a></p>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الرقم الكودي</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p> 656</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="company-single-distributors-col-div">
                  <h3 class="company-single-distributor-title">مكتب لاشين الحديث للدواجن</h3>
                  <p>النشاط: لدينا توكيل اعلاف الوادي كل انواع اعلاف التسمين اعلاف ارانب اعلاف بط عمل كل انواع التركيبات
                    العلف وخلطات التسمين والبياض
                  </p>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>العنوان</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p>34شارع احمد فتحي - متفرع من شارع</p>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الموبيل</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p class="distributor-mobile"><a href="tel:#">0100 0151551</a></p>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الرقم الكودي</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p> 656</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="company-single-distributors-col-div">
                  <h3 class="company-single-distributor-title">مكتب لاشين الحديث للدواجن</h3>
                  <p>النشاط: لدينا توكيل اعلاف الوادي كل انواع اعلاف التسمين اعلاف ارانب اعلاف بط عمل كل انواع التركيبات
                    العلف وخلطات التسمين والبياض
                  </p>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>العنوان</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p>34شارع احمد فتحي - متفرع من شارع</p>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الموبيل</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p class="distributor-mobile"><a href="tel:#">0100 0151551</a></p>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الرقم الكودي</p>
                    </div>
                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p> 656</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="company-single-distributors-col-div">
                  <h3 class="company-single-distributor-title">مكتب لاشين الحديث للدواجن</h3>
                  <p>النشاط: لدينا توكيل اعلاف الوادي كل انواع اعلاف التسمين اعلاف ارانب اعلاف بط عمل كل انواع التركيبات
                    العلف وخلطات التسمين والبياض
                  </p>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>العنوان</p>
                    </div>

                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p>34شارع احمد فتحي - متفرع من شارع</p>
                    </div>

                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الموبيل</p>
                    </div>

                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p class="distributor-mobile"><a href="tel:#">0100 0151551</a></p>
                    </div>

                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الرقم الكودي</p>
                    </div>

                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p> 656</p>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="company-single-distributors-col-div">
                  <h3 class="company-single-distributor-title">مكتب لاشين الحديث للدواجن</h3>
                  <p>النشاط: لدينا توكيل اعلاف الوادي كل انواع اعلاف التسمين اعلاف ارانب اعلاف بط عمل كل انواع التركيبات
                    العلف وخلطات التسمين والبياض
                  </p>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>العنوان</p>
                    </div>

                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p>34شارع احمد فتحي - متفرع من شارع</p>
                    </div>

                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الموبيل</p>
                    </div>

                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p class="distributor-mobile"><a href="tel:#">0100 0151551</a></p>
                    </div>

                  </div>
                  <div class="row">
                    <div
                      class="col-md-3 col-sm-3 col-xs-4 company-single-distributor-bold-titles bold-titles-padding-left-none">
                      <p>الرقم الكودي</p>
                    </div>

                    <div
                      class="col-md-9 col-sm-9 col-xs-8 company-single-distributor-bold-titles bold-titles-padding-right-none">
                      <p> 656</p>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="company-contact-form-div">
            <h3 class="company-contact-form-title">تواصل مع الشركه</h3>
            <hr class="company-contact-form-hr">
            <div>
              <form class="company-contact-form">
                <input class="form-control company-contact-input" placeholder="الاسم *">
                <input class="form-control company-contact-input" placeholder="الموبيل *">
                <input class="form-control company-contact-input" placeholder="البريد الالكتروني *">
                <input class="form-control company-contact-input" placeholder="افضل وقت للاتصال">
                <textarea class="form-control company-contact-input" rows="5" placeholder="الرســـالة *"></textarea>
                <button class="btn btn-warning company-contact-btn">ارســــــال</button>
              </form>
            </div>
          </div>
        </div>

        @if($company->company->latitude != null && $company->company->longitude != null)
          <div class="row">
            <div class="company-map-location">
              <h3 class="company-map-title">موقع الشركه علي الخريطه</h3>
              <div class="company-map-iframe">
                <div class="side-map" id="map" data-lat="{{ $company->company->latitude }}"
                     data-lng="{{ $company->company->longitude }}"
                     data-enable-selection="0"></div>
              </div>
            </div>
          </div>
        @endif

        @if(count($videos))
          <div class="row">
            <div class="company-product-videos-div">
              <h3 class="company-product-videos-div-title">فيديوهات خاصه بالمنتجات</h3>
              <div class="company-product-videos-big-div">
                @foreach($videos as $video)
                  <div class="company-product-video-col">
                    <a class="company-product-video-a" data-fancybox href="https://www.youtube.com/watch?v=9xwazD5SyVg">
                      <div class="video-btn-div">
                        <div class="company-product-video-img-container">
                          <div class="company-product-video-img"
                               style="background-image: url('https://img.youtube.com/vi/9xwazD5SyVg/hqdefault.jpg')">
                            <div class="company-product-video-img-shadow-div">
                              <i class="far fa-play-circle"></i>
                            </div>
                          </div>
                        </div>
                        <h3 class="company-product-video-title">فيديو خاص للاعلان عن المنتج</h3>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
  <br><br>
  <!----End Main page Body------>
@stop

@section('script')
  <script type="text/javascript">
      function initMap() {
          var lat = {{ $company->company->latitude }};
          var lng = {{ $company->company->longitude }};
          console.log(lat);
          console.log(lng);
          if (lat != null && lng != null) {
              var position = {lat: lat, lng: lng};
              var map = new google.maps.Map(document.getElementById('map'), {zoom: 17, center: position});
              var marker = new google.maps.Marker({position: position, map: map});
          }
      }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSM9Cm6DKEv9o8jDTCECJ_yfTS1YonB9k&callback=initMap"
          async defer></script>
@stop