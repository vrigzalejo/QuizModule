<li class="active has-dropdown">
    <a href="#">
        <img src="{{ Gravatar::src('Sentry::getUser()->email', 30) }}" id="circle-image">
        &nbsp;&nbsp;
         {{ Sentry::getUser()->studentno }} {{ Sentry::getUser()->first_name }} {{ Sentry::getUser()->last_name }}
     </a>
    <ul class="dropdown">
        <li><a href="/dashboard/signout"><i class="step fi-power size-72"></i>&nbsp;Logout</a></li>

    @if( Sentry::findUserByID(Sentry::getUser()->id)->hasAccess('system.prof') )

        <li class="divider"></li>
        <li><a href="/dashboard/signout"><i class="step fi-social-myspace size-72"></i>&nbsp;Manage Users</a></li>
        <li><a href="/dashboard/signout"><i class="step fi-wrench size-72"></i>&nbsp;Settings</a></li>

    @endif
    </ul>
</li>