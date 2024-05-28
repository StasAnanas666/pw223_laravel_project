@extends("layouts.app")


@section("content")
<div class="container">
    <h1>Мои услуги</h1>
    <div class="cards my-5 d-flex align-items-center flex-wrap">
        @foreach($services as $service)
            <div class="border border-2 rounded-3 p-3 text-center mb-4" style="width: calc(100%/4 - 30px); min-width: 220px; margin: 0 15px; height: 350px">
                <div class="card-img mx-auto" style="width: 200px; height: 200px">
                    <img src="{{url($service->image)}}" alt="{{$service->name}}" class="h-100">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="height: 44px">{{$service->name}}</h5>
                    <p class="card-text">{{$service->price}} руб.</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{route('edit_service', $service->id)}}" class="d-flex align-items-center justify-content-between btn btn-sm btn-warning text-light">
                            <span class="material-symbols-outlined">
                                edit
                            </span>
                            Изменить
                        </a>
                        {{html()->modelForm($service, "DELETE", route("delete_service", $service->id))->open()}}
                                    <button type="submit" class="d-flex align-items-center justify-content-between ms-4 btn btn-danger btn-sm">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                        Удалить
                                    </button>
                        {{html()->closeModelForm()}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection