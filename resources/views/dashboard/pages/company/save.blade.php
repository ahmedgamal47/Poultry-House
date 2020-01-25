@extends('dashboard.layout.template')

@section('title',  $company ? 'تحديث شركة': 'تسجيل شركة')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">{{ $company ? 'تحديث شركة' : 'تسجيل شركة' }}</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>{{ $company ? 'تحديث الشركة #' . $company->id : 'تسجيل شركة جديدة' }}</h5>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                @if( $errors->any() )
                  <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                      <p>{{ $error }}</p>
                    @endforeach
                  </div>
                @endif

                <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data"
                      action="{{ $company ? route('admin.company.update', $company->id) : route('admin.company.store') }}">
                  @csrf
                  {{ $company ? method_field('PUT') : null }}
                  <div class="form-group">
                    <label class="control-label col-sm-2">اسم الشركة</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" placeholder="اسم الشركة"
                             value="{{ old('name', optional(optional($company)->user)->name) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">البريد الالكترونى</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" placeholder="البريد الالكترونى"
                             value="{{ old('email', optional(optional($company)->user)->email) }}" required>
                    </div>
                  </div>
                  @if($company == null)
                    <div class="form-group">
                      <label class="control-label col-sm-2">كلمة المرور</label>
                      <div class="col-sm-10">
                        <input type="text" name="pass" class="form-control" placeholder="كلمة المرور"
                               value="{{ old('pass') }}" required>
                      </div>
                    </div>
                  @endif
                  <div class="form-group">
                    <label class="control-label col-sm-2">شعار الشركة</label>
                    <div class="{{ $company ? 'col-sm-1 text-center' : 'hidden' }}">
                      <img src="{{ $company ? $company->user->image->thumbnail->url : null }}" class="avatar">
                    </div>
                    <div class="{{ $company ? 'col-sm-9' : 'col-sm-10' }}">
                      <input type="file" name="logo" class="form-control" {{ $company == null ? 'required' : '' }}>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">رقم الهاتف</label>
                    <div class="col-sm-10">
                      <input type="text" name="phone" class="form-control" placeholder="رقم الهاتف"
                             value="{{ old('phone', optional(optional($company)->user)->phone) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">العنوان</label>
                    <div class="col-sm-10">
                      <input type="text" name="address" class="form-control" placeholder="العنوان"
                             value="{{ old('address', optional(optional($company)->user)->address) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">الوصف المختصر</label>
                    <div class="col-sm-10">
                      <textarea name="bio" class="form-control" placeholder="وصف مختصر عن الشركة" rows="3"
                                required>{{ old('bio', optional(optional($company)->user)->bio) }}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">الوصف الكامل</label>
                    <div class="col-sm-10">
                      <textarea name="description" class="form-control" placeholder="الوصف الكامل عن الشركة" rows="6"
                                id="description-editor"
                                required>{{ old('description', optional($company)->description) }}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="categories">مجال الشركة</label>
                    <div class="col-sm-10">
                      <select id="categories" class="form-control" name="categories[]" multiple required>
                        @foreach($categories as $category)
                          <option
                            value="{{ $category->id }}" {{ in_array($category->id, old('categories', $company ? $company->user->categories : [])) ? 'selected': '' }}>
                            {{ $category->name}}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">موقع الشركة الالكترونى</label>
                    <div class="col-sm-10">
                      <input type="url" name="website" class="form-control" placeholder="Website"
                             value="{{ old('website', optional($company)->website) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">موقع الشركة على الخريطة</label>
                    <div class="col-sm-10">
                      <div class="map" data-lat="{{ old('latitude', optional($company)->latitude) }}"
                           data-lng="{{ old('longitude', optional($company)->longitude) }}"
                           data-enable-selection="{{ $company ? '0' : '1' }}"
                           data-latitude-input-id="company-latitude"
                           data-longitude-input-id="company-longitude"></div>
                      <input type="hidden" id="company-latitude" name="latitude"
                             value="{{ old('latitude', optional($company)->latitude) }}">
                      <input type="hidden" id="company-longitude" name="longitude"
                             value="{{ old('longitude', optional($company)->longitude) }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">رابط صفحة الفيس بوك</label>
                    <div class="col-sm-10">
                      <input type="url" name="facebookLink" class="form-control" placeholder="Facebook Link"
                             value="{{ old('facebookLink', optional($company)->facebookLink) }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">رابط صفحة تويتر</label>
                    <div class="col-sm-10">
                      <input type="url" name="twitterLink" class="form-control" placeholder="Twitter Link"
                             value="{{ old('twitterLink', optional($company)->twitterLink) }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">رابط صفحة جوجل بلس</label>
                    <div class="col-sm-10">
                      <input type="url" name="googlePlusLink" class="form-control" placeholder="Google Plus Link"
                             value="{{ old('googlePlusLink', optional($company)->googlePlusLink) }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">رابط صفحة انستجرام</label>
                    <div class="col-sm-10">
                      <input type="url" name="instagramLink" class="form-control" placeholder="Instagram Link"
                             value="{{ old('instagramLink', optional($company)->instagramLink) }}">
                    </div>
                  </div>
                  <br><br>
                  <div class="form-group">
                    <div class="col-sm-12 text-right">
                      <button type="submit" class="btn btn-primary">
                        حــــفظ
                        <i class="fa fa-check fa-fw"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  <script type="text/javascript">
      (function () {
          CKEDITOR.replace('description-editor', {
              contentsLangDirection: 'rtl'
          });
      })();
  </script>
@stop