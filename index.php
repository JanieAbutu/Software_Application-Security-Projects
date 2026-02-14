<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>LDAP injections form</title>

    <style>
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        div {
            width: 50%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
</head>

<body>
    <h1>Login form</h1>
    <div>
        <form action="home.php" method="post">

            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="checkbox" onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show Password
            <br>

            <input type="submit" value="Log in">

        </form>
    </div>
</body>
</html>
