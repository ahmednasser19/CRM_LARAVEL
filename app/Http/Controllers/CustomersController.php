<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomer;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomersController extends Controller
{
    //get all cusomters
    public function  index(Request $request)
    {
        return Customer::all();
    }

    //create customer by id
    public function  create(CreateCustomer $request)
    {
        $customer = new Customer();
        $customer->name =  $request->get('name');
        $customer->save();
        return $customer;

    }

    //update customer by id
    public function  update(Request $request, $id)
    {
        $customer =  Customer::find($id);
        if(!$customer) {
            return response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
        }
        $customer->name =  $request->get('name');
        $customer->save();
        return $customer;

    }

    //delete customer
    public function  delete(Request $request, $id)
    {
        $customer =  Customer::find($id);
        if(!$customer) {
            return response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
        }
        $customer->delete();
        return  response()->json(['status'=>"user deleted successfully"],Response::HTTP_OK);
    }


    //get customer by id
    public function  show(Request $request, $id)
    {
        return   $customer =  Customer::find($id) ??   response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
    }
}


