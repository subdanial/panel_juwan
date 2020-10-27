@extends('layout.app')
@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        @if(Session::has('msg'))
        <div class="col">
            <div class="alert alert-success text-right" role="alert">
                {{Session::get('msg')}}
            </div>
        </div>
        @endif

        @if(Session::has('error'))
        <div class="col">
            <div class="alert alert-danger text-right" role="alert">
                {{Session::get('error')}}
            </div>
        </div>
        @endif

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card px-4  mb-1">
                <div class="d-flex justify-content-between  pt-2 pb-2">
                    <span class="h4 d-block m-0">
                        افزودن محصول به سبد
                    </span>
                    <div>
                        <a href="{{route('orders.cart')}}" class="d-block btn btn-sm btn-dark pt-1"> مشاهده سبد <i
                                class="fa fa-eye align-middle mr-1" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-8 pl-0">
            <div class="card p-4 mb-2">
                <table id="table-products-order" class="w-100 table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>کد</th>
                            <th>عنوان</th>
                            <th>تصویر</th>
                            <th>دسته</th>
                            {{-- <th>قیمت</th> --}}
                            {{-- <th>سایز</th> --}}
                            {{-- <th>رنگ</th> --}}
                            <th>عملیات</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
        <div class="col-4 pr-1">
            <form action="{{route('orders.store')}}" class="order_store">
                <div class="card p-4 mb-2">
                    <div class="form-group">
                        <label for="client_name">مشتری : </label>
                        @if(isset($client))
                        <input type="text" value="{{$client->name}} {{$client->lastname}} " autocomplete="off"
                            class="form-control client_name" name="client_name" disabled>
                        <div id="clientList"></div>
                        {{csrf_field()}}
                        <input type="hidden" class="client_id" name="client_id" value="{{$client->id}}">
                        @else
                        <input type="text" autocomplete="off" class="form-control client_name" name="client_name"
                            placeholder="جستجو نام مشتری" required>
                        <div id="clientList"></div>
                        {{csrf_field()}}
                        <input type="hidden" class="client_id" name="client_id" value="">
                        @endif
                    </div>
                </div>
                <div class="card p-4 mb-2">
                    <label for="product_code">کد کالا</label>
                    <div class="scan">
                        <div id="loadingMessage">اسکنر درحال لود . </div>
                        <canvas id="canvas" class="w-100"hidden></canvas>
                        <div id="output" hidden>
                            <div id="outputMessage"></div>
                            <div hidden><b>Data:</b> <span id="outputData"></span></div>
                        </div>

                    </div>
                    <div class="d-flex mb-2">
                        <input type="text" name="code" class="form-control"
                            value="@isset($item){{$item->product_code}}@endisset" id="product_code" required>
                        <button type="submit" class="select_color btn btn-dark">انتخاب</button><br>
                    </div>
                    <hr>
                    <label for="">رنگ و تعداد سفارش</label>
                    <select class="colors custom-select w-100 mb-2">
                        <option value="-1">انتخاب نشده</option>
                    </select>
                    <div class="boxes d-block w-100">
                    </div>
                    <button type="submit" class="btn order_create_submit btn-dark mt-3">ثبت</button>
                </div>
                <div class="card p-4 mb-2">
                    <label for="">تصویر کالای انتخاب شده</label>
                    <img class="procut_image  d-block w-100 mb-3" src="" alt="" width="">
                </div>
            </form>
        </div>

    </div>
</div>

<script src="{{asset('js/jsQR.js')}}"></script>

<script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var loadingMessage = document.getElementById("loadingMessage");
    var outputContainer = document.getElementById("output");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("product_code");

    function drawLine(begin, end, color) {
      canvas.beginPath();
      canvas.moveTo(begin.x, begin.y);
      canvas.lineTo(end.x, end.y);
      canvas.lineWidth = 4;
      canvas.strokeStyle = color;
      canvas.stroke();
    }

    // Use facingMode: environment to attemt to get the front camera on phones
    navigator.getUserMedia({
      video: {
        facingMode: "environment"
      },
    }, function (stream) {
      video.srcObject = stream;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.play();
      requestAnimationFrame(tick);
    },function(e){
      console.log(e)
    });

    function tick() {
      loadingMessage.innerText = "سکنر درحال لود ..."
      if (video.readyState === video.HAVE_ENOUGH_DATA) {
        loadingMessage.hidden = true;
        canvasElement.hidden = false;
        outputContainer.hidden = false;

        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        var code = jsQR(imageData.data, imageData.width, imageData.height, {
          inversionAttempts: "dontInvert",
        });
        if (code) {
          drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
          drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
          drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
          drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
          outputMessage.hidden = true;
          outputData.parentElement.hidden = false;
          outputData.value = code.data;
        } else {
          outputMessage.hidden = false;
          outputData.parentElement.hidden = true;
        }
      }
      requestAnimationFrame(tick);
    }
</script>


@endsection