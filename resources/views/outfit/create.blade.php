@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New outfit</div>

               <div class="card-body">
                    <form method="POST" action="{{route('outfit.store')}}">
                        <div class="list-block__content">
                            <label  class="form-label">Type</label>
                            <input type="text" class="form-control" name="outfit_type">
                            <label  class="form-label">Color</label>
                            <input type="text" name="outfit_color" class="form-control">
                            <label  class="form-label">Size</label>
                            <input type="text" name="outfit_size" class="form-control">
                            <label  class="form-label">About</label>
                            <textarea name="outfit_about"></textarea class="form-control">
                            <label  class="form-label">Select master</label>
                            <select name="master_id"  class="form-control">
                                @foreach ($masters as $master)
                                    <option value="{{$master->id}}">{{$master->name}} {{$master->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="list-block__buttons"> 
                            <button type="submit" class="btn btn-success">New outfit</button>
                        </div> 
                        @csrf
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


@section('title') New outfit @endsection
