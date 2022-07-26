<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VendorUserController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
        $this->user = new User();
    }
    public function allVendor()
    {
        $data = [
            'user' => User::where('email', \Auth::user()->email)->firstOrFail(),
            'vendor' => User::where('account_role', 'vendor')->get(),
        ];
        return view('pages.vendor_all', $data);
    }
    public function addVendor(Request $request){
        // $resp = array();
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone'=>'required|unique:users',
            'address'=>'required|min:3',
            'province'=>'required',
            'city'=>'required',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|min:6|same:password',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);
        } else{
            // return "<script>console.log(".$request->all().")</script>";
            $client = new Client();
            $province = $client->request('GET', 'https://dev.farizdotid.com/api/daerahindonesia/provinsi/'.$request->province)->getBody()->getContents();
            $province = json_decode($province, true);
            $city = $client->request('GET', 'https://dev.farizdotid.com/api/daerahindonesia/kota/'.$request->city)->getBody()->getContents();
            $city = json_decode($city, true);
            $userdata = $this->user->create([
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'province' => $province['nama'],
                'city' => $city['nama'],
                'password' => app('hash')->make($request->password),
                'account_type' => '3',
                'account_role' => 'vendor',
            ]);
            if ($userdata) {
                return response()->json(["status"=>true,"redirect_location"=>route("vendor.all")]);
            } else {
                return response()->json(["status"=>false,"message"=>"Failed to add vendor"]);
            }
        }
    }
}
