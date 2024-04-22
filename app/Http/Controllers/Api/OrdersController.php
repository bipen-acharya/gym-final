<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Order::search($request)->paginate(20);
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
        $sanitzed = $request->validate([
            'total' => 'required',
            'payment_method' => 'required',
            'products' => 'required|array',
            'date' => 'required'
        ], ['items.required' => 'Items Needs to array of object of item id and quantity']);

        $data = [];
        $sanitzed['user_id'] = auth('api')->id();
        $order = Order::create($sanitzed);
        foreach ($request->products as $product) {
            $data[] = [
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'] ?? 1
            ];
        }
        $order->products()->sync($data);
        return response()->json(['status' => 'success', 'message' => 'Order Created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json(['order' => $order->load(['user', 'products'])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
