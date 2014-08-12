<div class="fixed">
    <nav class="top-bar" data-topbar>
        <ul class="title-area">
            <li class="name">
                <a href="/dashboard">
                    <img id="logo" src="/assets/img/plptag-blurred.png"/>
                <span id="headertitle">Quiz Module
                </span>
                </a>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>

        </ul>

        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                <li class="has-form">
                    <div class="row collapse">
                        <div class="large-8 small-9 columns">
                            <input type="text" placeholder="Find Stuff">
                        </div>
                        <div class="large-4 small-3 columns">
                            <a href="#" class="alert button expand"><i class="step fi-magnifying-glass size-72"></i></a>
                        </div>
                    </div>
                </li>

                @include('dashboard._authdropdown')

            </ul>
        </section>
    </nav>
</div>