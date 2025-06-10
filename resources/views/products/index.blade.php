@extends('layouts.app')

@section('title', 'Список товаров')

@section('content')
<h1>Товары</h1>
<a href="{{ route('products.create') }}">Добавить товар</a>
@if(session('success'))
<div>{{ session('success') }}</div>
@endif
<table border="1" cellpadding="5" cellspacing="0">
<tr>
<th>ID</th><th>Название</th><th>Категория</th><th>Цена</th><th>Действия</th>
</tr>
@foreach($products as $product)
<tr>
<td>{{ $product->id }}</td>
<td>{{ $product->name }}</td>
<td>{{ optional($product->category)->name }}</td>
<td>{{ number_format($product->price, 2) }}</td>
<td>
<a href="{{ route('products.show', $product) }}">Просмотр</a> |
<a href="{{ route('products.edit', $product) }}">Редактировать</a> |
<form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
@csrf @method('DELETE')
<button type="submit" onclick="return confirm('Удалить?')">Удалить</button>
</form>
</td>
</tr>
@endforeach
</table>
@endsection