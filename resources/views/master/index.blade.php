@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Masters</div>

               <div class="card-body">
                   <div>{{$masters->links()}}</div>
                   <ul class="list-group">
                       @foreach ($masters as $master)
                        <li class="list-group-item">
                            <div class="list-block">
                                <div class="list-block__content">
                                    <p>{{$master->name}} {{$master->surname}}</p>
                                    @if ($master->getOutfit()->count())
                                    <small>Master works on {{$master->getOutfit()->count()}} outfits.</small>
                                    @else
                                     <small>Master is free now.</small>
                                    @endif
                                </div>
                                <div class="list-block__buttons">
                                    <a href="{{route('master.edit',[$master])}}" class="btn btn-primary">Edit</a>
                                    <form method="POST" action="{{route('master.destroy', $master)}}">
                                        <button type="submit" class="btn btn-danger">Delete</button>   
                                        @csrf
                                    </form> 
                                </div>
                            </div>
                        </li>
                        @endforeach
                   </ul>
                   <div class="mt-3">{{$masters->links()}}</div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@section('title') Masters @endsection
