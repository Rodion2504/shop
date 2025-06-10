@extends("layouts.app")

@section("title", "Заказ #{{\$order->id}}")

@section("content")
<h1>Заказ №{{\$order->id}}</h1>

<p><strong>Клиент:</strong> {{\$order->customer_name}}</p>
<p><strong>Дата создания:</strong> {{\$order->created_at}}</p>
<p><strong>Status:</strong> {{\$order->status}}</p>

@if(\$order->comment)
<p><strong>Комментарий:</strong> {{\$order->comment}}</p>@endif

<h2>Товары в заказе:</h2>

<table border=1 cellpadding=5 cellspacing=0 width='100%'>
<tr><th>#ID товара </th><th>Name </th><th>Количество </th></tr>@foreach(\$order->items as \$item)
<tr style='background-color:#f0f0f0;'><td>{{\$item -> product -> id}}</td ><td>{{\$item -> product -> name}}</td ><td>{{\$item -> quantity}}</td></tr>@endforeach 
<tr style='background-color:#ddd;'><td colspan=3'><b>Total price