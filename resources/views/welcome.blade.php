<!DOCTYPE html>
<html lang="en" ng-app="busStopsApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rozklad jazdy - MPK Rzeszów</title>
        <link rel="stylesheet" href="/css/app.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
        <script src="https://code.angularjs.org/1.5.8/angular-route.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div ng-view></div>
                </div>
            </div>
        </div>
        <script src="/js/app.js"></script>
        <script src="/js/all.js"></script>
    </body>
</html>
