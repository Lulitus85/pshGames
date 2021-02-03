

@foreach($scores as $data)  
 
    <div>
         <div> <img src="{{$data['photo']}}" alt=""></div>
         <div class="data"> 
             <h2>Player: {{$data['player_name']}} </h2>
             <p> Last Update: {{$data['updated']}} </p>
         </div>
         <h1> {{$data['score']}} </h1>
    </div>

@endforeach


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"> </script>
<script>
window.setTimeout(updateStatistics,5000);


</script>
