<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function index()
    {
        $response = Http::get('https://dummyjson.com/users');
        $customers = $response->json();

        for ($i = 0; $i < sizeof($customers['users']); $i++) {
            $validation = Validator::make($customers['users'][$i], [
                'firstName' => ['required', 'max:50'],
                'lastName' => ['required', 'max:50'],
                'email' => ['required', 'unique:customers', 'email'],
                'birthDate' => ['required', 'date'],
            ]);

            if ($validation->passes()) {
                $new = new Customer();
                $new->name = $customers['users'][$i]['firstName'] . " " . $customers['users'][$i]['lastName'];
                $new->email = $customers['users'][$i]['email'];
                $new->dob = $customers['users'][$i]['birthDate'];
                $new->save();
            }
        }

    }

    public function deleteCustomer(Request $request)
    {
        $customer = Customer::where('email', $request->email);
        if ($customer != null) {
            $customer->delete();
        }
    }

}
