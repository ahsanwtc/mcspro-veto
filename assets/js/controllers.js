
// Login Controller
vetoApp.controller('loginController', ['$scope', '$rootScope', function($scope, $rootScope) {
    // $scope.adminkey = '';
    // $scope.$watch('city', function() {
    //     cityService.city = $scope.city;
    // });

    // $scope.submit = function() {
    //     $location.path('/forecast');
    // }

}]);


// Home Controller
vetoApp.controller('homeController', ['$scope', '$location', function($scope, $location) {

}]);

// join Controller
vetoApp.controller('joinController', ['$scope', '$location', 'pathService', function($scope, $location, pathService) {
    $scope.path = pathService.path;

    $scope.submitEmail = function() {
        pathService.path = 'join/code';
        $location.path('/join/code');
    }

    $scope.submitCode = function() {
        pathService.path = 'veto';
        $location.path('/veto');
    }


}]);

// Veto Controller
vetoApp.controller('vetoController', ['$scope', '$location', 'vetoMapService', function($scope, $location, vetoMapService) {
    $scope.maps = vetoMapService.GetVetoMaps();
}]);