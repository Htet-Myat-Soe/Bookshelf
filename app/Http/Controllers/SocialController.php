<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{


    public function redirectToFacebook(){

        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect('/dashboard');
            }
            else{
                $newUser = User::create([

                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('password')

                ]);

                Auth::login($newUser);
                return redirect('/');

            }

        } catch (Exception $e) {

            dd($e->getMessage());

        }

    }

    // Google

    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback()

    {

        try {



            $user = Socialite::driver('google')->user();



            $finduser = User::where('google_id', $user->id)->first();



            if($finduser){



                Auth::login($finduser);



                return redirect()->to('/');



            }else{

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'google_id'=> $user->id,

                    'password' => encrypt('password')

                ]);



                Auth::login($newUser);



                return redirect()->to('/');

            }



        } catch (Exception $e) {

            dd($e->getMessage());

        }

    }

}
