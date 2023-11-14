<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Item\GetItemsAction;
use App\Actions\Item\StoreItemAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Http\Resources\Item\ItemResource;
use App\Models\Item;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index(GetItemsAction $getItemsAction): AnonymousResourceCollection
    {
        return $getItemsAction->execute();
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(StoreItemAction $storeItemAction, StoreItemRequest $request): ItemResource
    {
        return $storeItemAction->execute($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
