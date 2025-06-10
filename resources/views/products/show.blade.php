<!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        
        @if($product->image)
            <div class="product-image mb-4">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
        @endif

        <p><strong>Описание:</strong> {{ $product->description }}</p>
        <p><strong>Цена:</strong> {{ number_format($product->price, 2, '.', ',') }} ₽</p>
        <p><strong>Категория:</strong> {{ $product->category->name ?? 'Не указана' }}</p>

        <!-- Можно добавить дополнительные детали или действия -->
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Назад к списку</a>
    </div>
@endsection