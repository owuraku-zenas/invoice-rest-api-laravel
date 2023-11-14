<?php

namespace App\Actions\Item;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\Item\ItemResource;
use App\Models\Item;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetItemsAction
{
    /**
     * @throws GeneralJsonException
     */
    public function execute(): AnonymousResourceCollection
    {
        try {
            return ItemResource::collection(Item::all());
        } catch (Exception $exception) {
            throw new GeneralJsonException($exception->getMessage(), $exception->getCode());
        }
    }
}
