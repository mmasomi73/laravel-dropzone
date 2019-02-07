<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Upload Test</title>

    <!-- Bootstrap core CSS -->
    <link href="{{url('assets')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url ('assets')}}/dropzone/dropzone.css" rel="stylesheet" type="text/css">
    <link href="{{url('assets')}}/css/style.css" rel="stylesheet">

</head>

<body>

<div class="svg-container">
    <!-- I crated SVG with: https://codepen.io/anthonydugois/pen/mewdyZ -->
    <svg viewBox="0 0 800 200" class="svg">
        <path id="curve" fill="#ff2952" d="M 800 100 Q 400 150 0 100 L 0 0 L 800 0 L 800 100 Z">
        </path>
    </svg>
</div>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">DropZone Upload Image With Compress</h1>
        </div>
        <div class="col-lg-12">
            <div id="div-dropzone" style="margin-top: 30px; display: block;">
                <form id="property-picture" action="{{route('upload')}}"
                      class="dropzone" method="POST" files="true">
                    {{csrf_field()}}
                    <div class="dz-message">
                        <span class="note">...تصاوير ملک خود را آپلود کنيد...</span>
                        <span class="note"><br>حداقل 1 و حداکثر 20 تصوير با حداکثر حجم هر تصوير 5 مگابايت</span>
                        <span class="note"><br>برای حذف تصویر از لیست آپلود بر روی عکس کلیک کنید</span>
                    </div>
                    <div class="dropzone-previews"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="{{url('assets')}}/jquery/jquery.min.js"></script>
<script src="{{url('assets')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="{{url ('assets')}}/dropzone/dropzone.js"></script>
<script type="text/javascript" src="{{url ('assets')}}/dropzone/store-property-dropzone.js"></script>
<script type="text/javascript" src="{{url ('assets')}}/fonts/feather/feather.min.js"></script>
<script>
    feather.replace();
</script>

</body>

</html>
