<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Invoice\GetInvoicesAction;
use App\Actions\Invoice\StoreInvoiceAction;
use App\Exceptions\GeneralJsonException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws GeneralJsonException
     */
    public function index(GetInvoicesAction $getInvoicesAction): AnonymousResourceCollection
    {
        return $getInvoicesAction->execute();
    }

    /**
     * Store a newly created resource in storage.
     * @throws GeneralJsonException
     */
    public function store(StoreInvoiceAction $storeInvoiceAction, StoreInvoiceRequest $request): InvoiceResource
    {
        return $storeInvoiceAction->execute($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
