var initPlayer = function($rootScope){
    $rootScope.player = $('#player');
    $rootScope.playerNode = $('#player').get(0);
    $rootScope.playerPlayed = false;
    $rootScope.playerMuted = false;
    $rootScope.playerImage = '';
    $rootScope.playerName = '';
    $rootScope.playerSrc = '';

    $rootScope.play = function($event){
        $rootScope.playerName = $($event.currentTarget).data('name');
        $rootScope.playerImage = $($event.currentTarget).data('image');
        $rootScope.playerSrc = $($event.currentTarget).data('lissen');
        $rootScope.player.attr('src', $($event.currentTarget).data('lissen'));
        $rootScope.playerNode.play();
        $rootScope.playerPlayed = true;
    }
    $rootScope.eventPlayPause = function(){
        if($rootScope.playerPlayed){
            $rootScope.playerNode.pause();
            $rootScope.playerPlayed = false;
        } else {
            $rootScope.playerNode.play();
            $rootScope.playerPlayed = true;
        }
    }

    $rootScope.eventMuteOnOff = function(){
        if($rootScope.playerMuted){
            $rootScope.playerNode.muted = false;
            $rootScope.playerMuted = false;
        } else {
            $rootScope.playerNode.muted = true;
            $rootScope.playerMuted = true;
        }
    }
}