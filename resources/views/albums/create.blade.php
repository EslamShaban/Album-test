@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-8">
      <div class="tile">
        <div class="tile-header">
          <div style="padding-bottom: 10px">
            <span class="fas fa-info-circle"></span>  Create Album
          </div>
          <div class="col-12 divider"></div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" action="{{ route('albums.store')}}">
              @csrf

              <div class="form-group">
                <label for="name">Album name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
              </div>

          </div>

        </div>
        <div class="tile-footer">
          <button class="btn btn-info" type="submit">Add Album</button>
        </div>
      </div>
    </form>
    </div>
  </div>
@endsection
