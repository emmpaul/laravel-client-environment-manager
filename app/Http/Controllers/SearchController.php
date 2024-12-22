<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return inertia('Search/Index');
    }

    public function search(Request $request)
    {
        try {
            $search_result = Client::search($request->keyword)->get();

            if ($search_result->isEmpty()) {
                \Log::info('No results found for keyword: '.$request->keyword);
            } else {
                \Log::info('Search results found:', $search_result->toArray());
            }

            $search_result->load('informations');

            return response()->json([
                'result' => $search_result->map(function ($client) {
                    return [
                        'client' => $client,
                        'informations' => $client->informations->map(function ($information) {
                            return [
                                'client_id' => $information->client_id,
                                'url' => $information->url,
                                'server' => $information->server,
                                'environment' => $information->environment,
                                'updated_at' => $information->updated_at,
                            ];
                        }),
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            $error = 'Search error: '.$e->getMessage();
            \Log::error($error);

            return response()->json([
                'error' => $error,
            ], 500);
        }
    }
}
