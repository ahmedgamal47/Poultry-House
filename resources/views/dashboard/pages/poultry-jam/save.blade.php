@extends('dashboard.layout.template')

@section('title',  $poultryJam ? 'تحديث مربى': 'تسجيل مربى')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">{{ $poultryJam ? 'تحديث مربى' : 'تسجيل مربى' }}</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>{{ $poultryJam ? 'تحديث المربى #' . $poultryJam->id : 'تسجيل مربى جديد' }}</h5>
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
                      action="{{ $poultryJam ? route('admin.poultry-jam.update', $poultryJam->id) : route('admin.poultry-jam.store') }}">
                  @csrf
                  {{ $poultryJam ? method_field('PUT') : null }}
                  <div class="form-group">
                    <label class="control-label col-sm-2">اسم المربى</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" placeholder="اسم المربى"
                             value="{{ old('name', optional(optional($poultryJam)->user)->name) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">البريد الالكترونى</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" placeholder="البريد الالكترونى"
                             value="{{ old('email', optional(optional($poultryJam)->user)->email) }}" required>
                    </div>
                  </div>
                  @if($poultryJam == null)
                    <div class="form-group">
                      <label class="control-label col-sm-2">كلمة المرور</label>
                      <div class="col-sm-10">
                        <input type="text" name="pass" class="form-control" placeholder="كلمة المرور"
                               value="{{ old('pass') }}" required>
                      </div>
                    </div>
                  @endif
                  <div class="form-group">
                    <label class="control-label col-sm-2">صورة المربى</label>
                    <div class="{{ $poultryJam ? 'col-sm-1 text-center' : 'hidden' }}">
                      <img src="{{ $poultryJam ? $poultryJam->user->image->thumbnail->url : null }}" class="avatar">
                    </div>
                    <div class="{{ $poultryJam ? 'col-sm-9' : 'col-sm-10' }}">
                      <input type="file" name="logo" class="form-control" {{ $poultryJam == null ? 'required' : '' }}>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">رقم الهاتف</label>
                    <div class="col-sm-10">
                      <input type="text" name="phone" class="form-control" placeholder="رقم الهاتف"
                             value="{{ old('phone', optional(optional($poultryJam)->user)->phone) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">مجال المربى</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="field" placeholder="مجال المربى" required
                             value="{{ old('field', optional($poultryJam)->field) }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">الرقم الكودى</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="code" placeholder="الرقم الكودى"
                             value="{{ old('code', optional($poultryJam)->code) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">العنوان</label>
                    <div class="col-sm-10">
                      <input type="text" name="address" class="form-control" placeholder="العنوان"
                             value="{{ old('address', optional(optional($poultryJam)->user)->address) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">نبذة عن المربى</label>
                    <div class="col-sm-10">
                      <textarea name="bio" class="form-control" placeholder="وصف مختصر عن المربى" rows="4"
                                required>{{ old('bio', optional(optional($poultryJam)->user)->bio) }}</textarea>
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
