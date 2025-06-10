@extends('layouts.app')

@section('title', "Список заказов")

@section("content")
<h1>Заказы</h1>

@if(session("success"))
<div>{{ session("success") }}</div>
@endif

<table border=1 cellpadding=5 cellspacing=0>
<tr><th>ID</th><th>Клиент</th><th>Дата создания</th><th>Статус</th><th>Действия</th></tr>

@foreach($orders as $order)
<tr>
<td>{{ \$order->id }}</td>
<td>{{ \$order->customer_name }}</td>
<td>{{ \$order->created_at }}</td>
<td>{{ \$order->status }}</td>
<td>
<a href="{{ route("orders.show", \$order) }}">Просмотр / редактирование </a>&nbsp;
@if(\$order->status != "выполнен")
<form style='display:inline;' method='POST' action='{{ route("orders.complete", \$order) }}'>
@csrf @method("PATCH")
<button onclick='return confirm("Выполнить заказ?")'>Выполнить </button></form>
@endif 
<!-- Можно добавить кнопку удаления -->
<form style='display:inline;' method='POST' action='{{ route("orders.destroy", \$order) }}'>
@csrf @method("DELETE")
<button onclick='return confirm("Удалить заказ?")'>Удалить </button></form></td></tr>
@endforeach 
</table>
@endsection 