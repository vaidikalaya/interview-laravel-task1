<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\{User,Image_gallery,Employee};

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            if(!session('personal_access_token')){
                $tokens=$request->user()->createToken(Auth::user()->email)->plainTextToken;
                $request->session()->put('personal_access_token',  $tokens);
                echo "<script>localStorage.setItem('access_token', '$tokens')</script>";
            }else{
                $tokens=session('personal_access_token');
                echo "<script>localStorage.setItem('access_token','$tokens')</script>";
            }
            return $next($request);
        });
    }

    public function index()
    {
        $images=Image_gallery::all();
        $employees=Employee::all();
        return view('home',compact('images','employees'));
    }

    public function readWriteXMLFile(){

        $readFile = file_get_contents(public_path('assets/files/sample.xml'));
        $loadFile = simplexml_load_string($readFile);      
        $jsonData = json_encode($loadFile,JSON_PRETTY_PRINT);
        $data = json_decode($jsonData, true); 
        //return view('xml-view',compact('data'));
        dd($jsonData,$data);
    }

    public function uploadImage(Request $request){
        $image=$request->file('image');
        $name=$image->getClientOriginalName(); 
        if($image->extension()==='jpg'){
            $imageName=str_slug($name)."-".time().'.'.$image->extension();
            $image->move(public_path('/assets/images/'),$imageName);
            $path=public_path('/assets/images/'.$imageName);
            $res=Image_gallery::create([
                'name'=>$imageName,
                'path'=>$path
            ]);
            if($res){
                return back()->with('success_msg','image uploaded successfully');
            }
        }else{
            return back()->with('error_msg','only jpg images allowed');
        }
        
        dd($path);
    }
}
