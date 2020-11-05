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
setInterval(() =>  {
    try{
        $('#player_song_moment input').attr('value',audio.currentTime*10);
    }catch(e){
        //
    }
}, 500);
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
var usr_token = getCookie('token');
if(getCookie('volume') == ""){
    setCookie('volume',100);
}
if(getCookie('repeat') == ""){
    setCookie('repeat',1);
}
function is_in_favorites(){
    $.ajax({
        type: "GET",
        url: "https://api.vitasha.tk/music/is_in_favorites/"+usr_token+"/?playlist_name=Favorites&id="+playlist_now_played[song_id_playing]['id'],
        dataType: 'text',
        success: function(data){
            var array = JSON.parse(data);
            if(array['is_in_favorites']){
                $('#player_add_to_favorites').html('<span onclick="player_del_from_favorites();">Added to <img src="assets/images/favorites.png" alt="">!</span>')
            }else{
                $('#player_add_to_favorites').html('<span onclick="player_add_to_favorites();">Add to <img src="assets/images/favorites.png" alt="">?</span>')
            }
        }
    })
}
async function player_add_to_favorites(){
    $.ajax({
        type: "GET",
        url: "https://api.vitasha.tk/music/playlist_add_track/"+usr_token+"/?playlist_name=Favorites&json="+encodeURIComponent(JSON.stringify(playlist_now_played[song_id_playing])),
        dataType: 'text',
        success: function(data){
            $('#player_add_to_favorites').html('<span onclick="player_del_from_favorites();">Added to <img src="assets/images/favorites.png" alt="">!</span>')
        }
    })
}
async function player_del_from_favorites(){
    $.ajax({
        type: "GET",
        url: "https://api.vitasha.tk/music/playlist_del_track/"+usr_token+"/?playlist_name=Favorites&song_id="+playlist_now_played[song_id_playing]['id'],
        dataType: 'text',
        success: function(data){
            $('#player_add_to_favorites').html('<span onclick="player_add_to_favorites();">Add to <img src="assets/images/favorites.png" alt="">?</span>')
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
        //const el = document.getElementById('scroll');
        //el.scrollIntoView();
        //Манипуляции с name и author
        playlist_home_news[i]['name'] = short_name(playlist_home_news[i]['name']);
        playlist_home_news[i]['author'] = short_author(playlist_home_news[i]['author']);
        $('#home_news_div').append('<div class="song" onclick="getlinkbyid(\''+playlist_home_news[i]['id']+'\')"><div class="cover"><img src="'+playlist_home_news[i]['cover']+'" alt="cover"></div><div class="song_name"><span>'+playlist_home_news[i]['name']+'</span>'+explicit(playlist_home_news[i]['explicit'])+'</div><div class="song_author"><span>'+playlist_home_news[i]['author']+'</span></div></div>');
    }
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
    window.location.replace('login');
}
function change_song_volume(){
    var val = $('#player_volume input').val();
    setCookie('volume',val);
    audio.volume = val/100;
}
function change_song_moment(){
    audio.currentTime = $('#player_song_moment input').val()/10;
    $('#player_song_moment').empty();
    $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration*10+'" value="'+audio.currentTime*10+'" onchange="change_song_moment()">');
    audio.ontimeupdate = function() {
        $('#player_song_moment input').attr('value',audio.currentTime*10);
    };
}
function player(){
    $('#player').toggle();
}
function explicit(e){ //служебное fully
    if(e){
        return "<img class='explicit' src='assets/images/explicit.png' alt='e'>";
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
    $('#home').show();
    $('#my').hide();
    $('#settings').hide();
}
function open_my(){ //full
    set_playlist_now('my');
    $('#home').hide();
    $('#my').show();
    $('#settings').hide();
}
function open_settings(){ //full
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
        $('#player_closed_btn_play button').html('<img src="assets/images/pause.png" alt="search">');
        $('#player_play_btn button').html('<img src="assets/images/pause.png" alt="search">');
        is_pause = false;
    }else{
        audio.pause();
        $('#player_closed_btn_play button').html('<img src="assets/images/play.png" alt="search">');
        $('#player_play_btn button').html('<img src="assets/images/play.png" alt="search">');
        is_pause = true;
    }
}
async function prev(){
    $('#player_closed_btn_play button').html('<img src="assets/images/" alt="search">');
    $('#player_play_btn button').html('<img src="assets/images/pause.png" alt="search">');
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
                    $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration*10+'" value="'+audio.currentTime*10+'" onchange="change_song_moment()">');
                    audio.ontimeupdate = function() {
                        $('#player_song_moment input').attr('value',audio.currentTime*10);
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
                $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']*10);
                document.title = playlist_now_played[song_id_playing]['name']+" | "+playlist_now_played[song_id_playing]['author'];
                is_in_favorites();
                /*$('#control_window_song').empty();
                $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                $('#control_window_add_to_playlist').empty();
                $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                */
                audio.ontimeupdate = function() {
                    $('#player_song_moment input').attr('value',audio.currentTime*10);
                };
                audio.addEventListener('ended', (event) => {
                next('no');
                });
            }
        })
    }
    
}
async function next(dd){
    $('#player_closed_btn_play button').html('<img src="assets/images/pause.png" alt="search">');
    $('#player_play_btn button').html('<img src="assets/images/pause.png" alt="search">');
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
                    $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration*10+'" value="'+audio.currentTime*10+'" onchange="change_song_moment()">');
                    audio.ontimeupdate = function() {
                        $('#player_song_moment input').attr('value',audio.currentTime*10);
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
                $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']*10);
                document.title = playlist_now_played[song_id_playing]['name']+" | "+playlist_now_played[song_id_playing]['author'];
                is_in_favorites();
                /*$('#control_window_song').empty();
                $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                $('#control_window_add_to_playlist').empty();
                $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                */
                audio.ontimeupdate = function() {
                    $('#player_song_moment input').attr('value',audio.currentTime*10);
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
            $('#player_song_moment input').attr('value',audio.currentTime*10);
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
                    $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration*10+'" value="'+audio.currentTime*10+'" onchange="change_song_moment()">');
                    audio.ontimeupdate = function() {
                        $('#player_song_moment input').attr('value',audio.currentTime*10);
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
                $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']*10);
                document.title = playlist_now_played[song_id_playing]['name']+" | "+playlist_now_played[song_id_playing]['author'];
                is_in_favorites();
                /*$('#control_window_song').empty();
                $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                $('#control_window_add_to_playlist').empty();
                $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                */
                audio.ontimeupdate = function() {
                    $('#player_song_moment input').attr('value',audio.currentTime*10);
                };
                audio.addEventListener('ended', (event) => {
                next('no');
                });
            }
        })
    }else if(val == 3 && dd == 'no'){
        audio.load();
        audio.pause();
        document.title = "Vitasha Music";
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
                    $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration*10+'" value="'+audio.currentTime*10+'" onchange="change_song_moment()">');
                    audio.ontimeupdate = function() {
                        $('#player_song_moment input').attr('value',audio.currentTime*10);
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
                $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']*10);
                document.title = playlist_now_played[song_id_playing]['name']+" | "+playlist_now_played[song_id_playing]['author'];
                is_in_favorites();
                /*$('#control_window_song').empty();
                $('#control_window_song').append('<audio src="'+array['url']+'" controls autoplay onended="next()"></audio>');
                $('#control_window_add_to_playlist').empty();
                $('#control_window_add_to_playlist').append('<input id="control_window_playlist_name" type="text" placeholder="Название плейлиста">');
                $('#control_window_add_to_playlist').append('<button onclick="add_to_playlist(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add</button>');
                $('#control_window_add_to_playlist').append('<button onclick="add_to_favorites(\''+playlist[0]['name']+'\', \''+playlist[0]['author']+'\', \''+playlist[0]['id']+'\', \''+playlist[0]['cover']+'\', \''+playlist[0]['cover_xl']+'\', \''+playlist[0]['explicit']+'\')">Add to favorites</button>');
                */
                audio.ontimeupdate = function() {
                    $('#player_song_moment input').attr('value',audio.currentTime*10);
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
    $('#player_closed_btn_play button').html('<img src="assets/images/pause.png" alt="search">');
    $('#player_play_btn button').html('<img src="assets/images/pause.png" alt="search">');
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
        $('#player_song_moment').append('<label for="player_song_moment_input">Песня</label><br><input id="player_song_moment_input" type="range" min="0" max="'+audio.duration*10+'" value="'+audio.currentTime*10+'" onchange="change_song_moment()">');
        audio.ontimeupdate = function() {
            $('#player_song_moment input').attr('value',audio.currentTime*10);
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
            $('#player_song_moment input').attr('max',playlist_now_played[song_id_playing]['duration']*10);
            document.title = playlist_now_played[song_id_playing]['name']+" | "+playlist_now_played[song_id_playing]['author'];
            is_in_favorites();
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
                $('#player_song_moment input').attr('value',audio.currentTime*10);
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
    var search = $("#search_field").val();
    if(search !== ""){
        is_open_search = true;
        search_history_hide();
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
    }else{
        search_history_show();
    }
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
            //document.title = 'Playlist: '+name_1;
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