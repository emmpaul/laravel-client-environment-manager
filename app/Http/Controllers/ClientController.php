<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::with('informations');

        if ($request->has('keyword') && $request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $totalClients = $query->count();

        $clients = $query->orderBy('name')->paginate(16);

        return Inertia('Clients/Index', [
            'clients' => $clients,
            'total_clients' => $totalClients,
        ]);
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
            $search_result = Client::search($request->keyword)->get();

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

    public function stats()
    {
        $today = Carbon::today();
        $clientsToday = Client::whereDate('created_at', $today)->get(['name', 'created_at']);
        $count = $clientsToday->count();

        $last7Days = collect();
        $dailyClients = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $clientsCount = Client::whereDate('created_at', $date)->count();
            $last7Days->push([
                'date' => $date->format('Y-m-d'),
                'count' => $clientsCount,
            ]);
            $dailyClients[] = $clientsCount;
        }

        $totalClients = Client::count();
        $thisMonthClients = Client::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->count();

        $monthlyClients = [];
        foreach (range(1, 12) as $month) {
            $monthlyClients[] = [
                'name' => Carbon::create()->month($month)->format('M'),
                'total' => Client::whereMonth('created_at', $month)
                    ->whereYear('created_at', $today->year)
                    ->count()
            ];
        }

        return response()->json([
            'clients_today' => $count,
            'client_names' => $clientsToday->pluck('name'),
            'last_7_days' => $last7Days,
            'daily_clients' => $dailyClients,
            'total_clients' => $totalClients,
            'this_month_clients' => $thisMonthClients,
            'monthly_clients' => $monthlyClients,
        ]);
    }
}
