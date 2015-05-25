(function() {
  var travel = angular.module('travel', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
  });

  travel.controller('slideCtrl', function ($scope) {
    $scope.page = 0;
    $scope.locationSelected = false;
    $scope.dateSelected = false;

    $scope.increment = function() {
      $scope.page++;

      if ($scope.page > 0)
        $scope.locationSelected = true;

      if ($scope.page > 1)
        $scope.dateSelected = true;
    }

    $scope.decrement = function() {
      $scope.page--;
    }
  });
})();
