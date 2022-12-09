<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Http\Requests\AlbumRequest;
use App\Http\Requests\UploadImageRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();

        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        Album::create($request->validated());

        notify()->success('success', 'Album Added Successfully');
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $images = $album->getMedia();
        return view('albums.show', compact('album', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);

        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, Album $album)
    {
        $album->update($request->validated());

        notify()->success('success', 'Album Updated Successfully');
        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();

        notify()->success('success', 'Album deleted Successfully');
        return redirect()->route('albums.index');
    }

    public function upload_image(UploadImageRequest $request, Album $album)
    {
         if ($request->has('image')) {
            $album->addMedia($request->image)->usingName($request->name)->toMediaCollection();
        }
        return redirect()->back();
    }

    public function destroy_image(Album $album, $id)
    {
        $album_images = $album->getMedia();
        $album_images->where('id', $id)->first()->delete();

        return redirect()->back();
    }

    public function move_images_to_another_album(Request $request, Album $album)
    {
        foreach ($album->getMedia() as $key => $media) {
            $media->update(['model_id'=>$request->album_id]);
        }

        $album->delete();

        return redirect()->route('albums.index');

    }
}
