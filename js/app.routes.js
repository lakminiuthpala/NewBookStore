angular.module('ci-ng-auth')



.config(function($stateProvider, $urlRouterProvider) {
	$stateProvider
		.state('login', {
			url: '/login',
			templateUrl: 'tpl/login.html',
			controller: function($rootScope, $scope, $state, UrlService) {
				$scope.loginForm = {
					username: '',
					password: ''
				};

				$rootScope.currentState = "login";

				$scope.login = function (login) {
					$rootScope.req(UrlService.get('login'), 'POST', $scope.loginForm, false, function(resp) {
						$rootScope.ssSet('loggedIn', true);
						$rootScope.lsSet('user-data', resp.data, true);

						switch(resp.data.group) {
							case "admin":
								$state.go('admin.dashboard');
								break;

							case "members":
								$state.go('user.dashboard');
								break;
						}
					});
				};
			}
		})

		.state('register', {
			url: '/register',
			templateUrl: 'tpl/register.html',
			controller: function($rootScope, $scope, $state, UrlService, notify) {
				$scope.registerForm = {};
				$rootScope.currentState = "register";

				$scope.register = function () {
					$scope.registerForm.user_type = "2";

					$rootScope.req(UrlService.get('register'), "POST", $scope.registerForm, false, function (resp) {
						if (resp.code === "success") {
							notify({ message: resp.message, duration: 2000, position: 'right' });
							$scope.registerForm = {};
							$state.go('login');
						} else {
							notify({ message: resp.message, duration: 2000, position: 'right' });
						}
					});
				};
			}
		})

		.state('index', {
			url: '/login',
			templateUrl: 'tpl/index.html',
			controller: function($rootScope, $scope, UrlService, notify) {
				$rootScope.currentState = "index";
				$scope.book = $rootScope.lsGet('user-data', true);

				$scope.updateProfile = function() {
					$rootScope.req(UrlService.get('search_book'), "POST", $scope.book, false, function(resp) {
						if (resp.code === "success") {
							notify({ message: resp.message, duration: 2000, position: 'right' });
							$rootScope.req(UrlService.get('search_book'), "POST", $scope.book, false, function(resp) {
								$rootScope.lsSet('user-data', resp.data, true);
							});
						} else {
							notify({ message: resp.message, duration: 2000, position: 'right' });
						}
					});
				};
			}
		});

	$urlRouterProvider.otherwise('/login');
});