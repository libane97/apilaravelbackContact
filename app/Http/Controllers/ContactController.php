<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::orderByDesc('created_at')->get();
       //  return $contact;
        return $contact->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Contact::create($request->all())){
                return response()->json([
                      'success' => 'le contact à ete crée avec success',
                ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact_id
     * @return \Illuminate\Http\Response
     */
    public function show($contact_id)
    {
        $contact = Contact::find($contact_id);

        if($contact){
            return $contact;
        }elseif(!$contact){
            return response()->json([
                          'success' => 'le contact n\'existe pas',
                   ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if($contact->update($request->all())){
            return response()->json([
                  'success' => 'le contact à ete modifier avec success',
            ], 200);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if($contact->delete()){
            return response()->json([
                  'success' => 'le contact à ete supprime avec success',
            ], 200);
    }
    }

    public function search($contact){
       $contact = DB::table('contacts')->where('telephone',$contact)->get();
        if ($contact){
            return $contact;
        }elseif (!$contact){
            return response()->json([
                'success' => 'le numero de telephone n\'existe pas',
            ], 200);
        }
    }
}
