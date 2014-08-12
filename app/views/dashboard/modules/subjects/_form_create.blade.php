<form data-abide="data-abide" accept-charset="UTF-8" data-ng-show="showAddSubject" data-ng-submit="createSubject(add_subj_code, add_subj_description)">
	<div class="row">
		<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
			<div class="text-field">
				<label>Subject Code <small>required</small>
				<i class="step fi-clipboard-notes right size-72"></i>
				<input type="text" data-ng-model="add_subj_code" placeholder="e.g. PE101" required>
				</label>
				<small class="error">Subject Code</small>
			</div>
			<div class="text-field">
				<label>Description <small>required</small>
				<i class="step fi-clipboard-notes right size-72"></i>
				<input type="text" data-ng-model="add_subj_description" placeholder="e.g. Physical Education: Dancing" required>
				</label>
				<small class="error">Description</small>
			</div>
			
			<add-reset-cancel toggled="showAddSubject"></add-reset-cancel>
		</div>
	</div>
	<hr>
</form>