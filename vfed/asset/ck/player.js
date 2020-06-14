var vfed = {
	'player': {
		'loaded': function() {
			player.addListener('loadedmetadata', ckdata);
			player.addListener('time', cktime);
			player.addListener('ended', ckended);
		},
		'cplayer': function(auto, live, trys, seek, take, urls, jump, logo, pics) {
			var seek = vfed.cookie.get(take) && live == false ? vfed.cookie.get(take) : seek;
			player.newVideo({
				loaded: 'vfed.player.loaded',
				container: '#video',
				variable: 'player',
				flashplayer: true,
				autoplay: auto,
				poster: pics,
				video: urls,
				live: live,
				seek: seek
			});
		},
		'aplayer': function(auto, live, trys, seek, take, urls, jump, logo, pics) {
			var player = new Aliplayer({
				useFlashPrism: true,
				autoplay: auto,
				isLive: live,
				source: urls,
				id: 'video'
			});
			player.on('ended', function() {
				if(jump) top.location.href = jump;
			});
		},
		'eplayer': function(auto, live, trys, seek, take, urls, jump, logo, pics) {
			var type = urls.indexOf('.m3u8') > -1 ? 'customHls' : 'auto';
			var player = new DPlayer({
				container: document.getElementById('video'),
				autoplay: auto,
				live: live,
				logo: logo,
				video: {
					url: urls,
					type: type,
					pic: pics,
					customType: {
						'customHls': function(video, player) {
							var hls = new Hls();
							hls.loadSource(video.src);
							hls.attachMedia(video);
							var engine = new P2PEngine(hls, {
								maxBufSize: {
									'pc': 1024 * 1024 * 512,
									'mobile': 1024 * 1024 * 256
								}
							});
							engine.on('peerId', function(peerId) {
								$('.load').text('加载0MB 共享0MB 加速0MB');
								$('.peer').text('P2P已开启');
								$('.line').text('在线1NP');
							});
							engine.on('peers', function(peers) {
								$('.line').text('在线' + (peers.length + 1) + 'NP');
								$('.peer').text('P2P已开启');
							});
							engine.on('stats', function(data) {
								$('.load').text('加载' + (data.totalHTTPDownloaded / 1024).toFixed(2) + 'MB 共享' + (data.totalP2PUploaded / 1024).toFixed(2) + 'MB 加速' + (data.totalP2PDownloaded / 1024).toFixed(2) + 'MB');
								data.totalP2PDownloaded ? $('.peer').text('P2P加速中') : $('.peer').text('P2P已开启');
							});
						}
					}
				}
			});
			player.on('loadstart', function() {
				$('video').attr('playsinline', 'true');
				$('video').attr('x5-playsinline', 'true');
				$('video').attr('webkit-playsinline', 'true');
				if(player.video.paused) $('.play').show();
			});
			player.on('loadeddata', function() {
				if(vfed.cookie.get(take) && live == false)
					if(player.video.duration - vfed.cookie.get(take) < 60) player.seek(seek);
					else player.seek(vfed.cookie.get(take));
				else player.seek(seek);
				player.on('timeupdate', function() {
					if(take && live == false) vfed.cookie.set(take, player.video.currentTime, 30);
					if(trys != 0 && player.video.currentTime > trys) player.seek(0);
				});
			});
			player.on('ended', function() {
				if(jump) top.location.href = jump;
			});
			player.on('pause', function() {
				$('.play').show();
			});
			player.on('play', function() {
				$('.play').hide();
			});
			$('.play').click(function() {
				player.play();
			});
			player.on('error', function() {
				vfed.player.dplayer(auto, live, trys, seek, take, urls, jump, logo, pics);
			});
		},
		'dplayer': function(auto, live, trys, seek, take, urls, jump, logo, pics) {
			var player = new DPlayer({
				container: document.getElementById('video'),
				autoplay: auto,
				live: live,
				logo: logo,
				video: {
					url: urls,
					pic: pics
				}
			});
			player.on('loadstart', function() {
				$('video').attr('playsinline', 'true');
				$('video').attr('x5-playsinline', 'true');
				$('video').attr('webkit-playsinline', 'true');
				if(player.video.paused) $('.play').show();
			});
			player.on('loadeddata', function() {
				if(vfed.cookie.get(take) && live == false)
					if(player.video.duration - vfed.cookie.get(take) < 60) player.seek(seek);
					else player.seek(vfed.cookie.get(take));
				player.on('timeupdate', function() {
					if(take && live == false) vfed.cookie.set(take, player.video.currentTime, 30);
					if(trys != 0 && player.video.currentTime > trys) player.seek(0);
				});
			});
			player.on('ended', function() {
				if(jump) top.location.href = jump;
			});
			player.on('pause', function() {
				$('.play').show();
			});
			player.on('play', function() {
				$('.play').hide();
			});
			$('.play').click(function() {
				player.play();
			});
		}
	},
	'cookie': {
		'set': function(name, value, days) {
			var exp = new Date();
			exp.setTime(exp.getTime() + days * 24 * 60 * 60 * 1000);
			var arr = document.cookie.match(new RegExp('(^| )' + name + '=([^;]*)(;|$)'));
			document.cookie = name + '=' + escape(value) + ';path=/;expires=' + exp.toUTCString();
		},
		'get': function(name) {
			var arr = document.cookie.match(new RegExp('(^| )' + name + '=([^;]*)(;|$)'));
			if(arr != null) return unescape(arr[2]);
		},
		'put': function(urls) {
			var cookie = urls.replace(/[^a-z]+/ig, '');
			var cookie = cookie.substring(cookie.length - 32);
			return cookie;
		}
	}
};

function ckdata() {
	$('video').attr('playsinline', 'true');
	$('video').attr('x5-playsinline', 'true');
	$('video').attr('webkit-playsinline', 'true');
	var metadata = player.getMetaDate();
	if(metadata['duration'] - vfed.cookie.get(play.take) < 60) player.videoSeek(0);
}

function cktime(time) {
	if(play.take) vfed.cookie.set(play.take, time, 30);
	if(play.trys != 0 && time > play.trys) player.videoSeek(0);
}

function ckended() {
	if(jump) top.location.href = jump;
}