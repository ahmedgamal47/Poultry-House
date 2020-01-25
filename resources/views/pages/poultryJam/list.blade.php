@extends('layout.main')

@section('title', 'المربيين')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>المربيــــين</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li>المربيين</li>
      </ul>
    </div>
  </div>
  <!----End breadcrumbs------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <h3 class="breeder-title">جميع المربيين وبيانات التواصل معهم</h3>
    <div class="breeder-table-responsive">
      @if(count($poultryJams) > 0)
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
            <tr class="breeder-table-header">
              <th scope="col">الاسم</th>
              <th scope="col">العنوان</th>
              <th scope="col">التليفون</th>
              <th scope="col">الرقم الكودي</th>
              <th scope="col">النشاط</th>
              <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($poultryJams as $poultryJam)
              <tr>
                <td scope="row">{{ $poultryJam->user->name }}</td>
                <td>{{ $poultryJam->user->address }}</td>
                <td>{{ $poultryJam->user->phone }}</td>
                <td>{{ $poultryJam->code }}</td>
                <td>{{ $poultryJam->field }}</td>
                <td><a href="{{ route('poultry-jam', $poultryJam->user->id) }}">المزيد</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="alert alert-danger">
          <h3 class="text-center">لا يوجد مربيين</h3>
        </div>
      @endif
    </div>
  </div>
  <div class="text-center">
    {{ $poultryJams->links() }}
  </div>
  <br>
  <br>
  <!----End Main page Body------>
@stop
