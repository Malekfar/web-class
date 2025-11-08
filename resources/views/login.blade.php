<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>
<body>
    <form action="" method="POST">
        @csrf
        <label>Email</label>
        <input name="email" />
        <br/>
        <label>Password</label>
        <input name="password" />

        <button>Login</button>
    </form>
</body>
</html>