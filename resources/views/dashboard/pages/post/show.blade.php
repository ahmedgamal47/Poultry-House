@extends('dashboard.layout.template')

@section('title', $post->title)

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">المقال #{{ $post->id }}</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>بيانات المقال</h5>
          </div>
          <div class="panel-body">
            <table width="100%" class="table table-striped">
              <tbody>
              <tr>
                <th class="narrow">هنوان المقال</th>
                <td>{{ $post->title }}</td>
              </tr>
              <tr>
                <th class="narrow">صورة المقال</th>
                <td><img src="{{ $post ? $post->image->large->url : null }}" class="img-responsive"></td>
              </tr>
              <tr>
                <th class="narrow">المحتـــوى</th>
                <td>{!! nl2br($post->description) !!}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
