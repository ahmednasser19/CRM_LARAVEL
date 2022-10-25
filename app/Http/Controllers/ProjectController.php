<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    //get all Project
    public function  index(Request $request, $customerId)
    {
        return Project::where('customer_id',$customerId)->get();
    }

    //create customer by id
    public function  create(Request $request, $customerId)
    {
        $project = new Project();
        if(!Customer::find($customerId)){
            return response()->json(['status'=>"customer Not Found"],Response::HTTP_NOT_FOUND);
        }
        $project->project_name =  $request->get('project_name');
        $project->customer_id = $customerId;
        $project->project_cost = $request->get('project_cost');
        $project->save();
        return $project;

    }

    //update customer by id
    public function  update(Request $request, $customerId,  $id)
    {
        $project =  Project::find($id);
        if(!$project) {
            return response()->json(['status'=>"Note Not found"],Response::HTTP_NOT_FOUND);
        }
        $customerId = (int)$customerId;
        if($project->customer_id !== $customerId){
            return response()->json(['status'=>"Invalid customer"],Response::HTTP_BAD_REQUEST);
        }

        $project->project_name =  $request->get('project_name');
        $project->project_cost = $request->get('project_cost');

        $project->save();
        return $project;

    }

    //delete customer
    public function  delete(Request $request,$customerId, $id)
    {
        $project =  Project::find($id);
        if(!$project) {
            return response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
        }
        $customerId = (int)$customerId;
        if($project->customer_id != $customerId){
            return response()->json(['status'=>"Invalid customer"],Response::HTTP_BAD_REQUEST);
        }
        $project->delete();
        return  response()->json(['status'=>"Note deleted successfully"],Response::HTTP_OK);
    }

    //get customer by id
    public function  show(Request $request, $customerId, $id)
    {
        if(!Customer::find($customerId)){
            return response()->json(['status'=>"customer Not Found"],Response::HTTP_NOT_FOUND);
        }
        return  Project::find($id)??   response()->json(['status'=>"Not found"],Response::HTTP_NOT_FOUND);
    }
}


