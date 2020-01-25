@extends('layout.main')

@section('title', 'طلبات الشراء')

@section('content')
  <!----Start SecHeader------>
  <section class="secHeader-section-div">
    <div class="container-fluid secHeader-container-div">
      <h1>طلبــات الشراء</h1>
    </div>
  </section>
  <!----End SecHeader------>

  <!----Start breadcrumbs------>
  <div class="container-fluid my-breadcrumbs-container-fluid-div">
    <div class="my-breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li>طلبات الشراء</li>
      </ul>
    </div>
  </div>
  <!----End breadcrumbs------>

  <!----Start Main page Body------>
  <div class="container inner-page-body-container">
    <h3 class="breeder-title">جميع طلبات الشراء</h3>
    <div class="breeder-table-responsive">

      @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
      @endif

      @if(count($orders) > 0)
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
            <tr class="breeder-table-header">
              <th scope="col">رقم الشراء</th>
              <th scope="col">التاريخ</th>
              <th scope="col">المنتج</th>
              <th scope="col">الحاله</th>
              <th scope="col">الكميه</th>
              <th scope="col">اجمالي الوزن</th>
              <th scope="col">اجمالى المبلغ</th>
              <th scope="col" class="narrow"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
              <tr>
                <td scope="row">{{ $order->number }}</td>
                <td>{{ $order->date }}</td>
                <td>
                  <a class="text-nowrap" href="{{ route('product', $order->product->id) }}" target="_blank">
                    {{ $order->product->name }}
                  </a>
                </td>
                <td>{{ $order->statusLabel }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->quantity * $order->productWeight }} {{ $order->productWeightTypeLabel }}</td>
                <td>{{ $order->price }} جنيها</td>
                <td class="narrow">
                  @if(Auth::user()->isPoultryJam())
                    <a href="#" data-toggle="modal" data-target="#order-{{ $order->id }}-modal">تفاصيل الشركة النتجة</a>
                  @elseif(Auth::user()->isCompany())
                    <a href="#" data-toggle="modal" data-target="#order-{{ $order->id }}-modal">تفاصيل المربى</a>
                  @endif
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="text-center">
          {{ $orders->links() }}
        </div>
      @else
        <div class="alert alert-danger">
          <h3 class="text-center">لا يوجد طلبات</h3>
        </div>
      @endif
      <br>
    </div>
  </div>
  <br><br>

  @foreach($orders as $order)
    @if(Auth::user()->isPoultryJam())
      <div class="modal fade bd-example-modal-lg" id="order-{{ $order->id }}-modal" tabindex="-1" role="dialog"
           aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
              <h2>تفاصيل الشركة المنتجة</h2>
            </div>
            <div class="modal-body nav-search-form-body">
              <div class="row">
                <div class="col-md-3">
                  <img src="{{ $order->product->company->image->medium->url }}"
                       class="img-responsive img-rounded">
                </div>
                <div class="col-md-9">
                  <table class="table">
                    <tbody>
                    <tr>
                      <th class="no-border-top">اسم الشركة</th>
                      <td class="no-border-top">
                        <a href="{{ route('company', $order->product->company->id) }}" target="_blank">
                          {{ $order->product->company->name }}
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <th>التليفون</th>
                      <td>{{ $order->product->company->phone }}</td>
                    </tr>
                    <tr>
                      <th>العنوان</th>
                      <td>{{ $order->product->company->address }}</td>
                    </tr>
                    <tr>
                      <th>الموقع الالكترونى</th>
                      <td>
                        <a href="{{ $order->product->company->company->website }}" target="_blank">
                          {{ $order->product->company->company->website }}
                        </a>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-orange bold" data-dismiss="modal">اغـــلاق</button>
            </div>
          </div>
        </div>
      </div>
      <!----End Main page Body------>
    @elseif(Auth::user()->isCompany())
      <a href="#" data-toggle="modal" data-target="#order-{{ $order->id }}-modal">تفاصيل المربى</a>
      <div class="modal fade bd-example-modal-lg" id="order-{{ $order->id }}-modal" tabindex="-1"
           role="dialog"
           aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
              <h2>تفاصيل المربى</h2>
            </div>
            <div class="modal-body nav-search-form-body">
              <div class="row">
                <div class="col-md-3">
                  <img src="{{ $order->user->image->medium->url }}"
                       class="img-responsive img-rounded">
                </div>
                <div class="col-md-9">
                  <table class="table table">
                    <tbody>
                    <tr>
                      <th class="no-border-top">اسم المربى</th>
                      <td class="no-border-top">
                        <a href="{{ route('poultry-jam', $order->user->id) }}" target="_blank">
                          {{ $order->user->name }}
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <th>التليفون</th>
                      <td>{{ $order->user->phone }}</td>
                    </tr>
                    <tr>
                      <th>العنوان</th>
                      <td>{{ $order->user->address }}</td>
                    </tr>
                    <tr>
                      <th>النشاط</th>
                      <td>{{ $order->user->poultryJam->field }}</td>
                    </tr>
                    <tr>
                      <th>الرقم الكودي</th>
                      <td>{{ $order->user->poultryJam->code }}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-orange bold" data-dismiss="modal">اغـــلاق</button>
            </div>
          </div>
        </div>
      </div>
      <!----End Main page Body------>
    @endif
  @endforeach
@stop
