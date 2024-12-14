<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'client_id' => 'required|integer|exists:clients,id',
                'url' => 'required|string|unique:informations',
                'server' => 'required|string',
                'environment' => 'required|string',
            ],
            [
                'client_id.integer' => 'Client ID must be an integer.',
                'url.required' => 'The URL field is required.',
                'url.string' => 'The URL must be a string.',
                'url.unique' => 'This URL is already taken.',
                'server.required' => 'The server field is required.',
                'server.string' => 'The server must be a string.',
                'environment.required' => 'The environment field is required.',
                'environment.string' => 'The environment must be a string.',
            ]
        );

        Information::create($request->all());

        $client = Client::find($request->client_id);
        if ($client) {
            $client->touch();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
