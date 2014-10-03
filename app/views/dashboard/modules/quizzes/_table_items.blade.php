<table class="columns large-centered medium-centered responsive">
  <thead>
    <tr>
      <th><a data-ng-click="predicate='#';reverse=!reverse">#</a></th>
      <th><a data-ng-click="predicate='value';reverse=!reverse">Type</a></th>
      <th><a data-ng-click="predicate='question';reverse=!reverse">Question</a></th>
      <th><a data-ng-click="predicate='opt_one';reverse=!reverse">Option 1</a></th>
      <th><a data-ng-click="predicate='opt_two';reverse=!reverse">Option 2</a></th>
      <th><a data-ng-click="predicate='opt_three';reverse=!reverse">Option 3</a></th>
      <th><a data-ng-click="predicate='opt_four';reverse=!reverse">Option 4</a></th>
      <th><a data-ng-click="predicate='answer';reverse=!reverse">Answer</a></th>
      <th></th>
    </tr>
  </thead>
  <tbody data-ng-repeat="item in (items | filter:search | orderBy:predicate:reverse)">
    <tr>
      <td>
        <span><% $index + 1 %></span>
      </td>
      <td>
        <span><% item.value | cut:true:10:'...' %></span>
      </td>
      <td>
        <span><% item.question | cut:true:10:'...' %></span>
      </td>
      <td>
        <span data-ng-hide="item.is_img == 1"><% item.opt_one | cut:true:10:'...' %></span>
        <div class="th radius" data-ng-if="item.is_img == 1;">
          <a href="/assets/photos/<% item.opt_one %>" data-lightbox="Option 1" data-title="<% item.opt_one %>"><img data-ng-src="/assets/photos/<% item.opt_one %>" width="50px" height="50px"/></a>          
        </div>
      </td>
      <td>
        <span data-ng-hide="item.is_img == 1"><% item.opt_two | cut:true:10:'...' %></span>
        <div class="th radius" data-ng-if="item.is_img == 1;">
          <a href="/assets/photos/<% item.opt_two %>" data-lightbox="Option 2" data-title="<% item.opt_two %>"><img data-ng-src="/assets/photos/<% item.opt_two %>" width="50px" height="50px"/></a>
        </div>
      </td>
      <td>
        <span data-ng-hide="item.is_img == 1"><% item.opt_three | cut:true:10:'...' %></span>
        <div class="th radius" data-ng-if="item.is_img == 1;">
          <a href="/assets/photos/<% item.opt_three %>" data-lightbox="Option 3" data-title="<% item.opt_three %>"><img data-ng-src="/assets/photos/<% item.opt_three %>" width="50px" height="50px"/></a>
        </div>
      </td>
      <td>
        <span data-ng-hide="item.is_img == 1"><% item.opt_four | cut:true:10:'...' %></span>
        <div class="th radius" data-ng-if="item.is_img == 1;">
          <a href="/assets/photos/<% item.opt_four %>" data-lightbox="Option 4" data-title="<% item.opt_four %>"><img data-ng-src="/assets/photos/<% item.opt_four %>" width="50px" height="50px"/></a>
        </div>
      </td>
      <td>
        <span data-ng-hide="item.is_img == 1;"><% item.answer | cut:true:10:'...' %></span>
        <div class="th radius" data-ng-if="item.is_img == 1;">
          <a href="/assets/photos/<% item.answer %>" data-lightbox="Answer" data-title="<% item.answer %>"><img data-ng-src="/assets/photos/<% item.answer %>" width="50px" height="50px"/></a>
        </div>
      </td>
      <td>
        <div class="button-bar right">
          <ul class="button-group">
            <li>
              <a class="button alert tiny" data-ng-click="deleteItem(item.id, {{{ $subjquiz->subject_id }}}, {{{ $subjquiz->id }}});"><i class="fi-trash size-72"></i></a>
            </li>
          </ul>
        </div>
      </td>
    </tr>
  </tbody>
</table>
<load-bubble model="items" root-scope-model="loadItems"></load-bubble>
<no-records-row model="items" caption="Items"></no-records-row>