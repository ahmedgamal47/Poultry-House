@extends('dashboard.layout.template')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">المقالات</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-6">
                <h5>جميع المقالات</h5>
              </div>
              <div class="col-md-6 text-right">
                <a href="{{ route('admin.post.create') }}" class="btn btn-success">
                  إضافة مقال جديد
                  <i class="fa fa-plus-circle fa-fw"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="well">
              <h5>البحــث بواســطة</h5>
              <form action="{{ route('admin.post.index') }}" method="get">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="keyword" placeholder="كلمة فى العنوان أو المقال"
                           value="{{ old('keyword') }}">
                  </div>
                  <div class="col-md-3">
                    <select name="status" class="form-control">
                      <option value="" selected>-- الحالة --</option>
                      <option value="1" {{ old('status') == '1' ? 'selected': '' }}>مفــعل</option>
                      <option value="0" {{ old('status') == '0' ? 'selected': '' }}>غير مفعل</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <input type="submit" class="btn btn-primary btn-block" value="البحـــث">
                  </div>
                </div>
              </form>
            </div>

            <table width="100%" class="table table-striped table-bordered table-hover">
              <thead>
              <tr>
                <th class="narrow"></th>
                <th>العنوان</th>
                <th class="text-center">الحالة</th>
                <th class="narrow"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($posts as $index => $post)
                <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                  <td class="narrow">
                    <img src="{{ $post->image->thumbnail->url }}" class="avatar">
                  </td>
                  <td>{{ $post->title }}</td>
                  <td class="text-center">{{ $post->active ? 'مفــعل' : 'غير مفعل' }}</td>
                  <td class="narrow">
                    <div class="text-center">
                      <a href="{{ route('admin.post.show', $post->id) }}" target="_blank" class="btn btn-primary">
                        <i class="fa fa-info-circle"></i>
                      </a>
                      <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      <form action="{{ route('admin.post.activate', $post->id) }}" method="post"
                            class="inline-block">
                        @csrf
                        <input type="hidden" name="postId" value="{{ $post->id }}">
                        @if($post->active)
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
            <div class="text-right">
              {{ $posts->appends(request()->except('page'))->links() }}
            </div>
          </div>
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
@endsection