<?php

namespace App\Repositories;
use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Address;
use App\Models\Phone;

use App\Models\Customer;
use App\Models\Group;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all()
    {
        return Customer::with(['phone', 'address', 'group'])->get();
    }
      public function create(CustomerRequest $request)
         {


            $customer = Customer::create($request->all());


      $customerPhone = Phone::create([
        'customer_id' => $customer->id,
        'phone' =>$request['phone']
    ]);
    $customerAddress = null;
    if (isset($request->address))
     {
         $customerAddress= Address::create
         ([
            'customer_id' => $customer->id,
             'address' => $request['address']
            ]);

        }




        $customerGroup = null;
        if (isset($request->group))
         {
             $customerGroup= Group::create
             ([
                'customer_id' => $customer->id,
                 'group' => $request['group']
                ]);

            }




    //    return ['customer'=>$customer,'customerPhone'=>$customerPhone
    //            ,'customerAddress'=>$customerAddress,'customerGroup'=>$customerGroup];



    return ['customer'=>$customer,'customerPhone'=>$customerPhone,'customerAddress'=>$customerAddress,'customerGroup'=>$customerGroup];


    }

    public function find($id)
    {
        return Customer::with(['phone', 'address', 'group'])->find($id);
    }

    public function update($id,  $data)
    {
        $customer = $this->find($id);
        $customer->update($data);



        return $customer;
    }

    public function delete($id)
    {
        return Customer::destroy($id);
    }
}
