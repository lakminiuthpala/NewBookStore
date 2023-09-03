angular.module('ci-ng-auth')

.config(function($stateProvider, $urlRouterProvider) {
	$stateProvider
		
		.state('user', {
			url: '/user',
			templateUrl: 'tpl/user/user.html',
			controller: function($rootScope, $scope, $state) {
				$rootScope.currentState = "user";
				if (!$rootScope.ssGet('loggedIn')) {
					$state.go('login');
				};
			}
		})


		.state('user.dashboard', {
			url: '/dashboard',
			templateUrl: 'tpl/user/dashboard.html',
			controller: function($rootScope, $scope) {
				$rootScope.currentState = "user.dashboard";
				$scope.user_data = $rootScope.lsGet('user-data', true);
			}
		})

		.state('user.addBooks', {
			url: '/add_books',
			templateUrl: 'tpl/user/addBooks.html',
			controller: function($rootScope, $scope, UrlService, notify) {
				$rootScope.currentState = "user.addBooks";
				$scope.book = $rootScope.lsGet('user-data', true);

				$scope.updateProfile = function() {
					$rootScope.req(UrlService.get('add_book'), "POST", $scope.book, false, function(resp) {
						if (resp.code === "success") {
							notify({ message: resp.message, duration: 2000, position: 'right' });
							$rootScope.req(UrlService.get('profile_info'), "POST", $scope.book, false, function(resp) {
								$rootScope.lsSet('user-data', resp.data, true);
							});
						} else {
							notify({ message: resp.message, duration: 2000, position: 'right' });
						}
					});
				};
			}
		})



});