<?php

namespace App\Interfaces;
use App\Http\Requests\CustomerRequest;

interface CustomerRepositoryInterface
{
    public function all();
    public function create(CustomerRequest $request);
    public function find($id);
    public function update($id,$data);
    public function delete($id);
}
