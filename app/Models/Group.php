<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;



    protected $fillable = [
        'group',
        'customer_id',

        ];




        public function customer()
        {
            return $this->belongsTo(Customer::class);
        }
}
