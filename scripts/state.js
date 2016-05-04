app.config(function($stateProvider,$urlRouterProvider){
	$urlRouterProvider.otherwise("/login");

	$stateProvider.
		state('login',{
			url: '/login',
			views:{
				"main":{
					templateUrl:"partials/common/login.html",
					controller:'LoginCtrl'
				}
			}
		}).
		state('user',{
			views:{
				"main":{
					templateUrl:"partials/user/common.html",
					controller:'UserCtrl'
				}
			}
		}).
		state('user.main',{
			url: '/user/main',
			views:{
				"content":{
					templateUrl:"partials/user/main.html",
					controller:'UserMainCtrl'
				}
			}
		}).
		state('office',{
			views:{
				"main":{
					templateUrl:"partials/common/main.html",
					controller:'MenuCtrl'
				}
			}
		}).
		state('office.main',{
			url: '/office/main',
			views:{
				"content":{
					templateUrl:"partials/office/main.html",
					controller:'OfficeMainCtrl'
				}
			}
		}).
		state('office.masters',{
			url: '/office/masters',
			views:{
				"content":{
					templateUrl:"partials/office/masters.html",
					controller:'OfficeMastersCtrl'
				}
			}
		});
});