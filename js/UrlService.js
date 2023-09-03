angular.module('ci-ng-auth')


.service('UrlService', function () {
  var data = {
    baseurl: './api/',
    login: 'auth/login',
    register: 'auth/register',
    add_book: 'auth/addBook',
    profile_info: 'auth/info',
    search_book : 'auth/search'
  };

  this.get = function (id, single) {
    if (id) {
      return data.baseurl + data[id];
    } else {
      return data.baseurl;
    }
  }
});
