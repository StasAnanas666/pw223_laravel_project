@extends('layouts.app')

@section("content")
<div class="container">
    <a href="{{route("services")}}" class="ajax-link nav-link my-4">← Назад к списку услуг</a>

    <h1 class="mb-3">Оформление заказа</h1>

    @if(session()->has("selected-service"))
        @php
            $service = session("selected-service");
        @endphp
        <div class="d-flex justify-content-between align-items-center border border-3 rounded-3 p-2">
            @if ($service->image)
                <img src="{{url($service->image)}}" alt="{{$service->name}}" class="w-25" />
            @endif
            <div class="ms-4 w-75">
                <h2>{{$service->name}}</h2>
                <p>Описание: {{$service->description}}</p>
                <p>Цена: {{$service->price}} руб.</p>
            </div>
        </div>
        @if (session()->has("additional-services"))
            @php
                $additionalServices = session("additional-services");
            @endphp
            <h3 class="mt-3">Выберите дополнительные услуги</h3>
            <ul class="list-group">
                @foreach ($additionalServices as $additionalService)
                    <li class="list-group-item">
                        <input type="checkbox" name="additional-services[]" id="{{$additionalService->id}}" value="{{$additionalService->price}}" class="additional-service-checkbox form-check-input" />
                        {{$additionalService->name}} - Цена: {{$additionalService->price}} руб.
                    </li>
                @endforeach
            </ul>
        @endif

        <form action="{{route("save_order")}}" method="POST">
            @csrf
            <h3 class="mt-3">Выберите дату оказания услуги</h3>
            <div class="form-group d-flex justify-content-between">
                <input type="date" class="form-control w-25"/>
                <select name="ordertime" id="ordertime" class="form-select w-50"></select>
            </div>
            <input type="hidden" name="total_price" id="total_price" />
            <h3 class="mt-4">Общая сумма заказа: <span id="total-price" class="fw-bold">{{$service->price}}</span> руб.</h3>
            <button type="submit" class="btn btn-primary mt-5">Оформить заказ</button>
        </form>
    @else
        <p>Выберите услугу для заказа</p>
    @endif
</div>
@endsection