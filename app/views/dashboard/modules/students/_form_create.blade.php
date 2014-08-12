<form data-abide="data-abide" method="POST" action="/dashboard/students" accept-charset="UTF-8" data-ng-show="showRegister">
	{{ Form::token() }}
	<div class="row">
		<div class="small-12 medium-6 large-6 large-centered medium-centered columns">
			<div class="text-field">
				<label>Student No. <small>required</small>
				<i class="step fi-clipboard-notes right size-72"></i>
				<input type="text" pattern="[0-9]{2}-[0-9]{4}([0-9]{1})?" name="register_studentno" placeholder="e.g. 14-0000">
				</label>
				<small class="error">Student No.</small>
			</div>
			<div class="email-field">
		        <label for="email">Email <i class="step fi-clipboard-notes right size-72"></i>
		          <input type="email" name="register_email" placeholder="vrigz@gmail.com">
		        </label>
		        <small class="error">Valid email required.</small>
	      </div>
			<div class="password-field">
				<label>Password <small>required</small>
				<input type="password" name="password">
				</label>
				<small class="error">Password</small>
			</div>
			<div class="password-field">
				<label>Confirm Password <small>required</small>
				<input type="password" name="password_confirmation">
				</label>
				<small class="error">Confirm Password</small>
			</div>
			<div class="text-field">
				<label>Last Name <small>required</small>
				<i class="step fi-clipboard-notes right size-72"></i>
				<input type="text" name="register_lastname" placeholder="e.g. Dela Cruz">
				</label>
				<small class="error">Last Name</small>
			</div>
			<div class="text-field">
				<label>First Name <small>required</small>
				<i class="step fi-clipboard-notes right size-72"></i>
				<input type="text" name="register_firstname" placeholder="e.g. Juan">
				</label>
				<small class="error">First Name</small>
			</div>
			<div class="text-field">
				<label>Middle Initial <small>required</small>
				<i class="step fi-clipboard-notes right size-72"></i>
				<input type="text" name="register_mi" placeholder="e.g. M" maxlength="3">
				</label>
				<small class="error">Middle Initial</small>
			</div>
			<div class="select-field">
				<label>Level <small>required</small>
					<select id="levelsList" name="register_level" required>
					<option value="none">Select level</option>
					@foreach(Level::all() as $level)
						<option value="{{ $level->id }}">{{ $level->level }}</option>
					@endforeach
					</select>
				</label>
				<small class="error">Level</small>
			</div>
			<div class="select-field" id="sectionsField" style="display:none;">
				<label>Section <small>required</small>
       				<select id="sectionsList" name="register_section">
       				</select>
				</label>
				<small class="error">Section</small>
			</div>		
			<add-reset-cancel toggled="showRegister"></add-reset-cancel>
		</div>
	</div>
	<hr>
</form>