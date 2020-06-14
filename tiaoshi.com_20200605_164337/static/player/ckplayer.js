document.write('<script type="text/javascript" src="'+ maccms.path +'/static/player/ckplayerx/ckplayer.js"></script>');
MacPlayer.Html = '';
MacPlayer.Show();

setTimeout(function(){
    var video = [
        [
            MacPlayer.PlayUrl,
            "video/mp4"
        ],
        [
            MacPlayer.PlayUrl,
            "video/m3u8",
        ],
        [
            MacPlayer.PlayUrl,
            "video/ogg",
        ],
        [
            MacPlayer.PlayUrl,
            "video/webm",
        ]
    ];

    var videoObject = {
        container: '#playleft', //容器的ID或className
        variable: 'player',//播放函数名称
        autoplay:true,
        video:MacPlayer.PlayUrl
    };
    var player = new ckplayer(videoObject);

}, MacPlayer.Second * 1000 - 1000);





