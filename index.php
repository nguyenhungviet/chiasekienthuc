<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
       <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
        <title>Angular JS</title>
    </head>
    <body ng-app="myapp" ng-controller="mycontroller">
        <div class="container">
            <div class="row">
                <label class="col-md-1 control-label">Product</label>
            </div>
            <div class="row">
                <form class="col-md-10">
                    <input type="text" ng-model="txtSearch" class="form-control" placeholder="search product" />
                </form>
                <a data-toggle="modal" href="#myModalAdd" class="btn btn-primary col-md-2"><span class="glyphicon glyphicon-cloud"></span>Add New</a>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="t in sp |filter:txtSearch">
                            <td>{{t.id}}</td>
                            <td>{{t.name}}</td>
                            <td>{{t.description}}</td>
                            <td>{{t.price}}</td>
                            <td><a href="#" class="btn btn-info" id="btnEdit" data-toggle="modal" data-target="#myModalAdd" ng-click="Edit(t.id,t.name,t.price,t.description)"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                <a href="#" class="btn btn-info" ng-click="Xoa(t.id)"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>
                        </tr> 
                    </tbody>
                </table>
            </div>  


            <!--star popup add product-->

            <!-- Modal -->
            <div class="modal fade" id="myModalAdd" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add new product</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <div class="form-group">
                                    <input ng-model="id" type="hidden" />
                                    <div class="input-group">
                                        <label>Name</label>
                                        <input ng-model="name" type="text" class="form-control" id="form-name" placeholder="Type name" />

                                    </div>
                                    <div class="input-group">
                                        <label>Price</label>
                                        <input ng-model="price" type="text" class="form-control" id="Text1" placeholder="Type name" />

                                    </div>
                                    <div class="input-group">
                                        <label>Description</label>
                                        <input ng-model="description" type="text" class="form-control" id="Text2" placeholder="Type name" />

                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <input type="submit"  ng-click="add()" value="{{btnname}}"></input>
                        </div>
                    </div>

                </div>
            </div>
            <!--end popup-->

            <!--star popup edit product-->

            <!-- Modal -->
           

        </div>
    </body>
    <script>
        var app=angular.module('myapp',[]);
        app.controller('mycontroller',function($scope,$http){
            $scope.btnname="Save";
            $scope.loadsp=function(){
                $http.post('dbCon.php').success(function(data){
                    $scope.sp=data;
                });
            }
            $scope.loadsp();
            
            //Thêm
            $scope.add=function(){
                 $http.post('xlThem.php',{'name':$scope.name,'price':$scope.price,'description':$scope.description,'btnname':$scope.btnname,'id':$scope.id}).success(function(){
                    $scope.name=null;
                    $scope.price=null;
                    $scope.description=null;
                    $scope.btnname="Save";
                    $scope.loadsp();
                });
            }
            //Xóa
             $scope.Xoa=function(id){
                 if(confirm("Bạn có muốn xóa hay không?"))
                 {
                        $http.post('xlXoa.php',{'id':id}).success(function(){
                           $scope.loadsp();
                       });
                 }
            }
            //Sửa
            $scope.Edit=function(id,name,price,description)
            {
               
                $scope.id=id;
                $scope.name=name;
                $scope.price=price;
                $scope.description=description;
                $scope.btnname="Update";
                $scope.loadsp();
            }
            
            
        });
    </script>
    
</html>
