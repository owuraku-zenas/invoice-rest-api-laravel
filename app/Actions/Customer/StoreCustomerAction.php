<?php

namespace App\Actions\Customer;

use App\Exceptions\GeneralJsonException;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Exception;

class StoreCustomerAction
{
    /**
     * @throws Exception
     */
    public function execute(StoreCustomerRequest $request): CustomerResource
    {
        try {
            $customer = Customer::create($request->validated());
            return CustomerResource::make($customer);
        } catch (Exception $exception) {
            throw new GeneralJsonException($exception->getMessage(), $exception->getCode());
        }
    }
}
