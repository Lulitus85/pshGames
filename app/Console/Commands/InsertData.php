<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Models\Player;
use App\Models\Game;
use App\Models\Result;


class InsertData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert all registers in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
       return;
    }
}
