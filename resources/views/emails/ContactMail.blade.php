<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
    <!-- Bootstrap CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

</head>
<body>
    <div class="container">
        <h2 class="text-primary">Contact Message From Knowledge World User</h2>
        <h5>Name : {{$details['name']}}</h5>
        <p>Email From : <a href="mailto:{{$details['email']}}">{{$details['email']}}</a></p>
        <p class="text-justify">{{$details['message']}}</p>
    </div>
</body>
</html>


