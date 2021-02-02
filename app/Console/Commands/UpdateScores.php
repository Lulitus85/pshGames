<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Player;
use App\Models\Game;
use App\Models\Result;


class UpdateScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scores:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'the scores will be updated every 5 minutes';

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
        $results=Result::all();
        
        for($i=0; $i<count($results);$i++){
            $var = rand(1,100);
            $newStatistic = Result::find($results[$i]->id);
            /* if($newStatistic->score < $var){ */ //if score is less than $var
                $newStatistic->score = $var;
                $newStatistic->updated_at = date('Y-m-d H:i:s');
                $newStatistic->save();
            /* } */
        }

        return;
    }
}
