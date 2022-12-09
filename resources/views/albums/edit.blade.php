@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-8">
      <div class="tile"> 
        <div class="tile-header">
          <div style="padding-bottom: 10px">
            <span class="fas fa-info-circle"></span> Edit
          </div>
          <div class="col-12 divider"></div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('albums.update', $album->id)}}">
              @csrf
              <input type="hidden" name="_method" value="PUT"/>  

              <div class="form-group">
                <label for="name">{{ __('admin.username')}}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $album->name }}">
              </div>      
          </div>

        </div>
        <div class="tile-footer">
          <button class="btn btn-info" type="submit">Edit</button>
        </div>
      </div>
    </form>
    </div>
  </div>
@endsection