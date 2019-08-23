function initProgressBar() {
  var player = document.getElementById('player');
  var length = player.duration
  var current_time = player.currentTime;

  // calculate total length of value
  var totalLength = calculateTotalValue(length)
  document.getElementById("end-time").innerHTML = totalLength;

  // calculate current value time
  var currentTime = calculateCurrentValue(current_time);
  document.getElementById("start-time").innerHTML = currentTime;

  var progressbar = document.getElementById('seek-obj');
  progressbar.value = (player.currentTime / player.duration);
  progressbar.addEventListener("click", seek);

  if (player.currentTime == player.duration) {
    document.getElementById('play-btn').className = "";
  }

  function seek(event) {
    var percent = event.offsetX / this.offsetWidth;
    player.currentTime = percent * player.duration;
    progressbar.value = percent / 100;
  }
};

// function initPlayers(num) {
//   // pass num in if there are multiple audio players e.g 'player' + i

//   for (var i = 0; i < num; i++) {
//     (function() {

//       // Variables
//       // ----------------------------------------------------------
//       // audio embed object
//       var playerContainer = document.getElementById('player-container'),
//         player = document.getElementById('player'),
//         isPlaying = false,
//         playBtn = document.getElementById('play-btn');

//       // Controls Listeners
//       // ----------------------------------------------------------
//       if (playBtn != null) {
//         playBtn.addEventListener('click', function() {
//           togglePlay()
//         });
//       }

//       // Controls & Sounds Methods
//       // ----------------------------------------------------------
//       function togglePlay() {
//         if (player.paused === false) {
//           player.pause();
//           isPlaying = false;
//           document.getElementById('play-btn').className = "";

//         } else {
//           player.play();
//           document.getElementById('play-btn').className = "pause";
//           isPlaying = true;
//         }
//       }
//     }());
//   }
// }

function calculateTotalValue(length) {
  var minutes = Math.floor(length / 60),
    seconds_int = length - minutes * 60,
    seconds_str = seconds_int.toString(),
    seconds = seconds_str.substr(0, 2),
    time = minutes + ':' + seconds

  return time;
}

function calculateCurrentValue(currentTime) {
  var current_hour = parseInt(currentTime / 3600) % 24,
    current_minute = parseInt(currentTime / 60) % 60,
    current_seconds_long = currentTime % 60,
    current_seconds = current_seconds_long.toFixed(),
    current_time = (current_minute < 10 ? "0" + current_minute : current_minute) + ":" + (current_seconds < 10 ? "0" + current_seconds : current_seconds);

  return current_time;
}

// initPlayers(jQuery('#player-container').length);

(function($){
	$('.audio-player').each(function(){

      // Variables
      // ----------------------------------------------------------
      // audio embed object
      var audioPlayer = $(this);
      var playerContainer = audioPlayer.find('.player-container'),
        player = audioPlayer.find('.player'),
        isPlaying = false,
        playBtn = audioPlayer.find('.play-btn');

      // Controls Listeners
      // ----------------------------------------------------------
      playBtn.on('click', function() {
        togglePlay()
      });

		  var length = player[0].duration
		  var current_time = player[0].currentTime;

		  // calculate total length of value
		  var totalLength = calculateTotalValue(length)
		  audioPlayer.find('.end-time').text(totalLength);


      player.on('timeupdate', function(){
			  var length = player[0].duration
			  var current_time = player[0].currentTime;

			  // calculate total length of value
			  var totalLength = calculateTotalValue(length)
			  audioPlayer.find('.end-time').text(totalLength);

			  // calculate current value time
			  var currentTime = calculateCurrentValue(current_time);
			  audioPlayer.find('.start-time').text(currentTime);

			  var progressbar = audioPlayer.find('.seek-obj');
			  progressbar[0].value = (player[0].currentTime / player[0].duration);
			  progressbar.on("click", seek);

			  if (player[0].currentTime == player[0].duration) {
			    playBtn.removeClass('pause');
			  }

			  function seek(event) {
			    var percent = event.offsetX / this.offsetWidth;
			    player[0].currentTime = percent * player[0].duration;
			    progressbar[0].value = percent / 100;
			  }


      })
      // Controls & Sounds Methods
      // ----------------------------------------------------------
      function togglePlay() {
        if (player[0].paused === false) {
          player[0].pause();
          isPlaying = false;
          audioPlayer.addClass('pausing').removeClass('playing');
        } else {
        	if($('.audio-player.playing').length){
        		$('.audio-player.playing').find('.play-btn').trigger('click')
        	}
          player[0].play();
          audioPlayer.addClass('playing').removeClass('pausing');
          isPlaying = true;
        }
      }

	})

})(jQuery);
