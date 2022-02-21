<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CYTONN DMS SYSTEM </title>
</head>
<body>
<h3>Hello {{ $details['name'] }}</h3>
<p>
    {{ $details['requesterName'] }} has requested to access the document <b>{{ $details['document'] }}</b>
    temporarily for the following reasons <b>{{ $details['description'] }}</b> please login to view
    the request.
</p>
<hr>
<h4>Regards Cytonn DMS System Admin</h4>
</body>
</html>
