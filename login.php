<?php
//setcookie("token", 'EFN2G4bE', time()+3600*24*30);
if(isset($_POST['email'])){
    $response = json_decode(file_get_contents("https://api.vitasha.tk/music/signin/free/?email=".$_POST['email']."&password=".$_POST['pass']), true);
    if($response['token'] != null){
        setcookie("token", $response['token'], time()+3600*24*30);
        echo '<a href="/">Go!</a>';
    }else{
        echo "incorrect pass";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <input name="email" type="text" placeholder="email" required>
        <input name="pass" type="text" placeholder="pass" required>
        <input type="submit" value="Войти!">
    </form>
</body>
</html>