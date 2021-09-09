<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$outfit->color}}-{{$outfit->type}}</title>
</head>

<style>
body,
body * {
    vertical-align: top;
    box-sizing: border-box;
}

div {
    margin: 20px;
    padding: 5px;
}

h2 {
    display: inline-block;
}

h3 {
    display: inline-block;
}
</style>
<body>
    <h1>{{$outfit->type}}</h1> 
    <div>
       <h2>Master: </h2> <h2>{{$outfit->getMaster->name}}</h2> <h2> {{$outfit->getMaster->surname}}</h2> 
    </div>
 
    <div>
        <h2>Color: </h2> <h2>{{$outfit->color}}</h2>

    </div>
    <div>
        <h2>Size: </h2> <h2>{{$outfit->size}}</h2>
    </div>
        
    

    <div>
        <p>{{$outfit->about}}</p>
    </div>
    
</body>
</html>