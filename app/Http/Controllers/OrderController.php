<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Список заказов
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    // Просмотр заказа
    public function show($id)
    {
        $order = Order::with(['items.product'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Создание нового заказа (форма)
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    // Сохранение заказа
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'created_order' => 'required|date',
            'comment' => 'nullable|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Создаем заказ
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'created_order' => $request->created_at,
            'status' => 'новый',
            'comment' => $request->comment,
        ]);

        // Добавляем товары в заказ
        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', "Заказ №{$order->id} создан");
    }

    // Обновление статуса заказа (например, выполнить)
    public function markAsCompleted($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'выполнен']);

        return redirect()->route('orders.show', $order)->with('success', "Заказ №{$order->id} выполнен");
    }
}