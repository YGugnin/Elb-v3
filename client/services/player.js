(function () {
    'use strict';
    angular.module('elbeat.app').service('PlayerService', function ($http, $timeout) {
        this.player = $('#player');
        this.playerNode = $('#player').get(0);
        this.played = false;
        this.muted = false;
        this.image = '';
        this.name = '';
        this.src = '';
        this.currentTime = 0;
        this.currentTimePercents = 0;
        this.buffered = 0;
        this.bufferedPercents = 0;
        this.duration = 0;

        this.play = function ($event) {
            this.name = $($event.currentTarget).data('name');
            this.image = $($event.currentTarget).data('image');
            this.src = $($event.currentTarget).data('lissen');
            this.player.attr('src', this.src);
            this.playerNode.play();
            this.played = true;
        }
        this.eventPlayPause = function () {
            if (this.played) {
                this.playerNode.pause();
                this.played = false;
            } else {
                this.playerNode.play();
                this.played = true;
            }
        }

        this.eventMuteOnOff = function () {
            if (this.muted) {
                this.playerNode.muted = false;
                this.muted = false;
            } else {
                this.playerNode.muted = true;
                this.muted = true;
            }
        }

        this.rewind = function($event){
            this.playerNode.pause();
            this.playerNode.currentTime = this.duration * ($event.offsetX / $('#time-line').width());
            this.playerNode.play();

        }

        this.update = function(){
            this.currentTime = parseInt(this.playerNode.currentTime);
            this.duration = parseInt(this.playerNode.duration);
            this.buffered = this.playerNode.buffered;
            this.currentTimePercents = (this.currentTime / this.duration) * 100;
            if(this.buffered.length){
                this.bufferedPercents = (this.buffered.end(0) / this.duration) * 100;
            }
            this.bufferedPercents = this.bufferedPercents > 100 ? 100 : this.bufferedPercents;
            this.currentTimePercents = this.currentTimePercents > 100 ? 100 : this.currentTimePercents;
        }

        $("#volume").slider({min  : 0, max  : 100, value: 0, orientation: 'vertical', tooltip_position:'left', reversed : true});
    });
})();