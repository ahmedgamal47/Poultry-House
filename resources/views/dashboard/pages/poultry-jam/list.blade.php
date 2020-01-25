@extends('dashboard.layout.template')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">المربــيين</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-6">
                <h5>جميع المربيين</h5>
              </div>
              <div class="col-md-6 text-right">
                <a href="{{ route('admin.poultry-jam.create') }}" class="btn btn-success">
                  تسجيل مربى جديد
                  <i class="fa fa-plus-circle fa-fw"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="well">
              <h5>البحث بواسطة</h5>
              <form action="{{ route('admin.poultry-jam.index') }}" method="get">
                <div class="row">
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="name" placeholder="اسم المربى"
                           value="{{ old('name') }}">
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="phone" placeholder="رقم الهاتف"
                           value="{{ old('phone') }}">
                  </div>
                  <div class="col-md-2">
                    <input type="email" class="form-control" name="email" placeholder="البريد الالكترونى"
                           value="{{ old('email') }}">
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="code" placeholder="الرقم الكودى"
                           value="{{ old('code') }}">
                  </div>
                  <div class="col-md-2">
                    <select name="status" class="form-control">
                      <option value="" selected>-- الحالة --</option>
                      <option value="1" {{ old('status') == '1' ? 'selected': '' }}>مفــعل</option>
                      <option value="0" {{ old('status') == '0' ? 'selected': '' }}>غير مفعل</option>
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
                <th class="narrow"></th>
                <th>اسم المربى</th>
                <th>رقم الهاتف</th>
                <th>البريد الالكترونى</th>
                <th>الرقم الكودى</th>
                <th>مجال المربى</th>
                <th class="text-center">الحالة</th>
                <th class="narrow"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($poultryJams as $index => $poultryJam)
                <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                  <td class="narrow">
                    <img src="{{ $poultryJam->user->image->thumbnail->url }}" class="avatar">
                  </td>
                  <td>{{ $poultryJam->user->name }}</td>
                  <td>{{ $poultryJam->user->phone }}</td>
                  <td>{{ $poultryJam->user->email }}</td>
                  <td>{{ $poultryJam->code }}</td>
                  <td>{{ $poultryJam->field }}</td>
                  <td class="text-center">{{ $poultryJam->user->active ? 'مفــعل' : 'غير مفعل' }}</td>
                  <td class="narrow">
                    <div class="text-center">
                      <a href="{{ route('admin.poultry-jam.show', $poultryJam->id) }}" target="_blank"
                         class="btn btn-primary">
                        <i class="fa fa-info-circle"></i>
                      </a>
                      <a href="{{ route('admin.poultry-jam.edit', $poultryJam->id) }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      <form action="{{ route('admin.poultry-jam.activate', $poultryJam->id) }}" method="post"
                            class="inline-block">
                        @csrf
                        <input type="hidden" name="poultryJamId" value="{{ $poultryJam->id }}">
                        @if($poultryJam->user->active)
                          <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i>
                          </button>
                        @else
                          <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle"></i>
                          </button>
                        @endif
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="text-right">
              {{ $poultryJams->appends(request()->except('page'))->links() }}
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
