<?php 
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
?>



@foreach($scores as $data)  
 
    <div>
         {{-- <div> <img src="{{$result->id_player->photo}}" alt=""></div> </div>
         <h2> {{$result->id_player->nick_name}} </h2> --}}
         <h1> {{$data['score']}} </h1>
    </div>

@endforeach

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"> </script>
<script>
window.setTimeout(updateStatistics,5000);

function updateStatistics(){
    console.log("entra")
    $.ajax({
        type:"get",
        url:"/update",
        success:function(resp){
            console.log("success")
            $('#updated').html(resp)
        }
    })
}

</script>
