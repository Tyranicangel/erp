app.controller('UserMainCtrl', ['$scope','$http','$rootScope', function($scope,$http,$rootScope){
	$rootScope.showloader=true;
	$http({
		method:'GET',
		url:$rootScope.apiend+'modules',
		headers:{'JWT-AuthToken':localStorage.getItem('erptoken')}
	}).success(function(result){
		$rootScope.showloader=false;
		$scope.modules=result;
	});
}]);