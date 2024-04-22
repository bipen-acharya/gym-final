<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Suscription;
use Illuminate\Http\Request;

class SuscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $sanitized = $request->validate([
            'user_id' => ['required'],
            'valid_from' => ['required'],
            'valid_till' => ['required'],
            'payment_method' => ['required'],
            'total_paid_amount' => ['required'],
            'payment_ref_id' => ['nullable'],
            'plan_name' => ['nullable']
        ]);

        Suscription::create($sanitized);
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Suscription $suscription)
    {
        return response()->json(['suscription' => $suscription->load('user')], 200);
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
    public function destroy(Suscription $suscription)
    {
        $suscription->delete();
        return response()->json(['status' => 'success']);
    }
}
