<?php
if(!isset($_COOKIE['token'])){
    header("Location: login/");
}else{

}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- title -->
    <title>Vitasha Music</title>
    <!-- styles -->
    <link rel="preload" href="assets/css/preloader.css" as="style">
    <link href="assets/css/preloader.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="assets/fonts/Roboto_swap.css" rel="stylesheet">
    <!-- meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-status-bar" content="#27272c">
    <meta name="theme-color" content="#27272c">
    <!-- images -->
    <link href="assets/images/logo.png" as="image">
    <link href="assets/images/play.png" as="image">
    <link href="assets/images/pause.png" as="image">
    <link href="assets/images/home.png" as="image">
    <link href="assets/images/search.png" as="image">
    <link href="assets/images/exclicit.png" as="image"> 
    <!-- js -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/index.js"></script>
    <!-- manifest for pwa -->
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="assets/images/logo.png">
    <!-- favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/png">
</head>
<body>
    <!-- Прелоадер -->
    <div id="preloader">
        <div id="preloader_img_div">
            <svg id="preloader_img" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="currentColor"
                d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z">
            </path>
            </svg>
        </div>
    </div>
    <!-- Элементы приложения -->
    <div id="search_history_back" onclick="search_history_hide();"></div>
    <div id="search_history"></div>
    <div id="home">
        <div id="search">
            <div class="search_news_btn">
                <button id="news_btn" onclick="open_news()"><img src="assets/images/home.png" alt="home"></button>
            </div>
            <div class="search_field_div">
                <input type="text" name="search_field_input" id="search_field" autocomplete="off" onclick="search_history_show();" placeholder="Search...">
            </div>
            <div class="search_search_btn">
                <button id="search_btn" onclick="search()"><img src="assets/images/search.png" alt="search"></button>
            </div>
        </div>
        <div id="home_news_div">
            <!-- tracks -->
            <h3>Connecting internet...</h3>
        </div>
    </div>
    <div id="my">
        <div id="my_header">
            <div id="my_home">
                <button id="reopen_my_btn" onclick="my()"><img src="assets/images/home.png" alt="home"></button>
            </div>
            <div id="my_playlist_opened_name">
                <span>Open playlist</span>
            </div>
            <div id="refresh_my">
                <button id="refresh_my_btn" onclick="refresh_my()">Refresh</button>
            </div>
        </div>
        <div id="my_main">
        
        </div>
    </div>
    <div id="settings">
        <h3>Настройки:</h3>
        <button onclick="change_pass_open()" id="change_pass">Сменить пароль</button>
        <div id="pass_change_div">
            <form action="" autocomplete="off">
                <label for="new_pass_1">Новый пароль:</label><br>
                <input id="new_pass_1" type="password" autocomplete="current-password" name="password"><br>
                <label for="new_pass_2">Повторите новый пароль:</label><br>
                <input id="new_pass_2" type="password" autocomplete="current-password" name="password2"><br>
                <button onclick="change_pass()">Сменить</button>
            </form>
        </div>
        <button onclick="feed_back_open()" id="feed_back">Написать отзыв</button>
            <div id="feed_back_div">
                <label for="feed_back_text">Ваш отзыв:</label><br>
                <textarea id="feed_back_text" name="" id=""></textarea><br>
                <button onclick="feed_back()">Отправить</button>
            </div>
        <button onclick="support_open()" id="support">Поддержка</button>
            <div id="support_div">
                <label for="support_text">Ваш отзыв:</label><br>
                <textarea id="support_text" name="" id=""></textarea><br>
                <button onclick="support()">Отправить</button>
            </div>
        <button onclick="sign_out()" id="sign_out">Выйти</button>
    </div>
    <div id="player">
        <div id="player_close_btn" onclick="player();">
            <span>∨</span>
        </div>
        <div id="player_cover">

        </div>
        <div id="player_name">
            
        </div>
        <div id="player_author">

        </div>
        <div id="player_volume">
            <label for="player_volume_input">Громкость</label><br>
            <input id="player_volume_input" type="range" min="0" max="100" value="100" onchange="change_song_volume()">
        </div>
        <div id="player_song_moment">
            <label for="player_song_moment_input">Песня</label><br>
            <input id="player_song_moment_input" type="range" min="0" max="100" value="0" onchange="change_song_moment()">
        </div>
        <div id="player_btns">
            <div id="player_prev_btn">
                <button onclick="prev();">Prev</button>
            </div>
            <div id="player_play_btn">
                <button onclick="toggle_song_playing();"><img src="assets/images/pause.png" alt="search"></button>
            </div>
            <div id="player_next_btn">
                <button onclick="next('yes');">Next</button>
            </div>
        </div>
        <div id="player_next_type_btn">
            <button onclick="type_song_playing();"><!-- repeat track/repeat playlist/no repeat --></button>
        </div>
        <div id="player_add_to_favorites">
            <button onclick="player_add_to_favorites();">Add to favorites</button>
        </div>
    </div>
    <div id="under_player_closed">
        <span>Start listen ANYTHING!</span>
    </div>
    <div id="player_closed" onclick="player();">
        <div id="player_closed_name_and_author">
            <div id="player_closed_name">

            </div>
            <div id="player_closed_author">

            </div>
        </div>
        <div id="player_closed_btn_play">
            <button onclick="toggle_song_playing();"><img src="assets/images/pause.png" alt="search"></button>
        </div>
    </div>
    <footer> <!-- CSS added, JS added --> 
        <div class="footer_btn" id="footer_main_btn" onclick="open_main();"> <!-- CSS added for .footer_btn -->
            <span>Home</span>
        </div>
        <div class="footer_btn" id="footer_my_btn" onclick="open_my();">
            <span>My</span>
        </div>
        <div class="footer_btn" id="footer_settings_btn" onclick="open_settings();">
            <span>Settings</span>
        </div>
    </footer>
    <script>
    window.onload = function () {
        $('#preloader').remove();
        my();
        news();
        $("#search_field").keyup(function(event){
            if(event.keyCode == 13){
                event.preventDefault();
                search_history_hide();
                search();
            }
        });
        $("#player_closed_btn_play").on("click", function(ev){
            ev.stopPropagation();
        });
        if('serviceWorker' in navigator){
            navigator.serviceWorker.register('assets/js/sw.js')
            .then(reg => console.log('service worker registered'))
            .catch(err => console.log('service worker not registered', err));
        }
    }
    </script>
</body>
</html>