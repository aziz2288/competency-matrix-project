<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to competency matrix project</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f0f8ff; /* Light blue background */
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #007bff; /* Blue color */
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        .card a {
            color: #007bff; /* Blue color */
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            border: 1px solid #007bff;
            border-radius: 0.25rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .card a:hover {
            background-color: #007bff;
            color: white;
        }

        .footer {
            background-color: #007bff; /* Blue color */
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body class="antialiased">
    <div class="header">
        <h1>Welcome to competency matrix project</h1>
    </div>

    <div class="content">
        <div class="card">
            <h2>Start your session</h2>
                <a href="{{ route('login') }}">Log in</a>
        </div>
    </div>
</body>
</html>
