<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>Data</h1>
<table>
    @foreach($Data as $dat)
    <tr>
        <td>{{$dat->name}}</td>
        <td>{{$dat->date}}</td>
    </tr>
        @endforeach
</table>
</div>
</body>
</html>
