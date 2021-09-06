@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New master</div>

               <div class="card-body">
                  <form method="POST" action="{{route('master.store')}}">
                    <div class="list-block__content">
                        <label  class="form-label">Name</label>
                        <input type="text" class="form-control" name="master_name"  value="{{old('master_name')}}" >
                        <label  class="form-label">Surname</label>
                        <input type="text" class="form-control" name="master_surname" value="{{old('master_surname')}}" >
                    </div>
                    <div class="list-block__buttons">
                        <button type="submit" class="btn btn-success">New master</button>
                    </div>
                     @csrf
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@section('title') New master @endsection
