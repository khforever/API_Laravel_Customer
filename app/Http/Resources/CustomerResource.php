<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
      return [
          'id' => $this->id,
          'fullName' => $this->fullName,
          'account_type' => $this->account_type,
          'type' => $this->type,
          'birthday' => $this->birthday,
          'notes' => $this->notes,
          'phone' => $this->phone,
          'address' => $this->address,
          'group' => $this->group
      ];
    }
}
