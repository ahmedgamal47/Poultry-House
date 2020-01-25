@extends('layout.main')

@section('title', 'تعديل الحساب')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>بيانات المربى</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li><a href="{{ route('poultry-jams') }}">المربيين</a></li>
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
            <a href="#poultryJamInfo" aria-controls="poultryJamInfo" role="tab" data-toggle="tab">
              <i class="fas fa-clipboard-list"></i><span>البيانات الرئيسيه</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="col-sm-9">
        <div class="tab-content edit-page-tab-content">
          <div role="tabpanel" class="tab-pane fade {{ $tab == 'info' ? 'in active' : '' }}" id="poultryJamInfo">
            <form action="{{ route('poultry-jam.update-info') }}" method="post" enctype="multipart/form-data">
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
                <h3 class="company-logo-img-title">صورة المربى</h3>
                <div class="company-logo-img-div">
                  <img id="previewLogo" class="company-logo-img img-responsive"
                       src="{{ $poultryJam->image->small->url }}">
                </div>
                <div class="company-logo-img-btns-div">
                  <input id="companyLogoImgInput" name="photo" type="file" onchange="readURLcompanyLogoImgInpu(this);"/>
                  <label for="companyLogoImgInput" class="btn btn-default change-btn">تعديل</label>
                </div>
              </div>
              <hr class="content-tab-title-hr">
              <div class="company-data-div">
                <div class="row">
                  <div class="col-md-6">
                    <div class="company-data-col-div">
                      <label>اسم المربى</label>
                      <input type="text" class="form-control" name="name" placeholder="اسم الشركه"
                             value="{{ old('name', $poultryJam->name) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div">
                      <label for="email">البريد الالكترونى</label>
                      <input type="email" id="email" class="form-control" disabled value="{{ $poultryJam->email }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div company-phones-div">
                      <label>الهاتف</label>
                      <input type="text" class="form-control company-phones" name="phone" placeholder="الهاتف"
                             value="{{ old('phone', $poultryJam->phone) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div company-phones-div">
                      <label>النشـاط</label>
                      <input type="text" class="form-control company-phones" name="field" placeholder="النشـاط"
                             value="{{ old('field', $poultryJam->poultryJam->field) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div company-phones-div">
                      <label>الرقم الكودى</label>
                      <input type="number" min="0" class="form-control company-phones" name="code"
                             placeholder="النشـاط"
                             value="{{ old('code', $poultryJam->poultryJam->code) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div company-phones-div">
                      <label>الهاتف</label>
                      <input class="form-control company-phones" name="phone" placeholder="الهاتف"
                             value="{{ old('phone', $poultryJam->phone) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="company-data-col-div">
                      <label>العنوان</label>
                      <input class="form-control" name="address" placeholder="العنوان"
                             value="{{ old('address', $poultryJam->address) }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="company-data-col-div">
                      <label>وصف كامل عن المربى</label>
                      <textarea class="form-control company-phones" name="description" rows="6" id="description-editor"
                                placeholder="وصف كامل عن المربى">{{ old('description', $poultryJam->bio) }}</textarea>
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
              <div class="company-info-submit-btn-div">
                <button type="submit" class="btn btn-default company-info-submit-btn">حفــظ</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('script')
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
  </script>

  <script type="text/javascript">
      (function () {
          CKEDITOR.replace('description-editor', {
              contentsLangDirection: 'rtl'
          });
      })();
  </script>
@stop
