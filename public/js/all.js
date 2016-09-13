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
/**
 * Created by Sebastian on 2016-09-12.
 */
angular.
    module('time').
    component('time', {
        templateUrl: 'js/components/time.template.html',
        controller: ['$interval',
            function TimeController($interval) {
                var self = this;
                var tick = function() {
                    self.clock = Date.now();
                }
                tick();
                $interval(tick, 1000);
            }
        ]
    });
//# sourceMappingURL=all.js.map
