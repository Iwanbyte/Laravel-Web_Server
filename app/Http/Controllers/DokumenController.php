<?php

namespace App\Http\Controllers;

use App\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokumenController extends Controller
{
    //

    public function dokument(){
       $data = DB::table('dokumens')->get();
       $status = 200;
       $message = 'Success';


       return response()->json([
           'status' => $status,
           'data' => $data,
           'message' => $message
       ]);
    }


    public function store(Request $request){
        // $this->validate($request, [
        //     'gambar' => 'required|file|max:7000', // max 7MB
        // ]);
       $dokumen = new Dokumen;
       $dokumen->name = $request->get('name');
       if ($request->file('gambar')) {
           $file = $request->file('gambar')->store('avatars', 'public');
           $dokumen->gambar = $file;
       }
       $dokumen->body = $request->get('body');
       $dokumen->save();

    }
}
