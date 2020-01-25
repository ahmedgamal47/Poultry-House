@extends('layout.main')

@section('title', 'المنتجـــات')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>المنتجـــات</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li>المنتجات</li>
      </ul>
    </div>
  </div>
  <!----End breadcrumbs------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <br>
    <form action="{{ route('products') }}" method="get">
      <div class="row">
        <div class="col-md-1 search-col-div">
          <p>بحث في</p>
        </div>
        <div class="col-md-5 search-col-div">
          <input name="productName" class="form-control" placeholder="اسم المنتج"
                 value="{{ old('productName') }}">
        </div>
        <div class="col-md-4 search-col-div">
          <select name="productCategory" class="form-control" value="{{ old('productCategory') }}">
            <option selected value="">نوع المنتج</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $category->id == old('productCategory') ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <input type="submit" class="btn btn-full" value="بحـــث">
        </div>
      </div>
    </form>

    <div class="row archive-company-row">
      @if(count($products) > 0)
        @foreach($products as $product)
          <div class="col-md-3">
            <div class="archive-products-col-div">
              <div class="archive-products-img-div">
                <img src="{{ $product->image->xsmall->url }}">
              </div>
              <div class="archive-company-data-div archive-products-data-div ">
                <h3>{{ $product->name }}</h3>
              </div>
              <div class="archive-products-more-div">
                <div class="row">
                  <div class="col-md-6 archive-products-more-div-col">
                    <h4>
                      <span class="bold-span">{{ $product->price }}</span>
                      <span>جنيــها</span>
                    </h4>
                  </div>
                  <div class="col-md-6 archive-products-more-div-col">
                    <a href="{{ route('product', $product->id) }}">المزيد</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="alert alert-danger">
          <h3 class="text-center">لا يوجد منتجات</h3>
        </div>
      @endif
    </div>
    <div class="text-center">
      {{ $products->links() }}
    </div>
    <br><br>
  </div>
  <!----End Main page Body------>
@stop
