@extends('layout.main')

@section('title', 'الشركـــات')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>الشركـــات</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li>الشركات</li>
      </ul>
    </div>
  </div>
  <!----End breadcrumbs------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <br>
    <form action="{{ route('companies') }}" method="get">
      <div class="row">
        <div class="col-md-2 search-col-div">
          <p>بحث باستخدام</p>
        </div>
        <div class="col-md-4 search-col-div">
          <select class="form-control" name="categoryId">
            <option selected value="">مجال الشركه</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $category->id == old('categoryId') ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4 search-col-div">
          <select class="form-control" name="productId">
            <option selected value="">المنتج</option>
            @foreach($products as $product)
              <option value="{{ $product->id }}" {{ $product->id == old('productId') ? 'selected' : '' }}>
                {{ $product->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2 search-btn-col-div">
          <input type="submit" class="btn btn-full" value="بحـــث">
        </div>
      </div>
    </form>

    <div class="row archive-company-row">
      @if(count($companies) > 0)
        @foreach($companies as $company)
          <div class="col-md-4">
            <div class="archive-company-col-div">
              <div class="archive-company-img-div">
                <img src="{{ $company->user->image->xsmall->url }}">
              </div>
              <div class="archive-company-data-div">
                <h3>{{ $company->user->name }}</h3>
                <p>{{ $company->user->bio }}</p>
              </div>
              <div class="archive-company-more-div">
                <span><h4>{{ optional($company->user->categories->first())->name }}</h4></span>
                <span><a href="{{ route('company', $company->user->id) }}">المزيد</a></span>
              </div>
            </div>
          </div>
        @endforeach
        <div class="text-center">
          {{ $companies->links() }}
        </div>
      @else
        <div class="alert alert-danger">
          <h3 class="text-center">لا يوجد شركات</h3>
        </div>
      @endif
    </div>
    <br><br>
  </div>
  <!----End Main page Body------>
@stop
