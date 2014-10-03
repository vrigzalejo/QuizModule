<table class="columns large-centered medium-centered responsive">
  <thead>
    <tr>
      <th><a data-ng-click="predicate='name';reverse=!reverse">Quiz Name</a></th>
      <th><a data-ng-click="predicate='subj_code';reverse=!reverse">Subject</a></th>
      <th><a data-ng-click="predicate='subjquiz_items';reverse=!reverse">Items</a></th>
	  <th><a data-ng-click="predicate='time';reverse=!reverse">Time</a></th>
	  <th></th>
    </tr>
  </thead>
  <tbody data-ng-repeat="takeaquiz in (takeaquizzes | filter:search | orderBy:predicate:reverse)">
    <tr>
      <td>
	      <a href="/dashboard/quizzes/<% takeaquiz.id %>">
		      <span><% takeaquiz.name %></span>
	      </a>
      </td>
      <td>
      	<span data-ng-hide="editMode"><% takeaquiz.subj_code %></span>
      </td>
      <td>
      	<span data-ng-if="takeaquiz.subjquiz_items === '0'">No Items</span>
      	<span data-ng-if="takeaquiz.subjquiz_items !== '0'"><% takeaquiz.subjquiz_items %></span>
      </td>
      <td>
      	<span><i class="fi-clock size-72"></i></span>
      </td>
      <td>
      	<div class="button-bar right">
			<ul class="button-group">
				<li>
					<a class="button tiny" data-ng-hide="editMode" src="#"><i class="fi-clipboard-pencil size-72"></i> Take It</a>
					<a class="button tiny success disabled"><i class="fi-lock size-72"></i> Taken</a>
				</li>
			</ul>
		</div>
      </td>
    </tr>
  </tbody>	  	
</table>

<div class="row">
    <div class="small-12 medium-12 large-12 columns text-center"><br />
        <img src="/assets/img/under-construction.gif" alt="slide image">
    </div>
</div>

<load-bubble model="takeaquiz" root-scope-model="loadSubjquizzes"></load-bubble>
<no-records-row model="takeaquiz" caption="Quizzes"></no-records-row>