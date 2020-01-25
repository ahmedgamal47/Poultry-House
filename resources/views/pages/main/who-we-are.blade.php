@extends('layout.main')

@section('title', 'من نحن')

@section('content')
  <!----Start SecHeader------>

  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>من نحن</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li>من نحن</li>
      </ul>
    </div>
  </div>
  <!----End breadcrumbs------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <div class="about-page-text-img-div">
      <h2 class="about-page-title">عن شركه الدواجن المصريه</h2>
      <br>
      <div class="about-page-text">
        {!! $whoWeAre !!}
      </div>
      <br><br>
      {{--<div class="about-page-img">--}}
      {{--<img src="{{ asset('img/About Us.jpg') }}">--}}
      {{--</div>--}}
    </div>
    <div>
      <div class="about-list-text about-page-list">
        {{--<ul>--}}
        {{--<li>--}}
        {{--<span><i class="fas fa-check"></i></span>--}}
        {{--<p>تحقيق اقصي قدر من النمو والتقدم لصناعه الدواجن والعاملين بها بما يحقق الفائده العظيمه--}}
        {{--للاقتصاد القومي اهداف منظومه التسويق</p>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<span><i class="fas fa-check"></i></span>--}}
        {{--<p>تحقيق اقصي قدر من النمو والتقدم لصناعه الدواجن والعاملين بها بما يحقق الفائده العظيمه--}}
        {{--للاقتصاد القومي اهداف منظومه التسويق</p>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<span><i class="fas fa-check"></i></span>--}}
        {{--<p>تحقيق اقصي قدر من النمو والتقدم لصناعه الدواجن والعاملين بها بما يحقق الفائده العظيمه--}}
        {{--للاقتصاد القومي اهداف منظومه التسويق</p>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<span><i class="fas fa-check"></i></span>--}}
        {{--<p>تحقيق اقصي قدر من النمو والتقدم لصناعه الدواجن والعاملين بها بما يحقق الفائده العظيمه--}}
        {{--للاقتصاد القومي اهداف منظومه التسويق</p>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<span><i class="fas fa-check"></i></span>--}}
        {{--<p>تحقيق اقصي قدر من النمو والتقدم لصناعه الدواجن والعاملين بها بما يحقق الفائده العظيمه--}}
        {{--للاقتصاد القومي اهداف منظومه التسويق</p>--}}
        {{--</li>--}}
        {{--</ul>--}}
      </div>
    </div>


  </div>
  <section class="about-page-section">
    <div class="container about-page-section-container">
      <h2 class="background about-page-section-container-title"><span>خدمات شركه دواجن مصر تنقسم الي</span></h2>
      <div class="row about-page-section-row">
        @foreach($services as $service)
          <div class="col-md-6">
            <div class="about-page-section-col-div">
              <img src="{{ $service->photo }}" class="img-responsive">
              <div>
                <h3>{{ $service->name }}</h3>
                <div>
                  <a href="{{ route('contact-us') }}">ارسل بياناتك وسوف يتم التواصل معك</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!----End Main page Body------>
@stop