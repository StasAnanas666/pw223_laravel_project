<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    //работать с объектами данного класса может только авторизованный пользователь
    public function __construct()
    {
        $this->middleware("auth");
    }

    function index() {
        $services = Service::all();
        return view("services.index", ["services" => $services]);
    }

    function store(Request $request) {
        $service = new Service();
        $imagePath = null;
        $service->image = $imagePath;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;

        //валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|decimal:0,2'
        ]);

        //сохранение файла в resources/images
        if($request->hasFile("image")) {
            $image = $request->file("image");//получаем файл из запроса
            $imageName = time() . "_" . $image->getClientOriginalName();
            $imagePath = $image->storeAs("images", $imageName);
            $validated['image'] = $imagePath;
        }

        //продолжаем работу с валидированными данными, сохраняем в БД
        Service::create($validated);

        return redirect(route("admin"))->with("success", "Новая услуга успешно добавлена");
    }
}
