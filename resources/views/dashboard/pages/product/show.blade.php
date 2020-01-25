@extends('dashboard.layout.template')

@section('title', $product->name)

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">المنتج #{{ $product->id }}</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>بيانات المنتج</h5>
          </div>
          <div class="panel-body">
            <table width="100%" class="table table-striped">
              <tbody>
              <tr>
                <th class="narrow">اسم المنتج</th>
                <td>{{ $product->name }}</td>
              </tr>
              <tr>
                <th class="narrow">صورة المنتج</th>
                <td><img src="{{ $product ? $product->image->small->url : null }}" class="img-responsive"></td>
              </tr>
              <tr>
                <th class="narrow">الــوصف</th>
                <td>{!! nl2br($product->description) !!}</td>
              </tr>
              <tr>
                <th class="narrow">تصنيف المنتج</th>
                <td>{{ $product->category->name }}</td>
              </tr>
              <tr>
                <th class="narrow">الشركة المنتجة للمنتج</th>
                <td>{{ $product->company->name }}</td>
              </tr>
              <tr>
                <th class="narrow">السـعر</th>
                <td>{{ $product->price }} جنيها</td>
              </tr>
              <tr>
                <th class="narrow">الوزن</th>
                <td>{{ $product->weight }} {{ $product->weightTypeLabel }}</td>
              </tr>
              <tr>
                <th class="narrow">تالريخ الانتاج</th>
                <td>{{ $product->productionDate }}</td>
              </tr>
              <tr>
                <th class="narrow">مدى الصلاحية</th>
                <td>{{ $product->validity }}</td>
              </tr>
              <tr>
                <th class="narrow">دواعى الاستخدام</th>
                <td>{!! nl2br($product->usage) !!}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
@stop
