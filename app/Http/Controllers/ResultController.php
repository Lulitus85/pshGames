<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Player;
use App\Models\Game;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function insertData(Client $client){

        $loop=8;
        //insert data into tables.
        for($i=0; $i<$loop; $i++){
                //insert player
                $var = rand(0,10);      
                if($var > 0){
                    for ($i = 0; $i < $var; $i++){
                        $response = Http::get('https://randomuser.me/api');
                        $data = json_decode($response->getBody());
                        if($data){
                            $data = $data->results;
                            $player = array(
                                'nick_name'=>$data[0]->name->first,
                                'photo'=>$data[0]->picture->large
                            );
                            $newplayer = new Player($player);
                            $newplayer->save();
                        }
                    }
                }
                //

                //insert game
                $name=substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);

                $game=array(
                    'name'=>$name,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                );

                DB::table('games')->insert($game);
                
                $players=DB::table('players')->latest()->take($var)->get();
                $games=DB::table('games')->latest()->take(1)->get();

                //insert statistics
                if($var>0){
                    for($i=0; $i<count($players);$i++){
                        $score=rand(1,100);
                        $result = array(
                            'id_player'=>$players[$i]->id,
                            'id_game'=>$games[0]->id,
                            'score'=>$score,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s')
                        );
                        $newresult = new Result($result);
                        $newresult->save();
                    }
                }
                $results=DB::table('results')->latest()->take($var)->get();
        }
       
        //TOP 10 BEST SCOREs           
        $players=DB::table('players')->get()->all();
        $games=DB::table('games')->get()->all();
        $results=DB::table('results')->orderBy('score','DESC')->take(10)->get();

        //está trayendo los ultimos insertados... revisar
        return view('home')->with('players',$players)
                           ->with('games',$games)
                           ->with('results',$results);
    }

    //update view every 10 seconds
    public function viewUpdate(){
    
        $players=DB::table('players')->get()->all();
        $games=DB::table('games')->get()->all();
        $results=DB::table('results')->orderBy('score','DESC')->take(10)->get();

        return view('newStatistic')->with('results', $results)
                                   ->with('games',$games)
                                   ->with('players', $players);
    }

}
