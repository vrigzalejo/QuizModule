<form id="formQuestion" data-abide="data-abide" enctype="multipart/form-data" data-ng-submit="createQuestion(add, check, image)" accept-charset="UTF-8" data-ng-show="showAddQuestion">
	<div class="row">
		{{ Form::token() }}
		<load-bubble model="types" root-scope-model="loadTypes"></load-bubble>
		<load-bubble model="subjects" root-scope-model="loadSubjects"></load-bubble>
		<create-subjects-link model="types" available="typesAvailable"></create-subjects-link>
		<create-subjects-link model="subjects" available="subjectsAvailable"></create-subjects-link>

		<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
			<div class="select-field" data-ng-show="typesAvailable">
				<label>Type <small>required</small>
					<i class="step fi-clipboard-notes right size-72"></i>
					<select data-ng-model="add.question_type">
						<option value="">Choose Type</option>
						<option data-ng-value="t.id" data-ng-repeat="t in types"><% t.value %></option>
					</select>
				</label>
				<small class="error">Type</small>
			</div>
			<div class="select-field" data-ng-show="subjectsAvailable">
				<label>Subject <small>required</small>
					<i class="step fi-clipboard-notes right size-72"></i>
					<select data-ng-model="add.question_subj">
						<option value="">Choose Subject</option>
						<option data-ng-value="s.id" data-ng-repeat="s in subjects"><% s.subj_code %> - <%s.subj_description %></option>
					</select>
				</label>
				<small class="error">Subject</small>
			</div>
			<div class="text-field">
				<label>Question <small>required</small>
					<div class="row">
						<div class="medium-10 columns">			
							<textarea data-ng-model="add.question_ques" placeholder="e.g. Who's your look a like celebrity?" required></textarea>      
						</div>

						<div class="medium-2 columns">
							<label class="right">

								<input type="checkbox" data-ng-model="check">
								<small>Add Image</small>
							</label>
						</div>
					</div>				
				</label>
				<small class="error">Question</small>
			</div>
			<div class="text-field">
				<label>Option 1 <small>required</small>
					<div class="row">
						<div class="medium-10 columns">			
							<textarea data-ng-model="add.opt1" placeholder="e.g. Coco Martin" data-ng-hide="check"required></textarea>

							<input type="file" accept="image/*" data-ng-show="check" image="image.opt1" resize-max-height="350" resize-max-width="350" resize-quality="1" />

						</div>
					</div>				
				</label>
				<small class="error">Option 1</small>
			</div>
			<div class="text-field">
				<label>Option 2 <small>required</small>
					<div class="row">
						<div class="medium-10 columns">			
							<textarea data-ng-model="add.opt2" placeholder="e.g.  Aljur" data-ng-hide="check" required></textarea>

							<input type="file" accept="image/*" data-ng-show="check" image="image.opt2" resize-max-height="350" resize-max-width="350" resize-quality="1" />       
						</div>
					</div>				
				</label>
				<small class="error">Option 2</small>
			</div>
			<div class="text-field">
				<label>Option 3 <small>required</small>
					<div class="row">
						<div class="medium-10 columns">			
							<textarea data-ng-model="add.opt3" placeholder="e.g.  Mateo" data-ng-hide="check" required></textarea>

							<input name="opt_three_img" type="file" accept="image/*" data-ng-show="check" image="image.opt3" resize-max-height="350" resize-max-width="350" resize-quality="1" />

						</div>
					</div>				
				</label>
				<small class="error">Option 3</small>
			</div>
			<div class="text-field">
				<label>Option 4 <small>required</small>
					<div class="row">
						<div class="medium-10 columns">			
							<textarea data-ng-model="add.opt4" placeholder="e.g.  All of the above" data-ng-hide="check" required></textarea>

							<input type="file" accept="image/*" data-ng-show="check" image="image.opt4" resize-max-height="350" resize-max-width="350" resize-quality="1" />
						</div>
					</div>				
				</label>
				<small class="error">Option 4</small>
			</div>
			<div class="text-field">
				<label>Answer <small>required</small>
					<div class="row">
						<div class="medium-10 columns">
							<label>			 
								<input type="radio" data-ng-model="add.question_ans" value="<% add.opt1 %>" data-ng-if="!check || check == undefined"/>
								<input type="radio" data-ng-model="image.question_ans" value="<% image.opt1.resized.dataURL %>" data-ng-if="check"/>&nbsp;Option 1&nbsp;

								<div class="th radius" data-ng-show="image.opt1" data-ng-if="check">
									<img data-ng-src="<% image.opt1.resized.dataURL %>" />
								</div>

								<span data-ng-if="!check || check == undefined">
									<% add.opt1 %></span>
								</label>
							<label>
								<input type="radio" data-ng-model="add.question_ans" value="<% add.opt2 %>" data-ng-if="!check || check == undefined"/>
								<input type="radio" data-ng-model="image.question_ans" value="<% image.opt2.resized.dataURL %>" data-ng-if="check"/>&nbsp;Option 2&nbsp;

								<div class="th radius" data-ng-show="image.opt2" data-ng-if="check">
									<img data-ng-src="<% image.opt2.resized.dataURL %>"/>
								</div>					      
								<span data-ng-if="!check || check == undefined">
									<% add.opt2 %></span>
								</label>
							<label>
								<input type="radio" data-ng-model="add.question_ans" value="<% add.opt3 %>" data-ng-if="!check || check == undefined"/>
								<input type="radio" data-ng-model="image.question_ans" value="<% image.opt3.resized.dataURL %>" data-ng-if="check"/>&nbsp;Option 3&nbsp;

								<div class="th radius" data-ng-show="image.opt3" data-ng-if="check">
									<img data-ng-src="<% image.opt3.resized.dataURL %>"/>
								</div>

								<span data-ng-if="!check || check == undefined">
									<% add.opt3 %></span>
							</label>
							<label>
								<input type="radio" data-ng-model="add.question_ans" value="<% add.opt4 %>" data-ng-if="!check || check == undefined"/>
								<input type="radio" data-ng-model="image.question_ans" value="<% image.opt4.resized.dataURL %>" data-ng-if="check"/>&nbsp;Option 4&nbsp;

								<div class="th radius" data-ng-show="image.opt4" data-ng-if="check">
									<img data-ng-src="<% image.opt4.resized.dataURL %>"/>
								</div>

								<span data-ng-if="!check || check == undefined">
									<% add.opt4 %></span>
							</label>
						</div>	
					</div>		
				</label>
			<small class="error">Answer</small>
		</div>

		<div class="button-bar right">
			<ul class="button-group round">
				<li>
					<button class="button tiny" type="submit">Add</button>
				</li>
				<li>
					<button class="button tiny" type="reset" data-ng-click="reset()">Reset</button>
				</li>
				<li>
					<button class="button tiny" data-ng-click="showAddQuestion = false;">Cancel</button>
				</li>
			</ul>
		</div>

		</div>
	</div>
	<hr>
</form>