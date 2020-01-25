@extends('dashboard.layout.template')

@section('title',  $product ? 'تحديث منتج': 'إضافة منتج')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">{{ $product ? 'تحديث منتج' : 'إضافة منتج' }}</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>{{ $product ? 'تحديث المنتج #' . $product->id : 'إضافة منتج جديد' }}</h5>
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
                      action="{{ $product ? route('admin.product.update', $product->id) : route('admin.product.store') }}">
                  @csrf
                  {{ $product ? method_field('PUT') : null }}
                  <div class="form-group">
                    <label class="control-label col-sm-2">اسم المنتج</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" placeholder="اسم المنتج"
                             value="{{ old('name', optional($product)->name) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">صورة المنتج</label>
                    <div class="{{ $product ? 'col-sm-1 text-center' : 'hidden' }}">
                      <img src="{{ $product ? $product->image->thumbnail->url : null }}" class="avatar">
                    </div>
                    <div class="{{ $product ? 'col-sm-9' : 'col-sm-10' }}">
                      <input type="file" name="photo" class="form-control" {{ $product == null ? 'required' : '' }}>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">الــوصف</label>
                    <div class="col-sm-10">
                      <textarea name="description" class="form-control" placeholder="برجاء كتابة وصف كامل عن المنتج"
                                rows="6" required>{{ old('description', optional($product)->description) }}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="categoryId">تصنيف المنتج</label>
                    <div class="col-sm-10">
                      <select id="categoryId" class="form-control" name="categoryId" required>
                        <option value="" disabled selected>-- التصنــيف --</option>
                        @foreach($categories as $category)
                          <option
                            value="{{ $category->id }}" {{ old('categoryId', optional($product)->categoryId) == $category->id ? 'selected': '' }}>
                            {{ $category->name}}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="companyId">الشركة المنتجة للمنتج</label>
                    <div class="col-sm-10">
                      <select id="companyId" class="form-control" name="companyId" required>
                        <option value="" disabled selected>-- اختار الشركة --</option>
                        @foreach($companies as $company)
                          <option
                            value="{{ $company->id }}" {{ old('companyId', optional($product)->companyId) == $company->id ? 'selected': '' }}>
                            {{ $company->name}}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="weightTypeId">الوزن</label>
                    <div class="col-sm-5">
                      <input type="number" name="weight" class="form-control" placeholder="الوزن"
                             value="{{ old('weight', optional($product)->weight) }}" required>
                    </div>
                    <div class="col-sm-5">
                      <select id="weightTypeId" class="form-control" name="weightType" required>
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
                  <div class="form-group">
                    <label class="control-label col-sm-2">السـعر بالجـنيه</label>
                    <div class="col-sm-10">
                      <input type="number" name="price" class="form-control" placeholder="الســعر"
                             value="{{ old('price', optional($product)->price) }}" min="0" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">تالريخ الانتاج</label>
                    <div class="col-sm-10">
                      <input type="date" name="productionDate" class="form-control" placeholder="تاريخ الانتاج"
                             value="{{ old('productionDate', optional($product)->productionDateValue) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">مدى الصلاحية</label>
                    <div class="col-sm-10">
                      <input type="text" name="validity" class="form-control" placeholder="مدى الصلاحية"
                             value="{{ old('validity', optional($product)->validity) }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">دواعى الاستخدام</label>
                    <div class="col-sm-10">
                      <textarea name="usage" class="form-control" placeholder="برجاء كتابة دواعى استخدام المنتج"
                                rows="6" required>{{ old('usage', optional($product)->usage) }}</textarea>
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
