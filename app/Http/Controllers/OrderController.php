<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderPost;
use App\Http\Resources\OrderResource;
use App\Models\Order;

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
