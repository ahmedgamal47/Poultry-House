<!----Start Company Products------>
<section class="home-company-products-section">
  <img class="home-company-products-white-curve-img" src="img/curve1.png">
  <h2 class="home-company-products-title"><span>منتجات الشركات</span></h2>


  <div class="container-fluid home-company-products-container">
    <div class="home-company-products-div">
      <div class="home-company-products-tab-div">

        <div class="container" style="display: none" dir="rtl">
          <div class="slick-responsive">
            @foreach($categories as $index => $category)
              <div>
                <div class="cat-wrapper {{ $index == 0 ? 'active' : '' }}">
                  <a href="#category-{{ $category->id }}" role="tab" data-toggle="tab">
                    <img class="text" src="{{ $category->image->original->url }}">
                    <h3 class="text">{{ $category->name }}</h3>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Nav tabs -->
        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs  nav-tabs-responsive" role="tablist">
            @foreach($categories as $index => $category)
              <li role="presentation" class="{{ $index == 0 ? 'active' : '' }} {{ $index == 1 ? 'next' : '' }}">
                <a href="#category-{{ $category->id }}" role="tab" data-toggle="tab">
                  <img class="text" src="{{ $category->image->original->url }}">
                  <h3 class="text">{{ $category->name }}</h3>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <!-- Tab panes -->
        <div class="tab-content home-company-products-tab-content">
          @foreach($categories as $index => $category)
            <div role="tabpanel" class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="category-{{ $category->id }}">
              <div class="row">
                <div class="col-md-12 pc-div">
                  <div class="carousel slide multi-item-carousel" id="theCarousel">
                    <div class="carousel-inner">
                      <?php $delay = 0 ?>
                      @foreach($category->fewCompanies as $idx => $company)
                        <div class="item {{ $idx == 0 ? 'active' : '' }}" >
                          <div class="col-md-3 col-sm-6 col-xs-12 home-company-products-tab-content-col  wow fadeInDown" data-wow-delay="{{$delay}}s">
                            <a href="{{ route('company', $company->id) }}">
                              <div class="home-company-products-single-div ">
                                <div>
                                  <img src="{{ $company->image->xsmall->url }}">
                                </div>
                                <div class="home-company-products-title-div">
                                  <h3>{{ $company->name }}</h3>
                                </div>
                              </div>
                            </a>
                          </div>
                        </div>
                        <?php $delay += 0.2 ?>
                      @endforeach
                    </div>
                    <a class="left carousel-control" href="#theCarousel" data-slide="next"><i
                        class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#theCarousel" data-slide="prev"><i
                        class="glyphicon glyphicon-chevron-right"></i></a>
                  </div>
                </div>

                <div class="mobile-div">
                  @foreach($category->fewCompanies as $idx => $company)
                    @if($idx < 5)
                    <div class="col-md-3 col-sm-6 col-xs-12 home-company-products-tab-content-col">
                      <a href="{{ route('company', $company->id) }}">
                        <div class="home-company-products-single-div ">
                          <div>
                            <img src="{{ $company->image->xsmall->url }}">
                          </div>
                          <div class="home-company-products-title-div">
                            <h3>{{ $company->name }}</h3>
                          </div>
                        </div>
                      </a>
                    </div>
                    @endif
                  @endforeach
                </div>
              </div>

              <div class="home-company-products-more-div">
                <a href="{{ route('companies', ['categoryId' => $category->id]) }}">عرض باقي الشركات</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="home-about-container-fluid-curve">
    <img src="{{ asset('img/after-4icons.png') }}">
  </div>
</section>
<!----End Company Products------>