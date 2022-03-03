<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        table,th,thead,tr,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<table class="table" >
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">IP</th>
        <th scope="col">Short-URL</th>
        <th scope="col">Location</th>
        <th scope="col">Latitude</th>
        <th scope="col">Longitude</th>
        <th scope="col">Referer</th>
        <th scope="col">OS</th>
        <th scope="col">Device</th>
        <th scope="col">Browser</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clicks as $click )
    <tr>
        <th scope="row">{{$click->id}}</th>
        <td>{{$click->ip}}</td>
        <td>{{\App\Factories\LinkFactory::formatLink($click->link->short_chars)}}</td>
        <td>{{$click->location}}</td>
        <td>{{$click->latitude}}</td>
        <td>{{$click->longitude}}</td>
        <td>{{$click->referer}}</td>
        <td>{{$click->os_platform}}</td>
        <td>{{$click->device}}</td>
        <td>{{$click->browser}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
