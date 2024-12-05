<?php

namespace App\Http\Controllers;
use App\Interfaces\CustomerRepositoryInterface;
use App\Http\Responses\ApiResponse;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ImageBase64Request;
use App\Models\Phone;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\PhotoRequest;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     private CustomerRepositoryInterface $customerRepository;

     public function __construct(CustomerRepositoryInterface $customerRepository)
     {
         $this->customerRepository = $customerRepository;
     }
    public function index()
    {
        $customers = $this->customerRepository->all();
        return ApiResponse::success($customers);
    }


    /**
     * Store a newly created resource in storage.
     */

      public function store(CustomerRequest $request)

    {

        $customer = $this->customerRepository->create($request);

          return ApiResponse::success(CustomerResource::collection($customer), 'Customer created successfully',201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = $this->customerRepository->find($id);

      return ApiResponse::success(new CustomerResource($customer));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, $id)
    {

          $customer = $this->customerRepository->update($id, $request->all());
        // $customer = $this->customerRepository->update($id, $request->validated());

         //  $customer = $this->customerRepository->update($id, $request->validated()->all());

            return ApiResponse::success($customer, 'Customer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->customerRepository->delete($id);
        return ApiResponse::success([], 'Customer deleted successfully');
    }






    public function addPhone(Request $request, $customerId)        //not working
    {

        $customer = Customer::findOrFail($customerId);

        $phone = $customer->phone()->create($request->all());

        return ApiResponse::success($phone , 'Phone number stored successfully',201);


    }



    public function addAddress(Request $request, $customerId)
    {

        $customer = Customer::findOrFail($customerId);
        $address = $customer->address()->create($request->all());

        return ApiResponse::success($address , 'Address  stored successfully',201);

    }



    public function addGroup(Request $request, $customerId)
    {

        $customer = Customer::findOrFail($customerId);

        $group = $customer->group()->create($request->all());

        return ApiResponse::success($group , 'Group stored successfully',201);

    }




    public function uploadPhoto(PhotoRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
         if ($request->filled('photo'))
         {
             $customer->update(['photo' => $request->photo]);
              return ApiResponse::success(['message' => 'Photo uploaded successfully', 'photo' => $request->photo]); }
         else
          {
            return ApiResponse::error(['message' => 'Photo upload failed'], 500); }
    }






      public function storeImageBase64(ImageBase64Request $request,$id)
      {

        $customer = Customer::findOrFail($id);

          $file = $request->file('file');


          $fileContents = file_get_contents($file->getPathname());


          $base64EncodedImage = base64_encode($fileContents);

        //   return response()->json([
        //       'base64_image' => $base64EncodedImage
        //   ]);

       $decodedImage = base64_decode($base64EncodedImage);

        $filePath ='images/'. time() . '.png';

        Storage::disk('public')->put($filePath, $decodedImage);

        $customer->update(['photo' => $filePath]);
        return response()->json([ 'message' => 'Image successfully decoded and saved', 'path' => $filePath]);



      }






    }











