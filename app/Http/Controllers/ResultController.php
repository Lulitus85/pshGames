<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
Use App\Models\Player;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function insertData(Client $client){
        
        

   
/*         $player = array(
            'nick_name'=>'Lulitus',
            'photo'=>'Untitled-1-01.png',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        );

        $user = new Player($player);
        $user->save(); */

        

        //insert data a las 3 tablas.

       /*  $response = Http::get('https://randomuser.me/api');
        dd($response); */

/*        $response=$client->request('GET',"");
       dd($response); */
       
        /* $client=new Client([
            'base_uri' => 'https://randomuser.me',
            'timeout'=>2.0,
        ]);

        $response = $client->request('GET','api');

        dd($response);

        $response = $client->request('GET','api');
        $data = json_decode($response->getBody());
        dd($data); */
/* 
        $players=DB::table('players')->get(); */


        $client = new Client;
          
        $response = $client->get('https://randomuser.me/api');

        // You need to parse the response body
        // This will parse it into an array
        $response = json_decode($response->getBody(), true);
        dd($response);

        return view('home')->with('players',$players);
    }
}
