<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\{Employee};

class EmployeeController extends Controller
{
    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'max:10'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
  
        if ($validator->fails()) {
            return  response()->json([
                        'error' => $validator->errors()->all()
                    ],200);
        }

        $res=Employee::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);

        if($res){
            return response()->json(['msg' => 'registration successfully done']);
        }
    }

    public function getEmployeeData(Request $request){
        $res=Employee::find($request->id);
        if($res){
            return response()->json(['data'=>$res,'status'=>200]);
        }else{
            return response()->json(['data'=>null,'msg'=>'data not found','status'=>402]);
        }
    }
}
