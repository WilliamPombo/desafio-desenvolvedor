<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('order.index', compact('orders'));
    }
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('order.create', compact('products', 'clients'));
    }
    public function store()
    {
        Order::query()->create(request()->all());
        return redirect()->route('index_order');
    }
    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }
    public function edit(Order $order)
    {
        $clients = Client::all();
        $products = Product::all();
        return view('order.edit', compact('order', 'products', 'clients'));
    }
    public function update(Order $order)
    {
        Order::query()->where('id', $order->id)->update(request()
            ->only('status', 'client_id', 'product_id'));
        return redirect()->route('index_order');
    }
    public function destroy(Order $order)
    {
        Order::query()->where('id', $order->id)->delete();
        return redirect()->route('index_order');
    }
}
