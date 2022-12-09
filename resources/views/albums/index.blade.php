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
    <div class="col-md-12" >
        <a href="{{ route('albums.create')}}" class="btn btn-info create-new-btn">Add Album</a>
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
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </thead style="background-color: #f5f6f9">
              <tbody>
                @foreach ($albums as $index=>$album)

                  <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{ $album->name }}</td>
                    <td>{{ $album->created_at->diffForHumans() }}</td>
                    <td>  
                      <a href="{{route('albums.show', $album->id)}}" class="edit-btn"><i class="fa fa-eye fa-sm"></i> </a>
                      <a href="{{route('albums.edit', $album->id)}}" class="edit-btn"><i class="fa fa-edit fa-sm"></i> </a>
                      <a href="#" class="delete-btn deleteNotify" id="deleteNotify" 
                        @if ($album->getMedia()->count())
                            data-toggle="modal" data-target="#delteOrMoveModal_{{$album->id}}"
                        @else
                            onclick="deleteItem('#delete_item_{{$album->id}}')"
                        @endif
                        
                        ><i class="fa fa-trash fa-sm"></i> </a>

                      <form action="{{route('albums.destroy', $album->id)}}" method="POST" id="delete_item_{{$album->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete"/>
                      </form>


                      <div class="modal fade" id="delteOrMoveModal_{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="delteOrMoveModal_{{$album->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="delteOrMoveModalLabel">Delete Or (Move to another Album)</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body" style="margin: auto">
                              <a href="#" class="delete deleteNotify" id="deleteNotify" onclick="deleteItem('#delete_item_{{$album->id}}')"><i class="delete fa fa-trash fa-sm"> Delete</i></a>
                              <div style="text-align: center">Or</div>
                              <div class="">
                                <form method="POST" action="{{ route('albums.images.move', $album->id)}}">
                                  @csrf
                                  <div class="form-group">
                                    <select name="album_id" class="form-control" id="album_id" required>
                                      <option value="">Move to another album</option>
                                      @foreach (\App\Models\Album::all() as $albums)
                                          @if ($albums->id != $album->id)
                                            <option value="{{ $albums->id }}">{{$albums->name}}</option>
                                          @endif
                                      @endforeach
                                    </select>
                                  </div>
                                  <button type="submit" class="btn btn-info">move</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
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
