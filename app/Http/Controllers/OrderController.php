<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view("orders.index");
    }

    public function create(Service $service)
    {
        session(["selected-service" => $service]);
        $additionalServices = $service->additionalServices;
        session(["additional-services" => $additionalServices]);

        return redirect(route("order_page"));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        Order::create([
            "user_id" => $userId,
            "total_price" => $request->input("total_price"),
            "order_date" => Carbon::now("Europe/Moscow"),
            "status" => "Оформлен"
        ]);

        session()->forget("selected-service");
        session()->forget("additional-services");

        return redirect(route("services"));
    }
}
