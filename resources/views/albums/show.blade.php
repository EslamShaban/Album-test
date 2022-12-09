@extends('layouts.admin.app')

@section('content')

<div class="app-title">
  <div>
    <h1><i class="fas fa-users"></i> Albums</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="#">Albums</a></li>
  </ul>
</div>
<div class="row">
    <div class="col-lg-12 mb-3">
      <form method="POST" action="{{ route('albums.upload_image', $album->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="name">Image name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <div class="uploadOuter">
            <span class="dragBox" >
              <i class="fal fa-cloud-upload-alt fa-2x"></i>

              <input type="file" name="image" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadImage"  />
            </span>
          </div>
          <div id="preview"></div>
        </div>
        <button type="submit" class="btn btn-primary">Upload Image</button>
      </form>
    </div>
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive" id="buttons">
            <table class="table table-bordered table-hover" id="sampleTable">
              <thead style="background-color: #f5f6f9">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead style="background-color: #f5f6f9">
              <tbody>
                @foreach ($images as $index=>$image)

                  <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{ $image->name }}</td>
                    <td>
                      <img src="{{ $image->getUrl() }}" width="100px" height="100px">
                    </td>
                    <td>  
                      <a href="#" class="delete-btn deleteNotify" id="deleteNotify" onclick="deleteItem('#delete_item_{{$album->id}}')"><i class="fa fa-trash fa-sm"></i> </a>
                      <form action="{{route('albums.image.destroy', [$album->id, $image->id])}}" method="POST" id="delete_item_{{$album->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete"/>
                      </form>
                    </td>
                  </tr>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
        
@endsection