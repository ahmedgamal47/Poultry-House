@extends('layout.main')

@section('title', $poultryJam->name)

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>{{ $poultryJam->name }}</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li><a href="{{ route('poultry-jams') }}">المربيين</a></li>
        <li>{{ $poultryJam->name }}</li>
      </ul>
    </div>
  </div>
  <!----End breadcrumbs------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <div class="row">
      <div class="col-md-8">
        <div class="farmer-profile-div">
          <h2 class="farmer-profile-name-title">{{ $poultryJam->name }}</h2>
          <div><p>{{ $poultryJam->bio }}</p>
          </div>
          <div class="farmer-data-div">
            <ul>
              <li>
                <i class="fas fa-map-marker-alt"></i>
                <span class="farmer-profile-li-title-span">العنوان</span>
                <span>{{ $poultryJam->address }}</span>
              </li>
              <li>
                <i class="fas fa-phone"></i>
                <span class="farmer-profile-li-title-span">التليفون</span>
                <span>{{ $poultryJam->phone }}</span>
              </li>
              <li>
                <i class="fas fa-edit"></i>
                <span class="farmer-profile-li-title-span">النشاط</span>
                <span>{{ $poultryJam->poultryJam->field }}</span>
              </li>
              <li>
                <i class="far fa-address-book"></i>
                <span class="farmer-profile-li-title-span">الرقم الكودي</span>
                <span>{{ $poultryJam->poultryJam->code }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="contact-farmer-form">
          <h3 class="contact-farmer-title">تواصل مع المربي</h3>
          <hr>
          <div>
            <form action="{{ route('poultry-jam.send-inquiry') }}" method="post">
              @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $message }}</strong>
                </div>
              @elseif($errors->any())
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                  @endforeach
                </div>
              @endif
              @csrf
              <input type="hidden" name="receiverId" value="{{ $poultryJam->id }}">
              <input class="form-control" name="name" placeholder="الاســم *"
                     value="{{ old('name', optional(Auth::user())->name) }}" required>
              <input class="form-control" name="mobile" placeholder="الموبيل *"
                     value="{{ old('mobile', optional(Auth::user())->phone) }}" required>
              <input class="form-control" name="email" placeholder="البريد الالكتروني *"
                     value="{{ old('email', optional(Auth::user())->email) }}" required>
              <textarea class="form-control" rows="5" name="message"
                        placeholder="الرســــالة *">{{ old('message') }}</textarea>
              <button class="btn btn-danger">ارســــال</button>
            </form>
          </div>
        </div>
        <br><br>
      </div>
    </div>
  </div>
  <!----End Main page Body------>
@stop