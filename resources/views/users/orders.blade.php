@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Мои заказы</h2>

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата заказа</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->order_date}}</td>
                        <td>{{$order->total_price}} руб.</td>
                        <td>{{$order->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection