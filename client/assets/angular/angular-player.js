var player = function(){
    this.position = 0;
    this.lissen_link = '';
    this.playerObject = null;
    this.position = 10;
    this.fullTime = 0;

    this.init = function(){
        this.playerObject = document.getElementById('player');
    }

    this.restart = function(){
        //this.playerObject.onplay = this.timeUpdate();
        //*this.playerObject.addEventListener("timeupdate", function(){


        this.playerObject.addEventListener("timeupdate", this.timeUpdate);
    }

    this.timeUpdate = function(){
        rootScope.player.fullTime = rootScope.player.playerObject.duration;
        rootScope.playerPosition = rootScope.player.playerObject.currentTime;
        console.log(rootScope.playerPosition)
    }

    this.play = function(obj){
        this.lissen_link = obj.single.lissen_link;
        this.startPlay();
        this.restart();
    }

    this.startPlay = function(){
        this.playerObject.src =  this.lissen_link;
        this.playerObject.play();
    }

    this.init();
}
