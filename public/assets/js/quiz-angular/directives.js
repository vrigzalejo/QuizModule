angular.module('quizDirectives',[])
// Directives
.directive('loadBubble', function() {
    return {
        restrict: 'E',
        replace: true,
        scope: {
            model: '=',
            rootScopeModel: '='
        },
        template:'<div class="small-12 medium-6 large-6 large-centered medium-centered columns" data-ng-if="rootScopeModel">' +
        '<div class="bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div></div>'
    };
})
.directive('createSubjectsLink', function() {
    return {
        restrict: 'E',
        replace: true,
        scope: {
            model: '=',
        },
        template:'<div class="small-12 medium-6 large-6 large-centered medium-centered columns" data-ng-if="model.length === 0"><div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;No Subjects, add a subject first. <a href="/dashboard/subjects">click here</a></div></div>'
    };
})
.directive('noRecordsRow', function() {
    return {
        restrict: 'E',
        replace: true,
        scope: {
            model: '=',
            caption: '@?',
        },
        controller: function($scope) {
            $scope.caption = $scope.caption || 'Records';
        },
        template:'<h1 class="columns text-center" data-ng-if="model.length === 0">No <% caption %> found.</h1>'
    };
})
.directive('createTypesLink', function() {
    return {
        restrict: 'E',
        replace: true,
        scope: {
            model: '='
        },
        template:'<div class="small-12 medium-6 large-6 large-centered medium-centered columns" data-ng-if="model.length === 0"><div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;No Types, add a type first. <a href="#">click here</a></div></div></div>'
    };
})
.directive('toggleCreate', function() {
    return {
        restrict: 'EA',
        scope: {
            caption: '@?',
            toggled: '=',
        },
        replace: true,
        controller: function($scope) {
            $scope.caption = $scope.caption || 'Data';
        },
        template: "<a data-ng-click=\"toggle()\" class=\"button tiny round\"><i class=\"size-72\" data-ng-class=\"{'fi-plus':!toggled,'fi-minus':toggled}\"></i>&nbsp;Create <% caption %></a>",
        link: function(scope) {
            scope.toggle = function() {
                scope.toggled = !scope.toggled;
            }
        }
    };
})
.directive('addResetCancel', function() {
    return {
        restrict: 'EA',
        scope: {
            toggled: '='
        },
        replace: true,
        template:  '<div class="button-bar right">' +
                        '<ul class="button-group round">' +
                            '<li>' +
                                '<button class="button tiny" type="submit">Add</button>' +
                            '</li>' +
                            '<li>' +
                                '<button class="button tiny" type="reset">Reset</button>' +
                            '</li>' +
                            '<li>' +
                                '<button class="button tiny" type="button" data-ng-click="toggle()" class="button tiny round">Cancel</button>' +
                            '</li>' +
                        '</ul>' +
                    '</div>',
        link: function(scope) {
            scope.toggle = function() {
                scope.toggled = !scope.toggled;
            }
        }
    };
})
.directive('search', function() {
    return {
        restrict: 'E',
        replace: true,
        scope: {
            model: '=',
            filter: '=?'
        },
        conroller: function($scope){
            $scope.filter = $scope.filter || 'search';
        },
        template: '<div class="large-7 medium-9 large-centered medium-centered columns">' +
                        '<div class="row collapse">' +
                            '<div class="small-3 columns">' +
                                '<span class="prefix radius">Search</span>' +
                            '</div>' +
                            '<div class="small-6 columns">' +
                                '<input type="text" data-ng-model="filter">' +
                            '</div>' +
                            '<div class="small-3 columns">' +
                                '<span class="postfix radius">Records: ( <b><% (model|filter:filter).length %>  / <% model.length %></b> )</span>' +
                            '</div>' +
                        '</div>' +
                    '</div>'
    };
});
/*
.directive('update-delete', function() {
    return {
        restrict: 'EA',
        scope: {
            updateFunc: '&',
            deleteFunc: '&',
            model: '=',
            alias: '=',
            edit: '=?'
        },
        template: '<div class="button-bar right">' +
                '<ul class="button-group">' +
                    '<li>' +
                        '<a class="button success tiny" data-ng-show="editMode" data-ng-click="editMode = false; updateFunc"><i class="fi-save size-72"></i></a>' +
                    '</li>' +
                    '<li>' +
                        '<a class="button tiny" data-ng-hide="editMode" data-ng-click="editMode = true; editData(alias)"><i class="fi-clipboard-pencil size-72"></i></a>' +
                    '</li>' +
                    '<li>' +
                        '<a class="button alert tiny" data-ng-click="deleteFunc"><i class="fi-trash size-72"></i></a>' +
                    '</li>' +
                    '<li>' +
                        '<a class="button alert tiny" data-ng-show="editMode" data-ng-click="editMode = false;"><i class="fi-x size-72"></i></a>' +
                    '</li>' +
                '</ul>' +
            '</div>',
        link: function(scope) {
            scope.editData = function(alias) {
                scope.edit = scope.model.indexOf(alias);
            }          
        }
    };
}); 
*/