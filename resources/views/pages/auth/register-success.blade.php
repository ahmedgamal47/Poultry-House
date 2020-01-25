@extends('layout.main')

@section('title', 'تسجيل الحساب')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>تسجـــيل الحســــاب</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <h2 class="contact-us-page-title">تم تسجيل حسابك بنجاح</h2><br>
    <div class="alert alert-success text-center" role="alert">
      <p>
        تم ارسال رسالة الى بريدك الالكترونى لتفعيل حسابك
        <br>
        اذا لم تجد رسالة فى البريد الوارد برجاء الضغط على الزر لارسال الرسالة مرة أخرى
        <br><br>
        <a class="btn btn-orange bold" href="{{ route('verification.resend') }}">إعادة ارسال رسالة تفعيل الحساب</a>.
      </p>
    </div>
    <br><br>
  </div>
@endsection
