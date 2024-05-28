<?php

namespace App\Http\Controllers;

use App\Models\AdditionalService;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

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

    function create() {
        return view("admins.admin");
    }

    function store(Request $request) {
        $user = $request->user();

        //валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|decimal:0,2',
            'additional_services.*.name' => 'sometimes|required|string|max:100',
            'additional_services.*.price' => 'sometimes|required|decimal:0,2',
            'additional_services.*.description' => 'sometimes|required|string'
        ]);

        //сохранение файла в resources/images
        if($request->hasFile("image")) {
            $image = $request->file("image");//получаем файл из запроса
            $imageName = time() . "_" . $image->getClientOriginalName();
            $imagePath = $image->storeAs("images", $imageName);
            $validated['image'] = $imagePath;
        }

        //продолжаем работу с валидированными данными, сохраняем в БД
        $service = $user->services()->create($validated);

        if($request->has('additional_services')) {
            foreach($request->input('additional_services') as $additionalService) {
                $service->additionalServices()->create([
                    'service_id' => $service->id,
                    'name' => $additionalService['name'],
                    'price' => $additionalService['price'],
                    'description' => $additionalService['description']
                ]);
            }
        }

        return redirect(route("admin"))->with("success", "Новая услуга успешно добавлена");
    }

    function myServices(Request $request) {
        $user = $request->user();
        $services = $user->services()->with("additionalServices")->get();
        return view("services.myServices", ["services" => $services]);
    }

    function destroy(string $id) {
        $service = Service::find($id);
        $service->delete();
        return redirect(route("my_services"))->with("success", "Услуга успешно удалена");
    }
}
