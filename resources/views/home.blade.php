@foreach($players as $player)
<div> 
<h5>
    {{$player->nick_name}}
</h5>    

<img src="{{$player->photo}}" />
</div>
 @endforeach
