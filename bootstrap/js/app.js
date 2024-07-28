angular.module('MyApp', ['ngRoute'])
.controller('MyCtrl', function($scope, $http) {
    $scope.TacPham = [];
    $scope.selectedIndex = 0;
    $scope.selectedQuestion = null;
    $scope.totalScore = 0;
    $http.get('/Tai nguyen/data.json')
    .then(
        function(res) {
            $scope.TacPham = res.data;
            $scope.selectedQuestion = $scope.TacPham[0]; 
            console.log($scope.TacPham);
        },
        function(res) {
            alert('không đọc được dữ liệu')
        }
    );

    $scope.selectQuestion = function(index) {
        $scope.selectedIndex = index;
        $scope.selectedQuestion = $scope.TacPham[index];
        console.log( $scope.selectedQuestion)
    };
   
    $scope.isSelectedQuestion = function(question) {
        return $scope.selectedQuestion === question;
    };
    $scope.chonDapAn = function(kq) {
        if (kq) {
            $scope.totalScore += $scope.selectedQuestion.score;
        }
        $scope.goToNextQuestion();
    };
    $scope.goToNextQuestion = function() {
        if ($scope.selectedIndex < $scope.TacPham.length - 1) {
            $scope.selectedIndex++;
            $scope.selectedQuestion = $scope.TacPham[$scope.selectedIndex];
        }
    };
});
