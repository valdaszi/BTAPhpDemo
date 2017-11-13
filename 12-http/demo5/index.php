<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Užkrauti failą</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Pasirinkti tekstinį failą:
            <input type="file" name="failas">
            <input type="submit" value="Siųsti">
        </form>
    </body>
</html>