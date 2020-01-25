@extends('dashboard.layout.template')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">المنتجــات</h1>
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
                <h5>جميع المنتجات</h5>
              </div>
              <div class="col-md-6 text-right">
                <a href="{{ route('admin.product.create') }}" class="btn btn-success">
                  إضافة منتج جديد
                  <i class="fa fa-plus-circle fa-fw"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="well">
              <h5>البحــث بواســطة</h5>
              <form action="{{ route('admin.product.index') }}" method="get">
                <div class="row">
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="name" placeholder="اسم النتج"
                           value="{{ old('name') }}">
                  </div>
                  <div class="col-md-2">
                    <input type="number" min="0" class="form-control" name="minPrice" placeholder="أقل سعر"
                           value="{{ old('minPrice') }}">
                  </div>
                  <div class="col-md-2">
                    <input type="number" min="0" class="form-control" name="maxPrice" placeholder="أقصى سعر"
                           value="{{ old('maxPrice') }}">
                  </div>
                  <div class="col-md-2">
                    <select name="companyId" class="form-control">
                      <option value="" selected>-- الشركات --</option>
                      @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('companyId') == $company->id ? 'selected': '' }}>
                          {{ $company->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2">
                    <select name="status" class="form-control">
                      <option value="" selected>-- الحالة --</option>
                      <option value="1" {{ old('status') == '1' ? 'selected': '' }}>مفـعل</option>
                      <option value="0" {{ old('status') == '0' ? 'selected': '' }}>غير مفعل</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <input type="submit" class="btn btn-primary btn-block" value="البحــث">
                  </div>
                </div>
              </form>
            </div>

            <table width="100%" class="table table-striped table-bordered table-hover">
              <thead>
              <tr>
                <th class="narrow"></th>
                <th>اسم النتج</th>
                <th>السعر</th>
                <th>الشركة المقدمة للمنتج</th>
                <th>التصنيف</th>
                <th class="text-center">الحالة</th>
                <th class="narrow"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($products as $index => $product)
                <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                  <td class="narrow">
                    <img src="{{ $product->image->thumbnail->url }}" class="avatar">
                  </td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->price }} جنيهــا</td>
                  <td>{{ $product->company->name }}</td>
                  <td>{{ $product->category->name }}</td>
                  <td class="text-center">{{ $product->active ? 'مفــعل' : 'غير مفعل' }}</td>
                  <td class="narrow">
                    <div class="text-center">
                      <a href="{{ route('admin.product.show', $product->id) }}" target="_blank" class="btn btn-primary">
                        <i class="fa fa-info-circle"></i>
                      </a>
                      <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      <form action="{{ route('admin.product.activate', $product->id) }}" method="post"
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
            <div class="text-right">
              {{ $products->appends(request()->except('page'))->links() }}
            </div>
          </div>
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
@stop
