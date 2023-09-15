<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderPost;
use App\Http\Resources\OrderResource;
use App\Mail\OrderCreated;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrderPost  $request
     * @return OrderResource
     */
    public function store(StoreOrderPost $request)
    {
        $data = $request->validated();

        $order = Order::create($data);

        $currency = Currency::where('code', '=', $data['currency_code'])->firstOrFail();
        if ($currency->send_email) {
            try {
                Mail::send(new OrderCreated($order));
            } catch (\Exception $e) {
                Log::error('Sending order email failed. ' . $e->getMessage());
            }
        }

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return OrderResource
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return new OrderResource($order);
    }

}
