app.controller('LoginCtrl', ['$scope','$rootScope','$http','$state', function($scope,$rootScope,$http,$state){
	$scope.loginuser={};
	$scope.login=function(){
		$rootScope.showloader=true;
		$http({
			method:'POST',
			url:$rootScope.apiend+'login',
			data:$scope.loginuser
		}).success(function(result){
			$rootScope.showloader=false;
			if(result['statusCode']=="202")
			{
				localStorage.setItem("erptoken",result['message']);
				$state.go(result['link']);
			}
			else
			{
				$rootScope.showerror=true;
				$rootScope.error=result['message'];
			}
		});
	}
}]);

app.controller('MenuCtrl', ['$scope','$http','$rootScope','$state', function($scope,$http,$rootScope,$state){
	$scope.cstate=$state.current.name.split('.');
	$http({
		method:'GET',
		url:$rootScope.apiend+'menus',
		headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
		params:{state:$scope.cstate[0]}
	}).success(function(result){
		$scope.menus=result;
	}).error(function(err,data){
		$scope.logout();
	});

	$http({
		method:'GET',
		url:$rootScope.apiend+'checkuser',
		headers:{'JWT-AuthToken':localStorage.getItem('erptoken')}
	}).success(function(result){
		$scope.mainuser=result;
	}).error(function(err,data){
		$scope.logout();
	});
}]);

app.controller('UserCtrl', ['$scope','$rootScope','$http', function($scope,$rootScope,$http){
	$http({
		method:'GET',
		url:$rootScope.apiend+'checkuser',
		headers:{'JWT-AuthToken':localStorage.getItem('erptoken')}
	}).success(function(result){
		$scope.mainuser=result;
	}).error(function(err,data){
		$scope.logout();
	});
}]);