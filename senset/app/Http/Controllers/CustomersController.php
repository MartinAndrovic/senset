<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function index(){
        $response = Http::get('https://dummyjson.com/users');
        $customers = $response->json();
        $coje = $customers['users'][0]['id'];

        for($i=0; $i<sizeof($customers['users']); $i++){
            Validator::make($customers['users'][$i], [
                'email' => ['required', 'unique:customers'],
            ]);
            $new = new Customer();
            $new->name = $customers['users'][$i]['firstName']. " " . $customers['users'][$i]['lastName'];
            $new->email = $customers['users'][$i]['email'];
            $new->Dob = $customers['users'][$i]['birthDate'];
            $new->save();

        }

}


}
