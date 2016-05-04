app.controller('OfficeMainCtrl', ['$scope','$http','$rootScope', function($scope,$http,$rootScope){
	
}]);

app.controller('OfficeMastersCtrl', ['$scope','$http','$rootScope', function($scope,$http,$rootScope){
	$rootScope.showloader=true;
	$http({
		method:'GET',
		url:$rootScope.apiend+'offices',
		headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
	}).success(function(result){
		$rootScope.showloader=false;
		$scope.offices=result;
	}).error(function(err,data){
		$rootScope.showloader=false;
		$scope.logout();
	});

	$scope.activate=function(office){
		$rootScope.showloader=true;
		$http({
			method:'POST',
			url:$rootScope.apiend+'activate_office',
			headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
			data:{office_id:office.id}
		}).success(function(result){
			$rootScope.showloader=false;
			$scope.offices=result;
		});
	}

	$scope.deactivate=function(office){
		$rootScope.showloader=true;
		$http({
			method:'POST',
			url:$rootScope.apiend+'deactivate_office',
			headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
			data:{office_id:office.id}
		}).success(function(result){
			$rootScope.showloader=false;
			$scope.offices=result;
		});
	}

	$scope.add=function(){
		$scope.mainoffice={};
		$('#modal').modal('show');
	}

	$scope.edit=function(office){
		$scope.mainoffice=angular.copy(office);
		$('#modal').modal('show');
	}

	$scope.save=function(){
		$rootScope.showloader=true;
		$http({
			method:'POST',
			url:$rootScope.apiend+'save_office',
			headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
			data:$scope.mainoffice
		}).success(function(result){
			$rootScope.showloader=false;
			$scope.mainoffice={};
			$scope.offices=result;
			$('#modal').modal('hide');
		});
	}
}]);