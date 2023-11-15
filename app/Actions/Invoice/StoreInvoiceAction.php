<?php

namespace App\Actions\Invoice;

use App\Exceptions\GeneralJsonException;
use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Exception;
use function date;

class StoreInvoiceAction
{
    /**
     * @throws GeneralJsonException
     */
    public function execute(StoreInvoiceRequest $request)
    {
        try {
            $items = $request->validated()['items'];

            foreach ($items as $item) {
                $existingItem = Item::find($item['item_id']);

                throw_if(
                    !$existingItem || $existingItem->quantity < $item['quantity'],
                    GeneralJsonException::class,
                    "Item " . $item['item_id'] . " is insufficient",
                    422
                );
            }

            $invoice = new Invoice();
            $invoice->customer_id = $request->validated()['customer_id'];
            $invoice->issue_date = date('Y-m-d H:i:s');
            $invoice->due_date = $request->validated()['due_date'];
            $invoice->save();

            $totalAmount = 0;

            foreach ($items as $item) {
                $currentItem = Item::find($item['item_id']);

                $invoiceItem = new InvoiceItem();
                $invoiceItem->invoice_id = $invoice->id;
                $invoiceItem->item_id = $item['item_id'];
                $invoiceItem->quantity = $item['quantity'];
                $invoiceItem->amount = $item['quantity'] * $currentItem->unit_price;

                $totalAmount += $invoiceItem->amount;

                $newQuantity = $currentItem->quantity - $item['quantity'];
                $currentItem->quantity = $newQuantity;

                $currentItem->amount = $newQuantity * $currentItem->unit_price;

                $currentItem->save();
                $invoiceItem->save();
            }
            $invoice->amount = (double) number_format($totalAmount, 2);
            $invoice->save();

            return InvoiceResource::make($invoice);
        } catch (Exception $exception) {
            throw new GeneralJsonException($exception->getMessage(), $exception->getCode());
        }
    }
}
