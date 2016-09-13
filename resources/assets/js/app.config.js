angular.
    module('busStopsApp', ['lineDetail', 'stopDetail']).
    config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $locationProvider.hashPrefix('!');

            $routeProvider.
                when('/lines', {
                    template: '<lines></lines>'
                }).
                when('/table/:lineId/:stopId', {
                    template: '<line-detail></line-detail>'
                })
                .when('/lines/:lineId', {
                    template: '<line-detail></line-detail>'
                }).
                otherwise('/lines');
        }
    ]);