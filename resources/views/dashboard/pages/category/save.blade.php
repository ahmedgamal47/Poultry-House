@extends('dashboard.layout.template')

@section('title',  $category ? 'تحديث تصنيف': 'تسجيل تصنيف')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">{{ $category ? 'تحديث شركة' : 'تسجيل شركة' }}</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>{{ $category ? 'تحديث التصنيف #' . $category->id : 'تسجيل تصنيف جديد' }}</h5>
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
                      action="{{ $category ? route('admin.category.update', $category->id) : route('admin.category.store') }}">
                  @csrf
                  {{ $category ? method_field('PUT') : null }}
                  <div class="form-group">
                    <label class="control-label col-sm-2">اسم التصنيف</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" placeholder="اسم التصنيف"
                             value="{{ old('name', optional($category)->name) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">صورة التصنيف</label>
                    <div class="{{ $category ? 'col-sm-1 text-center' : 'hidden' }}">
                      <img src="{{ $category ? $category->image->thumbnail->url : null }}" class="avatar">
                    </div>
                    <div class="{{ $category ? 'col-sm-9' : 'col-sm-10' }}">
                      <input type="file" name="image" class="form-control" {{ $category == null ? 'required' : '' }}>
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