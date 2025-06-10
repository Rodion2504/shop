<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'created_order', 'status', 'comment'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Итоговая цена заказа:
    public function getTotalPriceAttribute()
    {
        return $this->items()->withSum('product as total_price', 'product.price * order_items.quantity')->first()->total_price ?? 0;
        // Или можно считать вручную:
        // return $this->items()->get()->sum(function($item) { return $item->product->price * $item->quantity; });
        
        // Для простоты:
        return number_format($this->items()->get()->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0), 2);
        
        // Вызов в представлении как: {{ $order->total_price }}
    }
}