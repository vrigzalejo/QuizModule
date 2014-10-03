<form data-abide="data-abide" accept-charset="UTF-8" data-ng-submit="createItem(add_item, {{{ $subjquiz->id }}}, {{{ $subjquiz->subject_id }}})">
	<div class="row">

		<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
			<h3 class="subheader">
				<small>Quiz Name ( {{{ $subjquiz->subject->subj_code }}} ): </small>
				{{{ $subjquiz->name }}} 
			</h3>
			<div class="row collapse postfix-round"  data-ng-show="questionsAvailable">

				<div class="small-9 columns">
					<div class="select-field">

						<select data-ng-model="add_item">
							<option value="">Choose Question</option>
							<option data-ng-value="q.id" data-ng-repeat="q in questions"><%q.question %> [ Answer: <%q.answer %> ] </option>
						</select>

						<small class="error">Question </small>
					</div>
				</div>
				<div class="small-3 columns">			
					<button type="submit" class="button postfix">Add</button>
				</div>

			</div>


		</div>
	</div>
	<hr>
</form>