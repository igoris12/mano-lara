@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                   <h3>Outfits</h3>
                   <form action="{{route('outfit.index')}}" method="get">
                        <fieldset>
                            <legend>Sort</legend>
                            <div class="block">
                                <button class="btn btn-primary" name="sort" value="type">Type</button>
                                <button class="btn btn-primary" name="sort" value="color">Color</button>
                                <button class="btn btn-primary" name="sort" value="size">Size</button>
                            </div>
                            <div class="block">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" 
                                    name="sortDir" id="_1" 
                                    value="asc" @if($sortDir != 'desc' )  checked @endif>
                                    <label class="form-check-label" for="_1">
                                    ASC
                                    </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                        name="sortDir" id="_2"
                                        value="desc"  @if($sortDir == 'desc' )  checked @endif>
                                        <label class="form-check-label" for="_2">
                                            DESC
                                        </label>
                                </div>
                            </div>

                            <div class="block">
                                <a href="{{route('outfit.index')}}"class="btn btn-danger">Reset</a>
                            </div>
                        </fieldset>
                        
                    </form>
                    <form action="{{route('outfit.index')}}" method="get">
                        <fieldset >
                            <legend>Filter</legend>
                            <div class="block">
                                <select class="form-control" name="master_id">
                                    <option value="0" disabled selected >Select Master</option>
                                    @foreach ($masters as $master)
                                       <option value="{{$master->id}}" @if($master_id == $master->id) selected @endif>{{$master->name}} {{$master->surname}}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Select master from the list.</small>
                            </div>
                            <div class="block">
                                <button type="submit" class="btn btn-primary" name="filter" value="master">Filter</button>
                                <a href="{{route('outfit.index')}}" class="btn btn-danger">Reset</a>
                            </div>
                        </fieldset>
                    </form>

                    </form>
                    <form action="{{route('outfit.index')}}" method="get">
                        <fieldset >
                            <legend>Search</legend>
                            <div class="block">
                                <input class="form-control" type="text" placeholder="Search" name="s" value="">
                                <small class="form-text text-muted">Search in our Fashion House</small>
                            </div>
                            <div class="block">
                                <button type="submit" class="btn btn-primary" name="search" value="all">Filter</button>
                                <a href="{{route('outfit.index')}}" class="btn btn-danger">Reset</a>
                            </div>
                        </fieldset>
                    </form>
                </div>

               <div class="card-body">
                    <div class="mt-3">{{$outfits->links()}}</div>

                   <ul class="list-group">
                        @foreach ($outfits as $outfit)
                            <li class="list-group-item">
                                 <div class="list-block">
                                    <div class="list-block__content">
                                        <div class="list-block__img">
                                            @if ($outfit->photo)
                                            <img src="{{$outfit->photo}}" alt="{{$outfit->type}}">
                                            @else
                                            <img src="{{asset('img/noImage.png')}}" alt="{{$outfit->type}}">
                                            @endif
                                        </div>
                                        <p><b>{{$outfit->type}}</b>  <i>Color:</i> {{$outfit->color}}   <i>Size: </i>{{$outfit->size}}</p>
                                        <small>{{$outfit->getMaster->name}} {{$outfit->getMaster->surname}}</small>
                                    </div>
                                    <div class="list-block__buttons">
                                        <a href="{{route('outfit.show',[$outfit])}}" class="btn btn-info">Show</a>
                                        <a href="{{route('outfit.edit',[$outfit])}}" class="btn btn-primary">Edit</a>
                                        <form method="POST" action="{{route('outfit.destroy', [$outfit])}}">
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-3">{{$outfits->links()}}</div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


@section('title') Outfits @endsection