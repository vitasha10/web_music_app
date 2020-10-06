<?php
if(!isset($_COOKIE['token'])){
    header("Location: login.php");
}else{

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"><title>Music</title>
    <title>Music</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }
        .footer_btn{
            display: block;
            float: left;
            width: 33%;
            height: 7vh;
            text-align: center;
            line-height: 7vh;
            color: white;
            background-color: #27272c;
        }
        footer{
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 7vh;
            color: white;
            background-color: #27272c;
        }
        #player_closed{
            position: fixed;
            color: white;
            background-color: #27272c;
            left: 0;
            bottom: 7vh;
            width: 100%;
            height: 7vh;
        }
        #my{
            display:none;
            height: 86vh;
            position: fixed;
            width: 100%;
            color: white;
            overflow: auto;
            background-color: #161618;
        }
        #settings{
            display:none;
            height: 86vh;
            position: fixed;
            width: 100%;
            color: white;
            overflow: auto;
            background-color: #27272c;
        }
        .song{
            background-color: #27272c;
            color: white;
            display: block;
            font-size: 2.3vh;
            height: 7vh;
            width: 94%;
            margin: 1.3vh 3% 1vh 3%;
            border: solid #27272c 1px;
            border-radius: 5px;
        }
        .cover img{
            height: 6vh;
            width: 6vh;
            border-radius: 50%;
            margin: 0.5vh;
        }
        .cover{
            display:block;
            float: left;
            height: 8vh;
            width: 8vh;
        }
        .song_name{
            display:block;
            height: 4vh;
        }
        .song_name span{
            display:block;
            float:left;
            line-height: 4vh;
            font-size: 2vh;
        }
        .song_author{
            display:block;
            height: 4vh;
        }
        .song_author span{
            display:block;
            float:left;
            line-height: 3vh;
            font-size: 1.5vh;
        }
        .explicit{
            height: 3vh;
            width: 3vh;
            margin: 0.5vh;
        }
        #search_history{
            position: fixed;
            width: 100%;
            height: auto;
            min-height: 7vh;
            max-height: 79vh;
            overflow: auto;
            top: 7vh;
            background-color: #161618;
            z-index: 5;
            display: none;
        }
        #search_history_back{
            position: fixed;
            width: 100%;
            height: 100vh;
            overflow: auto;
            top: 0;
            z-index: 4;
            display: none;
        }
        #search_a{
            display: block;
            height: 4vh;
            font-size: 2vh;
            width: 96vw;
            color: white;
            line-height: 4vh;
            padding-left: 3vw;
        }
        #player{
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            overflow: auto;
            background-color: #27272c;
            z-index: 500;
            display: none;
        }
        #player_close_btn{
            display: block;
            margin: 1vh auto;
            width: 3vh;
            text-align: center;
            height: 3vh;
            font-size: 2vh;
            color: white;
            background-color: #27272c;
            border: solid #27272c 1px;
            border-radius: 25%;
        }
        #home_news_div{
            height: 79vh;
            position: fixed;
            top: 7vh;
            width: 100%;
            color: white;
            overflow: auto;
            background-color: #161618;
        }
        #home{
            display:block;
            height: 86vh;
            position: fixed;
            width: 100%;
            color: white;
            overflow: auto;
            background-color: #161618;
        }
        #news_btn{
            display:block;
            color: white;
            width: 98%;
            max-width: 5.5vh;
            height: 5.5vh;
            background-color: #27272c;
            border: none;
            margin: 0 auto;
        }
        .search_news_btn{
            float:left;
            color: white;
            width: 12%;
            height: 6vh;
            background-color: #27272c;
            border: solid #27272c 1px;
            border-radius: 3px;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
        }
        #search_field{
            background-color: #27272c;
            border: none;
            text-align: center;
            color: white;
            z-index:6;
            width: 70vw;
            height: 90%;
        }
        .search_field_div{
            display:block;
            float:left;
            width: 72%;
            height: 6vh;
            background-color: #27272c;
            border: solid #27272c 1px;
            text-align: center;
            color: white;
            border-radius: 3px;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
            z-index:6;
        }
        #search_btn{
            display:block;
            width: 100%;
            max-width: 5.5vh;
            height: 5.5vh;
            background-color: #27272c;
            color: white;
            border: none;
            margin: 0 auto;
        }
        #search_btn img{
            width: 70%;
            height:70%;
            max-height: 11vw;
            display: block;
            margin: 15% auto;
        }
        .search_search_btn{
            float:left;
            width: 11%;
            height: 6vh;
            background-color: #27272c;
            color: white;
            border: solid #27272c 1px;
            border-radius: 3px;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
        }
        #player_closed_btn_play{
            width: 5vh;
            height: 5vh;
            margin: 1vh 0 1vh 2.5vw;
            display: block;
            float:left;
        }
        #player_closed_btn_play button{
            background-color: #161618;
            color: white;
            border: solid 1px #161618;
            border-radius: 5px;
            width: 5vh;
            max-width: 100%;
            height: 5vh;
            font-size: 2vh;
            line-height: 2vh;
        }
        #player_closed_name_and_author{
            display: block;
            float:left;
        }
        #player_closed_name{
            padding: 0 0 0 3vw;
            line-height: 3.55vh;
            height: 3.55vh;
            width: 77vw;
        }
        #player_closed_author{
            padding: 0 0 0 3vw;
            line-height: 3.45vh;
            height: 3.45vh;
            width: 77vw;
        }
        #player_closed{
            display:none;
        }
        #under_player_closed{
            position: fixed;
            color: white;
            background-color: #27272c;
            left: 0;
            bottom: 7vh;
            width: 100%;
            height: 7vh;
            text-align: center;
            line-height: 7vh;
        }
        #player_cover{
            height: 45vh;
            max-height: 80vw;
            width: 45vh;
            max-width: 80vw;
            margin: 0 auto;
        }
        #player_cover img{
            height: 100%;
            width: 100%;
        }
        #player_name{
            width: 45vh;
            max-width: 80vw;
            margin: 0 auto;
            height:5vh;
            line-height: 5vh;
            font-size: 2.5vh;
            color: white;
        }
        #player_author{
            width: 45vh;
            max-width: 80vw;
            margin: 0 auto;
            height: 4vh;
            line-height: 4vh;
            font-size: 2.3vh;
            color: white;
        }
        #player_btns{
            height: 6vh;
            width: 35vw;
            margin: 5vh auto;
        }
        #player_prev_btn{
            float:left;
            display: block;
            width:25%;
            margin: 0 auto;
        }
        #player_prev_btn button{
            display: block;
            width: 4vh;
            height: 4vh;
            background-color: #161618;
            border: solid #161618 1px;
            border-radius: 1vh;
            color: white;
            margin: 1vh auto;
        }
        #player_play_btn{
            float:left;
            display: block;
            width:49%;
            margin: 0 auto;
        }
        #player_play_btn button{
            display: block;
            width: 6vh;
            height: 6vh;
            background-color: #161618;
            border: solid #161618 1px;
            border-radius: 1vh;
            color: white;
            margin: 0 auto;
        }
        #player_next_btn{
            float:left;
            display: block;
            width:25%;
            margin: 0 auto;
        }
        #player_next_btn button{
            display: block;
            width: 4vh;
            height: 4vh;
            background-color: #161618;
            border: solid #161618 1px;
            border-radius: 1vh;
            color: white;
            margin: 1vh auto;
        }
        #player_play_btn button img{
            height: 100%;
            width: 100%;
        }
        #player_closed_btn_play button img{
            height: 100%;
            width: 100%;
        }
        #news_btn img{
            height: 80%;
            width: 80%;
            margin: 10% auto;
        }
        #player_volume{
            color: white;
            height: 5vh;
            width: 45vh;
            max-width: 80vw;
            margin: 1vh auto;
        }
        #player_volume input{
            margin: 1vh 0 1vh 0;
            height: 2vh;
            border-radius: 5px;
            outline: none;
            width: 100%;
            appearance: none;
        }
        #player_volume input::-webkit-slider-thumb{
            -webkit-appearance: none;
            appearance: none;
            width: 1.8vh;
            height: 1.8vh;
            background: #161618;
            border-radius: 50%;
            cursor: pointer;
        }
        #player_volume input::-moz-range-thumb{
            width: 1.8vh;
            height: 1.8vh;
            background: #161618;
            border-radius: 50%;
            cursor: pointer;
        }
        #player_song_moment{
            color: white;
            height: 5vh;
            width: 45vh;
            max-width: 80vw;
            margin: 1vh auto;
        }
        #player_song_moment input{
            margin: 1vh 0 1vh 0;
            height: 2vh;
            border-radius: 5px;
            outline: none;
            width: 100%;
            appearance: none;
        }
        #player_song_moment input::-webkit-slider-thumb{
            -webkit-appearance: none;
            appearance: none;
            width: 1.8vh;
            height: 1.8vh;
            background: #161618;
            border-radius: 50%;
            cursor: pointer;
        }
        #player_song_moment input::-moz-range-thumb{
            width: 1.8vh;
            height: 1.8vh;
            background: #161618;
            border-radius: 50%;
            cursor: pointer;
        }
        #player_next_type_btn{
            width: 45vh;
            max-width: 80vw;
            margin: 1vh auto;
        }
        #player_next_type_btn button{
            height: 3.5vh;
            width: 25vw;
            max-width: 15vh;
            color: white;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 1.4vh;
        }
        #sign_out{
            height: 4vh;
            width: 45vh;
            max-width: 80vw;
            display: block; 
            line-height: 4vh;
            color: white;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 2vh;
            margin: 1vh auto;
        }
        #settings h3{
            margin: 2vh;
        }
        #change_pass{
            height: 4vh;
            width: 45vh;
            max-width: 80vw;
            display: block; 
            line-height: 4vh;
            color: white;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 2vh;
            margin: 1vh auto;
        }
        #support{
            height: 4vh;
            width: 45vh;
            max-width: 80vw;
            display: block; 
            color: white;
            line-height: 4vh;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 2vh;
            margin: 1vh auto;
        }
        #feed_back{
            height: 4vh;
            width: 45vh;
            max-width: 80vw;
            display: block; 
            color: white;
            line-height: 4vh;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 2vh;
            margin: 1vh auto;
        }
        #pass_change_div{
            color: white;
            text-align: center;
            background-color: #27272c;
            border: solid #161618 3px;
            border-radius: 3vh;
            width: 45vh;
            max-width: 80vw;
            display: none; 
            margin: 2vh auto;
        }
        #feed_back_div{
            display:none;
            color: white;
            text-align: center;
            background-color: #27272c;
            border: solid #161618 3px;
            border-radius: 3vh;
            width: 45vh;
            max-width: 80vw;
            margin: 2vh auto;
        }
        #old_pass, #new_pass_1, #new_pass_2{
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            margin: 0.5vh;
            color: white;
            text-align: center;
        }
        #pass_change_div button{
            height: 3vh;
            width: 50%;
            display: block; 
            color: white;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 1.5vh;
            margin: 1vh auto;
        }
        #feed_back_div button{
            height: 3vh;
            width: 50%;
            display: block; 
            color: white;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 1.5vh;
            margin: 1vh auto;
        }
        #support_div button{
            height: 3vh;
            width: 50%;
            display: block; 
            color: white;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 1.5vh;
            margin: 1vh auto;
        }
        #feed_back_text{
            width: 80%;
            height: 15vh;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            margin: 0.5vh;
            color: white;
            padding: 0.5vh; 
        }
        #support_div{
            display:none;
            color: white;
            text-align: center;
            background-color: #27272c;
            border: solid #161618 3px;
            border-radius: 3vh;
            width: 45vh;
            max-width: 80vw;
            margin: 2vh auto;
        }
        #support_text{
            width: 80%;
            height: 15vh;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            margin: 0.5vh;
            color: white;
            padding: 0.5vh; 
        }
        #hidden{
            display:none;
        }
        #my_header{
            display:block;
            color: white;
            width: 100%;
            height: 7vh;
        }
        #my_home{
            float:left;
            color: white;
            width: 12%;
            height: 6vh;
            background-color: #27272c;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
            border: solid #27272c 1px;
            border-radius: 3px;
        }
        #reopen_my_btn{
            color: white;
            width: 98%;
            margin: 0 auto;
            display:block;
            max-width: 5.5vh;
            height: 5.5vh;
            background-color: #27272c;
            border: none;
        }
        #reopen_my_btn img{
            height: 80%;
            width: 80%;
            margin: 10% auto;
        }
        #my_playlist_opened_name{
            float:left;
            color: white;
            width: 64%;
            height: 6vh;
            background-color: #27272c;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
            padding: 0 0 0 3vw;
            border: solid #27272c 1px;
            border-radius: 3px;
        }
        #my_playlist_opened_name span{
            display:block;
            height: 100%;
            line-height: 6vh;
            font-size: 2.5vh;
        }
        .playlist_name{
            background-color: #27272c;
            color: white;
            display: block;
            font-size: 3vh;
            height: 7vh;
            line-height: 7vh;
            width: 91vw;
            margin: 1.3vh 3vw 1vh 3vw;
            border: solid #27272c 1px;
            border-radius: 5px;
            padding: 0 0 0 2vw;
        }
        .del_song_from_playlist_btn{
            display:block;
            float: right;
            height: 7vh;
            line-height: 7vh;
            width: 5vh;
            z-index: 5;
            text-align: center;
        }
        #refresh_my_btn{
            float:left;
            color: white;
            width: 16%;
            height: 6vh;
            background-color: #27272c;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
            border: solid #27272c 1px;
            border-radius: 3px;
            font-size: 1.5vh;
        }
        #player_add_to_favorites{
            width: 45vh;
            max-width: 80vw;
            margin: 1vh auto;
        }
        #player_add_to_favorites button{
            height: 3.5vh;
            width: 25vw;
            max-width: 15vh;
            color: white;
            background-color: #161618;
            border: solid #161618 3px;
            border-radius: 1vh;
            font-size: 1.4vh;
        }
        #my_main h3{
            text-align: center;
            font-size: 3vh;
            padding: 3vh;
        }
    </style>
</head>
<body>
    <div id="hidden">
        <!-- подгрузка изображений заранее -->
        <img src="play.png" alt="loading">
        <img src="pause.png" alt="loading">
        <img src="home.png" alt="loading">
        <img src="search.png" alt="loading">
        <img src="explicit.png" alt="loading">
    </div>
    <div id="search_history_back" onclick="search_history_hide();">

    </div>
    <div id="search_history">

    </div>
    <div id="home">
        <div id="search">
            <div class="search_news_btn">
                <button id="news_btn" onclick="open_news()"><img src="home.png" alt="home"></button>
            </div>
            <div class="search_field_div">
                <input type="text" name="search_field_input" id="search_field" autocomplete="off" onclick="search_history_show();" placeholder="Search...">
            </div>
            <div class="search_search_btn">
                <button id="search_btn" onclick="search()"><img src="search.png" alt="search"></button>
            </div>
        </div>
        <div id="home_news_div">
            <!-- tracks -->
        </div>
    </div>
    <div id="my">
        <div id="my_header">
            <div id="my_home">
                <button id="reopen_my_btn" onclick="my()"><img src="home.png" alt="home"></button>
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
                <button onclick="toggle_song_playing();"><img src="pause.png" alt="search"></button>
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
            <button onclick="toggle_song_playing();"><img src="pause.png" alt="search"></button>
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
        var usr_token = "<?php echo $_COOKIE['token'];?>";
        var audio;
        var is_pause = false;
        var is_song_playing = false;
        var song_id_playing;
        
        var playlist_home_news = [];
        var playlist_home_search = []; //not used
        var playlist_now = [];
        var playlist_now_played = [];
        var is_open_playlist = false;
        var open_playlist = [];
        var is_open_search = false;
        /*setInterval(() =>  {
            try{
                $('#player_song_moment input').attr('value',audio.currentTime);
            }catch{

            }
        }, 200);*/
        async function player_add_to_favorites(){
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/playlist_add_track/"+usr_token+"/?playlist_name=Favorites&json="+encodeURIComponent(JSON.stringify(playlist_now_played[song_id_playing])),
                dataType: 'text',
                success: function(data){
                    alert('Добавлено');
                }
            })
        }
        function refresh_my(){
            if(is_open_playlist){
                playlist_open(is_open_playlist);
            }else{
                my();
            }
        }
        function type_song_playing(){
            var val = getCookie('repeat');
            if(val == 1){
                $('#player_next_type_btn button').empty();
                $('#player_next_type_btn button').html('repeat track');
                setCookie('repeat',2);
            }else if(val== 2){
                $('#player_next_type_btn button').empty();
                $('#player_next_type_btn button').html('no repeat');
                setCookie('repeat',3);
            }else if(val == 3){
                $('#player_next_type_btn button').empty();
                $('#player_next_type_btn button').html('repeat playlist');
                setCookie('repeat',1);
            }
        }
        function open_news(){   
            is_open_search = false;
            $('#home_news_div').empty();
            $('#search_field').val('');
            playlist_now = [];
            for(let i=0; i < playlist_home_news.length; i ++){
                playlist_now[i] = playlist_home_news[i];
                //document.title = 'Music';
                //const el = document.getElementById('scroll');
                //el.scrollIntoView();
                //Манипуляции с name и author
                playlist_home_news[i]['name'] = short_name(playlist_home_news[i]['name']);
                playlist_home_news[i]['author'] = short_author(playlist_home_news[i]['author']);
                $('#home_news_div').append('<div class="song" onclick="getlinkbyid(\''+playlist_home_news[i]['id']+'\')"><div class="cover"><img src="'+playlist_home_news[i]['cover']+'" alt="cover"></div><div class="song_name"><span>'+playlist_home_news[i]['name']+'</span>'+explicit(playlist_home_news[i]['explicit'])+'</div><div class="song_author"><span>'+playlist_home_news[i]['author']+'</span></div></div>');
            }
        }
        function setCookie(cname, cvalue) { //fully
            var d = new Date();
            d.setTime(d.getTime() + (30*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        function getCookie(cname) { //fully
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        if(getCookie('volume') == ""){
            setCookie('volume',100);
        }
        if(getCookie('repeat') == ""){
            setCookie('repeat',1);
        }
        function support(){
            var text = $('#support_text').val();
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/tgbot/music_support/free/?text="+text,
                dataType: 'text',
                success: function(data){
                    $('#support_div').hide();
                    alert('Отправлено');
                }
            })
        }
        function support_open(){
            $('#support_div').toggle();
            $('#pass_change_div').hide();
            $('#feed_back_div').hide();
        }
        function change_pass(){
            var pass1 = $('#new_pass_1').val();
            var pass2 = $('#new_pass_2').val();
            if(pass1 == pass2){
                $.ajax({
                    type: "GET",
                    url: "https://api.vitasha.tk/music/change_pass/"+usr_token+"/?pass="+pass1,
                    dataType: 'text',
                    success: function(data){
                        $('#pass_change_div').hide();
                        alert('Пароль сменён!');
                    }
                })
            }else{
                alert('Пароли различны!');
            }
        }
        function change_pass_open(){
            $('#pass_change_div').toggle();
            $('#support_div').hide();
            $('#feed_back_div').hide();
        }
        function feed_back(){
            var text = $('#feed_back_text').val();
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/tgbot/music_feed_back/free/?text="+text,
                dataType: 'text',
                success: function(data){
                    $('#feed_back_div').hide();
                    alert('Отправлено');
                }
            })
        }
        function feed_back_open(){
            $('#feed_back_div').toggle();
            $('#support_div').hide();
            $('#pass_change_div').hide();
        } 
        function sign_out(){ //fully
            var cookies = document.cookie.split(";");
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                var eqPos = cookie.indexOf("=");
                var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
            }
            document.write('Перезагрузите страницу!');
        }
        function change_song_volume(){
            var val = $('#player_volume input').val();
            setCookie('volume',val);
            audio.volume = val/100;
        }
        function change_song_moment(){
            audio.currentTime = $('#player_song_moment input').val();
            $('#player_song_moment').empty();
            $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration+'" value="'+audio.currentTime+'" onchange="change_song_moment()">');
            audio.ontimeupdate = function() {
                $('#player_song_moment input').attr('value',audio.currentTime);
            };
        }
        function player(){
            $('#player').toggle();
        }
        function explicit(e){ //служебное fully
            if(e){
                return "<img class='explicit' src='explicit.png' alt='e'>";
            }else{
                return "";
            }
        }
        function short_name(name){ //служебное fully
            name1 = name.substr(0, 25);
            if(name1 !== name){
                name2 = name1+"...";
            }else{
                name2 = name1;
            }
            return name2;
        }
        function short_author(author){ //служебное fully
            author1 = author.substr(0, 25);
            if(author1 !== author){
                author2 = author1+"...";
            }else{
                author2 = author1;
            }
            return author2;
        }
        function set_playlist_now(arg){ //служебное fully
            if(arg == 'main'){ //fully
                if(is_open_search){
                    //playlist_now = playlist_home_search;
                }else{
                    playlist_now = playlist_home_news;
                }
            }else if(arg == 'my'){
                if(is_open_playlist){
                    playlist_now = open_playlist;
                }else{
                    //Nothing to do, because u don't see any tracks this way
                }
            }
        }
        async function news(){ //служебное fully
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/news/"+usr_token+"/",
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    $('#home_news_div').empty();
                    for(let i=0; i < array['songs'].length; i ++){
                        playlist_now[i] = array['songs'][i];
                        //document.title = 'Music';
                        //const el = document.getElementById('scroll');
                        //el.scrollIntoView();
                        //Манипуляции с name и author
                        array['songs'][i]['name'] = short_name(array['songs'][i]['name']);
                        array['songs'][i]['author'] = short_author(array['songs'][i]['author']);
                        $('#home_news_div').append('<div class="song" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt="cover"></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'</div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div></div>');
                    }
                    playlist_home_news = playlist_now;
                }
            })
        }
        function open_main(){ //full
            set_playlist_now('main');
            document.title = 'Music';
            $('#home').show();
            $('#my').hide();
            $('#settings').hide();
        }
        function open_my(){ //full
            set_playlist_now('my');
            document.title = 'My';
            $('#home').hide();
            $('#my').show();
            $('#settings').hide();
        }
        function open_settings(){ //full
            document.title = 'Settings';
            $('#home').hide();
            $('#my').hide();
            $('#settings').show();
        }
        function search_field(text){ //fully
            $('#search_field').val(text);
            search();
        }
        function search_history_show(){ //fully
            set_playlist_now('main');
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/search_history/"+usr_token+"/",
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    for(let i=0; i < array['search_history'].length; i ++){
                        $('#search_history').append('<div onclick="search_field(\''+array['search_history'][i]['search']+'\')" id="search_a">&#8226; '+array['search_history'][i]['search']+'</div>');
                    }
                    $('#search_history').show();
                    $('#search_history_back').show();
                }
            })
        }
        function search_history_hide(){ //fully
            set_playlist_now('main');

            $('#search_history').hide();
            $('#search_history').empty();
            $('#search_history_back').hide();
        }
        function toggle_song_playing(){ //fully
            if(is_pause){
                audio.play();
                $('#player_closed_btn_play button').html('<img src="pause.png" alt="search">');
                $('#player_play_btn button').html('<img src="pause.png" alt="search">');
                is_pause = false;
            }else{
                audio.pause();
                $('#player_closed_btn_play button').html('<img src="play.png" alt="search">');
                $('#player_play_btn button').html('<img src="play.png" alt="search">');
                is_pause = true;
            }
        }
        async function prev(){
            $('#player_closed_btn_play button').html('<img src="pause.png" alt="search">');
            $('#player_play_btn button').html('<img src="pause.png" alt="search">');
            is_pause = false;
            song_playing = true;
            if(song_id_playing-1 < 0){
                console.log('No prev track');
            }else{
                song_id_playing = song_id_playing-1;
                var id = playlist_now_played[song_id_playing]['id'];
                $.ajax({
                    type: "GET",
                    url: "https://api.vitasha.tk/music/getlinkbyid/"+usr_token+"/?id="+id,
                    dataType: 'text',
                    success: function(data){
                        try{
                            audio.load();
                            audio.currentTime = 0;
                            $('#player_song_moment').empty();
                            $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration+'" value="'+audio.currentTime+'" onchange="change_song_moment()">');
                            audio.ontimeupdate = function() {
                                $('#player_song_moment input').attr('value',audio.currentTime);
                            };
                        }catch{
                            //
                        }
                        var array = JSON.parse(data);
                        audio = new Audio(array['url']);
                        var val = $('#player_volume input').val();
                        audio.volume = val/100;
                        audio.play();
                        /*$('#controls_area').empty();
                        document.title = playlist[0]['name']+" | "+playlist[0]['author'];
                        $('#controls_area').append('<div id="cover_audio"><img src="'+playlist[0]['cover']+'" alt=""></div><span id="name_audio">'+playlist[0]['name']+'</span>'+'<span id="author_audio">'+playlist[0]['author']+'</span>');
                        $('#control_window_cover').empty();
                        $('#control_window_cover').append('<img src="'+playlist[0]['cover_xl']+'" alt="">');
                        */
                        $('#player_cover').empty();
                        $('#player_name').empty();
                        $('#player_author').empty();
                        $('#player_cover').html('<img src="'+playlist_now_played[song_id_playing]['cover_xl']+'" alt="cover">');
                        $('#player_name').html('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                        $('#player_author').html('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                        $('#player_closed_name').empty();
                        $('#player_closed_name').append('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                        $('#player_closed_author').empty();
                        $('#player_closed_author').append('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                        $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']);
                        /*$('#control_window_song').empty();
                        $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                        $('#control_window_add_to_playlist').empty();
                        $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                        $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                        $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                        */
                        audio.ontimeupdate = function() {
                            $('#player_song_moment input').attr('value',audio.currentTime);
                        };
                        audio.addEventListener('ended', (event) => {
                        next('no');
                        });
                    }
                })
            }
            
        }
        async function next(dd){
            $('#player_closed_btn_play button').html('<img src="pause.png" alt="search">');
            $('#player_play_btn button').html('<img src="pause.png" alt="search">');
            is_pause = false;
            song_playing = true;
            var val = getCookie('repeat');
            if(val == 1){
                if(playlist_now_played[song_id_playing+1] == undefined){
                    console.log('no next track');
                    song_id_playing = 0;
                }else{
                    song_id_playing = song_id_playing+1;
                }
                var id = playlist_now_played[song_id_playing]['id'];
                $.ajax({
                    type: "GET",
                    url: "https://api.vitasha.tk/music/getlinkbyid/"+usr_token+"/?id="+id,
                    dataType: 'text',
                    success: function(data){
                        try{
                            audio.load();
                            audio.currentTime = 0;
                            $('#player_song_moment').empty();
                            $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration+'" value="'+audio.currentTime+'" onchange="change_song_moment()">');
                            audio.ontimeupdate = function() {
                                $('#player_song_moment input').attr('value',audio.currentTime);
                            };
                        }catch{
                            //
                        }
                        var array = JSON.parse(data);
                        audio = new Audio(array['url']);
                        var val = $('#player_volume input').val();
                        audio.volume = val/100;
                        audio.play();
                        /*$('#controls_area').empty();
                        document.title = playlist[0]['name']+" | "+playlist[0]['author'];
                        $('#controls_area').append('<div id="cover_audio"><img src="'+playlist[0]['cover']+'" alt=""></div><span id="name_audio">'+playlist[0]['name']+'</span>'+'<span id="author_audio">'+playlist[0]['author']+'</span>');
                        $('#control_window_cover').empty();
                        $('#control_window_cover').append('<img src="'+playlist[0]['cover_xl']+'" alt="">');
                        */
                        $('#player_cover').empty();
                        $('#player_name').empty();
                        $('#player_author').empty();
                        $('#player_cover').html('<img src="'+playlist_now_played[song_id_playing]['cover_xl']+'" alt="cover">');
                        $('#player_name').html('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                        $('#player_author').html('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                        $('#player_closed_name').empty();
                        $('#player_closed_name').append('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                        $('#player_closed_author').empty();
                        $('#player_closed_author').append('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                        $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']);
                        /*$('#control_window_song').empty();
                        $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                        $('#control_window_add_to_playlist').empty();
                        $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                        $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                        $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                        */
                        audio.ontimeupdate = function() {
                            $('#player_song_moment input').attr('value',audio.currentTime);
                        };
                        audio.addEventListener('ended', (event) => {
                        next('no');
                        });
                    }
                })
            }else if(val == 2 && dd=='no'){
                audio.pause();
                audio.load();
                audio.play();
                $('#player_song_moment input').attr('value',0);
                audio.ontimeupdate = function() {
                    $('#player_song_moment input').attr('value',audio.currentTime);
                };
                audio.addEventListener('ended', (event) => {
                next('no');
                });
            }else if(val == 2 && dd=='yes'){
                is_pause = false;
                if(playlist_now_played[song_id_playing+1] == undefined){
                    console.log('no next track');
                    song_id_playing = 0;
                }else{
                    song_id_playing = song_id_playing+1;
                }
                var id = playlist_now_played[song_id_playing]['id'];
                $.ajax({
                    type: "GET",
                    url: "https://api.vitasha.tk/music/getlinkbyid/"+usr_token+"/?id="+id,
                    dataType: 'text',
                    success: function(data){
                        try{
                            audio.load();
                            audio.currentTime = 0;
                            $('#player_song_moment').empty();
                            $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration+'" value="'+audio.currentTime+'" onchange="change_song_moment()">');
                            audio.ontimeupdate = function() {
                                $('#player_song_moment input').attr('value',audio.currentTime);
                            };
                        }catch{
                            //
                        }
                        var array = JSON.parse(data);
                        audio = new Audio(array['url']);
                        var val = $('#player_volume input').val();
                        audio.volume = val/100;
                        audio.play();
                        /*$('#controls_area').empty();
                        document.title = playlist[0]['name']+" | "+playlist[0]['author'];
                        $('#controls_area').append('<div id="cover_audio"><img src="'+playlist[0]['cover']+'" alt=""></div><span id="name_audio">'+playlist[0]['name']+'</span>'+'<span id="author_audio">'+playlist[0]['author']+'</span>');
                        $('#control_window_cover').empty();
                        $('#control_window_cover').append('<img src="'+playlist[0]['cover_xl']+'" alt="">');
                        */
                        $('#player_cover').empty();
                        $('#player_name').empty();
                        $('#player_author').empty();
                        $('#player_cover').html('<img src="'+playlist_now_played[song_id_playing]['cover_xl']+'" alt="cover">');
                        $('#player_name').html('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                        $('#player_author').html('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                        $('#player_closed_name').empty();
                        $('#player_closed_name').append('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                        $('#player_closed_author').empty();
                        $('#player_closed_author').append('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                        $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']);
                        /*$('#control_window_song').empty();
                        $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                        $('#control_window_add_to_playlist').empty();
                        $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                        $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                        $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                        */
                        audio.ontimeupdate = function() {
                            $('#player_song_moment input').attr('value',audio.currentTime);
                        };
                        audio.addEventListener('ended', (event) => {
                        next('no');
                        });
                    }
                })
            }else if(val == 3 && dd == 'no'){
                audio.load();
                audio.pause();
            }else if(val == 3 && dd == 'yes'){
                is_pause = false;   
                if(playlist_now_played[song_id_playing+1] == undefined){
                    console.log('no next track');
                    song_id_playing = 0;
                }else{
                    song_id_playing = song_id_playing+1;
                }
                var id = playlist_now_played[song_id_playing]['id'];
                $.ajax({
                    type: "GET",
                    url: "https://api.vitasha.tk/music/getlinkbyid/"+usr_token+"/?id="+id,
                    dataType: 'text',
                    success: function(data){
                        try{
                            audio.load();
                            audio.currentTime = 0;
                            $('#player_song_moment').empty();
                            $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration+'" value="'+audio.currentTime+'" onchange="change_song_moment()">');
                            audio.ontimeupdate = function() {
                                $('#player_song_moment input').attr('value',audio.currentTime);
                            };
                        }catch{
                            //
                        }
                        var array = JSON.parse(data);
                        audio = new Audio(array['url']);
                        var val = $('#player_volume input').val();
                        audio.volume = val/100;
                        audio.play();
                        /*$('#controls_area').empty();
                        document.title = playlist[0]['name']+" | "+playlist[0]['author'];
                        $('#controls_area').append('<div id="cover_audio"><img src="'+playlist[0]['cover']+'" alt=""></div><span id="name_audio">'+playlist[0]['name']+'</span>'+'<span id="author_audio">'+playlist[0]['author']+'</span>');
                        $('#control_window_cover').empty();
                        $('#control_window_cover').append('<img src="'+playlist[0]['cover_xl']+'" alt="">');
                        */
                        $('#player_cover').empty();
                        $('#player_name').empty();
                        $('#player_author').empty();
                        $('#player_cover').html('<img src="'+playlist_now_played[song_id_playing]['cover_xl']+'" alt="cover">');
                        $('#player_name').html('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                        $('#player_author').html('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                        $('#player_closed_name').empty();
                        $('#player_closed_name').append('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                        $('#player_closed_author').empty();
                        $('#player_closed_author').append('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                        $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']);
                        /*$('#control_window_song').empty();
                        $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                        $('#control_window_add_to_playlist').empty();
                        $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                        $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                        $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                        */
                        audio.ontimeupdate = function() {
                            $('#player_song_moment input').attr('value',audio.currentTime);
                        };
                        audio.addEventListener('ended', (event) => {
                        next('no');
                        });
                    }
                })
            }
        }
        async function getlinkbyid(id){ //fully_first
            $('#player_closed').show();
            $('#player_closed_btn_play button').html('<img src="pause.png" alt="search">');
            $('#player_play_btn button').html('<img src="pause.png" alt="search">');
            is_pause = false;
            song_playing = true;
            playlist_now1 = playlist_now.slice();
            var num;
            for(let i=0; i < 999; i ++){
                num = i;
                if(playlist_now1[i]['id'] == id){
                    break;
                }
            }
            song_id_playing = num;
            try{
                audio.load();
                audio.currentTime = 0;
                $('#player_song_moment').empty();
                $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration+'" value="'+audio.currentTime+'" onchange="change_song_moment()">');
                audio.ontimeupdate = function() {
                    $('#player_song_moment input').attr('value',audio.currentTime);
                };
            }catch{
                console.log('no song was playing');
            }
            playlist_now_played = playlist_now;
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/getlinkbyid/"+usr_token+"/?id="+playlist_now_played[song_id_playing]['id'],
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    audio = new Audio(array['url']);
                    var val = $('#player_volume input').val();
                    audio.volume = val/100;
                    audio.play();
                    /*$('#controls_area').empty();
                    document.title = playlist[0]['name']+" | "+playlist[0]['author'];*/
                    $('#player_cover').html('<img src="'+playlist_now_played[song_id_playing]['cover_xl']+'" alt="cover">');
                    $('#player_name').html('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                    $('#player_author').html('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                    /*$('#control_window_cover').empty();
                    $('#control_window_cover').append('<img src="'+playlist[0]['cover_xl']+'" alt="">');
                    */$('#player_closed_name').empty();
                    $('#player_closed_name').append('<span>'+playlist_now_played[song_id_playing]['name']+'</span>');
                    $('#player_closed_author').empty();
                    $('#player_closed_author').append('<span>'+playlist_now_played[song_id_playing]['author']+'</span>');
                    $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']);
                    /*$('#control_window_song').empty();
                    $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                    $('#control_window_add_to_playlist').empty();
                    $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                    $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                    $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                    */
                    //<!-- repeat track/repeat playlist/no repeat -->
                    var val = getCookie('repeat');
                    if(val == 1){
                        $('#player_next_type_btn button').empty();
                        $('#player_next_type_btn button').html('repeat playlist');
                    }else if(val== 2){
                        $('#player_next_type_btn button').empty();
                        $('#player_next_type_btn button').html('repeat track');
                    }else if(val == 3){
                        $('#player_next_type_btn button').empty();
                        $('#player_next_type_btn button').html('no repeat');
                    }
                    $('#player_volume input').val(getCookie('volume'));
                    audio.volume = getCookie('volume')/100;
                    audio.ontimeupdate = function() {
                        $('#player_song_moment input').attr('value',audio.currentTime);
                    };
                    audio.addEventListener('ended', (event) => {
                    next('no');
                    });
                }
            })
        }
        function add_to_playlist(name, author, id, cover, cover_xl, explicit){
            if(explicit != false){explicit=1;}
            else{explicit=0;}
            var playlist_name = $('#control_window_playlist_name').val();
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/playlist_add_track/"+usr_token+"/?playlist_name="+playlist_name+"&name="+name+"&author="+author+"&id="+id+"&cover="+cover+"&cover_xl="+cover_xl+"&explicit="+explicit,
                dataType: 'text',
                success: function(data){
                    alert('Success');
                }
            })
        }
        function add_to_favorites(name, author, id, cover, cover_xl, explicit){
            if(explicit == 1){explicit=1;}
            else{explicit=0;}
            var playlist_name = "Favorites";
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/playlist_add_track/"+usr_token+"/?playlist_name="+playlist_name+"&name="+name+"&author="+author+"&id="+id+"&cover="+cover+"&cover_xl="+cover_xl+"&explicit="+explicit,
                dataType: 'text',
                success: function(data){
                    alert('Success');
                }
            })
        }
        async function search(){
            is_open_search = true;
            search_history_hide();
            var search = $("#search_field").val();
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/search/"+usr_token+"/?search="+search,
                dataType: 'text',
                /*
                success: function(data){
                    var array = JSON.parse(data);
                    $('main').empty();
                    playlist_new = [];
                    for(let i=0; i < array['songs'].length; i ++){
                        playlist_new[i] = array['songs'][i];
                        document.title = search;
                        const el = document.getElementById('scroll');
                        el.scrollIntoView();
                        var name = array['songs'][i]['name'];
                        name = name.substr(0, 25);
                        if(name !== array['songs'][i]['name']){
                            array['songs'][i]['name'] = name+" ...";
                        }
                        var author = array['songs'][i]['author'];
                        author = author.substr(0, 35);
                        if(author !== array['songs'][i]['author']){
                            array['songs'][i]['author'] = author+" ...";
                        }
                        //$('#songs').append('<div class="song"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt=""></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'</div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div><div class="play"><input type="submit" value="Play" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"></div></div>');
                        $('main').append('<div class="song" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt=""></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'</div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div></div>');
                        //$('#songs').append('<div class="song"><img id="cover" src="'+array['songs'][i]['cover']+'" alt="cover"><p>'+array['songs'][i]['name']+explicit(array['songs'][i]['explicit'])+"<br>"+array['songs'][i]['author']+'</p>'+'<input class="song_id" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')" value="Play"></div>');
                    }
                }*/
                success: function(data){/*
                    var array = JSON.parse(data);
                    $('#home_news_div').empty();
                    for(let i=0; i < array['songs'].length; i ++){
                        playlist_now[i] = array['songs'][i];
                        //document.title = 'Music';
                        //const el = document.getElementById('scroll');
                        //el.scrollIntoView();
                        //Манипуляции с name и author
                        array['songs'][i]['name'] = short_name(array['songs'][i]['name']);
                        array['songs'][i]['author'] = short_author(array['songs'][i]['author']);
                        $('#home_news_div').append('<div class="song" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt="cover"></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'</div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div></div>');
                    }
                    playlist_home_news = playlist_now;
                    */
                    var playlist_now1 = [];
                    var array = JSON.parse(data);
                    $('#home_news_div').empty();
                    for(let i=0; i < array['songs'].length; i ++){
                        playlist_now1[i] = array['songs'][i];
                        //document.title = 'Music';
                        //const el = document.getElementById('scroll');
                        //el.scrollIntoView();
                        //Манипуляции с name и author
                        array['songs'][i]['name'] = short_name(array['songs'][i]['name']);
                        array['songs'][i]['author'] = short_author(array['songs'][i]['author']);
                        $('#home_news_div').append('<div class="song" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt="cover"></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'</div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div></div>');
                    }
                    playlist_now = playlist_now1.slice();
                    console.log(playlist_now);
                }
                
            })
        }
        async function my(){
            is_open_playlist = false;
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/playlists_get/"+usr_token+"/",
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    $('#my_main').empty();
                    $('#my_playlist_opened_name span').html('All playlists:');
                    if(array['playlists'] == null){
                        $('#my_main').append('<h3>Nothing to watch!</br>Добавьте что-то в понравившееся:</br>При открытии трека на полный экран есть кнопка</br>Add to favorites<br>Не забудь нажать Refresh!</h3>');
                    }else{
                        for(let i=0; i < array['playlists'].length; i ++){
                            $('#my_main').append('<div class="playlist_name" onclick="playlist_open(\''+array['playlists'][i]['playlist_name']+'\')"><span>'+array['playlists'][i]['playlist_name']+'</span></div>');
                        }
                    }
                }
            })
        }
        function playlist_open(name_1){
            is_open_playlist = name_1;
            playlist_now = [];
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/playlist_get_tracks/"+usr_token+"/?playlist_name="+name_1,
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    $('#my_main').empty();
                    $('#my_playlist_opened_name span').html('Playlist: '+name_1);
                    document.title = 'Playlist: '+name_1;
                    for(let i=0; i < array['songs'].length; i ++){
                        playlist_now[i] = array['songs'][i];
                        //document.title = 'Music';
                        //const el = document.getElementById('scroll');
                        //el.scrollIntoView();
                        //Манипуляции с name и author
                        array['songs'][i]['name'] = short_name(array['songs'][i]['name']);
                        array['songs'][i]['author'] = short_author(array['songs'][i]['author']);
                        $('#my_main').append('<div class="song" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt="cover"></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'<div class="del_song_from_playlist_btn" onclick="del_song_from_playlist(\''+name_1+'\',\''+array['songs'][i]['id']+'\');">X</div></div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div></div>');
                    }
                    open_playlist = playlist_now;
                    $(".del_song_from_playlist_btn").on("click", function(ev){
                        ev.stopPropagation();
                    });
                }
            })
        }
        function del_song_from_playlist(playlist_name, song_id){
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/playlist_del_track/"+usr_token+"/?playlist_name="+playlist_name+"&song_id="+song_id,
                dataType: 'text',
                success: function(data){
                    playlist_open(playlist_name);
                }
            })
        }
        function control_window(){
            $('#control_window').toggle();
        }
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
    </script>
</body>
</html>