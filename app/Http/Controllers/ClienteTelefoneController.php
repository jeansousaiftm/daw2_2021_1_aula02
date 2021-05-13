<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClienteTelefone;

class ClienteTelefoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
        $cliente_telefone = new ClienteTelefone();
		$cliente_telefone->cliente = $request->get("cliente");
		
		$cliente_telefones = ClienteTelefone::Where("cliente", $request->get("cliente"))->orderByDesc("preferencial")->get();
		
		return view("cliente_telefone.index", [
			"cliente_telefone" => $cliente_telefone,
			"cliente_telefones" => $cliente_telefones
		]);
		
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
        if ($request->get("id") != "") {
			$cliente_telefone = ClienteTelefone::Find($request->get("id"));
		} else {
			$cliente_telefone = new ClienteTelefone();
		}
		
		$cliente_telefone->cliente = $request->get("cliente");
		
		$telefone = $request->get("telefone");
		$telefone = str_replace("(", "", $telefone);
		$telefone = str_replace(")", "", $telefone);
		$telefone = str_replace("-", "", $telefone);
		$telefone = str_replace(" ", "", $telefone);
		$cliente_telefone->telefone = $telefone;
		
		if ($request->get("preferencial") == 1) {
			$cliente_telefone->preferencial = 1;
		} else {
			$cliente_telefone->preferencial = 0;
		}
		
		$cliente_telefone->save();
		
		$request->session()->flash("status", "salvo");
		
		return redirect()->action(
			[ClienteTelefoneController::class, "index"], [ "cliente" => $request->get("cliente") ]
		);
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cliente_telefone = ClienteTelefone::Find($id);
		$cliente = $cliente_telefone->cliente;
		
		$cliente_telefone->delete();
		$request->session()->flash("status", "excluido");
		
		return redirect()->action(
			[ClienteTelefoneController::class, "index"], [ "cliente" => $cliente ]
		);
		
    }
}
