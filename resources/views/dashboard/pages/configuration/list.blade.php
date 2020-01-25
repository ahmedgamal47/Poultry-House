@extends('dashboard.layout.template')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">الاعدادات</h1>
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
                <h5>جميع الاعدادات</h5>
              </div>
            </div>
          </div>
          <div class="panel-body">
            @if (($message = Session::get('success')))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @elseif( $errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                  <p>{{ $error }}</p>
                @endforeach
              </div>
            @endif
            <br>
            <form action="{{ route('admin.config') }}" method="post" enctype="multipart/form-data">
              @csrf
              <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th class="narrow">الاسم</th>
                  <th>القيمة</th>
                </tr>
                </thead>
                <tbody>
                <tr class="even">
                  <td class="narrow">عن الشركة</td>
                  <td>
                    <textarea id="about-company-editor" class="form-control" rows="5" name="about_company"
                              placeholder="تفاصيل عن الشركة"
                              required>{{ old('about_company', $configurations['about_company']) }}</textarea>
                  </td>
                </tr>
                <tr class="odd">
                  <td class="narrow">من نحن</td>
                  <td>
                    <textarea id="who-we-are-editor" class="form-control" rows="5" name="who_we_are"
                              placeholder="تعريف دور الشركة"
                              required>{{ old('who_we_are', $configurations['who_we_are']) }}</textarea>
                  </td>
                </tr>
                <tr class="even">
                  <td class="narrow">العنوان</td>
                  <td>
                    <input type="text" name="address" placeholder="العنوان" class="form-control" required
                           value="{{ old('address', $configurations['address']) }}">
                  </td>
                </tr>
                <tr class="odd">
                  <td class="narrow">الموبايل</td>
                  <td>
                    <input type="text" name="mobile" placeholder="الموبايل" class="form-control" required
                           value="{{ old('mobile', $configurations['mobile']) }}">
                  </td>
                </tr>
                <tr class="even">
                  <td class="narrow">البريد الالكترونى</td>
                  <td>
                    <input type="email" name="email" placeholder="البريد الالكترونى" class="form-control" required
                           value="{{ old('email', $configurations['email']) }}">
                  </td>
                </tr>
                <tr class="odd">
                  <td class="narrow">موقع الشركة على الخريطة</td>
                  <td>
                    <div class="map" data-lat="{{ old('latitude', $configurations['location_lat']) }}"
                         data-lng="{{ old('longitude', $configurations['location_lng']) }}"
                         data-enable-selection="1"
                         data-latitude-input-id="company-latitude"
                         data-longitude-input-id="company-longitude"></div>
                    <input type="hidden" id="company-latitude" name="latitude"
                           value="{{ old('latitude', $configurations['location_lat']) }}">
                    <input type="hidden" id="company-longitude" name="longitude"
                           value="{{ old('longitude', $configurations['location_lng']) }}">
                  </td>
                </tr>
                <tr class="even">
                  <td class="narrow">خدمات شركة دواجن مصر</td>
                  <td>
                    <ul class="services company">
                      <li>
                        <a class="btn btn-info bold btn-add-new"
                           onclick="addService(this, 'companyServices')">
                          اضافة خدمة جديدة
                        </a>
                      </li>
                      @php $lastIndex = 0; @endphp
                      @if(!empty(old('services', json_decode($configurations['services']))))
                        @foreach(old('services', json_decode($configurations['services'])) as $i => $service)
                          @php $lastIndex = max($lastIndex, $i); @endphp
                          <li>
                            <div class="row">
                              <div class="col-md-2">
                                <img src="{{ $service->photo }}" class="img-responsive img-thumbnail">
                              </div>
                              <div class="col-md-5">
                                <input type="text" name="services[{{ $i }}][name]" class="form-control"
                                       placeholder="اسم الخدمة" value="{{ $service->name }}" required>
                                <input type="hidden" name="services[{{ $i }}][photo]" value="{{ $service->photo }}">
                              </div>
                              <div class="col-md-4">
                                <input type="file" name="services-photos[{{ $i }}]" class="form-control">
                              </div>
                              <div class="col-md-1">
                                <a href="#" class="btn btn-danger btn-delete"><i class="fa fa-times-circle"></i></a>
                              </div>
                            </div>
                          </li>
                        @endforeach
                      @endif
                    </ul>
                  </td>
                </tr>
                <tr class="even">
                  <td class="narrow">خدمات الشركات</td>
                  <td>
                    <ul class="services company">
                      <li>
                        <a class="btn btn-info bold btn-add-new"
                           onclick="addElement(this, 'companyServices')">
                          اضافة خدمة جديدة
                        </a>
                      </li>
                      @if(!empty(old('companyServices', json_decode($configurations['company_services']))))
                        @foreach(old('companyServices', json_decode($configurations['company_services'])) as $service)
                          @if(!empty($service))
                            <li>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="text" name="companyServices[]" class="form-control"
                                         placeholder="وصف الخدمة" value="{{ $service }}" required>
                                </div>
                                <div class="col-md-1">
                                  <a href="#" class="btn btn-danger btn-delete"><i class="fa fa-times-circle"></i></a>
                                </div>
                              </div>
                            </li>
                          @endif
                        @endforeach
                      @endif
                    </ul>
                  </td>
                </tr>
                <tr class="odd">
                  <td class="narrow">خدمات المربيين</td>
                  <td>
                    <ul class="services company">
                      <li>
                        <a class="btn btn-info bold btn-add-new"
                           onclick="addElement(this, 'poultryJamServices')">
                          اضافة خدمة جديدة
                        </a>
                      </li>
                      @if(!empty(old('poultryJamServices', json_decode($configurations['poultry_jam_services']))))
                        @foreach(old('poultryJamServices', json_decode($configurations['poultry_jam_services'])) as $service)
                          @if(!empty($service))
                            <li>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="text" name="poultryJamServices[]" class="form-control"
                                         placeholder="وصف الخدمة" value="{{ $service }}" required>
                                </div>
                                <div class="col-md-1">
                                  <a href="#" class="btn btn-danger btn-delete"><i class="fa fa-times-circle"></i></a>
                                </div>
                              </div>
                            </li>
                          @endif
                        @endforeach
                      @endif
                    </ul>
                  </td>
                </tr>
                <tr class="even">
                  <td class="narrow">خدمات التجار</td>
                  <td>
                    <ul class="services company">
                      <li>
                        <a class="btn btn-info bold btn-add-new"
                           onclick="addElement(this, 'dealerServices')">
                          اضافة خدمة جديدة
                        </a>
                      </li>
                      @if(!empty(old('dealerServices', json_decode($configurations['dealer_services']))))
                        @foreach(old('dealerServices', json_decode($configurations['dealer_services'])) as $service)
                          @if(!empty($service))
                            <li>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="text" name="dealerServices[]" class="form-control"
                                         placeholder="وصف الخدمة" value="{{ $service }}" required>
                                </div>
                                <div class="col-md-1">
                                  <a href="#" class="btn btn-danger btn-delete"><i class="fa fa-times-circle"></i></a>
                                </div>
                              </div>
                            </li>
                          @endif
                        @endforeach
                      @endif
                    </ul>
                  </td>
                </tr>
                <tr class="odd">
                  <td class="narrow">خدمات الموزعين</td>
                  <td>
                    <ul class="services company">
                      <li>
                        <a class="btn btn-info bold btn-add-new"
                           onclick="addElement(this, 'distributorServices')">
                          اضافة خدمة جديدة
                        </a>
                      </li>
                      @if(!empty(old('distributorServices', json_decode($configurations['distributor_services']))))
                        @foreach(old('distributorServices', json_decode($configurations['distributor_services'])) as $service)
                          @if(!empty($service))
                            <li>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="text" name="distributorServices[]" class="form-control"
                                         placeholder="وصف الخدمة" value="{{ $service }}" required>
                                </div>
                                <div class="col-md-1">
                                  <a href="#" class="btn btn-danger btn-delete"><i class="fa fa-times-circle"></i></a>
                                </div>
                              </div>
                            </li>
                          @endif
                        @endforeach
                      @endif
                    </ul>
                  </td>
                </tr>
                <tr class="even">
                  <td class="narrow">خدمات البيطريين</td>
                  <td>
                    <ul class="services company">
                      <li>
                        <a class="btn btn-info bold btn-add-new"
                           onclick="addElement(this, 'vetServices')">
                          اضافة خدمة جديدة
                        </a>
                      </li>
                      @if(!empty(old('vetServices', json_decode($configurations['vet_services']))))
                        @foreach(old('vetServices', json_decode($configurations['vet_services'])) as $service)
                          @if(!empty($service))
                            <li>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="text" name="vetServices[]" class="form-control"
                                         placeholder="وصف الخدمة" value="{{ $service }}" required>
                                </div>
                                <div class="col-md-1">
                                  <a href="#" class="btn btn-danger btn-delete"><i class="fa fa-times-circle"></i></a>
                                </div>
                              </div>
                            </li>
                          @endif
                        @endforeach
                      @endif
                    </ul>
                  </td>
                </tr>
                </tbody>
              </table>
              <br>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">
                  حــــفظ
                  <i class="fa fa-check fa-fw"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
      (function () {
          CKEDITOR.replace('about-company-editor', {
              contentsLangDirection: 'rtl'
          });
          CKEDITOR.replace('who-we-are-editor', {
              contentsLangDirection: 'rtl'
          });

          $(document).on('click', 'a.btn-delete', function (event) {
              event.preventDefault();
              $(this).parent().parent().parent().remove();
          });
      })();

      function addElement(element, inputName) {
          $(element).parent().parent().append(
              '<li>\n' +
              '  <div class="row">\n' +
              '    <div class="col-md-6">\n' +
              '      <input type="text" name="' + inputName + '[]" class="form-control" placeholder="وصف الخدمة" required>\n' +
              '    </div>\n' +
              '    <div class="col-md-1">\n' +
              '      <a href="#" class="btn btn-danger btn-delete"><i class="fa fa-times-circle"></i></a>\n' +
              '    </div>\n' +
              '  </div>\n' +
              '</li>\n');
      }

      var last_service_index = {{ $lastIndex }};

      function addService(element) {
          last_service_index++;
          $(element).parent().parent().append(
              '<li>\n' +
              '  <div class="row">\n' +
              '    <div class="col-md-7">\n' +
              '      <input type="text" name="services[' + last_service_index + '][name]" class="form-control"\n' +
              '             placeholder="اسم الخدمة" value="" required>\n' +
              '    </div>\n' +
              '    <div class="col-md-4">\n' +
              '      <input type="file" name="services-photos[' + last_service_index + ']" class="form-control" required>\n' +
              '    </div>\n' +
              '    <div class="col-md-1">\n' +
              '      <a href="#" class="btn btn-danger btn-delete"><i class="fa fa-times-circle"></i></a>\n' +
              '    </div>\n' +
              '  </div>\n' +
              '</li>\n'
          );
      }
  </script>
@stop