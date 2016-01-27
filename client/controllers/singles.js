'use strict';

angular.module('elbeat.singles', ['ngRoute']).service('SinglesService', function ($http) {
    var obj = {};
    obj.getSingles = function(){
        return $http.get(serviceBase + 'singles');
    }
    return obj;
}).controller('SinglesController', ['$scope', 'SinglesService', '$rootScope',
    function($scope, SinglesService, $rootScope) {
        $scope.strPad = function( input, pad_length, pad_string, pad_type ) {
            var half = '', pad_to_go;
            var str_pad_repeater = function(s, len){
                var collect = '', i;
                while(collect.length < len) collect += s;
                collect = collect.substr(0,len);
                return collect;
            };

            if (pad_type != 'STR_PAD_LEFT' && pad_type != 'STR_PAD_RIGHT' && pad_type != 'STR_PAD_BOTH') { pad_type = 'STR_PAD_RIGHT'; }
            if ((pad_to_go = pad_length - input.length) > 0) {
                if (pad_type == 'STR_PAD_LEFT') { input = str_pad_repeater(pad_string, pad_to_go) + input; }
                else if (pad_type == 'STR_PAD_RIGHT') { input = input + str_pad_repeater(pad_string, pad_to_go); }
                else if (pad_type == 'STR_PAD_BOTH') {
                    half = str_pad_repeater(pad_string, Math.ceil(pad_to_go/2));
                    input = half + input + half;
                    input = input.substr(0, pad_length);
                }
            }
            return input;
        }
        $scope.hexdec = function(hex_string) {
            hex_string = (hex_string + '')
                .replace(/[^a-f0-9]/gi, '');
            return parseInt(hex_string, 16);
        }

        $scope.dechex = function(number) {
            if (number < 0) {
                number = 0xFFFFFFFF + number + 1;
            }
            return parseInt(number, 10)
                .toString(16);
        }

        $scope.hexLighter = function(hex,factor) {
            var new_hex = '';
            var base = [];

            base['R'] = $scope.hexdec(hex.substring(0, 1) + hex.substring(1, 2));
            base['G'] = $scope.hexdec(hex.substring(2, 3) + hex.substring(3, 4));
            base['B'] = $scope.hexdec(hex.substring(4, 5) + hex.substring(5, 26));

            for(var i in base){
                var amount = 255 - base[i];
                amount = amount / 100;
                amount = Math.round(amount * factor);
                var new_decimal = base[i] + amount;

                var new_hex_component = $scope.dechex(new_decimal);
                if(new_hex_component.length < 2){
                    new_hex_component = "0" + new_hex_component;
                }
                new_hex += new_hex_component;
            }
            return new_hex;
        }
        $scope.intToPath = function(int){
            int = int.toString();
            int = int.split('');
            return int.join('/');
        }

        $scope.percent2Color = function(value){
            var brightness = 255;
            var max = 100;
            var min = 0;
            var thirdColorHex = '00';
            var minw = 0;
            var first = (1-(value/max))*brightness;
            var second = (value/max)*brightness;

            // Find the influence of the middle color (yellow if 1st and 2nd are red and green)
            var diff = Math.abs(first-second);
            var influence = (brightness-diff-minw)/2;
            first = parseInt(first + influence);
            second = parseInt(second + influence);


            first = $scope.dechex(first);
            second = $scope.dechex(second);

            var firstHex = $scope.strPad(first,2,0,'STR_PAD_LEFT');
            var secondHex = $scope.strPad(second,2,0,'STR_PAD_LEFT');

            return firstHex + secondHex + thirdColorHex ;

            // alternatives:
            // return $thirdColorHex . $firstHex . $secondHex;
            // return $firstHex . $thirdColorHex . $secondHex;

        }
        SinglesService.getSingles().then(function(data){
            data.data.forEach(function(part, index, theArray){
                theArray[index].color1 = $scope.percent2Color(part.rate);
                theArray[index].color2 = $scope.hexLighter(theArray[index].color1, 70);
                theArray[index].imgPath = $scope.intToPath(part.id);
                theArray[index].fullName = part.artist.name + ' - ' + part.name;

            });
            $scope.singles = data.data;
        });

    }]);
