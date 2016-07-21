<nav id="ui_menu" class="menu menu-left nav-drawer nav-drawer-md">
    <div class="menu-scroll">
        <div class="menu-content">
            <a class="menu-logo" href="/">
                <span class="avatar"><img src="/images/logo.jpg" alt="YSITD"></span>
                YSITD Cloud
            </a>
            <ul class="nav">
                @if(Session::get('root'))
                    <li>
                        <a class="waves-attach" data-toggle="collapse" href="#collapse-user">
                            <span class="fa fa-users fa-fw"></span>
                            User
                        </a>
                        <ul class="menu-collapse collapse" id="collapse-user">
                            <li>
                                <a class="waves-attach" href="/user/list">
                                    <span class="material-icons material-icons-lg">apps</span>
                                    List
                                </a>
                            </li>
                            <li>
                                <a class="waves-attach" href="/user/create">
                                    <span class="fa fa-user-plus fa-fw"></span>
                                    Create
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a class="waves-attach" data-toggle="collapse" href="#collapse-credit">
                        <span class="material-icons material-icons-lg">account_balance</span>
                        Credit
                    </a>
                    <ul class="menu-collapse collapse" id="collapse-credit">
                        <li>
                            <a class="waves-attach" href="/credit/balance">
                                <span class="fa fa-gbp fa-fw"></span>
                                Balance
                            </a>
                        </li>

                        <li>
                            <a class="waves-attach" href="/credit/exchange">
                                <span class="material-icons material-icons-lg">autorenew</span>
                                Exchange
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="waves-attach" data-toggle="collapse" href="#collapse-health">
                        <span class="fa fa-heartbeat fa-fw"></span>
                        Service Health
                    </a>
                    <ul class="menu-collapse collapse" id="collapse-health">
                        <li>
                            <a class="waves-attach" href="/health">
                                <span class="fa fa-server fa-fw"></span>
                                Overview
                            </a>
                        </li>

                        @foreach($nodes as $node)
                        <li>
                            <a class="waves-attach" href="/health/{{$node->id}}">{{ strtoupper($node->name) }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>