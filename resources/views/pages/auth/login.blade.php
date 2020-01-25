@extends('layout.login')

@section('title', 'تسجيل الدخول')

@section('content')
  <div class="bg-container">
    <img class="clear-image" src="{{ asset('img/landscape.jpeg') }}">
    <div class="login-white-div">
      <div class="login-logo-div">
        <img class="login-logo-img" src="{{ asset('img/Logo.png') }}">
      </div>
      <div>
        <div class="row">
          <div class="col-md-12">
            <!-- Nav tabs -->
            <div class="card login-tabs">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="login-nav-border {{ $page == 'login' ? 'active' : '' }}">
                  <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                    <span>تسجيل الدخول</span>
                  </a>
                </li>
                <li role="presentation" class="{{ $page == 'sign-up' ? 'active' : '' }}">
                  <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                    <span>انشاء حساب</span>
                  </a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content login-tab-content">
                <div role="tabpanel" class="tab-pane login-tab fade {{ $page == 'login' ? 'in active' : '' }}"
                     id="home">
                  <div>
                    <form action="{{ url('login') }}" method="post">
                      @csrf
                      <h5>برجاء كتابه بياناتك في الاسفل</h5>
                      @if($errors->any())
                        <div class="alert alert-danger">
                          {{ $errors->first() }}<br>
                        </div>
                      @endif
                      <div>
                        <div class="input-group login-input-group">
                          <span class="input-group-btn">
                            <i class="fas fa-user"></i>
                          </span>
                          <input type="email" name="email" class="form-control" placeholder="البريد الالكترونى"
                                 required>
                        </div>
                        <div class="input-group login-input-group">
                          <span class="input-group-btn">
                            <i class="fas fa-unlock"></i>
                          </span>
                          <input type="password" name="password" class="form-control" placeholder="كلمة المرور"
                                 required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 text-right">
                          <a href="{{ route('password.request') }}" class="black">نسيت كلمة المرور؟</a>
                        </div>
                        <div class="col-sm-6 text-left">
                          <button type="submit" class="btn btn-default login-div-login-btn">دخول</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade {{ $page == 'sign-up' ? 'in active' : '' }}" id="profile">
                  <div>
                    <form action="{{ url('register') }}" method="post">
                      @csrf
                      <div>
                        @if($errors->any())
                          <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                              {{ $error }}<br>
                            @endforeach
                          </div>
                        @endif
                        <div class="input-group login-input-group">
                          <span class="input-group-btn">
                            <i class="fas fa-user"></i>
                          </span>
                          <input type="text" name="name" class="form-control" placeholder="اسم المستخدم *"
                                 value="{{ old('name') }}" required>
                        </div>
                        <div class="input-group login-input-group">
                          <span class="input-group-btn">
                            <i class="fas fa-envelope"></i>
                          </span>
                          <input type="email" name="email" class="form-control" placeholder="البريدالالكتروني *"
                                 value="{{ old('email') }}" required>
                        </div>
                        <div class="input-group login-input-group">
                          <span class="input-group-btn">
                            <i class="fas fa-unlock"></i>
                          </span>
                          <input type="password" name="password" class="form-control" placeholder="كلمة المرور *"
                                 required>
                        </div>
                        <div class="input-group login-input-group">
                          <span class="input-group-btn">
                            <i class="fas fa-unlock"></i>
                          </span>
                          <input type="password" name="password_confirmation" class="form-control"
                                 placeholder="تأكيد كلمة المرور* "
                                 required>
                        </div>
                      </div>
                      <div class="login-div-login-btn-div">
                        <button type="submit" class="btn btn-default login-div-login-btn">تسجيل</button>
                      </div>
                    </form>
                  </div>
                </div>

                <div>
                  <h4 class="login-div-social-title"><span>سجل عبر التواصل الاجتماعي</span></h4>
                  <div class="login-social-btns-div">
                    <div class="login-social-btns-single-div">
                      <button class="btn  login-social-btns face-book-btn">
                        <span>Facebook</span>
                        <i class="fab fa-facebook-f"></i>
                      </button>
                    </div>
                    <div class="login-social-btns-single-div">
                      <button class="btn  login-social-btns linked-btn">
                        <span>Linkedin</span><i class="fab fa-linkedin-in"></i>
                      </button>
                    </div>
                    <div class="login-social-btns-single-div">
                      <button class="btn  login-social-btns google-btn">
                        <span>+Google</span><i class="fab fa-google-plus-g"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('script')
  <script type="text/javascript">
      (function ($) {
          var image = document.querySelector('.clear-image');
          var appending = document.querySelector('.bg-container');
          var imageCanvas = document.createElement('canvas');
          var imageCanvasContext = imageCanvas.getContext('2d');
          var lineCanvas = document.createElement('canvas');
          var lineCanvasContext = lineCanvas.getContext('2d');
          var pointLifetime = 1000;
          var points = [];

          if (image.complete) {
              start();
          } else {
              image.onload = start;
          }

          /**
           * Attaches event listeners and starts the effect.
           */
          function start() {
              document.addEventListener('mousemove', onMouseMove);
              window.addEventListener('resize', resizeCanvases);
              appending.appendChild(imageCanvas);
              resizeCanvases();
              tick();
          }

          /**
           * Records the user's cursor position.
           *
           * @param {!MouseEvent} event
           */
          function onMouseMove(event) {
              points.push({
                  time: Date.now(),
                  x: event.clientX,
                  y: event.clientY
              });
          }

          /**
           * Resizes both canvases to fill the window.
           */
          function resizeCanvases() {
              imageCanvas.width = lineCanvas.width = window.innerWidth;
              imageCanvas.height = lineCanvas.height = window.innerHeight;
          }

          /**
           * The main loop, called at ~60hz.
           */
          function tick() {
              // Remove old points
              points = points.filter(function (point) {
                  var age = Date.now() - point.time;
                  return age < pointLifetime;
              });

              drawLineCanvas();
              drawImageCanvas();
              requestAnimationFrame(tick);
          }

          /**
           * Draws a line using the recorded cursor positions.
           *
           * This line is used to mask the original image.
           */
          function drawLineCanvas() {
              var minimumLineWidth = 25;
              var maximumLineWidth = 100;
              var lineWidthRange = maximumLineWidth - minimumLineWidth;
              var maximumSpeed = 50;

              lineCanvasContext.clearRect(0, 0, lineCanvas.width, lineCanvas.height);
              lineCanvasContext.lineCap = 'round';
              lineCanvasContext.shadowBlur = 30;
              lineCanvasContext.shadowColor = '#000';

              for (var i = 1; i < points.length; i++) {
                  var point = points[i];
                  var previousPoint = points[i - 1];

                  // Change line width based on speed
                  var distance = getDistanceBetween(point, previousPoint);
                  var speed = Math.max(0, Math.min(maximumSpeed, distance));
                  var percentageLineWidth = (maximumSpeed - speed) / maximumSpeed;
                  lineCanvasContext.lineWidth = minimumLineWidth + percentageLineWidth * lineWidthRange;

                  // Fade points as they age
                  var age = Date.now() - point.time;
                  var opacity = (pointLifetime - age) / pointLifetime;
                  lineCanvasContext.strokeStyle = 'rgba(0, 0, 0, ' + opacity + ')';

                  lineCanvasContext.beginPath();
                  lineCanvasContext.moveTo(previousPoint.x, previousPoint.y);
                  lineCanvasContext.lineTo(point.x, point.y);
                  lineCanvasContext.stroke();
              }
          }


          function getDistanceBetween(a, b) {
              return Math.sqrt(Math.pow(a.x - b.x, 2) + Math.pow(a.y - b.y, 2));
          }

          /**
           * Draws the original image, masked by the line drawn in drawLineToCanvas.
           */
          function drawImageCanvas() {
              // Emulate background-size: cover
              var width = imageCanvas.width;
              var height = imageCanvas.width / image.naturalWidth * image.naturalHeight;

              if (height < imageCanvas.height) {
                  width = imageCanvas.height / image.naturalHeight * image.naturalWidth;
                  height = imageCanvas.height;
              }

              imageCanvasContext.clearRect(0, 0, imageCanvas.width, imageCanvas.height);
              imageCanvasContext.globalCompositeOperation = 'source-over';
              imageCanvasContext.drawImage(image, 0, 0, width, height);
              imageCanvasContext.globalCompositeOperation = 'destination-in';
              imageCanvasContext.drawImage(lineCanvas, 0, 0);
          }
      })(jQuery);
  </script>
@stop