/**
 * Created by Sebastian on 2016-09-12.
 */
angular.
    module('lineDetail').
    component('lineDetail', {
        templateUrl: 'js/components/line-detail.template.html',
        controller: ['$routeParams', '$http',
            function LineDetailController($routeParams, $http) {
                this.lineId = $routeParams.lineId;
                var self = this;
                $http.get('api/lines/' + $routeParams.lineId + '/stops').then(function(response){
                    self.busStops = response.data;
                });
            }
        ]
    });