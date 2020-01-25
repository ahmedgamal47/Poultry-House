@extends('dashboard.layout.template')

@section('title', $poultryJam->user->name)

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">المربى #{{ $poultryJam->id }}</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>بيانات المربى</h5>
          </div>
          <div class="panel-body">
            <table width="100%" class="table table-striped">
              <tbody>
              <tr>
                <th class="narrow">اسم المربى</th>
                <td>{{ $poultryJam->user->name }}</td>
              </tr>
              <tr>
                <th class="narrow">البريد الالكترونى</th>
                <td>{{ $poultryJam->user->email }}</td>
              </tr>
              <tr>
                <th class="narrow">صورة المربى</th>
                <td><img src="{{ $poultryJam ? $poultryJam->user->image->small->url : null }}" class="img-responsive">
                </td>
              </tr>
              <tr>
                <th class="narrow">رقم الهاتف</th>
                <td>{{ $poultryJam->user->phone }}</td>
              </tr>
              <tr>
                <th class="narrow">مجال المربى</th>
                <td>{{ $poultryJam->field }}</td>
              </tr>
              <tr>
                <th class="narrow">الرقم الكودى</th>
                <td>{{ $poultryJam->code }}</td>
              </tr>
              <tr>
                <th class="narrow">العنوان</th>
                <td>{{ $poultryJam->user->address }}</td>
              </tr>
              <tr>
                <th class="narrow">نبذة عن المربى</th>
                <td>{!! nl2br($poultryJam->user->bio) !!}</td>
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
