(function () {
    'use strict';
    angular.module('elbeat.app').controller('PlayerController', ['$scope', 'PlayerService', function ($scope, PlayerService) {
        $scope.player = PlayerService;
    }]);
})();