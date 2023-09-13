<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'source_currency_code' => $this->source_currency_code,
            'currency_code' => $this->currency_code,
            'exchange_rate' => $this->exchange_rate,
            'surcharge_percent' => $this->surcharge_percent,
            'surcharge_amount' => $this->surcharge_amount,
            'discount_percent' => $this->discount_percent,
            'discount_amount' => $this->discount_amount,
            'source_currency_amount' => $this->source_currency_amount,
            'currency_amount' => $this->currency_amount,
            'source_total' => $this->source_total,
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
    }
}
