@extends('dashboard.layout.template')

@section('title', $company->user->name)

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">الشركة #{{ $company->id }}</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>بيانات الشركة</h5>
          </div>
          <div class="panel-body">
            <table width="100%" class="table table-striped">
              <tbody>
              <tr>
                <th class="narrow">الاسم</th>
                <td>{{ $company->user->name }}</td>
              </tr>
              <tr>
                <th class="narrow">البريد الالكترونى</th>
                <td>{{ $company->user->email }}</td>
              </tr>
              <tr>
                <th class="narrow">الشــعار</th>
                <td><img src="{{ $company ? $company->user->image->small->url : null }}" class="img-responsive"></td>
              </tr>
              <tr>
                <th class="narrow">رقم الهاتف</th>
                <td>{{ $company->user->phone }}</td>
              </tr>
              <tr>
                <th class="narrow">العنوان</th>
                <td>{{ $company->user->address }}</td>
              </tr>
              <tr>
                <th class="narrow">الوصف المختصر</th>
                <td>{!! nl2br($company->user->bio) !!}</td>
              </tr>
              <tr>
                <th class="narrow">الوصف الكامل</th>
                <td>{!! nl2br($company->description) !!}</td>
              </tr>
              <tr>
                <th class="narrow">مجال الشركة</th>
                <td>{{ $company->user->categories->implode('name', ' , ') }}</td>
              </tr>
              <tr>
                <th class="narrow">موقع الشركة الالكترونى</th>
                <td>{{ $company->website }}</td>
              </tr>
              <tr>
                <th class="narrow">مكان الشركة على الخريطة</th>
                <td>
                  <div class="map" data-lat="{{ $company->latitude }}" data-lng="{{ $company->longitude }}"
                       data-enable-selection="0"></div>
                </td>
              </tr>
              <tr>
                <th class="narrow">رابط صفحة الفيس بوك</th>
                <td>{{ $company->facebookLink }}</td>
              </tr>
              <tr>
                <th class="narrow">رابط صفحة تويتر</th>
                <td>{{ $company->twitterLink }}</td>
              </tr>
              <tr>
                <th class="narrow">رابط صفحة جوجل بلس</th>
                <td>{{ $company->googlePlusLink }}</td>
              </tr>
              <tr>
                <th class="narrow">رابط صفحة انستجرام</th>
                <td>{{ $company->instagramLink }}</td>
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
