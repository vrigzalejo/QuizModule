@extends('dashboard.dashboard')

@section('module.styles')
<link rel="stylesheet" href="/css/foundation-datepicker.css" />
@stop


@section('module.contents')
<form data-abide="data-abide">
	<div class="row">

		<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
			<div class="select-field">
				<label>Item / Meal <small>required</small><a href="#" data-tooltip data-options="disable_for_touch:true" class="right has-tip tip-bottom radius" 
					title="<ul class='no-bullet'>
					<li><b>Tooltips</b></li> 
					<li>are awesome</li>
				</ul>">&nbsp;<i class="step fi-clipboard-notes size-72"></i></a>
				<a href="#" class="right">New</a>
				<select name="item_meals" required>
					<option value=''></option>
				</select>

			</label>
			<small class="error">Enter item / meal.</small>
		</div>
		<div class="select-field">
			<label>Received by <small>required</small><a href="#" data-tooltip data-options="disable_for_touch:true" class="right has-tip tip-bottom radius" 
				title="<ul class='no-bullet'>
				<li><b>Tooltips</b></li> 
				<li>are awesome</li>
			</ul>">&nbsp;<i class="step fi-clipboard-notes size-72"></i></a>
			<a href="#" class="right">New</a>
			<select name="receivedby" required>
				<option value=''></option>
			</select>
		</label>
		<small class="error">Enter received by.</small>
	</div>
	<div class="date-field">
		<label>Date received <small>required</small>
			<input type="date" id="datepicker" data-date-format="yyyy-mm-dd" required>
		</label>
		<small class="error">Enter date.</small>
	</div>
	<div class="text-field">
		<label>APR PO</label>
		<input type="text" name="apr-po" placeholder="e.g. APR-1122">
	</div>
	<div class="number-field">
		<label>Receipts 
			<input type="number" name="qty"  min="0">
		</label>
	</div>
	<div class="number-field">
		<label>Quantity <small>required</small>
			<input type="number" name="qty"  min="0" required>
		</label>
		<small class="error">Enter quantity.</small>
	</div>
	<div class="button-bar right">
		<ul class="button-group round">
			<li>
				<button class="button large" type="submit">Add</button>
			</li>
			<li>
				<button class="button large" type="reset">Reset</button>
			</li>
		</ul>
	</div>
</div>

</div>
</form>
@stop


@section('module.scripts')
<script type="text/javascript" src="/js/foundation/foundation.abide.js"></script>
<script type="text/javascript" src="/js/foundation/foundation.tooltip.js"></script>
<script type="text/javascript" src="/js/foundation/foundation-datepicker.js"></script>
<script type="text/javascript">
	$('#datepicker').fdatepicker('setDate', new Date());
	$(document).foundation();
</script>
@stop