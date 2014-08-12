angular.module('quizServices',['ngCookies'])
 // Set CSRF protection
.constant("CSRF_TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
.run(['$http', 'CSRF_TOKEN', function($http, CSRF_TOKEN) {
    $http.defaults.headers.common['X-CSRF-Token'] = CSRF_TOKEN;
}])
// Factories
.factory('Quiz', ['$http', 'CSRF_TOKEN', function($http, CSRF_TOKEN) {
    return {
        get: function() {
            return $http.get('/api/quizzes');
        },
        create: function(quiz_name, subject) {
            return $http({
                method: "POST",
                url: "/dashboard/quizzes",
                data: {"add_quiz_name":quiz_name,"add_quiz_subject":subject,"_token":CSRF_TOKEN}
            });
        },
        update: function(id, quiz_name, subject) {
            return $http({
                method: "POST",
                url: "/dashboard/quizzes/update",
                data: {'subjquiz_id':id,'subjquiz_name':quiz_name,'subjquiz_subject':subject,'_token':CSRF_TOKEN}
            });
        },
        destroy: function(id) {
            return $http({
                method: "POST",
                url: "/dashboard/quizzes/delete",
                data: {'subjquiz_id':id, '_token':CSRF_TOKEN}
            });
        }
    }
}])
.factory('Subject', ['$http', 'CSRF_TOKEN', function($http, CSRF_TOKEN) {
    return {
        get: function() {
            return $http.get('/api/subjects');
        },
        create: function(code, description) {
            return $http({
               method: "POST",
                url: "/dashboard/subjects",
                data: {"add_subj_code":code,"add_subj_description":description,"_token":CSRF_TOKEN}
            });
        },
        update: function(id, code, description) {
            return $http({
                method: "POST",
                url: "/dashboard/subjects/update",
                data: {'subj_id':id,'subj_code':code,'subj_description':description, '_token':CSRF_TOKEN}            });
        },
        destroy: function(id) {
            return $http({
                method: "POST",
                url: "/dashboard/subjects/delete",
                data: {'subj_id':id, '_token':CSRF_TOKEN}
            });
        }
    }
}])
.factory('Type', ['$http', 'CSRF_TOKEN', function($http, CSRF_TOKEN) {
    return {
        get: function() {
            return $http.get('/api/types');
        }
    }
}])
.factory('Question', ['$http', 'CSRF_TOKEN', function($http, CSRF_TOKEN) {
    return {
        get: function() {
            return $http.get('/api/questions');
        },
        create: function(add, check, image) {
            // Opt1-4 into arrays
            var opt = (check === undefined || check === false ? [add.opt1, add.opt2, add.opt3, add.opt4, add.question_ans, false] : [image.opt1.resized.dataURL, image.opt2.resized.dataURL, image.opt3.resized.dataURL, image.opt4.resized.dataURL, image.question_ans, true]);
            //console.log(opt);
            return $http({
                method: "POST",
                url: "/dashboard/questions",
                data: {
                    'type_id':add.question_type,
                    'subject_id':add.question_subj,
                    'question':add.question_ques,
                    'opt_one':opt[0],
                    'opt_two':opt[1],
                    'opt_three':opt[2],
                    'opt_four':opt[3],
                    'answer':opt[4],
                    'is_img':opt[5],
                    '_token':CSRF_TOKEN
                }
            });
        }
    }
}]);