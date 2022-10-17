<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Styles -->
     <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<style>
    body {
        direction: rtl;
    }
</style>
<body class="w-full">
    <div class="font-bold text-lg w-full text-center my-24">
        @if(isset($response['respStatus']) && $response['respStatus'] == 'A')
        <p class="text-green-500">
            تمت عملية الدفع بنجاح 
        </p>
        @else
        <p class="text-red-500">
            حدث خطأ أثناء عملية الدفع
        </p>
        @endif
    </div>
   
</body>
</html>