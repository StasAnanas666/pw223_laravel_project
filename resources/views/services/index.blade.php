@extends("layouts.app")


@section("content")
<div class="container">
    <h1>Услуги</h1>
    <div class="cards my-5 d-flex align-items-center flex-wrap">
        @foreach($services as $service)
            <div class="border border-2 rounded-3 p-3 text-center mb-3" style="width: calc(100%/4 - 30px); min-width: 220px; margin: 0 15px; height: 450px">
                <div class="card-img mx-auto" style="width: 200px; height: 200px">
                    <img src="{{url($service->image)}}" alt="{{$service->name}}" class="h-100">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="height: 44px">{{$service->name}}</h5>
                    <p class="card-text overflow-auto" style="height: 80px">{{$service->description}}</p>
                    <p class="card-text">{{$service->price}} руб.</p>
                    <a href="{{route('order_service', $service)}}" class="btn btn-primary">Перейти к заказу</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection