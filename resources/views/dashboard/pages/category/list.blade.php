@extends('dashboard.layout.template')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">التصنيفـــــات</h1>
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
                <h5>جميع التصنيفات</h5>
              </div>
              <div class="col-md-6 text-right">
                <a href="{{ route('admin.category.create') }}" class="btn btn-success">
                  تسجيل تصنيف جديد
                  <i class="fa fa-plus-circle fa-fw"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="well">
              <h5>البحــث بواســطة</h5>
              <form action="{{ route('admin.category.index') }}" method="get">
                <div class="row">
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="name" placeholder="اسم التصنيف"
                           value="{{ old('name') }}">
                  </div>
                  <div class="col-md-4">
                    <select name="status" class="form-control">
                      <option value="" selected>-- الحالة --</option>
                      <option value="1" {{ old('status') == '1' ? 'selected': '' }}>مفــعل</option>
                      <option value="0" {{ old('status') == '0' ? 'selected': '' }}>غير مفعل</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <input type="submit" class="btn btn-primary btn-block" value="البحـــث">
                  </div>
                </div>
              </form>
            </div>

            <table width="100%" class="table table-striped table-bordered table-hover">
              <thead>
              <tr>
                <th class="narrow"></th>
                <th>الاســم</th>
                <th>عدد الشركات</th>
                <th>عدد المنتجات</th>
                <th class="text-center">الحالة</th>
                <th class="narrow"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($categories as $index => $category)
                <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                  <td class="narrow">
                    <img src="{{ $category->image->thumbnail->url }}" class="avatar">
                  </td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->companies_count }}</td>
                  <td>{{ $category->products_count }}</td>
                  <td class="text-center">{{ $category->active ? 'مفــعل' : 'غير مفعل' }}</td>
                  <td class="narrow">
                    <div class="text-center">
                      <a href="{{ route('admin.category.show', $category->id) }}" target="_blank"
                         class="btn btn-primary">
                        <i class="fa fa-info-circle"></i>
                      </a>
                      <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      <form action="{{ route('admin.category.activate', $category->id) }}" method="post"
                            class="inline-block">
                        @csrf
                        <input type="hidden" name="categoryId" value="{{ $category->id }}">
                        @if($category->active)
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
              {{ $categories->appends(request()->except('page'))->links() }}
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