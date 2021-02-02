
<div id="updated">
    @foreach($results as $result)
    <h2> {{$result->score}} </h2>
    @endforeach
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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