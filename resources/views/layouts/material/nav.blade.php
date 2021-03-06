<nav id="ui_menu" class="menu menu-left nav-drawer nav-drawer-md default-nav">
    <div class="menu-scroll">
        <div class="menu-content">
            <a class="menu-logo" href="/">
                <span class="avatar"><img src="/images/logo.jpg" alt="YSITD"></span>
                YSITD Cloud
            </a>
            <ul class="nav">
                @if($user->root)
                    <li>
                        <a class="waves-attach" data-toggle="collapse" href="#collapse-user">
                            <span class="fa fa-users fa-fw margin-right-sm"></span>
                            User
                        </a>
                        <ul class="menu-collapse collapse" id="collapse-user">
                            <li>
                                <a class="waves-attach box" href="/user/list">
                                    <span class="material-icons material-icons-lg margin-right-sm">view_list</span>
                                    List
                                </a>
                            </li>
                            <li>
                                <a class="waves-attach box" href="/user/create">
                                    <span class="fa fa-user-plus fa-fw margin-right-sm"></span>
                                    Create
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="#collapse-market" data-toggle="collapse"  class="waves-attach">
                        <span class="material-icons material-icons-lg margin-right-sm">shop_two</span>
                        Market
                    </a>
                    <ul class="menu-collapse collapse" id="collapse-market">
                        <li>
                            <a class="waves-attach" href="/market/all">
                                <span class="material-icons material-icons-lg margin-right-sm">shopping_basket</span>
                                View All
                            </a>
                        </li>

                        <li>
                            <a class="waves-attach" href="/market/hosting">
                                <span class="material-icons material-icons-lg margin-right-sm">web</span>
                                Hosting
                            </a>
                        </li>

                        <li>
                            <a class="waves-attach" href="/market/manage">
                                <span class="material-icons material-icons-lg margin-right-sm">assignment</span>
                                Management
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="waves-attach" href="/issue">
                        <span class="material-icons material-icons-lg margin-right-sm">error_outline</span>
                        Issue
                    </a>
                </li>
                <li>
                    <a class="waves-attach" data-toggle="collapse" href="#collapse-doc">
                        <span class="material-icons material-icons-lg margin-right-sm">description</span>
                        Documentation
                    </a>
                    <ul class="menu-collapse collapse" id="collapse-doc">
                        <li>
                            <a class="waves-attach" href="/doc/vm">
                                <span class="material-icons material-icons-lg margin-right-sm">computer</span>
                                Virtual Mechine
                            </a>
                        </li>

                        <li>
                            <a class="waves-attach" href="/doc/service">
                                <span class="material-icons material-icons-lg margin-right-sm">adb</span>
                                Service
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>