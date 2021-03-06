<header class="header header-transparent header-waterfall">
    <ul class="nav nav-list pull-left hidden-md hidden-lg">
        <li>
            <a data-toggle="menu" href="#ui_menu">
                <span class="material-icons material-icons-lg">menu</span>
                <span class="header-logo header-affix-hide margin-left-no margin-right-no" data-offset-top="213" data-spy="affix">
                    YSITD Cloud
                </span>
            </a>
        </li>
    </ul>
    <span class="header-logo header-affix margin-left-no margin-right-no" data-offset-top="213" data-spy="affix">
        @yield('title')
    </span>
    <ul class="nav nav-list pull-right">
        <li class="dropdown margin-right">
            <a class="dropdown-toggle padding-left-no padding-right-no" data-toggle="dropdown">
                <span class="access-hide">User</span>
                <span class="avatar avatar-sm">
                    <img alt="User Icon" src="{{$user->logo or '/images/user.png'}}" class="user-logo">
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li>
                    <a class="padding-right-lg waves-attach" href="/user/profile">
                        <span class="material-icons material-icons-lg margin-right">account_box</span>
                        Profile
                    </a>
                </li>
                <li>
                    <a class="padding-right-lg waves-attach" href="/signout">
                        <span class="material-icons material-icons-lg margin-right">exit_to_app</span>
                        Sign Out
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</header>