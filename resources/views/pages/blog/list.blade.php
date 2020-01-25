@extends('layout.main')

@section('title', 'الخبـــراء')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>الخبـــراء</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li>الخبراء</li>
      </ul>
    </div>
  </div>
  <!----End breadcrumbs------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <br>
    <form action="{{ route('experts') }}" method="get">
      <div class="row">
        <div class="col-md-2 search-col-div">
          <p>بحث باستخدام</p>
        </div>
        <div class="col-md-8 search-col-div">
          <input type="text" class="form-control" name="keyword" value="{{ old('keyword') }}"
                 placeholder="كلمة فى عنوان المقال أو المحتوى">
        </div>
        <div class="col-md-2 search-btn-col-div">
          <input type="submit" class="btn btn-full" value="بحـــث">
        </div>
      </div>
    </form>

    <div class="row archive-company-row">
      @if(count($posts) > 0)
        @foreach($posts as $post)
          <div class="col-md-4">
            <div class="archive-company-col-div">
              <div class="archive-company-img-div">
                <img src="{{ $post->image->xsmall->url }}">
              </div>
              <div class="archive-company-data-div">
                <h3>{{ $post->title }}</h3>
                <p>{!! $post->summary !!}</p>
              </div>
              <div class="archive-company-more-div">
                <span></span>
                <span><a href="{{ route('article', $post->slug) }}">المزيد</a></span>
              </div>
            </div>
          </div>
        @endforeach
        <div class="text-center">
          {{ $posts->links() }}
        </div>
      @else
        <div class="alert alert-danger">
          <h3 class="text-center">لا يوجد مقالات</h3>
        </div>
      @endif
    </div>
    <br><br>
  </div>
  <!----End Main page Body------>
@stop
