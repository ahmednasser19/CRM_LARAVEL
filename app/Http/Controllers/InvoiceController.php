<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    //get all Project
    public function  index(Request $request, $customerId)
    {
        return Invoice::where('customer_id',$customerId)->get();
    }

    //create customer by id
    public function  create(Request $request, $customerId)
    {
        $invoice = new Invoice();
        if(!Customer::find($customerId)){
            return response()->json(['status'=>"customer Not Found"],Response::HTTP_NOT_FOUND);
        }
        $invoice->invoice_total =  $request->get('invoice_total');
        $invoice->items = $request->get('items');

        $invoice->customer_id = $customerId;
        $invoice->save();
        return $invoice;

    }

    //update customer by id
    public function  update(Request $request, $customerId,  $id)
    {
        $invoice =  Invoice::find($id);
        if(!$invoice) {
            return response()->json(['status'=>"Note Not found"],Response::HTTP_NOT_FOUND);
        }
        $customerId = (int)$customerId;
        if($invoice->customer_id !== $customerId){
            return response()->json(['status'=>"Invalid customer"],Response::HTTP_BAD_REQUEST);
        }

        $invoice->invoice_total=  $request->get('invoice_total');
        $invoice->items = $request->get('items');

        $invoice->save();
        return $invoice;

    }

    //delete customer
    public function  delete(Request $request,$customerId, $id)
    {
        $invoice =  Invoice::find($id);
        if(!$invoice) {
            return response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
        }
        $customerId = (int)$customerId;
        if($invoice->customer_id != $customerId){
            return response()->json(['status'=>"Invalid customer"],Response::HTTP_BAD_REQUEST);
        }
        $invoice->delete();
        return  response()->json(['status'=>"Inovice  deleted successfully"],Response::HTTP_OK);
    }

    //get customer by id
    public function  show(Request $request, $customerId, $id)
    {
        if(!Customer::find($customerId)){
            return response()->json(['status'=>"Customer Not Found"],Response::HTTP_NOT_FOUND);
        }
        return  Invoice::find($id)??   response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
    }
}


