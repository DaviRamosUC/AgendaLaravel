<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return response()->json([
            'contacts' => $contacts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formulario = $request->input();
        
        $newAddress = new Address();
        $newAddress->cep = $formulario['cep'];
        $newAddress->estado = $formulario['estado'];
        $newAddress->cidade = $formulario['cidade'];
        $newAddress->bairro = $formulario['bairro'];
        $newAddress->endereco = $formulario['logradouro'];
        $newAddress->numero = $formulario['numero'];
        $newAddress->save();

        $newContact = new Contact();
        $newContact->nome = $formulario['nome']." ".$formulario['sobrenome'];
        $newContact->email = $formulario['email'];
        $newContact->telefone = $formulario['telefone'];
        $newContact->addresses_id = $newAddress->id;
        $newContact->save();

        return response()->json([
            'contato' => $newContact
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $contact = Contact::where('id',$id)->first();
        if($contact){
            $response = Contact::destroy($id);
            return response()->json([
                'id' => $response
            ], 200);
        }else{
            return response()->json([
                'id' => 0
            ], 400);
        }

    }
}
