<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$cliente = new Cliente();
		$clientes = Cliente::All();
        return view("cliente.index", [
			"clientes" => $clientes,
			"cliente" => $cliente
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
			$cliente = Cliente::Find($request->get("id"));
		} else {
			$cliente = new Cliente();
		}
		
		$cliente->nome = $request->get("nome");
		$cliente->email = $request->get("email");
		$cliente->save();
		
		$request->Session()->flash("status", "salvo");
		
		return redirect("/cliente");
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
        $cliente = Cliente::Find($id);
		$clientes = Cliente::All();
		return view("cliente.index", [
			"clientes" => $clientes,
			"cliente" => $cliente
		]);
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
        Cliente::Destroy($id);
		$request->Session()->flash("status", "excluido");
		return redirect("/cliente");
    }
}
