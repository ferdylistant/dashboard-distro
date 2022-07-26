<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getProvince()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://dev.farizdotid.com/api/daerahindonesia/provinsi');
        return response()->json($response->getBody()->getContents());

    }
    public function getVendor()
    {
        $data['vendor'] = User::where('account_role', 'vendor')->get();
        return response()->json($data);
    }
}
