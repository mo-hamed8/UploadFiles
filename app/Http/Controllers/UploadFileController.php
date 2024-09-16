<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function prviateStore(Request $request)
    {
        //
        $request->validate([
            "photo"=>"required|file|mimes:png,jpg|max:2048"
        ]);

        $path=$request->file("photo")->store("uploads","private");
        $f=File::create([
            "path"=>$path
        ]);
        return ["message"=>"done","id"=>$f->id];
    }
    public function publicStore(Request $request)
    {
        //
        $request->validate([
            "photo"=>"required|file|mimes:png,jpg|max:2048"
        ]);

        $path=$request->file("photo")->store("uploads","public");
        return ["path"=>asset("storage/".$path)];
    }


    public function getPhoto(File $file){
        $fileContent= Storage::disk('private')->get($file->path);
        $mimeType = Storage::disk('private')->mimeType($file->path);
        return response($fileContent, 200)->header('Content-Type', $mimeType);
    }
    public function downloadPhoto(File $file){
        return Storage::disk('private')->download($file->path);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
