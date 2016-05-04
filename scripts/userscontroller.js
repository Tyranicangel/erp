app.controller('UsersMainCtrl', ['$scope','$http','$rootScope', function($scope,$http,$rootScope){
	
}]);

app.controller('UsersMastersCtrl', ['$scope','$http','$rootScope', function($scope,$http,$rootScope){
	$rootScope.showloader=true;
	$http({
		method:'GET',
		url:$rootScope.apiend+'offices',
		headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
	}).success(function(result){
		$rootScope.showloader=false;
		$scope.offices=result;
		if($scope.offices.length==0)
		{
			swal('You need to create masters for offices first.');
		}
	});

	$http({
		method:'GET',
		url:$rootScope.apiend+'users',
		headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
	}).success(function(result){
		$scope.users=result;
	});

	$scope.add=function(){
		$scope.muser={};
		$scope.muser.officedetails={};
		$('#modal').modal('show');
	}

	$scope.edit=function(user){
		$scope.muser=angular.copy(user);
		$('#modal').modal('show');
	}

	$scope.activate=function(user){
		$rootScope.showloader=true;
		$http({
			method:'POST',
			url:$rootScope.apiend+'activate_user',
			headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
			data:{user_id:user.id}
		}).success(function(result){
			$rootScope.showloader=false;
			$scope.users=result;
		});
	}

	$scope.deactivate=function(user){
		$rootScope.showloader=true;
		$http({
			method:'POST',
			url:$rootScope.apiend+'deactivate_user',
			headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
			data:{user_id:user.id}
		}).success(function(result){
			$rootScope.showloader=false;
			$scope.users=result;
		});
	}

	$scope.save=function(){
		$rootScope.showloader=true;
		$http({
			method:'POST',
			url:$rootScope.apiend+'save_user',
			headers:{'JWT-AuthToken':localStorage.getItem('erptoken')},
			data:$scope.muser
		}).success(function(result){
			$rootScope.showloader=false;
			if(result[1]=='success')
			{
				$scope.muser={};
				$scope.users=result[2];
				$('#modal').modal('hide');
			}
			alert(result[0]);
		});
	}

}]);