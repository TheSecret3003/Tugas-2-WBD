var main_module = angular.module("search_app",[]);

main_module.controller("contentController", function($scope) {
	$scope.status = 1;
	$scope.title = "Search Book";
	$scope.books = [
			{"id": 101, "name": "Fundamental of Physics Theorem", "description": "Best book to study physics", "author": "some1", "image": "", "harga": 230000},
			{"id": 101, "name": "Fundamental of Physics Theorem", "description": "Best book to study physics", "author": "some1", "image": "", "harga": 230000},
			{"id": 101, "name": "Fundamental of Physics Theorem", "description": "Best book to study physics", "author": "some1", "image": "", "harga": 230000}
		];
	$scope.submit = function(){
		$scope.title = "Search Result";
		$scope.status = 0;
	}
});