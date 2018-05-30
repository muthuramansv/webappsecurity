<?php

$connectToDb = new SimpleConnectDB();

$connectToDb.connectDB();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Websecurity</title>


</head>
<body>
    <form action="index.php" method="post" accept-charset="utf-8">
        <input type="text" name="test" />
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
        <input type="submit" value="Senden" />
    </form>



</body>
</html>