'use strict';

var serviceBase = 'http://server.local/';

var app = angular.module('elbeat.app', [
    'ngRoute'
    ,'slugifier'
    ,'elbeat.filters'


    ,'elbeat.index'
    ,'elbeat.singles'

]).config(/*['$routeProvider', '$locationProvider',*/
    function($routeProvider, $locationProvider) {
        $routeProvider.
            when('/singles', {
                templateUrl: 'views/singles/index.html',
                controller: 'SinglesController'
            }).
            when('/', {
                templateUrl: 'views/index/index.html',
                controller: 'IndexController'
            }).
            otherwise({
                redirectTo: '/'
            });
        $locationProvider.html5Mode(true);
    }/*]*/).run(['$rootScope','$location', '$routeParams', function($rootScope, $location, $routeParams){
    //PLAYER ----------------

        $rootScope.player = $('#player');
        $rootScope.playerNode = $('#player').get(0);
        $rootScope.name = '';

        $rootScope.play = function($event){
            $rootScope.name = $($event.currentTarget).data('name');
            $rootScope.player.attr('src', $($event.currentTarget).data('lissen'));
            $rootScope.playerNode.play();
        }

    //END PLAYER


    console.log('Current route name: ' + $location.path());
}]);

