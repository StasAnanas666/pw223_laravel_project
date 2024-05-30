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

    <h3 class="my-4">Добавить услугу</h3>

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

    <div id="additional-services-container" style="display: none;">
        <h4 class="my-4">Дополнительные услуги</h4>
        <div id="additional-services"></div>
    </div>

    <button type="button" id="add-service" class="btn btn-sm btn-outline-success d-flex align-items-center">
        <span class="material-symbols-outlined">
            add
        </span>
        Добавить дополнительные услуги
    </button>

    {{html()->input()->type("submit")->class("btn btn-outline-primary my-3")->value("Сохранить")}}
    {{html()->form()->close()}}

    <template id="additional-service-template">
        <div class="additional-service">
            <h5>Услуга № INDEX</h5>
            <div class="form-group my-3">
                <input type="text" name="additional_services[INDEX][name]" class="form-control" placeholder="Название дополнительной услуги..." required>
            </div>
            <div class="form-group my-3">
                <input type="number" class="form-control" min="0" step="0.01" name="additional_services[INDEX][price]" placeholder="Цена дополнительной услуги..." required>
            </div>
            <div class="form-group my-3">
                <textarea class="form-control" name="additional_services[INDEX][description]" placeholder="Описание дополнительной услуги..." required></textarea>
            </div>
        </div>
    </template>

    <script>
        document.querySelector("#add-service").addEventListener("click", () => {
            let container = document.querySelector("#additional-services-container");
            let servicesContainer = document.querySelector("#additional-services");
            let template = document.querySelector("#additional-service-template").content.cloneNode(true);
            let index = servicesContainer.querySelectorAll(".additional-service").length;
            let html = template.querySelector(".additional-service").outerHTML.replace(/INDEX/g, index+1);//уточнить, как сделать для вывода index+1 отдельно
            let div = document.createElement("div");
            div.innerHTML = html;
            servicesContainer.appendChild(div.firstChild);

            container.style.display = "block";
        })
    </script>
</div>
@endsection