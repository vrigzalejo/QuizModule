<form data-abide="data-abide" accept-charset="UTF-8" data-ng-show="showAddQuiz" data-ng-submit="createSubjquiz(add_quiz_name, add_quiz_subject)">
	<div class="row">
		
      	<load-bubble model="subjects" root-scope-model="loadSubjects"></load-bubble>
    	<create-subjects-link model="subjects" available="subjectsAvailable"></create-subjects-link>
		
		<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
			<div class="text-field">
				<label>Quiz Name <small>required</small>
				<i class="step fi-clipboard-notes right size-72"></i>
				<input type="text" data-ng-model="add_quiz_name" placeholder="e.g. Pre-test July 2014" required>
				</label>
				<small class="error">Quiz Name </small>
			</div>
			<div class="select-field" data-ng-show="subjectsAvailable">
				<label>Subject <small>required</small>
				<i class="step fi-clipboard-notes right size-72"></i>
				<select data-ng-model="add_quiz_subject">
					<option value="">Choose Subject</option>
					<option data-ng-value="s.id" data-ng-repeat="s in subjects"><% s.subj_code %> - <%s.subj_description %></option>
				</select>
				</label>
				<small class="error">Subject </small>
			</div>
			
			<add-reset-cancel toggled="showAddQuiz"></add-reset-cancel>
		</div>
	</div>
	<hr>
</form>