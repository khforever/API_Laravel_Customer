<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $fillable = [
        'fullName',
        'account_type',
        'type','birthday','notes','photo'
        ];



        public function phone()
        {
            return $this->hasMany(Phone::class);
        }


    public function address()
    {
        return $this->hasMany(Address::class);
    }



    public function group()
    {
        return $this->hasMany(Group::class);
    }









}
