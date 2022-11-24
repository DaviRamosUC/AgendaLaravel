<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::with('Addresses')->get();

        return response()->json([
            'contacts' => $contacts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function email($id)
    {
        $data = ['Id'=>$id];
        Mail::send('emails.newContact', $data, function ($message) {
            $message->from('ifbadavi@gmail.com', 'Davi Ramos');
            $message->sender('ifbadavi@gmail.com', 'Davi Ramos');
            $message->to('rmatos358@gmail.com', 'Renata Matos');
            $message->replyTo('ifbadavi@gmail.com', 'Davi Ramos');
            $message->subject('Email de teste');
        });
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
        $newContact->nome = $formulario['nome'];
        $newContact->sobrenome = $formulario['sobrenome'];
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
    public function update(Request $request)
    {
        $formulario = $request->input();
        
        $contato = Contact::where('id', $formulario['id'])->first();
        $contato->nome = $formulario['nome'];
        $contato->sobrenome = $formulario['sobrenome'];
        $contato->email = $formulario['email'];
        $contato->telefone = $formulario['telefone'];
        $contato->save();

        $endereco = Address::where('id', $contato->addresses_id)->first();
        $endereco->CEP = $formulario['cep'];
        $endereco->bairro = $formulario['bairro'];
        $endereco->estado = $formulario['estado'];
        $endereco->numero = $formulario['numero'];
        $endereco->cidade = $formulario['cidade'];
        $endereco->endereco = $formulario['logradouro'];
        $endereco->save();
        
        return response()->json([
            'contato' => $formulario
        ], 200);
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
