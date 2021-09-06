@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Manser info</div>

               <div class="card-body">
                  <form method="POST" action="{{route('master.update',$master)}}">
                    <div class="list-block__content">
                        <label  class="form-label">Name</label>
                        <input type="text" class="form-control" name="master_name" value="{{$master->name}}">
                        <label  class="form-label">Surname</label>
                        <input type="text" class="form-control" name="master_surname" value="{{$master->surname}}">
                    </div>
                    <div class="list-block__buttons">
                        <button type="submit" class="btn btn-info">Edit</button>
                    </div>
                     @csrf
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@section('title') Master info @endsection
