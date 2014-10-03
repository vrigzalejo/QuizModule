<table class="columns large-centered medium-centered responsive">
  <thead>
    <tr>
      <th><a data-ng-click="predicate='name';reverse=!reverse">Quiz Name</a></th>
      <th><a data-ng-click="predicate='subj_code';reverse=!reverse">Subject</a></th>
      <th><a data-ng-click="predicate='subjquiz_items';reverse=!reverse">Items</a></th>
      <th>Taken</th>
      <th><a data-ng-click="predicate='created_at';reverse=!reverse">Created</a></th>
      <th><a data-ng-click="predicate='updated_at';reverse=!reverse">Updated</a></th>
      <th></th>
    </tr>
  </thead>
  <tbody data-ng-repeat="subjquiz in (subjquizzes | filter:search | orderBy:predicate:reverse)">
    <tr>
      <td>
      <a data-ng-hide="editMode" href="/dashboard/quizzes/<% subjquiz.id %>">
	      <span><% subjquiz.name %></span>
      </a>
	      <input type="text" data-ng-show="editMode" data-ng-model="subjquiz.name" data-ng-required />
      </td>
      <td>
      	<span data-ng-if="subjquiz.subj_code == NULL">No Subject</span>
      	<span data-ng-hide="editMode"><% subjquiz.subj_code %></span>
		<select data-ng-show="editMode" data-ng-model="subjquiz.subj_code" data-ng-options="subject.subj_code as subject.subj_code for subject in subjects">
		</select>
      </td>
      <td>
      	<span data-ng-if="subjquiz.subjquiz_items === '0'">No Items</span>
      	<span data-ng-if="subjquiz.subjquiz_items !== '0'"><% subjquiz.subjquiz_items %></span>
      </td>
      <td>
      </td>
      <td>
      	<span><% subjquiz.created_at | date:'EEE, MMM d, yyyy h:mm a' | cut:true:20:'...' %></span>
      </td>
      <td>
      	<span><% subjquiz.updated_at | date:'EEE, MMM d, yyyy h:mm a' | cut:true:20:'...' %></span>
      </td>
      <td>
      	<div class="button-bar right">
			<ul class="button-group">
				<li>
					<a class="button success tiny" data-ng-show="editMode" data-ng-click="editMode = false; saveSubjquiz(subjquiz.id, subjquiz.name, subjquiz.subj_code)"><i class="fi-save size-72"></i></a>
				</li>
				<li>
					<a class="button tiny" data-ng-hide="editMode" data-ng-click="editMode = true; editSubjquiz(subjquiz)"><i class="fi-clipboard-pencil size-72"></i></a>
				</li>
				<li>
					<a class="button alert tiny" data-ng-click="deleteSubjquiz(subjquiz.id)"><i class="fi-trash size-72"></i></a>
				</li>
				<li>
					<a class="button alert tiny" data-ng-show="editMode" data-ng-click="editMode = false;"><i class="fi-x size-72"></i></a>
				</li>
			</ul>
		</div>
      </td>
    </tr>
  </tbody>	  	
</table>
<load-bubble model="subjquizzes" root-scope-model="loadSubjquizzes"></load-bubble>
<no-records-row model="subjquizzes" caption="Quizzes"></no-records-row>