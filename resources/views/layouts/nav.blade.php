<nav id="ui_menu" class="menu menu-left nav-drawer nav-drawer-md">
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
                                <a class="waves-attach" href="/user/list">
                                    <span class="material-icons material-icons-lg margin-right-sm">view_list</span>
                                    List
                                </a>
                            </li>
                            <li>
                                <a class="waves-attach" href="/user/create">
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
                    <a class="waves-attach" data-toggle="collapse" href="#collapse-credit">
                        <span class="material-icons material-icons-lg margin-right-sm">account_balance</span>
                        Credit
                    </a>
                    <ul class="menu-collapse collapse" id="collapse-credit">
                        <li>
                            <a class="waves-attach" href="/credit/balance">
                                <span class="fa fa-gbp fa-fw margin-right-sm"></span>
                                Balance
                            </a>
                        </li>

                        <li>
                            <a class="waves-attach" href="/credit/exchange">
                                <span class="material-icons material-icons-lg margin-right-sm">autorenew</span>
                                Exchange
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="waves-attach" data-toggle="collapse" href="#collapse-health">
                        <span class="fa fa-heartbeat fa-fw margin-right-sm"></span>
                        Service Health
                    </a>
                    <ul class="menu-collapse collapse" id="collapse-health">
                        <li>
                            <a class="waves-attach" href="/health">
                                <span class="fa fa-server fa-fw margin-right-sm"></span>
                                Overview
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>