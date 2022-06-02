<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <meta charset="utf-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}" defer></script>

    <title>Product select</title>

</head>

<body class="bg-gray-100">

<div class="flex border-b-2 fixed-top h-18 border-gray-200 p-3 bg-white">
    <img src="image/back.png" class="object-contain hover:cursor-pointer w-8 md:w-auto">
    <div class="font-bold text-2xl md:text-5xl ml-2 mx-auto">Buy</div>
</div>

<div id="app">
    <select-option></select-option>
</div>



</body>

</html>
