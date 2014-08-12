@extends('dashboard.dashboard')

@section('module.styles')
<link media="screen" rel="stylesheet" href="/assets/css/responsive-tables.css" />
@stop

@section('module.contents')
<div class="row" data-ng-controller="StudentCtrl" style="padding-top:1em;">
<div class="row">
	<div class="small-4 medium-2 large-2 small-centered large-centered medium-centered columns">
		<toggle-create caption="Student" toggled="showRegister"></toggle-create>
	</div>
</div>
 @if(Session::has('message') && Session::get('for') === 'register')
 <div class="row">
 	<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
	{{ Session::get('message') }}
	</div>
 </div>
 @endif
 @foreach($errors->all() as $error)
  <div class="row">
 	<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
      <div data-alert class="alert-box alert radius"><i class="fi-clipboard-pencil size-72"></i>&nbsp;{{ $error }}<a href="#" class="close">&times;</a></div>
    </div>
  </div>
 @endforeach

@include('dashboard.modules.students._form_create')

<div class="row">
    <div class="large-5 medium-5 columns large-centered medium-centered">
        <select id="levelsStudentList">
        <option value="none">Select Level</option>
        @foreach(Level::all() as $level)
		<option value="{{ $level->id }}">{{ $level->level }}</option>
		@endforeach
        </select>
        <select id="sectionsStudentList" style="display:none;">
        </select>        
    </div>
</div>
<div class="row">
	
@include('dashboard.modules.students._table')

</div>
</div>

@stop


@section('module.scripts')
<script type="text/javascript" src="/assets/js/vendors/foundation/foundation.abide.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/foundation.alert.js"></script>
<script type="text/javascript" src="/assets/js/vendors/foundation/responsive-tables.js"></script>

<script>
jQuery(function() {
	jQuery('#levelsList').on('change', function() {
		var value = jQuery(this).val(), sectionsList = jQuery('#sectionsList'), sectionsField = jQuery('#sectionsField');
		if(value=='none')
			sectionsField.hide();

		jQuery.ajax({
			type: 'GET',
			url: '/api/sections/'+value,
			dataType: 'json',
			success: function(data) {
				var options = {};

				options = "<option value='none'>Select section</option>";
				for(var i=0; i<data.length; i++) 
					options += "<option value='"+data[i].id+"'>"+data[i].section+"</option>";

				sectionsList.html(options);

				if(data.length != 0) {
					sectionsField.show();
					jQuery(this).change();
				} else 
					sectionsField.hide();
			}
		});
	});
	jQuery("#levelsStudentList").on('change', function() {
		var value = jQuery(this).val(), sectionsStudentList = jQuery('#sectionsStudentList'), tableStudentList = jQuery('#tableStudentList');

		if(value == 'none')
			sectionsStudentList.hide();tableStudentList.hide();

		jQuery.ajax({
			type: 'GET',
			url: '/api/sections/'+value,
			dataType: 'json',
			success:function(data) {
				var options = {};

				options = "<option value='none'>Select section</option>";
				for(var i=0; i<data.length; i++) 
					options += "<option value='"+data[i].id+"'>"+data[i].section+"</option>";

				sectionsStudentList.html(options);

				if(data.length != 0) {
					sectionsStudentList.show();
					jQuery(this).change();
				} else 
					sectionsStudentList.hide();tableStudentList.hide();
			}
		});


		
	});
	jQuery("#sectionsStudentList").on('change', function() {
		var value = jQuery(this).val();
		var tableStudentList = jQuery('#tableStudentList');

		if(value == 'none') {
			tableStudentList.hide();
		}
		jQuery.ajax({
			type: 'GET',
			url: '/api/students/'+value,
			dataType: 'json',
			success: function(data) {
				var row = {};

				for(var i=0; i<data.length; i++) {
					if(data[i].activated == 1) {
						var student_status = "<a href='#' data-id='"+data[i].user_id+"' class='button tiny round success'>Activated</a>";
					} else {
						var student_status = "<a href='#' data-id='"+data[i].user_id+"' class='button tiny round alert'>Not Activated</a>";
					}

					row += "<tr><td>"+data[i].studentno+"</td><td>"+data[i].email+"</td><td>"+data[i].lastname+", "+data[i].firstname+" "+data[i].mi+".</td><td>"+data[i].level+"-"+data[i].section+"</td><td></td><td>"+student_status+"</td></tr>";
				}
				tableStudentList.html(row);

				if(data.length != 0) {
					tableStudentList.show();
					jQuery(this).change();
				} else {
					row = "<tr><td colspan='6'><h1 class='text-center'>No Records</h1></td></tr>";
					tableStudentList.html(row);
					tableStudentList.show();
				}
			}
		});
	});
});
</script>
@stop