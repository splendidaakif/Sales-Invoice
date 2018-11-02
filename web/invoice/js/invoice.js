var  invoice_application = angular.module("invoiceModule",[]);
     invoice_application.config(function ($interpolateProvider)
                              {
                                 $interpolateProvider.startSymbol('[[').endSymbol(']]');
                              }
                          );
     invoice_application.controller("invoiceController", function ($scope)
                      {
                        $scope.no_of_iteams=1;
                        $scope.id=1;
                        $scope.additeamsRows = function()
                                      {
                                        for(x=0;x<$scope.no_of_iteams;x++)
                                          {
                                            $scope.addarray.push([x]);
                                          }
                                      };
                        $scope.addarray=[1];



      				   $scope.removeiteamsRows = function()
                                      {
                                            $scope.addarray.pop([x]);

                                      };

                      }
                    );
