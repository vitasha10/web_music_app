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
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"><title>XIVS</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }
        header{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 7vh;
            background-color: #161618;
        }
        #controls_area{
            position: fixed;
            bottom: 7vh;
            left: 0;
            width: 100%;
            height: 7vh;
            color: white;
            background-color: #27272c;
        }
        audio{
            width: 60%;
            color: white;
            background-color: #27272c;
        }
        main{
            position: fixed;
            width: 100%;
            height: 79vh;
            top: 7vh;
            overflow: auto;
            background-color: #161618;
        }
        #control_window{
            position: fixed;
            width: 100%;
            height: 93vh;
            top: 0;
            overflow: auto;
            background-color: #161618;
            z-index: 5;
            display: none;
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
        #controls_span{
            display: block;
            text-align: center;
            line-height: 7vh;
            font-size: 3vh;
            background-color: #27272c;
            color: white;
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
        #news_btn{
            display:block;
            float:left;
            width: 12vw;
            height: 6vh;
            color: white;
            background-color: #27272c;
            border: solid #27272c 1px;
            border-radius: 3px;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
        }
        .search_area{
            display:block;
            float:left;
            width: 72vw;
            height: 6vh;
            background-color: #27272c;
            border: solid #27272c 1px;
            text-align: center;
            color: white;
            border-radius: 3px;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
            z-index:6;
        }
        #search_area{
            width: 70vw;
            height: 5vh;
            background-color: #27272c;
            border: solid #27272c 1px;
            text-align: center;
            color: white;
            border-radius: 3px;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
        }
        #search_btn{
            display:block;
            float:left;
            width: 12vw;
            height: 6vh;
            background-color: #27272c;
            color: white;
            border: solid #27272c 1px;
            border-radius: 3px;
            margin: 0.5vh 0.5vw 0.5vh 0.5vw;
        }
        #search_btn img{
            width: 6vh;
            max-width: 12vw;
            height: 6vh;
            max-height: 12vw;
            display: block;
            margin: 0 auto;
        }
        #cover_audio{
            width: 7vh;
            height: 7vh;
            display:block;
            float:left;
            color: white;
            background-color: #27272c;
        }
        #cover_audio img{
            width: 6vh;
            height: 6vh;
            display:block;
            margin: 0.5vh;
            border-radius: 20%;
        }
        #name_audio{
            height: 3.5vh;
            display:block;
            font-size: 2vh;
            line-height: 3.5vh;
            color: white;
            background-color: #27272c;
        }
        #author_audio{
            height: 3.5vh;
            display:block;
            font-size: 1.5vh;
            line-height: 3.5vh;
            color: white;
            background-color: #27272c;
        }
        #footer_btns{
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 7vh;
            color: white;
            background-color: #27272c;
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
        #close_control_window{
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
        #control_window_cover{
            display: block;
            height: 80vw;
            max-height: 40vh;
            width: 80vw;
            max-width: 40vh;
            margin: 3vh auto;

        }
        #control_window_cover img{
            height: 80vw;
            max-height: 40vh;
            width: 80vw;
            max-width: 40vh;
        }
        #control_window_name{
            height: 3.5vh;
            display:block;
        }
        #control_window_name span{
            display: block;
            text-align: center;
            color: white;
            width: 100%;
        }
        #control_window_author{
            height: 3.5vh;
            display:block;
        }
        #control_window_author span{
            display: block;
            text-align: center;
            color: white;
            width: 100%;
        }
        #control_window_song audio{
            width: 100%;
            display: block;
            margin: 5vh auto;
        }
        #control_window_add_to_playlist{
            width: 100%;
            display: block;
            margin: 5vh auto;
            text-align: center;
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
            width: 100%;
            color: white;
            line-height: 4vh;
            padding-left: 3vh;
        }
        #settings{
            position: fixed;
            width: 100%;
            height: 93vh;
            overflow: auto;
            top: 0;
            z-index: 10;
            display: none;
            background-color: #27272c;
        }
        #my{
            position: fixed;
            width: 100%;
            height: 86vh;
            overflow: auto;
            top: 0;
            z-index: 3;
            display: none;
            background-color: #27272c;
        }
        .playlist_name{
            display: block;
            height: 4vh;
            font-size: 2vh;
            color: white;
            line-height: 4vh;
            padding-left: 3vh;
        }
        h3{
            display: block;
            height: 10vh;
            font-size: 5vh;
            color: white;
            line-height: 10vh;
            padding-left: 3vh;
        }
        #control_window_add_to_favorites{

        }
    </style>
</head>
<body>
    <header>
        <button id="news_btn" onclick="news()">News</button>
        <div class="search_area">
            <input id="search_area" onfocus="search_history_show()" placeholder="Search">
        </div>
        <button id="search_btn" onclick="search()"><img src="search.svg" alt="search"></button>
    </header>
    <div id="settings">
        <h3>NOTHING</h3>
    </div>
    <div id="my">
        
    </div>
    <div id="control_window">
        <button id="close_control_window" onclick="control_window()">X</button>
        <div id="control_window_cover">
        
        </div>
        <div id="control_window_name">
        
        </div>
        <div id="control_window_author">
        
        </div>
        <div id="control_window_song">
        
        </div>
        <div id="control_window_add_to_playlist">

        </div>
    </div>
    <div id="search_history_back" onclick="search_history_hide()">
        <div id="search_history">
            
        </div>
    </div>
    <main id="scroll">
    
    </main>
    <div id="controls_area" onclick="if(song_playing){control_window();}">
        <span id="controls_span">Запустите любую песню</span>
    </div>
    <div id="footer_btns">
        <div class="footer_btn" onclick="home_show()">
        HOME
        </div>
        <div class="footer_btn" onclick="my_show()">
        MY
        </div>
        <div class="footer_btn" onclick="settings_show()">
        SETTINGS
        </div>
    </div>
    <script>
        var usr_token = "<?php echo $_COOKIE['token'];?>";
        var song_playing = false;
        var playlist = [];
        var playlist_new = [];
        function explicit(e){
            if(e){
                return "<img class='explicit' src='explicit.png' alt='e'>";
            }else{
                return "";
            }
        }
        function home_show(){
            news();
            $('#settings').hide();
            $('#my').hide();
        }  
        function settings_show(){
            $('#settings').show();
            $('#my').hide();
        }
        function settings_hide(){
            $('#settings').hide();
        }
        function my_show(){
            my();
            $('#my').show();
            $('#settings').hide();
            $('#control_window').hide();
        }
        function my_hide(){
            $('#my').hide();
        }
        function search_field(text){
            $('#search_area').val(text);
            search();
        }
        function song_playing(){

        }
        function search_history_show(){
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/search_history/"+usr_token+"/",
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    //$('#search_history').empty();
                    for(let i=0; i < array['search_history'].length; i ++){
                        $('#search_history').append('<div onclick="search_field(\''+array['search_history'][i]['search']+'\')" id="search_a">&#8226; '+array['search_history'][i]['search']+'</div>');
                    }
                    //$('main').append('<div class="song" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt=""></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'</div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div></div>');
                    $('#search_history').show();
                    $('#search_history_back').show();
                }
            })
        }
        function search_history_hide(){
            $('#search_history').hide();
            $('#search_history').empty();
            $('#search_history_back').hide();
        }
        async function next(){
            var id = playlist[1]['id'];
            playlist = playlist.slice(1);
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/getlinkbyid/"+usr_token+"/?id="+id,
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    $('#controls_area').empty();
                    document.title = playlist[0]['name']+" | "+playlist[0]['author'];
                    $('#controls_area').append('<div id="cover_audio"><img src="'+playlist[0]['cover']+'" alt=""></div><span id="name_audio">'+playlist[0]['name']+'</span>'+'<span id="author_audio">'+playlist[0]['author']+'</span>');
                    $('#control_window_cover').empty();
                    $('#control_window_cover').append('<img src="'+playlist[0]['cover_xl']+'" alt="">');
                    $('#control_window_name').empty();
                    $('#control_window_name').append('<span>'+playlist[0]['name']+'</span>');
                    $('#control_window_author').empty();
                    $('#control_window_author').append('<span>'+playlist[0]['author']+'</span>');
                    $('#control_window_song').empty();
                    $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                    $('#control_window_add_to_playlist').empty();
                    $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                    $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                    $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                }
            })
        }
        async function getlinkbyid(id){
            song_playing = true;
            playlist_new1 = playlist_new.slice();
            var num;
            for(let i=0; i < 999; i ++){
                num = i;
                if(playlist_new1[i]['id'] == id){
                    break;
                }
            }
            playlist_new1.splice(0, num);
            playlist = playlist_new1;
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/getlinkbyid/"+usr_token+"/?id="+id,
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    $('#controls_area').empty();
                    document.title = playlist[0]['name']+" | "+playlist[0]['author'];
                    $('#controls_area').append('<div id="cover_audio"><img src="'+playlist[0]['cover']+'" alt=""></div><span id="name_audio">'+playlist[0]['name']+'</span>'+'<span id="author_audio">'+playlist[0]['author']+'</span>');
                    $('#control_window_cover').empty();
                    $('#control_window_cover').append('<img src="'+playlist[0]['cover_xl']+'" alt="">');
                    $('#control_window_name').empty();
                    $('#control_window_name').append('<span>'+playlist[0]['name']+'</span>');
                    $('#control_window_author').empty();
                    $('#control_window_author').append('<span>'+playlist[0]['author']+'</span>');
                    $('#control_window_song').empty();
                    $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                    $('#control_window_add_to_playlist').empty();
                    $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                    $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                    $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
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
            var search = $("#search_area").val();
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/search/"+usr_token+"/?search="+search,
                dataType: 'text',
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
                }
            })
        }
        async function news(){
            var search = $("#search_area").val();
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/news/"+usr_token+"/",
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    $('main').empty();
                    playlist_new = [];
                    for(let i=0; i < array['songs'].length; i ++){
                        playlist_new[i] = array['songs'][i];
                        document.title = 'XIVS';
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
                        //$('#songs').append('<div class="song"><img id="cover" src="'+array['songs'][i]['cover']+'" alt="cover"><span class="song_name">'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+"<br>"+'<span class="song_author">'+array['songs'][i]['author']+'</span>'+'<input class="song_id" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')" value="Play"></div>');
                        $('main').append('<div class="song" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt=""></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'</div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div></div>');
                    }
                }
            })
        }
        async function my(){
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/playlists_get/"+usr_token+"/",
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    $('#my').empty();
                    $('#my').append('<h3>Playlists: </h3>');
                    for(let i=0; i < array['playlists'].length; i ++){
                        document.title = 'MY';
                        $('#my').append('<div class="playlist_name" onclick="playlist_open(\''+array['playlists'][i]['playlist_name']+'\')"><span>'+array['playlists'][i]['playlist_name']+'</span></div>');
                    }
                }
            })
        }
        function playlist_open(name_1){
            $.ajax({
                type: "GET",
                url: "https://api.vitasha.tk/music/playlist_get_tracks/"+usr_token+"/?playlist_name="+name_1,
                dataType: 'text',
                success: function(data){
                    var array = JSON.parse(data);
                    $('#my').empty();
                    $('#my').append('<h3>Playlist '+name_1+': </h3>');
                    playlist_new = [];
                    for(let i=0; i < array['songs'].length; i ++){
                        playlist_new[i] = array['songs'][i];
                        document.title = 'Playlist '+name_1;
                        //const el = document.getElementById('scroll');
                        //el.scrollIntoView();
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
                        $('#my').append('<div class="song" onclick="getlinkbyid(\''+array['songs'][i]['id']+'\')"><div class="cover"><img src="'+array['songs'][i]['cover']+'" alt=""></div><div class="song_name"><span>'+array['songs'][i]['name']+'</span>'+explicit(array['songs'][i]['explicit'])+'</div><div class="song_author"><span>'+array['songs'][i]['author']+'</span></div></div>');
                    }
                    /*for(let i=0; i < array['playlists'].length; i ++){
                        document.title = 'MY';
                        $('#my').append('<div class="playlist_name" onclick="playlist_open(\''+array['playlists'][i]['playlist_name']+'\')"><span>'+array['playlists'][i]['playlist_name']+'</span></div>');
                    }*/
                }
            })
        }
        function control_window(){
            $('#control_window').toggle();
        }
        news();
        $("#search_area").keyup(function(event){
            if(event.keyCode == 13){
                event.preventDefault();
                search_history_hide();
                search();
            }
        });

    </script>
</body>
</html>