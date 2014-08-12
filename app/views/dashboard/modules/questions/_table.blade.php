<table class="columns large-centered medium-centered responsive">
	<thead>
		<tr>
			<th><a data-ng-click="predicate='value';reverse=!reverse">Type</a></th>
			<th><a data-ng-click="predicate='subj_code';reverse=!reverse">Subject</a></th>
			<th><a data-ng-click="predicate='question';reverse=!reverse">Question</a></th>
			<th><a data-ng-click="predicate='opt_one';reverse=!reverse">Option 1</a></th>
			<th><a data-ng-click="predicate='opt_two';reverse=!reverse">Option 2</a></th>
			<th><a data-ng-click="predicate='opt_three';reverse=!reverse">Option 3</a></th>
			<th><a data-ng-click="predicate='opt_four';reverse=!reverse">Option 4</a></th>
			<th><a data-ng-click="predicate='answer';reverse=!reverse">Answer</a></th>
			<th width="150px"></th>
		</tr>
	</thead>
	<tbody data-ng-repeat="question in (questions | filter:search | orderBy:predicate:reverse)">
		<tr>
			<td>
				<span data-ng-hide="editMode"><% question.value | cut:true:10:'...' %></span>
				<select data-ng-show="editMode" data-ng-model="question.value" data-ng-options="type.value as type.value for type in types">
				</select>
			</td>
			<td>
				<span data-ng-show="question.subj_code == NULL">No Subject</span>
				<span data-ng-hide="editMode"><% question.subj_code | cut:true:10:'...' %></span>
				<select data-ng-show="editMode" data-ng-model="question.subj_code" data-ng-options="subject.subj_code as subject.subj_code for subject in subjects">
				</select>
			</td>
			<td>
				<span data-ng-hide="editMode"><% question.question | cut:true:10:'...' %></span>
				<textarea data-ng-show="editMode" data-ng-model="question.question" required></textarea>
			</td>
			<td>
				<span data-ng-hide="editMode || question.is_img == 1"><% question.opt_one | cut:true:10:'...' %></span>
				<div class="th radius" data-ng-if="!editMode && question.is_img == 1;">
					<a href="/assets/photos/<% question.opt_one %>" data-lightbox="Option 1" data-title="<% question.opt_one %>"><img data-ng-src="/assets/photos/<% question.opt_one %>" width="50px" height="50px"/></a>					
				</div>

				<textarea data-ng-show="editMode && question.is_img == 0" data-ng-model="question.opt_one" required></textarea>

				<div class="th radius" data-ng-show="editImage.opt_one" data-ng-if="editMode && question.is_img == 1">
					<img data-ng-src="<% editImage.opt_one.resized.dataURL %>" />
				</div>

				<input id="imageEdit" data-ng-show="editMode && question.is_img == 1" type="file" accept="image/*" image="editImage.opt_one" resize-max-height="350" resize-max-width="350" resize-quality="1" />

			</td>
			<td>
				<span data-ng-if="!editMode && question.is_img == 0"><% question.opt_two | cut:true:10:'...' %></span>
				<div class="th radius" data-ng-if="!editMode && question.is_img == 1;">
					<a href="/assets/photos/<% question.opt_two %>" data-lightbox="Option 2" data-title="<% question.opt_two %>"><img data-ng-src="/assets/photos/<% question.opt_two %>" width="50px" height="50px"/></a>
				</div>

				<textarea data-ng-if="editMode && question.is_img == 0" data-ng-model="question.opt_two" required></textarea>

				<input data-ng-if="editMode && question.is_img == 1" type="file" accept="image/*" image="question.opt_two" resize-max-height="350" resize-max-width="350" resize-quality="1" />
			</td>
			<td>
				<span data-ng-if="!editMode && question.is_img == 0"><% question.opt_three | cut:true:10:'...' %></span>
				<div class="th radius" data-ng-if="!editMode && question.is_img == 1;">
					<a href="/assets/photos/<% question.opt_three %>" data-lightbox="Option 3" data-title="<% question.opt_three %>"><img data-ng-src="/assets/photos/<% question.opt_three %>" width="50px" height="50px"/></a>
				</div>

				<textarea data-ng-if="editMode && question.is_img == 0" data-ng-model="question.opt_three" data-ng-required></textarea>

				<input data-ng-if="editMode && question.is_img == 1" type="file" accept="image/*" image="question.opt_three" resize-max-height="350" resize-max-width="350" resize-quality="1" />
			</td>
			<td>
				<span data-ng-if="!editMode && question.is_img == 0"><% question.opt_four | cut:true:10:'...' %></span>
				<div class="th radius" data-ng-if="!editMode && question.is_img == 1;">
					<a href="/assets/photos/<% question.opt_four %>" data-lightbox="Option 4" data-title="<% question.opt_four %>"><img data-ng-src="/assets/photos/<% question.opt_four %>" width="50px" height="50px"/></a>
				</div>

				<textarea data-ng-if="editMode && question.is_img == 0" data-ng-model="question.opt_four" data-ng-required></textarea>

				<input data-ng-if="editMode && question.is_img == 1" type="file" accept="image/*" image="question.opt_four" resize-max-height="350" resize-max-width="350" resize-quality="1" />
			</td>
			<td>
				<span data-ng-hide="editMode || question.is_img == 1;"><% question.answer | cut:true:10:'...' %></span>
				<div class="th radius" data-ng-if="!editMode && question.is_img == 1;">
					<a href="/assets/photos/<% question.answer %>" data-lightbox="Answer" data-title="<% question.answer %>"><img data-ng-src="/assets/photos/<% question.answer %>" width="50px" height="50px"/></a>
				</div>

				<label data-ng-if="editMode">			 
					<input type="radio" data-ng-model="editText.question_ans" value="<% question.opt_one %>" data-ng-if="question.is_img == 0;"/>
					<input type="radio" data-ng-model="editImage.question_ans" value="<% editImage.opt_one.resized.dataURL %>" data-ng-if="question.is_img == 1;"/>&nbsp;1&nbsp;
				</label>
				<label data-ng-if="editMode">
					<input type="radio" data-ng-model="editText.question_ans" value="<% question.opt_two %>" data-ng-if="question.is_img == 0;"/>
					<input type="radio" data-ng-model="editImage.question_ans" value="<% editImage.opt_two.resized.dataURL %>" data-ng-if="question.is_img == 1;"/>&nbsp;2&nbsp;
				</label>
				<label data-ng-if="editMode">
					<input type="radio" data-ng-model="editText.question_ans" value="<% question.opt_three %>" data-ng-if="question.is_img == 0;"/>
					<input type="radio" data-ng-model="editImage.question_ans" value="<% editImage.opt_three.resized.dataURL %>" data-ng-if="question.is_img == 1;"/>&nbsp;3&nbsp;
				</label>
				<label data-ng-if="editMode">
					<input type="radio" data-ng-model="editText.question_ans" value="<% question.opt_four %>" data-ng-if="question.is_img == 0;"/>
					<input type="radio" data-ng-model="editImage.question_ans" value="<% editImage.opt_four.resized.dataURL %>" data-ng-if="question.is_img == 1;"/>&nbsp;4&nbsp;
				</label>
			</td>
			<td>
				<div class="button-bar right">
					<ul class="button-group">
						<li>
							<a class="button success tiny" data-ng-show="editMode" data-ng-click="editMode = false; saveSubject(subject.id, subject.subj_code, subject.subj_description)"><i class="fi-save size-72"></i></a>
						</li>
						<li>
							<a class="button tiny" data-ng-hide="editMode" data-ng-click="editMode = true; editQuestion(question)"><i class="fi-clipboard-pencil size-72"></i></a>
						</li>
						<li>
							<a class="button alert tiny" data-ng-click="deleteSubject(subject.id)"><i class="fi-trash size-72"></i></a>
						</li>
						<li>
							<a class="button alert tiny" data-ng-show="editMode" data-ng-click="editMode = false; editImage = undefined;"><i class="fi-x size-72"></i></a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
	</tbody>
</table>
<load-bubble model="questions" root-scope-model="loadQuestions"></load-bubble>
<no-records-row model="questions" caption="Questions"></no-records-row>