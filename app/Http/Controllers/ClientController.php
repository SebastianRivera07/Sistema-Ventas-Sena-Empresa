<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clientes = Client::all();
        return view('clients.index', compact('clientes'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Client::create($request->only('name'));

        return redirect()->route('clients.index')->with('ok', 'Cliente creado');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $client->update($request->only('name'));

        return redirect()->route('clients.index')->with('ok', 'Cliente actualizado');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('ok', 'Cliente eliminado');
    }
}
