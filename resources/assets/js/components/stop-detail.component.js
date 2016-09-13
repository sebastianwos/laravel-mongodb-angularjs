/**
 * Created by Sebastian on 2016-09-12.
 */
angular.
    module('stopDetail').
    component('stopDetail', {
        templateUrl: 'js/components/stop-detail.template.html',
        controller: ['$routeParams', '$http',
            function StopDetailController($routeParams, $http) {
                var self = this;
                var d = new Date();
                self.hour = d.getHours();
                self.minutes = d.getMinutes();
                if($routeParams.stopId !== undefined){
                    $http.get('api/table/'+$routeParams.lineId+'/'+$routeParams.stopId).then(function(response){
                        self.table = response.data.data;
                    });
                }
            }
        ]
    });