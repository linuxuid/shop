<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>error page</title>
</head>
<body>

    <style>
        body {
            font-size: 18px;
        }

        p > a {
            text-decoration: none;
            color: blue;
        }

        p > a:hover {
            color: red
        }
    </style>

    <p>Please, log in <a href="{{ route('session.create') }}">Log in</a></p>
    <p>Or register <a href="{{ route('users') }}">Register</a></p>
</body>
</html>