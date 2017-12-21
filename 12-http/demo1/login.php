<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Prisijungti</h1>

        <?php if (isset($_GET['user']) || isset($_GET['pass'])): ?>
            <div>Neteisingas prisijungimo vardas ar slaptažodis</div> 
        <?php endif; ?>
        
        <form action="auth.php" method="get">
            <input name="user" type="text">
            <input name="pass" type="password">
            <button>Prisijungti</button>
        </form>
    </body>
</html>