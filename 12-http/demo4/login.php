<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Prisijungti</h1>
        <?php if (isset($_POST['user'])): ?>
            <div>Neteisingas prisijungimo vardas ar slaptažodis</div> 
        <?php endif; ?>
        <form action="auth.php" method="post">
            <input name="user" type="text">
            <input name="pass" type="password">
            <input type="submit" value="Login">
        </form>
    </body>
</html>