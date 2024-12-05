<?php
namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function register( $request)
    {


        if (is_array($request)) {
            $data = $request;
        } else {
            $data = $request->validated();
        }

       $user=  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken($data['email'])->accessToken;

        return
        [
            'user'=>$user,
            'token'=>$token
        ];

    }


    public function login(array $request)
    {


        if (is_array($request)) {
            $data = $request;
        } else {
            $data = $request->validated();
        }




        $user = User::where('email', $request['email'])->first();

        $token = $user->createToken($data['email'])->accessToken;

        if ($user && Hash::check($request['password'], $user->password)) {


            return
            [
                'user'=>$user,
                'token'=>$token
            ];





        }
        return null;

    }


}


