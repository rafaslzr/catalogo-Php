(function(){
        var app= angular.module("tiendaCamaras",[]);
        app.controller('camarasController',function ($scope,$http) {
                $http.get("categorias.json").success(function(data) {
                        $scope.categoria = data;
                });
	});
})();




