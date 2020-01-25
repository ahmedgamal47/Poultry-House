@extends('dashboard.layout.template')

@section('title',  $post ? 'تحديث مقال': 'إضافة مقال')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">{{ $post ? 'تحديث مقال' : 'إضافة مقال' }}</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>{{ $post ? 'تحديث المقال #' . $post->id : 'إضافة مقال جديد' }}</h5>
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
                      action="{{ $post ? route('admin.post.update', $post->id) : route('admin.post.store') }}">
                  @csrf
                  {{ $post ? method_field('PUT') : null }}
                  <div class="form-group">
                    <label class="control-label col-sm-2">عنوان المقال</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" class="form-control" placeholder="عنوان المقال"
                             value="{{ old('title', optional($post)->title) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">صورة المقال</label>
                    <div class="{{ $post ? 'col-sm-1 text-center' : 'hidden' }}">
                      <img src="{{ $post ? $post->image->thumbnail->url : null }}" class="avatar">
                    </div>
                    <div class="{{ $post ? 'col-sm-9' : 'col-sm-10' }}">
                      <input type="file" name="image" class="form-control" {{ $post == null ? 'required' : '' }}>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">المحتـــوى</label>
                    <div class="col-sm-10">
                      <textarea name="description" class="form-control" placeholder="المحتـــوى" rows="3"
                                id="description-editor"
                                required>{{ old('description', optional($post)->description) }}</textarea>
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