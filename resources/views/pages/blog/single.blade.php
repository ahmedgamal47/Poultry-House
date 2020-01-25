@extends('layout.main')

@section('title', $post->title)

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>{{ $post->title }}</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li><a href="{{ route('experts') }}">الخبراء</a></li>
        <li>{{ $post->title }}</li>
      </ul>
    </div>
  </div>

  <div class="container-fluid inner-page-body-container company-page-body-container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="post">
          <h2 class="title text-center">{{ $post->title }}</h2>
          <img src="{{ $post->image->original->url }}" class="img-responsive">
          <hr>
          {!! $post->description !!}
        </div>
      </div>
    </div>
  </div>
  <br><br><br><br>
  <!----End Main page Body------>
@stop
