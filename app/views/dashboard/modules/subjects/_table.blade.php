<table class="columns large-centered medium-centered responsive">
  <thead>
    <tr>
      <th><a data-ng-click="predicate='subj_code';reverse=!reverse">Subject Code</a></th>
      <th><a data-ng-click="predicate='subj_description';reverse=!reverse">Description</th>
      <th></th>
    </tr>
  </thead>
  <tbody data-ng-repeat="subject in (subjects | filter:search | orderBy:predicate:reverse)">
    <tr>
      <td>
	      <span data-ng-hide="editMode"><% subject.subj_code | uppercase %></span>

	      <input type="text" data-ng-show="editMode" data-ng-model="subject.subj_code" data-ng-required />
      </td>
      <td>
      	<span data-ng-hide="editMode"><% subject.subj_description %></span>
      	<input type="text" data-ng-show="editMode" data-ng-model="subject.subj_description" data-ng-required />
      </td>
      <td>
      	<div class="button-bar right">
			<ul class="button-group">
				<li><a class="button success tiny" data-ng-show="editMode" data-ng-click="editMode = false; saveSubject(subject.id, subject.subj_code, subject.subj_description)"><i class="fi-save size-72"></i></a></li>
				<li><a class="button tiny" data-ng-hide="editMode" data-ng-click="editMode = true; editSubject(subject)"><i class="fi-clipboard-pencil size-72"></i></a></li>
				<li><a class="button alert tiny" data-ng-click="deleteSubject(subject.id)"><i class="fi-trash size-72"></i></a></li>
				<li><a class="button alert tiny" data-ng-show="editMode" data-ng-click="editMode = false;"><i class="fi-x size-72"></i></a></li>
			</ul>
		</div>			
      </td>
    </tr>
   </tbody>
</table>
<load-bubble model="subjects" root-scope-model="loadSubjects"></load-bubble>
<no-records-row model="subjects" caption="Subjects"></no-records-row>