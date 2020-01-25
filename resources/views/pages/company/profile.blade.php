@extends('layout.main')

@section('title', 'تعديل الحساب')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>بيانات الشركة</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li><a href="{{ route('companies') }}">الشركات</a></li>
        <li>تعديل البيانات</li>
      </ul>
    </div>
  </div>

  <!----End Main page Body------>

  <div class="container-fluid inner-page-body-container company-page-body-container-fluid">
    <div class="row">
      <h3 class="edit-page-container-title">تعديل البيانات</h3>
      <div class="col-sm-3">
        <ul class="nav nav-tabs tabs-left edit-page-tabs-left" role="tablist">
          <li role="presentation" class="{{ $tab == 'info' ? 'active' : '' }}">
            <a href="#comapnyInfo" aria-controls="comapnyInfo" role="tab" data-toggle="tab">
              <i class="fas fa-clipboard-list"></i><span>البيانات الرئيسيه</span>
            </a>
          </li>
          <li role="presentation" class="{{ $tab == 'products' ? 'active' : '' }}">
            <a href="#products" aria-controls="products" role="tab" data-toggle="tab">
              <i class="fas fa-box"></i><span>المنتجات</span>
            </a>
          </li>
          <li role="presentation" class="{{ $tab == 'videos' ? 'active' : '' }}">
            <a href="#videos" aria-controls="videos" role="tab" data-toggle="tab">
              <i class="fas fa-video"></i><span>الفيديوهات</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="col-sm-9">
        <div class="tab-content edit-page-tab-content">
          <div role="tabpanel" class="tab-pane fade {{ $tab == 'info' ? 'in active' : '' }}" id="comapnyInfo">
            <form action="{{ route('company.update-info') }}" method="post" enctype="multipart/form-data">
              @csrf
              <h3 class="content-tab-title">البيانات الرئيسيه</h3>
              <hr class="content-tab-title-hr">

              @if (($message = Session::get('success')) && $tab == 'info')
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $message }}</strong>
                </div>
              @elseif( $errors->any() && $tab == 'info')
                <div class="alert alert-danger">
                  @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                  @endforeach
                </div>
              @endif

              <div class="company-logo-div">
                <h3 class="company-logo-img-title">شعار الشركه</h3>
                <div class="company-logo-img-div">
                  <img id="previewLogo" class="company-logo-img img-responsive"
                       src="{{ $company->image->small->url }}">
                </div>
                <div class="company-logo-img-btns-div">
                  <input id="companyLogoImgInput" name="logo" type="file" onchange="readURLcompanyLogoImgInpu(this);"/>
                  <label for="companyLogoImgInput" class="btn btn-default change-btn">تعديل</label>
                </div>
              </div>
              <hr class="content-tab-title-hr">
              <div class="company-data-div">
                <div class="row">
                  <div class="col-md-6">
                    <div class="company-data-col-div">
                      <label>اسم الشركه</label>
                      <input class="form-control" name="name" placeholder="اسم الشركه"
                             value="{{ old('name', $company->name) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div">
                      <label for="fieldId">المجال</label>
                      <select id="fieldId" class="form-control" multiple name="categories[]" required>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', $companyCategories->pluck('id')->toArray())) ? 'selected': '' }}>
                            {{ $category->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div">
                      <label>العنوان</label>
                      <input class="form-control" name="address" placeholder="العنوان"
                             value="{{ old('address', $company->address) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div">
                      <label>موقع الشركه</label>
                      <input class="form-control" name="website" placeholder="موقع الشركه"
                             value="{{ old('website', $company->company->website) }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="company-data-col-div">
                      <label>وصف مختصر عن الشركة</label>
                      <textarea class="form-control company-phones" id="ck-editor" name="bio" rows="4"
                                placeholder="وصف مختصر عن الشركة">{{ old('bio', $company->bio) }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="company-data-col-div">
                      <label>وصف كامل عن الشركة</label>
                      <textarea class="form-control company-phones" name="description" rows="6" id="description-editor"
                                placeholder="وصف كامل عن الشركة">{{ old('description', $company->company->description) }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="company-data-col-div">
                      <label>موقع الشركة على الخريطة</label>
                      <div class="map" data-lat="{{ old('latitude', $company->latitude) }}"
                           data-lng="{{ old('longitude', $company->longitude) }}"
                           data-enable-selection="1"
                           data-latitude-input-id="company-latitude"
                           data-longitude-input-id="company-longitude"></div>
                      <input type="hidden" id="company-latitude" name="latitude"
                             value="{{ old('latitude', $company->company->latitude) }}">
                      <input type="hidden" id="company-longitude" name="longitude"
                             value="{{ old('longitude', $company->company->longitude) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div company-phones-div">
                      <label>الهاتف</label>
                      <input class="form-control company-phones" name="phone" placeholder="الهاتف"
                             value="{{ old('phone', $company->phone) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div add-more-btn-div hidden">
                      <a id="addMoreCompanyData" class="btn btn-default add-more-btn">اضافه المزيد</a>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="content-tab-title-hr">
              <div class="company-data-div">
                <h3 class="company-logo-img-title">حسابات التواصل الاجتماعي</h3>
                <div class="row">
                  <div class="col-md-6">
                    <div class="company-social-data-container-div">
                      <div class="company-data-col-div company-social-div-div">
                        <label>رابط صفحة الفيس بوك</label>
                        <input type="url" class="form-control company-social" name="facebookLink"
                               placeholder="رابط صفحة الفيس بوك"
                               value="{{ old('facebookLink', $company->company->facebookLink) }}">
                      </div>
                      <div class="company-data-col-div company-social-div-div">
                        <label>رابط صفحة تويتر</label>
                        <input type="url" class="form-control company-social" name="twitterLink"
                               placeholder="رابط صفحة تويتر"
                               value="{{ old('twitterLink', $company->company->twitterLink) }}">
                      </div>
                      <div class="company-data-col-div company-social-div-div">
                        <label>رابط صفحة جوجل بلس</label>
                        <input type="url" class="form-control company-social" name="googlePlusLink"
                               placeholder="رابط صفحة جوجل بلس"
                               value="{{ old('googlePlusLink', $company->company->googlePlusLink) }}">
                      </div>
                      <div class="company-data-col-div company-social-div-div">
                        <label>رابط صفحة انستجرام</label>
                        <input type="url" class="form-control company-social" name="instagramLink"
                               placeholder="رابط صفحة انستجرام"
                               value="{{ old('instagramLink', $company->company->instagramLink) }}">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
              </div>
              <hr class="content-tab-title-hr">
              <div class="company-info-submit-btn-div">
                <button type="submit" class="btn btn-default company-info-submit-btn">حفــظ</button>
              </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane fade {{ $tab == 'products' ? 'in active' : '' }}" id="products">
            <h3 class="content-tab-title">المنتجات</h3>
            <hr class="content-tab-title-hr">
            <form action="{{ $product ? route('product.update', $product->id) : route('product.create') }}"
                  method="post" enctype="multipart/form-data">
              @csrf

              {{ $product ? method_field('PUT') : null }}

              @if (($message = Session::get('success')) && $tab == 'products')
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $message }}</strong>
                </div>
              @elseif( $errors->any() && $tab == 'products')
                <div class="alert alert-danger">
                  @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                  @endforeach
                </div>
              @endif

              <div class="company-logo-div">
                <h3 class="company-logo-img-title">صورة المنتج</h3>
                <div class="company-logo-img-div">
                  <img id="previewProduct" class="company-logo-img img-responsive"
                       src="{{ $product ? $product->image->small->url : 'https://www.healthoptimizingmanila.com/sites/default/files/sample-image_25_1.png' }}">
                </div>
                <div class="company-logo-img-btns-div">
                  <input id="companyProductImgInput" name="photo" type="file"
                         onchange="readURLcompanyProductImgInput(this);"/>
                  <label for="companyProductImgInput" class="btn btn-default change-btn">تعديل</label>
                </div>
              </div>
              <hr class="content-tab-title-hr">
              <div class="company-data-div">
                <div class="row">
                  <div class="col-md-5">
                    <div class="company-data-col-div">
                      <label>اسم المنتج</label>
                      <input class="form-control" name="name" placeholder="اسم المنتج"
                             value="{{ old("name", optional($product)->name) }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="company-data-col-div">
                      <label>السعر</label>
                      <input class="form-control" name="price" placeholder="السعر"
                             value="{{ old('price', optional($product)->price) }}" min="0"
                             required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="company-data-col-div">
                      <label for="weightTypeId">الوزن</label>
                      <div class="row">
                        <input type="number" min="0" class="form-control col-sm-4" name="weight" required
                               placeholder="الوزن" value="{{ old('weight', optional($product)->weight) }}">
                        <select id="weightTypeId" class="form-control col-sm-8" name="weightType" required>
                          <option value="" disabled selected>-- اختار نوعية الوزن --</option>
                          @foreach($weightTypes as $weightType)
                            <option
                              value="{{ $weightType['id'] }}" {{ old('weightType', optional($product)->weightType) == $weightType['id'] ? 'selected': '' }}>
                              {{ $weightType['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="company-data-col-div">
                      <label>تفاصيل المنتج</label>
                      <textarea class="form-control" name="description" placeholder="تفاصيل المنتج"
                                id="prod-description-editor"
                                rows="6">{{ old('description', optional($product)->description) }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div">
                      <label for="categoryId">تصنيف المنتج</label>
                      <select id="categoryId" class="form-control" name="categoryId" required>
                        <option value="" disabled selected>-- التصنــيف --</option>
                        @foreach($companyCategories as $category)
                          <option
                            value="{{ $category->id }}" {{ old('categoryId', optional($product)->categoryId) == $category->id ? 'selected': '' }}>
                            {{ $category->name}}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="company-data-col-div">
                      <label>مدى الصلاحية</label>
                      <input type="text" name="validity" class="form-control" placeholder="مدى الصلاحية"
                             value="{{ old('validity', optional($product)->validity) }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="company-data-col-div">
                      <label>تاريخ الانتاج</label>
                      <input type="date" name="productionDate" class="form-control" placeholder="تاريخ الانتاج"
                             value="{{ old('productionDate', optional($product)->productionDateValue) }}" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="company-data-col-div">
                      <label>دواعى الاستخدام</label>
                      <textarea class="form-control" name="usage" placeholder="دواعى الاستخدام"
                                id="usage-editor"
                                rows="6">{{ old('usage', optional($product)->usage) }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="content-tab-title-hr">
              <div class="company-info-submit-btn-div">
                <button type="submit"
                        class="btn btn-default company-info-submit-btn">{{ $product ? 'تحديث' : 'حفظ' }}</button>
                @if($product)
                  <a class="btn btn-default" href="{{ route('company.account', ['tab' => 'products']) }}">إلغاء
                    التعديل</a>
                @endif
              </div>
            </form>
            <hr class="content-tab-title-hr">
            @if(! $product)
              <table width="100%" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th class="narrow"></th>
                  <th>اسم النتج</th>
                  <th>السعر</th>
                  <th>الوزن</th>
                  <th class="text-center">الحالة</th>
                  <th class="narrow"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $index => $product)
                  <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                    <td class="narrow">
                      <a href="{{ route('product', $product->id) }}" target="_blank">
                        <img src="{{ $product->image->thumbnail->url }}" class="avatar">
                      </a>
                    </td>
                    <td>
                      <a href="{{ route('product', $product->id) }}" target="_blank">{{ $product->name }}</a>
                    </td>
                    <td>{{ $product->price }} جنيها</td>
                    <td>{{ $product->weight }} {{ $product->weightTypeLabel }}</td>
                    <td class="text-center">{{ $product->active ? 'مفــعل' : 'غير مفعل' }}</td>
                    <td class="narrow">
                      <div class="text-center">
                        <a class="btn btn-info"
                           href="{{ route('company.account', ['productId' => $product->id, 'tab' => 'products']) }}">
                          <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('product.activate', $product->id) }}" method="post"
                              class="inline-block">
                          @csrf
                          <input type="hidden" name="productId" value="{{ $product->id }}">
                          @if($product->active)
                            <button type="submit" class="btn btn-danger">
                              <i class="fa fa-times-circle"></i>
                            </button>
                          @else
                            <button type="submit" class="btn btn-success">
                              <i class="fa fa-check-circle"></i>
                            </button>
                          @endif
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              <br>
              <div class="text-center">
                {{ $products->appends(request()->except('page'))->appends(['tab' => 'products'])->links() }}
              </div>
            @endif
          </div>
          <div role="tabpanel" class="tab-pane fade {{ $tab == 'videos' ? 'in active' : '' }}" id="videos">
            <h3 class="content-tab-title">الفيديوهات</h3>
            <hr class="content-tab-title-hr">
            <form action="{{ route('company.video.create')}}" method="post">
              <div class="row">
                @csrf
                @if (($message = Session::get('success')) && $tab == 'videos')
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                @elseif( $errors->any() && $tab == 'videos')
                  <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                      <p>{{ $error }}</p>
                    @endforeach
                  </div>
                @endif

                <div class="col-md-9">
                  <div class="row videos-data-row">
                    <div class="col-md-6">
                      <div class="company-data-col-div">
                        <label>رابط الفيديو</label>
                        <input class="form-control" name="videoUrl" placeholder="رابط الفيديو"
                               value="{{ old('videoUrl') }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="company-data-col-div">
                        <label>اسم الفيديو</label>
                        <input class="form-control" name="videoName" placeholder="اسم الفيديو"
                               value="{{ old('videoName') }}" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="content-tab-title-hr">
              <div class="company-info-submit-btn-div">
                <button class="btn btn-default company-info-submit-btn">حفظ</button>
              </div>
            </form>
            <hr class="content-tab-title-hr">
            <table width="100%" class="table table-striped table-bordered table-hover">
              <thead>
              <tr>
                <th class="narrow"></th>
                <th>اسم الفيديو</th>
                <th>رابط الفيديو</th>
                <th class="narrow"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($videos as $index => $video)
                <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                  <td class="narrow">{{ $index + 1 }}</td>
                  <td>{{ $video->name }}</td>
                  <td><a href="{{ $video->url }}">{{ $video->url }}</a></td>
                  <td class="narrow">
                    <form action="{{ route('company.video.remove', $video->id) }}" method="post"
                          class="inline-block">
                      @csrf
                      {{ $product ? method_field('DELETE') : null }}
                      <button type="submit" class="btn btn-danger">مسج</button>
                    </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <br>
            <div class="text-center">
              {{ $videos->appends(request()->except('page'))->appends(['tab' => 'videos'])->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('script')
  <script type="text/javascript" src="{{ asset('js/sb-admin-2.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSM9Cm6DKEv9o8jDTCECJ_yfTS1YonB9k&callback=initMap"
          async defer></script>
  <script>
      var phoneCounter = 1;
      $("#addMoreCompanyData").click(function (event) {
          event.preventDefault();
          var newClass = "company-clone-phones" + phoneCounter;
          var divClass = "company-clone-phone-div" + phoneCounter;
          var removClass = "company-clone-phone-remove" + phoneCounter;
          $(".company-phones-div").append(
              '<div id="' + divClass + '">' +
              '  <input class="form-control company-phones company-clone-phones">' +
              '  <a id="' + removClass + '" class="company-clone-remove-btn">' +
              '    <i class="fas fa-minus"></i>' +
              '  </a>' +
              '</div>');
          $('.company-clone-phones').addClass(newClass);
          phoneCounter++;
      });
      $(".company-phones-div").on('click', '.company-clone-remove-btn', function (e) {
          e.preventDefault();
          $(this).parent('div').remove();
          phoneCounter--;
      });
  </script>
  <script>
      var counter = 1;
      $("#addMoreVideoData").click(function () {
          var videosNewRow = '<div class="row videos-data-row"><div class="col-md-6"> <div class="company-data-col-div"> <label>رابط الفيديو </label> <input class="form-control"> </div> </div> <div class="col-md-6"> <div class="company-data-col-div"> <label> اسم الفيديو</label> <input class="form-control company-clone-social"><span class="company-clone-remove-btn"><i class="fas fa-minus"></i></span> </div> </div> </div>';
          $(".video-data-container").append(videosNewRow);
      });
      $(".video-data-container").on('click', '.company-clone-remove-btn', function (e) {
          e.preventDefault();
          $(this).parent().parent().parent('div').remove();
      });
  </script>
  <script>
      function readURLcompanyLogoImgInpu(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#previewLogo').attr('src', e.target.result);
              };
              reader.readAsDataURL(input.files[0]);
          }
      };

      function readURLcompanyProductImgInput(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#previewProduct').attr('src', e.target.result);
              };

              reader.readAsDataURL(input.files[0]);
          }
      };
  </script>

  <script type="text/javascript">
      (function () {
          CKEDITOR.replace('description-editor', {
              contentsLangDirection: 'rtl'
          });
          CKEDITOR.replace('prod-description-editor', {
              contentsLangDirection: 'rtl'
          });
          CKEDITOR.replace('usage-editor', {
              contentsLangDirection: 'rtl'
          });
      })();
  </script>
@stop
