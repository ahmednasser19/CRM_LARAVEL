<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    //get all cusomters
    public function  index(Request $request, $customerId)
    {
        return Note::where('customer_id',$customerId)->get();
    }

    //create customer by id
    public function  create(Request $request, $customerId)
    {
        $note = new Note();
        if(!Customer::find($customerId)){
            return response()->json(['status'=>"customer Not Found"],Response::HTTP_NOT_FOUND);
        }
        $note->note =  $request->get('note');
        $note->customer_id = $customerId;
        $note->save();
        return $note;

    }

    //update customer by id
    public function  update(Request $request, $customerId,  $id)
    {
        $note =  Note::find($id);
        if(!$note) {
            return response()->json(['status'=>"Note Not found"],Response::HTTP_NOT_FOUND);
        }
        $customerId = (int)$customerId;
        if($note->customer_id !== $customerId){
            return response()->json(['status'=>"Invalid customer"],Response::HTTP_BAD_REQUEST);
        }
        $note->note =  $request->get('note');
        $note->save();
        return $note;

    }

    //delete customer
    public function  delete(Request $request,$customerId, $id)
    {
        $note =  Note::find($id);
        if(!$note) {
            return response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
        }
        $customerId = (int)$customerId;
        if($note->customer_id != $customerId){
            return response()->json(['status'=>"Invalid customer"],Response::HTTP_BAD_REQUEST);
        }
        $note->delete();
        return  response()->json(['status'=>"Note deleted successfully"],Response::HTTP_OK);
    }


    //get customer by id
    public function  show(Request $request, $customerId, $id)
    {
        if(!Customer::find($customerId)){
            return response()->json(['status'=>"customer Not Found"],Response::HTTP_NOT_FOUND);
        }
        if(Customer::find($customerId)->customer_id !==$customerId){
            return response()->json(['status'=>"Invalid customer"],Response::HTTP_BAD_REQUEST);
        }
        return  Note::find($id)??   response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
    }
}


