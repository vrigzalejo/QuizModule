<aside class="left-off-canvas-menu">
    <ul class="off-canvas-list">
        <li><label>Menu</label></li>
        @if( Sentry::findUserByID(Sentry::getUser()->id)->hasAccess('system.student') )
            <li><a href="/dashboard/takeaquiz"><i class="step fi-list-number size-72"></i>&nbsp;Take a Quiz</a></li>
        @endif
        @if( Sentry::findUserByID(Sentry::getUser()->id)->hasAccess('system.prof') )
            <li><a href="/dashboard/quizzes"><i class="step fi-list size-72"></i>&nbsp;Quizzes</a></li>
            <li><a href="/dashboard/questions"><i class="step fi-clipboard-pencil size-72"></i>&nbsp;Questions</a></li>
            <li><a href="/dashboard/subjects"><i class="step fi-page-multiple size-72"></i>&nbsp;Subjects</a></li>
            <li><a href="/dashboard/students"><i class="step fi-torso-business size-72"></i>&nbsp;Students</a></li>
            <li><a href="/dashboard/reports"><i class="step fi-print size-72"></i>&nbsp;Reports</a></li>
            <li><a href="/dashboard/users"><i class="step fi-social-myspace size-72"></i>&nbsp;Users</a></li>
            <li><a href="/dashboard/settings"><i class="step fi-wrench size-72"></i>&nbsp;Settings</a></li>
        @endif

    </ul>
</aside>