<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->load('customer', 'items');

        return [
            "id" => $this->id,
            "amount" => $this->amount,
            'issue_date' => $this->issue_date,
            'due_date' => $this->due_date,
            'customer' => $this->whenLoaded('customer'),
            'items' => $this->whenLoaded('items'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
