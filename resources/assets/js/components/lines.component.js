/**
 * Created by Sebastian on 2016-09-12.
 */
angular.
    module('busStopsApp').
    component('lines', {
        templateUrl: 'js/components/lines.template.html',
        controller: ['$http',
            function LinesController($http) {
                var self = this;
                self.clearQuery = function(){
                    self.query = '';
                };
                $http.get('api/lines').then(function(response){
                   self.lines = response.data;
                });
            }
        ]
    });