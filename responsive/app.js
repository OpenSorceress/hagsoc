var app = angular.module("app", []);

app.controller('WorkController', ['$scope', '$http', function($scope, $http) {
    $http.get('http://www.hagiographysociety.org/wp-content/themes/responsive/query.php').success(function(data) {
            $scope.works = data;
    });
}]);

app.controller('AdminController', ['$scope', '$http', function($scope, $http) {
    $http.get('http://www.hagiographysociety.org/wp-content/themes/responsive/query2.php').success(function(data) {
            $scope.apps = data;
            $scope.thisType = $scope.apps.type;

    });
}]);

app.controller('UserController', ['$scope', '$http', function($scope, $http) {
    $http.get('http://www.hagiographysociety.org/wp-content/themes/responsive/query3.php').success(function(data) {
            $scope.users = data;
    });
}]);
