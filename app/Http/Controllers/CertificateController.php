<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Certificate::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_fields = $request->validate([
            'title'=>'required',
            'img'=> 'required',
        ]);

        if($request->hasFile('img')) {
            $file = $request->file('img')->store('images/certificates', 'images');
            $form_fields['img'] = $file;
        }
        return Certificate::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Certificate::find($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $certificate = Certificate::find($id);
        $form_fields = $request->validate([
            'title'=>'required',
            'img'=> 'required',
        ]);

        if($request->hasFile('img')) {
            !is_null($certificate->img) && Storage::disk('images')->delete($certificate->img);
            $file = $request->file('img')->store('images/certificates', 'images');
            $form_fields['img'] = $file;
        }
        $certificate->update($form_fields);
        return $certificate;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Certificate::find($id);
        !is_null($certificate->img) && Storage::disk('images')->delete($certificate->img);
        Certificate::destroy(($id));
    }
}
