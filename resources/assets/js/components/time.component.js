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