angular.module('quizApp',['quizServices', 'quizDirectives', 'quizControllers', 'angular-loading-bar'])
// Global Configuration
.config(function($interpolateProvider) {
      $interpolateProvider.startSymbol('<%');
      $interpolateProvider.endSymbol('%>');
})
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.latencyThreshold = 600;
}])
// To cut lengthy strings
.filter('cut', function() {
    return function(value, wordwise, max, tail) {
        if(!value) return '';
        max = parseInt(max, 10);
        if(!max) return value;
        if(value.length <= max) return value;

        value = value.substr(0, max);
        if(wordwise) {
            var lastspace = value.lastIndexOf(' ');
            if(lastspace != -1)
                value = value.substr(0, lastspace);
        }
        return value + (tail || ' ...');
    };
});


