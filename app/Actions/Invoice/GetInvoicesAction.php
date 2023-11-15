<?php

namespace App\Actions\Invoice;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetInvoicesAction
{
    /**
     * @throws GeneralJsonException
     */
    public function execute(): AnonymousResourceCollection
    {
        try {
            return InvoiceResource::collection(Invoice::all());
        } catch (Exception $exception) {
            throw new GeneralJsonException($exception->getMessage(), $exception->getCode());
        }
    }
}
