angular.module('elbeat.filters', []).filter('escapeHtml', function() {
  var entityMap = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': '&quot;',
        "'": '&#39;',
        "/": '&#x2F;'
    };
    return function(str) {
        return String(str).replace(/[&<>"'\/]/g, function (s) {
            return entityMap[s];
        });
    }
}).filter('formatTimer', function () {
    return function (input) {
        input = parseInt(input);
        function z(n) { return (n < 10 ? '0' : '') + n; }
        var seconds = input % 60;
        var minutes = Math.floor(input % 3600 / 60);
        var hours = Math.floor(input / 3600);
        return (z(hours) + ':' + z(minutes) + ':' + z(seconds));
    }});