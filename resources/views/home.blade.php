<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body{
    margin: 0 auto;
    padding: 1rem;
    box-sizing: border-box;
    font-family: 'Nunito';
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

div{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width:80%;
}

div>h1{
    text-transform: uppercase;
    color: #477ADD;
}

div>span{
    background: #477ADD;
    border: 1px solid gainsboro;
    border-radius: 5px;
    padding: .5rem;
    color: ghostwhite;
    cursor: pointer;
    transition-property: all;
    transition-duration: 1s;
    transition-timing-function: ease;
}

div>span:hover{
    background: gainsboro;
    border: 1px solid #477ADD;
    color: #477ADD;
}

#updated{
    justify-content: center;
    width: 80%;
    align-items: center;
    flex-wrap: wrap;
}

#updated>div{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin-bottom: 1rem;
}

#updated>div>div{
    width: 5rem;
    height: 5rem;
    border-radius: 5rem;
    border: 4px solid #477ADD;
}

#updated>div>div>img{
    object-fit: cover;
    width: 100%;
    border-radius: 5rem;
}

#updated>div>div:nth-child(2){
    width: 80%;
    border: 0;
    border-radius: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
}

#updated>div>div:nth-child(2)>h2{
    margin: 0;
    color: #477ADD;
}

#updated>div>div:nth-child(2)>p{
    margin: 0;
    font-size: .8rem;
    font-style: italic;
}


</style>

<div>
    <h1>TOP TEN STATISTICS</h1>
    <span data-href="/export" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span>
</div>

<div>
    <h2> Player Data </h2>
    <h2> SCORE </h2>
</div>

<div id="updated">    
    {{-- content --}}
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>

updateStatistics();
window.setTimeout(updateStatistics,5000);

function updateStatistics(){
    $.ajax({
        type:"get",
        url:"/update",
        success:function(resp){
            $('#updated').html(resp)
        }

    })
}

function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }

 </script>