<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all()->load('informations');

        return Inertia('Clients/Index', [
            'clients' => $clients
        ]);

//        return Inertia('Clients/Index', [
//            'clients' => Inertia::defer(fn () => $clients),
//        ]);
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
                'name' => 'required|string|unique:clients',
            ],
            [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.unique' => 'This client name is already taken.',
            ]
        );

        Client::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $client = Client::findOrFail($id)->load('informations');

        return Inertia('Clients/Show', compact('client'));
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
        Client::destroy($id);
    }

    public function search(Request $request)
    {
        try {
            // Perform the search
            $search_result = Client::search($request->keyword)->get();

            // Check if the result is empty
            if ($search_result->isEmpty()) {
                \Log::info('No results found for keyword: ' . $request->keyword);
            } else {
                \Log::info('Search results found:', $search_result->toArray());
            }

            return response()->json([
                'result' => $search_result,
            ]);
        } catch (\Exception $e) {
            \Log::error('Search error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Search failed, please try again later.'
            ], 500);
        }
    }
}
