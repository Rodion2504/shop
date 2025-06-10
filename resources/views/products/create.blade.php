@extends('layouts.app')

@section('title', 'Добавить товар')

@section('content')
<h1>Добавить товар</h1>

<form method="POST" action="{{ route('products.store') }}">
@csrf
<label>Название:</label><br>
<input type="text" name="name" required><br>

<label>Описание:</label><br>
<textarea name="description"></textarea><br>

<label>Цена:</label><br>
<input type="number" step="0.01" name="price" required><br>

<label>Категория:</label><br>
<select name="category_id" required>
@foreach($categories as $category)
<option value="{{ $category->id }}">{{ $category->name }}</option>
@endforeach
</select><br>

<button type="submit">Сохранить</button>
</form>

<a href="{{ route('products.index') }}">Назад к списку товаров</a>
@endsection