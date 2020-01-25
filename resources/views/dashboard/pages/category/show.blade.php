@extends('dashboard.layout.template')

@section('title', $category->name)

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">التصنيف #{{ $category->id }}</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>بيانات التصنيف</h5>
          </div>
          <div class="panel-body">
            <table width="100%" class="table table-striped">
              <tbody>
              <tr>
                <th class="narrow">الاســم</th>
                <td>{{ $category->name }}</td>
              </tr>
              <tr>
                <th class="narrow">الصــورة</th>
                <td><img src="{{ $category->image->small->url }}" class="img-responsive img-rounded"></td>
              </tr>
              <tr>
                <th class="narrow">عدد الشركات المرتبطة</th>
                <td>{{ $category->companies_count }}</td>
              </tr>
              <tr>
                <th class="narrow">عدد المنتجات المرتبطة</th>
                <td>{{ $category->products_count }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
