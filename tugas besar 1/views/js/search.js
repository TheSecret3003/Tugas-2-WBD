var main_module = angular.module("search_app",[]);

main_module.controller("contentController", function($scope,$http) {
	$scope.status = 1;
	$scope.title = "Search Book";
	$scope.books = [];

	$scope.submit = function(){
		$scope.title = "Search Result";
		$scope.status = 0;

		$url = "./extra/showBook.php?title=" + $scope.search_term;
		$http.get($url)
		.then(function(response){
			console.log(response.data);
			parse_response(response.data);
		});
	};

	parse_response = function(data){
		for (var i = 0; i < data.items.length; i++){
			$scope.books.push({
				"id"		: data.items[i].id,
				"name"		: data.items[i].volumeInfo.title,
				"description"	: data.items[i].volumeInfo.description,
				"author"	: check_if_author_exist(data.items[i].volumeInfo.authors),
				"image"		: data.items[i].volumeInfo.imageLinks.thumbnail,
				"harga"		: check_if_saleability(data.items[i].saleInfo)}
			);
		}
	};

	check_if_author_exist = function(authors){
		if (typeof authors === "undefined"){
			return "No author";
		} else {
			return authors.join();
		}
	}

	check_if_saleability = function(sale_info){
		if (sale_info.saleability === "NOT_FOR_SALE"){
			return "NOT FOR SALE";
		} else {
			return sale_info.listPrice.amount;
		}
	}
});

