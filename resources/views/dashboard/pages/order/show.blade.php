@extends('dashboard.layout.template')

@section('title', 'طلب شراء ' . $order->number)

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">طلب الشراء #{{ $order->number }}</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>بيانات طلب الشراء</h5>
          </div>
          <div class="panel-body">
            @if (($message = Session::get('success')))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif

            <table width="100%" class="table table-striped">
              <tbody>
              <tr>
                <th class="narrow">رقم الشراء</th>
                <td>{{ $order->number }}</td>
              </tr>
              <tr>
                <th class="narrow">تاريخ الشراء</th>
                <td>{{ $order->date }}</td>
              </tr>
              <tr>
                <th class="narrow">اسم المشترى</th>
                <td><a href="{{ route('poultry-jam', $order->user->id) }}">{{ $order->user->name }}</a></td>
              </tr>
              <tr>
                <th class="narrow">اسم المنتج</th>
                <td><a href="{{ route('product', $order->product->id) }}">{{ $order->product->name }}</a></td>
              </tr>
              <tr>
                <th class="narrow">سعر المنتج</th>
                <td>{{ $order->productPrice }} جنيهــأ</td>
              </tr>
              <tr>
                <th class="narrow">وزن المنتج</th>
                <td>{{ $order->productWeight }} {{ $order->productWeightTypeLabel }}</td>
              </tr>
              <tr>
                <th class="narrow">الشركة المنتجة</th>
                <td><a
                    href="{{ route('company', $order->product->company->id) }}">{{ $order->product->company->name }}</a>
                </td>
              </tr>
              <tr>
                <th class="narrow">الكمــية</th>
                <td>{{ $order->quantity }}</td>
              </tr>
              <tr>
                <th class="narrow">المبلغ الاجمالى</th>
                <td>{{ $order->price }}</td>
              </tr>
              <tr>
                <th class="narrow">حـالة الشراء</th>
                <td>{{ $order->statusLabel }}</td>
              </tr>
              @if($order->isPending || $order->isInProcessing)
                <tr>
                  <th class="narrow">تحويل حالة الشراء</th>
                  <td>
                    @if($order->isPending)
                      <form action="{{ route('admin.order.process', $order->id) }}" method="post" class="inline-block">
                        @csrf
                        <button type="submit" class="btn btn-primary bold">
                          <i class="fa fa-cog"></i> &nbsp;
                          جعل الطلب تحت التنفيذ
                        </button>
                      </form>
                    @endif
                    @if($order->isInProcessing)
                      <form action="{{ route('admin.order.finish', $order->id) }}" method="post" class="inline-block">
                        @csrf
                        <button type="submit" class="btn btn-success bold">
                          <i class="fa fa-check-circle"></i> &nbsp;
                          تم استلام الطلب
                        </button>
                      </form>
                    @endif
                    @if($order->isPending || $order->isInProcessing)
                      <form action="{{ route('admin.order.cancel', $order->id) }}" method="post" class="inline-block">
                        @csrf
                        <button type="submit" class="btn btn-danger bold">
                          <i class="fa fa-times-circle"></i> &nbsp;
                          إلغــاء الطــلب
                        </button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endif
            </table>
          </div>
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
@stop
