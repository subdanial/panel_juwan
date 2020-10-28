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

    .line {
        margin-left: 288px;
        margin-bottom: 8px;
    }

    .qrcode {

        width: calc(132px * 2);
        height: calc(94px* 2);
        border: 1px solid black;
        font-size: calc(0.6rem * 2);
        margin-right: calc(8px * 2);
    }

    .qr-image {
        margin: 5px;
        height: calc(63px * 2);
    }

    .code {
        margin-top: calc(1px * 2);

    }

    .name {
        padding-top: calc(2px * 2);
        font-size: calc(0.65rem * 2);

    }

    .data {
        margin-left: 5px;
    }
</style>

<body>
    @for ($i = 0; $i <= $count; $i++) <div class="line">
        <div class="d-flex for-col ">
            <div class="qrcode">
                <div class="d-flex ">
                    <div class="qr-image">
                        <div id="qrcode" class="qr_code_div"></div>
                    </div>
                    <div class="data">
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
                <div class="name text-center d-block mx-auto w-100">
                    {{$qr_name}}
                </div>
            </div>
        </div>
        </div>

        @endfor



        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/qrcode.min.js')}}"></script>

        <script>
            var qrcode ;
            for(i=0;i<={{$count}};i++){
                qrcode = new QRCode($(".qr_code_div")[i], {
            text: '0',
            width: 126,
            height: 126,
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