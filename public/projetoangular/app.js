'use strict'

angular.module('myApp',['ngRoute','myApp.controllers'])
    .config(
    ['$routeProvider',
        function($routeProvider) {
            $routeProvider

                .when('/categorias/', {
                    templateUrl: 'projetoangular/templates/categorias.html',
                    controller: 'CategoriasCtrl'
                })

                .when('/categorias/novo/', {
                    templateUrl: 'projetoangular/templates/novaCategoria.html',
                    controller: 'CategoriasCtrl'
                })


                .when('/categorias/editar/:id', {
                    templateUrl: 'projetoangular/templates/editarCategoria.html',
                    controller: 'CategoriasCtrl'
                })

                .when('/produtos/',{
                    templateUrl: 'projetoangular/templates/produtos.html',
                    controller: 'ProdutosCtrl'
                })

                .when('/produtos/novo',{
                    templateUrl: 'projetoangular/templates/novoProduto.html',
                    controller: 'ProdutosCtrl'
                })

                .when('/produtos/editar/:id',{
                    templateUrl: 'projetoangular/templates/editarProduto.html',
                    controller: 'ProdutosCtrl'
                })
        }
    ]
);























/*
var categorias=angular.module('Categorias',['ngRoute']);


categorias.config('$routeProvider',[function($routeProvider){
    $routeProvider.when('/',{templateUrl:'projetoangular/templates/categorias.html'});
}]);*/
