'use strict';

var serviceBase = 'http://server.local/';

var app = angular.module('elbeat.app', [
    'ngRoute'
    ,'ngMedia'
    ,'slugifier'
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

    console.log('Current route name: ' + $location.path());
}]);

