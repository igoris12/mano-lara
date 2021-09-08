<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$outfit->color}}-{{$outfit->type}}</title>
</head>
<body>
    <h1>{{$outfit->type}}</h1> 
    <small>{{$outfit->getMaster()->name}} {{$outfit->getMaster()->surname}}</small>
    <h2>{{$outfit->color}}</h2>
    <h2>{{$outfit->size}}</h2>
    <p>{{$outfit->about}}</p>
</body>
</html>