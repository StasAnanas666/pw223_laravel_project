@extends('layouts.app')

@section("content")


<div class="container">
    {{-- сообщения об ошибках --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger border border-none">{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- успешное завершение --}}
    @if(session("success"))
    <div class="alert alert-success">
        {{session("success")}}
    </div>
    @endif

    {{html()->form("POST")->route("add_service")->class("my-5")->acceptsFiles()->open()}}
    <div class="form-group my-3">
        {{html()->text("name")->class("form-control")->placeholder("Название услуги...")}}
    </div>
    <div class="form-group my-3">
        {{html()->text("price")->type("number")->class("form-control")->placeholder("Цена услуги...")}}
    </div>
    <div class="form-group my-3">
        {{html()->file("image")->class("form-control")->acceptImage()}}
    </div>
    <div class="form-group my-3">
        {{html()->textarea("description")->class("form-control")->placeholder("Описание услуги...")}}
    </div>
    {{html()->input()->type("submit")->class("btn btn-outline-primary my-3")->value("Добавить услугу")}}
    {{html()->form()->close()}}
</div>
@endsection