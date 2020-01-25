@extends('dashboard.layout.template')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">طلبــات الشــراء</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-12">
                <h5>جميع طلبات الشراء</h5>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="well">
              <h5>البحــث بواســطة</h5>
              <form action="{{ route('admin.order.index') }}" method="get">
                <div class="row">
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="number" placeholder="رقم الشراء"
                           value="{{ old('number') }}">
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="buyerUserName" placeholder="اسم المشترى"
                           value="{{ old('buyerUserName') }}">
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="productName" placeholder="اسم المنتج"
                           value="{{ old('productName') }}">
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="companyName" placeholder="اسم الشركة"
                           value="{{ old('companyName') }}">
                  </div>
                  <div class="col-md-2">
                    <select name="status" class="form-control">
                      <option value="" selected>-- الحالة --</option>
                      @foreach($orderStatusList as $key => $value)
                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2">
                    <input type="submit" class="btn btn-primary btn-block" value="البحــث">
                  </div>
                </div>
              </form>
            </div>

            <table width="100%" class="table table-striped table-bordered table-hover">
              <thead>
              <tr>
                <th>رقم الشراء</th>
                <th>تاريخ الشراء</th>
                <th>المشترى</th>
                <th>المنتج</th>
                <th>الشركة</th>
                <th>المبلغ الاجمالى</th>
                <th class="text-center">الحالة</th>
                <th class="narrow"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($orders as $index => $order)
                <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                  <td>{{ $order->number }}</td>
                  <td>{{ $order->date }}</td>
                  <td><a href="{{ route('poultry-jam', $order->user->id) }}">{{ $order->user->name }}</a>
                  </td>
                  <td><a href="{{ route('product', $order->product->id) }}">{{ $order->product->name }}</a></td>
                  <td><a
                      href="{{ route('company', $order->product->company->id) }}">{{ $order->product->company->name }}</a>
                  </td>
                  <td>{{ $order->price }}</td>
                  <td>{{ $order->statusLabel }}</td>
                  <td class="narrow">
                    <div class="text-center">
                      <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-primary">
                        <i class="fa fa-info-circle"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="text-right">
              {{ $orders->appends(request()->except('page'))->links() }}
            </div>
          </div>
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
@stop
