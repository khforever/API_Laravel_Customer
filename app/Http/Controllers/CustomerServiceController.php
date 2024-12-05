<?php

namespace App\Http\Controllers;
 use App\Http\Responses\ApiResponse;
 use App\Models\Address;
 use App\Models\Customer;
 use App\Models\Phone;
 use App\Models\Group;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;

class CustomerServiceController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['phone', 'address', 'group'])->get();
        return ApiResponse::success($customers, 'Show all Customers.');
    }

    public function store(CustomerRequest $request)
    {
       $customer= Customer::create($request->validated());

        // $customer= Customer::create($request->all());

        if ($request->has('phone')) {
            foreach ($request->phone as $phone) {
                $customer->phone()->create($phone);
            }
        }

        if ($request->has('address')) {
            foreach ($request->address as $address) {
                $customer->address()->create($address);
            }
        }

        if ($request->has('group')) {
            foreach ($request->group as $group) {
                $customer->group()->create($group);
            }
        }

        return ApiResponse::success($customer, 'Customer created successfully');
    }

    public function show($id)
    {
        $customer = Customer::with(['phone', 'address', 'group'])->find($id);

        if (!$customer) {
             return ApiResponse::error($customer, 'Customer not found', 404);
        }
        return ApiResponse::success($customer, 'show Customer  successfully');


    }

    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());


        return ApiResponse::success($customer, 'Customer updated successfully');
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);

    if (!$customer) {
        return ApiResponse::error('Customer not found', 404);
    }
    $customer->phone()->delete();
    $customer->address()->delete();
    $customer->group()->delete();

    $customer->delete();
    return ApiResponse::success([], 'Customer deleted successfully', 200);
    }










    public function storePhone(Request $request, $customerId)
    {

        $customer = Customer::findOrFail($customerId);

        $phone = $customer->phone()->create($request->all());

        return ApiResponse::success($phone , 'Phone number stored successfully',201);


    }



    public function storeAddress(Request $request, $customerId)
    {

        $customer = Customer::findOrFail($customerId);
        $address = $customer->address()->create($request->all());

        return ApiResponse::success($address , 'Address  stored successfully',201);

    }



    public function storeGroup(Request $request, $customerId)
    {

        $customer = Customer::findOrFail($customerId);

        $group = $customer->group()->create($request->all());

        return ApiResponse::success($group , 'Group stored successfully',201);

    }









}
