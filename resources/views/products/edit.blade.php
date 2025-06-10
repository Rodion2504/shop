@extends('layouts.app')

@section('title', "Редактировать товар #{{ $product->id }}")

@section('content')
<h1>Редактировать товар #{{ $product->id }}</h1>

<form method="POST" action="{{ route('products.update', $product) }}">
@csrf @method("PUT")
<label>Название:</label><br>
<input type="text" name="name" value="{{ old('name', $product->name) }}" required><br>

<label>Описание:</label><br>
<textarea name="description">{{ old('description', optional($product)->description) }}</textarea><br>

<label>Цена:</label><br>
<input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required><br>

<label>Категория:</label><br>
<select name="category_id" required>
@foreach($categories as $category)
<option value="{{ $category->id }}" {{ ($category->id == old("category_id", optional($product)->category_id)) ? "selected" : "" }}>{{ $category->name }}</option>
@endforeach
</select><br>

<button type="submit">Обновить</button>
</form>

<a href="{{ route("products.index") }}">К списку товаров</a>
@endsection