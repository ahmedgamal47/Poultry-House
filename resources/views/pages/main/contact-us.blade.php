@extends('layout.main')

@section('title', 'اتصل بنا')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>اتصل بنا</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li>اتصل بنا</li>
      </ul>
    </div>
  </div>
  <!----End breadcrumbs------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <h2 class="contact-us-page-title">برجاء ارسال بياناتك وسوف يتم التواصل معك</h2>
    <div class="row contact-us-page-row">
      <div class="col-md-6">
        <div class="contact-us-page-form-col">
          <form action="{{ route('send-inquiry') }}" method="post">
            @csrf
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
            <div class="row contact-us-page-form-col-row">
              <input class="col-md-6 col-sm-12 form-control contact-us-page-form-input input-right-col"
                     name="name" value="{{ old('name', optional(Auth::user())->name) }}" placeholder="الاسم *"
                     required>
              <input class="col-md-6 col-sm-12 form-control contact-us-page-form-input input-left-col"
                     name="mobile" value="{{ old('mobile', optional(Auth::user())->phone) }}" placeholder="الموبيل *"
                     required>
              <input class="col-md-6 col-sm-12 form-control contact-us-page-form-input input-right-col"
                     name="email" value="{{ old('email', optional(Auth::user())->email) }}"
                     placeholder="البريد الالكتروني *"
                     required>
              <input class="col-md-6 col-sm-12 form-control contact-us-page-form-input input-left-col"
                     name="address" value="{{ old('address', optional(Auth::user())->address) }}" placeholder="العنوان">
              <input class="col-md-6 col-sm-12 form-control contact-us-page-form-input input-right-col"
                     name="job" value="{{ old('job') }}" placeholder="الوضيفة">
              <input class="col-md-6 col-sm-12 form-control contact-us-page-form-input input-left-col"
                     name="company" value="{{ old('company') }}" placeholder="اسم جهه العمل">
              <textarea class="col-md-12 form-control contact-us-page-form-text" rows="3"
                        name="message" placeholder="الرســــالة *" required>{{ old('message') }}</textarea>
              <div class="contact-us-submit-btn-div">
                <input type="submit" value="ارســــال" class="contact-us-submit-btn">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="contact-us-information-div">
          <div class="row">
            <div class="col-xs-2 contact-us-information-icon-div">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="col-xs-10">
              <h3>الفرع الرئيسي</h3>
              <h4><span>{{ $address }}</span></h4>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-2 contact-us-information-icon-div">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <div class="col-xs-10">
              <h3>الموبيل</h3>
              <h4><span><a href="tel:{{ $mobile }}">{{ $mobile }}</a></span></h4>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-2 contact-us-information-icon-div">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="col-xs-10">
              <h3>البريد الالكتروني </h3>
              <h4><span><a href="mailto:{{ $email }}">{{ $email }}</a></span></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 contact-us-map">
      <div class="map map-tall" data-lat="{{ $latitude }}" data-lng="{{ $longitude }}" data-enable-selection="0"></div>
    </div>
  </div>
  <br><br>
  <!----End Main page Body------>
@stop

@section('script')
  <script type="text/javascript" src="{{ asset('js/sb-admin-2.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSM9Cm6DKEv9o8jDTCECJ_yfTS1YonB9k&callback=initMap"
          async defer></script>
@stop
