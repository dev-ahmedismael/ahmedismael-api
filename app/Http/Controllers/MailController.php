<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Mail::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_fields = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'subject'=>'required',
        ]);

        return Mail::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Mail::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Mail::destroy($id);
    }
}
