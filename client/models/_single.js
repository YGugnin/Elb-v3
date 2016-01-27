'use strict';
angular.module('elbeat.single', []).factory("services", ['$http','$location','$route',
    function($http,$location,$route) {alert(8)
    var obj = {};
    obj.getSingles = function(){
        return $http.get(serviceBase + 'singles');
    }    
    obj.createSingle = function (single) {
        return $http.post( serviceBase + 'singles', single )
            .then( successHandler )
            .catch( errorHandler );
        function successHandler( result ) {
            $location.path('/single/index');
        }
        function errorHandler( result ){
            alert("Error data")
            $location.path('/single/create')
        }
    };    
    obj.getSingle = function(singleID){
        return $http.get(serviceBase + 'singles/' + singleID);
    }

    obj.updateSingle = function (single) {
        return $http.put(serviceBase + 'singles/' + single.id, single )
            .then( successHandler )
            .catch( errorHandler );
        function successHandler( result ) {
            $location.path('/single/index');
        }
        function errorHandler( result ){
            alert("Error data")
            $location.path('/single/update/' + single.id)
        }    
    };    
    obj.deleteSingle = function (singleID) {
        return $http.delete(serviceBase + 'singles/' + singleID)
            .then( successHandler )
            .catch( errorHandler );
        function successHandler( result ) {
            $route.reload();
        }
        function errorHandler( result ){
            alert("Error data")
            $route.reload();
        }    
    };    
    return obj;   
}]);