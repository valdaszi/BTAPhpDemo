<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Delete Radar</title>
    </head>
    <body>
        <h1>Delete Radar</h1>

        <form method="post" action="{{ url('radars', $radar->id) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            
            <div>id: {{$radar->id}}</div>
            <div>Date: {{$radar->date}}</div>
            <div>Number: {{$radar->number}}</div>
            <div>Distance: {{$radar->distance}}</div>
            <div>Time: {{$radar->time}}</div>
            <div>Speed: {{$radar->distance / $radar->time * 3.6}}</div>

            <button type="submit">Delete</button>
        </form>

        <button onclick="window.history.back();">Go Back</button>

    </body>
</html>