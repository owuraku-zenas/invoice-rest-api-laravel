<?php

namespace App\Actions\Item;

use App\Exceptions\GeneralJsonException;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Resources\Item\ItemResource;
use App\Models\Item;
use Exception;

class StoreItemAction
{
    /**
     * @throws Exception
     */
    public function execute(StoreItemRequest $request): ItemResource
    {
        try {
            $item = new Item;
            $item->fill($request->validated());
            $item->amount = (double) number_format($request->input("unit_price") * $request->input("quantity"), 2);
            $item->save();

            return ItemResource::make($item);
        } catch (Exception $exception) {
            throw new GeneralJsonException($exception->getMessage(), $exception->getCode());
        }
    }
}
