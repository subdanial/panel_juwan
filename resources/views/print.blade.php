<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css' rel='stylesheet' type='text/css'>
</head>
<style>
    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }


    }

    * {
        font-family: Vazir;
        font-size: 0.88rem;
    }


    .label {
        margin-right: 2mm;
        margin-left: 2mm;
        margin-top: 1.55mm;
        margin-bottom: 1.55mm;
        font-weight: 900;
        width: 5cm;
        height: 3cm;
        border: 1px solid black;
    }

    .#qrcode {
        height: 24mm !important;
    }
</style>

<body>
    <div class="ml-4 mt-3 d-flex flex-wrap" style="width: 25cm">
        @for ($i = 0; $i <= $count; $i++) 
        <div class="label text-right">
            <div class="d-flex justify-content-between">
                <div class="qr-image">
                    <div id="qrcode" class="qr_code_div"></div>
                </div>
                <div class="data p-1">
                    <span class="code d-block">
                        {{$qr_code}}
                    </span>
                    <span class="code-system d-block">
                        {{$qr_code_system}}
                    </span>
                    <span class="price d-block">
                        {!!number_format($qr_price)!!}
                    </span>
                </div>
            </div>
            <div class="name text-center d-block mx-auto mt-2 w-100">
                {{$qr_name_system}}
            </div>
    </div>
    @endfor
    </div>



    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/qrcode.min.js')}}"></script>

    <script>
        var qrcode ;
            for(i=0;i<={{$count}};i++){
                qrcode = new QRCode($(".qr_code_div")[i], {
            text: '{{$qr_code}}',
            width: 80,
            height: 80,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
            });
            }

    //  qrcode.clear();
    //  qrcode.makeCode($(this).attr('data-code'));
  
        
    </script>


</body>

</html>