@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Outfit info</div>

               <div class="card-body">
                    <form method="POST" action="{{route('outfit.update',[$outfit])}}"  enctype="multipart/form-data">
                        <div class="list-block__content">
                            <label  class="form-label">Type</label>
                            <input type="text" class="form-control" name="outfit_type" value="{{old('outfit_type', $outfit->type)}}">
                            <label  class="form-label">Color</label>
                            <input type="text" name="outfit_color" class="form-control"  value="{{old('outfit_color', $outfit->color)}}">
                            <label  class="form-label">Size</label>
                            <input type="text" name="outfit_size" class="form-control" value="{{old('outfit_size',$outfit->size)}}">
                            <label  class="form-label">About</label>
                            <textarea name="outfit_about" id="summernote">{{old('outfit_about', $outfit->about)}}</textarea>

                             
                            <label  class="form-label mt-3 ">Photo</label>
                            <div class=" mb-3 editImg">
                                @if($outfit->photo )
                                <img src="{{$outfit->photo}}" alt="{{$outfit->type}}">
                                @else
                                <img src="{{asset('img/noImage.png')}}" alt="{{$outfit->type}}">
                                @endif
                            </div>
                            <div class="imgCheckbox">
                                <input type="checkbox" class="form-check-input" name="outfit_photo_delete" id="df">
                                <label for="df">Delete photo</label>
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control" name="outfit_photo">
                                <small class="form-text text-muted">Outfit image.</small>
                            </div>

                            <label  class="form-label">Select master</label>
                            <select name="master_id"  class="form-control">
                                @foreach ($masters as $master)
                                    <option value="{{$master->id}}" @if(old('master_id', $outfit->master_id) == $master->id) selected @endif>{{$master->name}} {{$master->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="list-block__buttons"> 
                            <button type="submit" class="btn btn btn-info">Edit</button>
                        </div> 
                        @csrf
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>
@endsection

@section('title') Outfit info @endsection

