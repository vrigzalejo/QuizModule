/* --------------
Injected modules
    @ngSanitize -> to bind HTML elements from a scope
    @imageupload -> to use "image" directive
 -------------- */ 
angular.module('quizControllers',['ngSanitize', 'imageupload'])
 /* --------------
  "toggle-create" directive depends with these scopes:
    > showAddQuiz
    > showAddSubject
    > showAddQuestion
  "load-bubble" directive depends with these rootScopes:
    > loadSubjects
    > loadTypes
    > loadQuizzes
  ---------------- */
/*------------- Controllers ---------------*/
.controller('QuizzesCtrl', ['$scope', '$rootScope', '$http', 'Quiz', 'Subject', '$q', '$timeout', function($scope, $rootScope, $http, Quiz, Subject, $q, $timeout) {
    $scope.showAddQuiz = false; 
    $rootScope.loadSubjects = true;
    $rootScope.loadSubjquizzes = true;

    Subject.get().success(function(data) {
        $scope.subjects = data;
        $scope.subjects.length > 0 ? $scope.subjectsAvailable = true : $scope.subjectsAvailable = false;
        $rootScope.loadSubjects = false;
    });

    $scope.getQuizzes = function() {

        Quiz.get().success(function(data) {
        for(var i=0; i<data.length;i++) {
            data[i].created_at = new Date(data[i].created_at.replace(/-/g,"/"));
            data[i].updated_at = new Date(data[i].updated_at.replace(/-/g,"/"));
        }

        $scope.subjquizzes = data;
        $rootScope.loadSubjquizzes = false;
        });
    }
    $scope.getQuizzes();

    $scope.edit = false;

    $scope.createSubjquiz = function(quiz_name, subject) {

        var d = $q.defer();
        Quiz.create(quiz_name, subject).success(function(data, status, header) {
            d.resolve(data);
            if(data.success){
                $scope.getQuizzes();
                $scope.showAddQuiz = !$scope.showAddQuiz;
                $scope.results = data.message;
            } else {
                var errors = [data.message.add_quiz_name, data.message.add_quiz_subject];
                for(var i=0;errors.length > i;i++) {
                    $scope.results = '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;<b>' + errors.join('&nbsp;') + '</b><a href="#" class="close">&times;</a></div>';
                }
                $scope.showAddQuiz = !$scope.showAddQuiz;                    
            }                              
            $timeout(function() {$scope.results = '';}, 10000);
        }).error(function(data, status, header) {
            d.reject(data);
            console.log(data);
        });
        return d.promise;   
    }

    $scope.editSubjquiz = function(subjquiz) {
        $scope.edit = $scope.subjquizzes.indexOf(subjquiz);
    }
   

    $scope.saveSubjquiz = function(id, quiz_name, subject) {       
        var d = $q.defer();
        Quiz.update(id, quiz_name, subject).success(function(data, status, header) {
            d.resolve(data);
            if(data.success){
                $scope.getQuizzes();
                $scope.results = data.message;
            } else {
                var errors = [data.message.subjquiz_name, data.message.subjquiz_subject];
                for(var i=0;errors.length > i;i++) {
                    $scope.results = '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;<b>' + errors.join('&nbsp;') + '</b><a href="#" class="close">&times;</a></div>';
                }                       
            }                                  
            $timeout(function() {$scope.results = '';}, 10000);
        }).error(function(data, status, header) {
            d.reject(data);
            console.log(data);
        });
        return d.promise;
    }

    $scope.deleteSubjquiz = function(id) {
        conf = window.confirm("Are you sure you want to delete this?");
        if(conf) {
            var d = $q.defer();
            Quiz.destroy(id).success(function(data, status, header) {
                d.resolve(data);
                $scope.results = data.message;
                $scope.getQuizzes();
                $timeout(function() {$scope.results = '';}, 10000);
            }).error(function(data, status, header) {
                d.reject(data);
                console.log(data);
            });
            return d.promise;
        } else {
            return false;
        }
    }

}])
.controller('QuestionsCtrl', ['$scope', '$rootScope', '$http', 'Subject', 'Type', 'Question', '$q', '$timeout', function($scope, $rootScope, $http, Subject, Type, Question, $q, $timeout) {
    $scope.showAddQuestion = false;
    $rootScope.loadTypes = true;
    $rootScope.loadSubjects = true;
    $rootScope.loadQuestions = true;
  
    Type.get().success(function(data) {
        $scope.types = data;
        $scope.types.length > 0 ? $scope.typesAvailable = true : $scope.typesAvailable = false;
        $rootScope.loadTypes = false;
    });

    Subject.get().success(function(data) {
        $scope.subjects = data;
        $scope.subjects.length > 0 ? $scope.subjectsAvailable = true : $scope.subjectsAvailable = false;
        $rootScope.loadSubjects = false;
    });

    $scope.getQuestions = function() {
        Question.get().success(function(data) {
        for(var i=0; i<data.length;i++) {
            data[i].created_at = new Date(data[i].created_at.replace(/-/g,"/"));
            data[i].updated_at = new Date(data[i].updated_at.replace(/-/g,"/"));
        }

        $scope.questions = data;
        $rootScope.loadQuestions = false;
        });
    }
    $scope.getQuestions();

    $scope.edit = false;
 
    $scope.reset = function() { // Reset all models & inputs
        document.getElementById('formQuestion').reset();
        $scope.add = undefined;
        $scope.check = undefined;
        $scope.image = undefined;
    }

    $scope.editQuestion = function(question) {
        $scope.edit = $scope.questions.indexOf(question);;
    }

    $scope.createQuestion = function(add, check, image) {
        
        if(add !== undefined || image !== undefined) {
            var d = $q.defer();
            Question.create(add, check, image).success(function(data, status, header) {
                d.resolve(data);
                if(data.success) {
                    $scope.results = data.message;
                    $scope.reset();                   
                    $scope.getQuestions();
                    $scope.showAddQuestion = !$scope.showAddQuestion;
                } else {
                    var errors = [data.message.add_quiz_name, data.message.add_quiz_subject];
                    for(var i=0;errors.length > i;i++) {
                        $scope.results = '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;<b>' + errors.join('&nbsp;') + '</b><a href="#" class="close">&times;</a></div>';
                    }
                    $scope.showAddQuestion = !$scope.showAddQuestion;                    
                }
                
                console.log(data);
                $timeout(function() {$scope.results = '';}, 10000);
            }).error(function(data, status, header) {
                d.reject(data);
                console.log(data);
            });
            return d.promise;
        }
    }

    $scope.deleteQuestion = function(question) {
        conf = window.confirm("Are you sure you want to delete this?");
        if(conf) {
            var d = $q.defer();
            Question.destroy(question).success(function(data, status, header) {
                d.resolve(data);
                $scope.results = data.message;
                $scope.getQuestions();
                $timeout(function() {$scope.results = '';}, 10000);
            }).error(function(data, status, header) {
                d.reject(data);
                console.log(data);
            });
            return d.promise;
        } else {
            return false;
        }
    }

    $scope.saveQuestion = function(question, editText) {       
        var d = $q.defer();
        Question.update(question, editText).success(function(data, status, header) {
            d.resolve(data);
            if(data.success){
                $scope.getQuestions();
                $scope.results = data.message;
            } else {
                var errors = [
                    data.message.type_id, 
                    data.message.subject_id, 
                    data.message.question, 
                    data.message.opt_one, 
                    data.message.opt_two,
                    data.message.opt_three,
                    data.message.opt_four,
                    data.message.answer
                ];
                for(var i=0;errors.length > i;i++) {
                    $scope.results = '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;<b>' + errors.join('&nbsp;') + '</b><a href="#" class="close">&times;</a></div>';
                }                       
            }                                  
            $timeout(function() {$scope.results = '';}, 10000);
        }).error(function(data, status, header) {
            d.reject(data);
            console.log(data);
        });
        return d.promise;
    }

    
}])
.controller('ItemsCtrl', ['Question', 'Item', '$scope', '$rootScope', '$http', '$q', '$timeout', function(Question, Item, $scope, $rootScope, $http, $q, $timeout) {
    $rootScope.loadItems = true;
    $rootScope.loadQuestions = true;
  
    $scope.getItems = function(sid, id) {
        Item.get(sid, id).success(function(data) {
            $scope.items = data;
            $scope.items.length > 0 ? $scope.itemsAvailable = true : $scope.itemsAvailable = false;
            $rootScope.loadItems = false;
        });  
    }

    $scope.getQuestions = function(id) {
        Question.getBySubject(id).success(function(data) {
            $scope.questions = data;
            $scope.questions.length > 0 ? $scope.questionsAvailable = true : $scope.questionsAvailable = false;
            $rootScope.loadQuestions = false;

        });   
    }



    $scope.createItem = function(question_id, subjquiz_id, subject_id) {
        var d = $q.defer();
        Item.create(question_id, subjquiz_id, subject_id).success(function(data, status, header) {
            d.resolve(data);
            if(data.success){
                $scope.getItems(subject_id, subjquiz_id);                    
                $scope.showAddSubject = !$scope.showAddSubject;
                $scope.results = data.message;
            } else {
                var errors = [data.message.subjquiz_id, data.message.question_id];
                for(var i=0;errors.length > i;i++) {
                    $scope.results = '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;<b>' + errors.join('&nbsp;') + '</b><a href="#" class="close">&times;</a></div>';
                }                 
            }    
            console.log(data);                           
            $timeout(function() {$scope.results = '';}, 10000);
        }).error(function(data, status, header) {
            d.reject(data);
            console.log(data);
        });
        return d.promise;
    }

    $scope.deleteItem = function(id, subject_id, subjquiz_id) {
        conf = window.confirm("Are you sure you want to delete this?");
        if(conf) {
            var d = $q.defer();
            Item.destroy(id).success(function(data, status, header) {
                d.resolve(data);
                $scope.results = data.message;
                $scope.getItems(subject_id, subjquiz_id);
                $timeout(function() {$scope.results = '';}, 10000);
            }).error(function(data, status, header) {
                d.reject(data);
                console.log(data);
            });
            return d.promise;
        } else {
            return false;
        }
    }

    // $scope.getQuestionsBySubject = function(id) {
    //     Question.getBySubject(id).success(function(data) {
    //     for(var i=0; i<data.length;i++) {
    //         data[i].created_at = new Date(data[i].created_at.replace(/-/g,"/"));
    //         data[i].updated_at = new Date(data[i].updated_at.replace(/-/g,"/"));
    //     }

    //     $scope.questions = data;
    //     $rootScope.loadQuestions = false;
    //     });
    // }

}])
.controller('TakeAQuizCtrl', ['TakeAQuiz', '$scope', '$rootScope', '$http', function(TakeAQuiz, $scope, $rootScope, $http) {
    $rootScope.loadQuizzes = true;
    $scope.getTakeAQuiz = function() {
        TakeAQuiz.get().success(function(data) {
            $scope.takeaquiz = data;
            $rootScope.loadQuizzes = false;
        });
    }
}])
.controller('StudentCtrl', ['$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {
    $scope.showRegister = false;
}])
.controller('SubjectCtrl', ['$scope', '$rootScope', '$http', 'Subject', '$q', '$timeout', function($scope, $rootScope, $http, Subject, $q, $timeout) {
    $scope.showAddSubject = false;
    $rootScope.loadSubjects = true;
  
    $scope.getSubjects = function() {
        Subject.get().success(function(data) {
            $scope.subjects = data;
            $rootScope.loadSubjects = false;
        });
    }
    $scope.getSubjects();

    $scope.edit = false; //$scope.newField = {}; 

    $scope.createSubject = function(code, description) {
        var d = $q.defer();
        Subject.create(code, description).success(function(data, status, header) {
            d.resolve(data);
            if(data.success){
                $scope.getSubjects();                    
                $scope.showAddSubject = !$scope.showAddSubject;
                $scope.results = data.message;
            } else {
                var errors = [data.message.add_subj_code, data.message.add_subj_description];
                for(var i=0;errors.length > i;i++) {
                    $scope.results = '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;<b>' + errors.join('&nbsp;') + '</b><a href="#" class="close">&times;</a></div>';
                }
                $scope.showAddSubject = !$scope.showAddSubject;                    
            }                               
            $timeout(function() {$scope.results = '';}, 10000);
        }).error(function(data, status, header) {
            d.reject(data);
            console.log(data);
        });
        return d.promise;  
    }

    $scope.editSubject = function(subject) {
        $scope.edit = $scope.subjects.indexOf(subject); //$scope.newField = angular.copy(subject);
    }
    /* $scope.saveField = function(index) {if($scope.edit !== false) {$scope.subjects[$scope.edit] = $scope.newField;$scope.edit = false; }}$scope.cancel = function(index) {if($scope.edit !== false) {$scope.subjects[$scope.edit] = $scope.newField;$scope.edit = false;}}*/

    $scope.saveSubject = function(id, code, description) {       

        var d = $q.defer();
        Subject.update(id, code, description).success(function(data, status, header) {
            d.resolve(data);
            if(data.success){
                $scope.getSubjects();
                $scope.results = data.message;
            } else {
                var errors = [data.message.subj_code, data.message.subj_description];
                for(var i=0;errors.length > i;i++) {
                    $scope.results = '<div data-alert class="alert-box alert radius"><i class="fi-alert size-72"></i>&nbsp;<b>' + errors.join('&nbsp;') + '</b><a href="#" class="close">&times;</a></div>';
                }
            }
            $timeout(function() {$scope.results = '';}, 10000);
        }).error(function(data, status, header) {
            d.reject(data);
            console.log(data);
        });
        return d.promise;
    
    }

    $scope.deleteSubject = function(id) {
        conf = window.confirm("Are you sure you want to delete this?");
        if(conf) {
            var d = $q.defer();
            Subject.destroy(id).success(function(data, status, header) {
                d.resolve(data);
                $scope.results = data.message;
                $scope.getSubjects();
                $timeout(function() {$scope.results = '';}, 10000);
            }).error(function(data, status, header) {
                d.reject(data);
                console.log(data);
            });
            return d.promise;
        } else {
            return false;
        }
    }

}]);