@extends('layout.main')

@section('title', $product->name)

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>{{ $product->name }}</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li><a href="{{ route('products') }}">المنتجات</a></li>
        <li>{{ $product->name }}</li>
      </ul>
    </div>
  </div>

  <div class="container-fluid inner-page-body-container company-page-body-container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="row company-img-social-info-div">
          <div class="col-md-3">
            <div class="products-profile-img-div">
              <img src="{{ $product->image->small->url }}">
            </div>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-12">
                <h2 class="product-profile-title">{{ $product->name }}</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p class="product-text">{{ $product->description }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row product-data-div">
          <div class="col-md-12">
            <h3 class="about-company-div-title product-title">بيانات المنتج</h3>
            <div class="row product-data-row">
              <div class="col-md-4">
                <div class="product-data-span-div">
                  <span class="bold-span">اسم الشركه :</span>
                  <span>{{ $product->company->name }}</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="product-data-span-div">
                  <span class="bold-span">الصلاحيه :</span>
                  <span>{{ $product->validity }}</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="product-data-span-div">
                  <span class="bold-span">تاريخ الانتاج :</span>
                  <span>{{ $product->productionDate }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row product-data-div">
          <div class="col-md-12">
            <h3 class="about-company-div-title product-title">دواعي الاستعمال:</h3>
            <div class="company-divider-hr">
              <hr>
            </div>
            <div class="indications-div">
              {{ $product->usage }}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row single-product-btn-div">
          <div class="{{ !Auth::user()->isPoultryJam() ? 'col-md-6' : 'col-md-4' }}">
            <div class="single-product-btn">
              <h4 class="bold">
                <span class="bold-span">{{ $product->price }}</span> <br>
                <span>جنيها</span>
              </h4>
            </div>
          </div>
          <div class="{{ !Auth::user()->isPoultryJam() ? 'col-md-6' : 'col-md-4' }}">
            <div class="single-product-btn">
              <h4 class="bold">
                <span class="bold-span">{{ $product->weight }}</span> <br>
                <span>{{ $product->weightTypeLabel }}</span>
              </h4>
            </div>
          </div>
          @if(Auth::user()->isPoultryJam())
            <div class="col-md-4">
              <div class="product-order-now-btn-div">
                <form action="{{ route('order.create') }}" method="post">
                  <input type="hidden" name="productId" value="{{ $product->id }}">
                  @csrf
                  <a data-toggle="modal" data-target="#order-modal"
                     class="btn btn-warning company-contact-btn product-order-now-btn bold btn-wrap">
                    اطلــب الأن
                  </a>
                </form>
              </div>
            </div>
            <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content footer-mail-form nav-search-form">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h2>إضــافة الكمية المطلوبة</h2>
                  </div>
                  <div class="modal-body nav-search-form-body">
                    <form action="{{ route('order.create') }}" method="post">
                      <input type="number" name="quantity" min="1" placeholder="الكمية المطلوبة" class="form-control">
                      <input type="hidden" name="productId" value="{{ $product->id }}">
                      @csrf
                      <input type="submit" class="btn btn-orange btn-full" value="اطلــب الأن">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
        <div class="row">
          <div class="company-contact-form-div">
            <h3 class="company-contact-form-title">تواصل مع الشركه</h3>
            <hr class="company-contact-form-hr">
            <div>
              <form class="company-contact-form">
                <input class="form-control company-contact-input" placeholder="الاسم *" required>
                <input class="form-control company-contact-input" placeholder="الموبيل *" required>
                <input class="form-control company-contact-input" placeholder="البريد الالكتروني *" required>
                <input class="form-control company-contact-input" placeholder="افضل وقت للاتصال" required>
                <textarea class="form-control company-contact-input" rows="5" placeholder="الرســــالة *"
                          required></textarea>
                <button class="btn btn-warning company-contact-btn">ارسال</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(count($relatedProducts) > 0)
      <div class="row">
        <h3 class="related-products-title">منتجات اخري ذات صله</h3>
        <div class="company-divider-hr">
          <hr>
        </div>
        <div class="related-products-div">
          @foreach($relatedProducts as $product)
            <div class="col-md-3">
              <div class="archive-products-col-div">
                <div class="archive-products-img-div">
                  <img src="{{ $product->image->small->url }}">
                </div>
                <div class="archive-company-data-div archive-products-data-div ">
                  <h3>{{ $product->name }}</h3>
                </div>
                <div class="archive-products-more-div">
                  <div class="row">
                    <div class="col-md-6 archive-products-more-div-col">
                      <h4><span class="bold-span">{{ $product->price }}</span><span>جنيــها</span></h4>
                    </div>
                    <div class="col-md-6 archive-products-more-div-col">
                      <a href="{{ route('product', $product->id) }}">المزيد</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
  <!----End Main page Body------>
@stop
