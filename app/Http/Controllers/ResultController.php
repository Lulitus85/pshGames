<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ResultController extends Controller
{
    public function insertData(Client $client){
        //insert data a las 3 tablas.

        $response=$client->request('GET',"api");
        dd($response);
        /* $client=new Client([
            'base_uri' => 'https://randomuser.me',
            'timeout'=>2.0,
        ]);

        $response = $client->request('GET','api');

        dd($response);

        $response = $client->request('GET','api');
        $data = json_decode($response->getBody());
        dd($data); */
        



    }
}
