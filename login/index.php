<?php
setcookie("token", 'EFN2G4bE', time()+3600*24*30);
if(isset($_POST['email'])){
    if($_POST['type'] == 'signin'){
        $response = json_decode(file_get_contents("https://api.vitasha.tk/music/signin/free/?email=".$_POST['email']."&password=".$_POST['pass']), true);
        if($response['token'] != null){
            setcookie("token", $response['token'], time()+3600*24*30, '/');
            echo "<script>window.location.replace('../');</script>";
        }else{
            echo "<script>alert('Пароль неверный, если что-то не так, попробуйте ещё раз или обратитесь ко мне в VK.');</script>";
        }
    }else{
        $response = json_decode(file_get_contents("https://api.vitasha.tk/music/signup/free/?email=".$_POST['email']."&password=".$_POST['pass']."&app=33"), true);
        if($response['status'] == true){
            echo "<script>alert('Регистрация успешна, проверьте почту.');</script>";
        }else{
            echo "<script>alert('Что-то не так... Попробуйте ещё раз или обратитесь ко мне в VK.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/fonts/Roboto_swap.css" rel="stylesheet">
    <title>Login</title>
    <script src="../assets/js/jquery.min.js"></script>
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <style>
    *{
        padding: 0;
        margin: 0;
        font-family: 'Roboto', sans-serif;
    }
    body{
        height: 100vh;
        width: 100%;
        background-color: #27272c;
        overflow: hidden;
    }
    #form{
        border-radius: 3vh;
        border: solid white 3px;
        display: block;
        width: 40vh;
        max-width: 90vw;
        margin: 20vh auto;
        height: 50vh;
        background-color: #161618;
    }
    input{
        display: block;
        margin: 3vh auto;
        height: 5vh;
        text-align: center;
        color: white;
        width: 80%;
        background-color: #27272c;
        border-radius: 3vh;
        border: solid white 3px;
        font-size: 2vh;
    }
    p{
        color: white;
        text-align: center;
    }
    </style>
</head>
<body>
    <div id="form">
        <form action="" method="post">
            <br>
            <input id="type" type="hidden" name="type" value="signin">
            <input name="email" type="text" placeholder="email" required> <br>
            <input name="pass" type="text" placeholder="pass" required> <br>
            <input id="submit_btn" type="submit" value="Войти!">
        </form>
        <p id="switch" onclick="signup()">Зарегистрироваться?</p>
    </div>
    <script>
    function signup(){
        $('#submit_btn').val('Зарегистрироваться!');
        $('#switch').html('Хотите войти?');
        $('#switch').attr('onclick', 'signin()');
        $('#type').val('signup');
    }
    function signin(){
        $('#submit_btn').val('Войти!');
        $('#switch').html('Хотите зарегистрироваться?');
        $('#switch').attr('onclick', 'signup()');
        $('#type').val('signin');
    }
    async function registerSW(){
        if('serviceWorker' in navigator) {
            try{
                await navigator.serviceWorker.register('../sw.js');
            }catch(e){
                console.log('SW registration failed');
            }
        }
    }
    window.onload = function () {
        registerSW();
    }
    </script>
</body>
</html>