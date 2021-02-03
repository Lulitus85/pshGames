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
    public function getData(Client $client){

        $loop=10;
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

       
        $post=[];
        $scores=[];
        for($i=0; $i<count($results); $i++){
            for($j=0; $j<count($players); $j++){
                if($results[$i]->id_player === $players[$j]->id){
                    $post = array(
                        'id'=>$results[$i]->id,
                        'score'=>$results[$i]->score,
                        'player_name'=>$players[$j]->nick_name,
                        'photo'=>$players[$j]->photo,
                        'updated'=>$results[$i]->updated_at
                    );
                }
            }
            array_push($scores,$post);
        }
   
        return view('home')->with('scores',$scores);
    }

    //update view every 10 seconds
    public function viewUpdate(){
    
        $players=DB::table('players')->get()->all();
        $games=DB::table('games')->get()->all();
        $results=DB::table('results')->orderBy('score','DESC')->take(10)->get();

        $post=[];
        $scores=[];
        for($i=0; $i<count($results); $i++){
            for($j=0; $j<count($players); $j++){
                if($results[$i]->id_player === $players[$j]->id){
                    $post = array(
                        'id'=>$results[$i]->id,
                        'score'=>$results[$i]->score,
                        'player_name'=>$players[$j]->nick_name,
                        'photo'=>$players[$j]->photo,
                        'updated'=>$results[$i]->updated_at
                    );
                }
            }
            array_push($scores,$post);
        }

        return view('newStatistic')->with('scores', $scores);
    }

    public function getReport(Request $request){
        $fileName = 'scores.csv';
        $players=DB::table('players')->get()->all();
        $games=DB::table('games')->get()->all();
        $results=DB::table('results')->orderBy('score','DESC')->take(10)->get();

        $post=[];
        $scores=[];
        for($i=0; $i<count($results); $i++){
            for($j=0; $j<count($players); $j++){
                if($results[$i]->id_player === $players[$j]->id){
                    $post = array(
                        'id'=>$results[$i]->id,
                        'score'=>$results[$i]->score,
                        'player_name'=>$players[$j]->nick_name,
                        'photo'=>$players[$j]->photo,
                        'updated'=>$results[$i]->updated_at
                    );
                }
            }
            array_push($scores,$post);
        } 

        $headers=array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Id Player', 'Player', 'Score', 'Last Update');

        $callback = function() use($scores, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($scores as $score) {
                $row['Id Player']  = $score['id'];
                $row['Player']    = $score['player_name'];
                $row['Score']    = $score['score'];
                $row['Last Update']  = $score['updated'];

                fputcsv($file, array($row['Id Player'], $row['Player'], $row['Score'], $row['Last Update']));
            }

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

}
