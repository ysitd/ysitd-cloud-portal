<div class="container">
    <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only">
        <i class="material-icons">menu</i>
    </a>
</div>

<ul class="side-nav fixed">
    <li class="logo">
        <a href="{{ route('home') }}" class="brand-logo">
            <img src="{{ url('images/logo.jpg') }}">
        </a>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header waves-effect waves-teal">
                    <i class="fa fa-users fa-fw left"></i>
                    User
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li>
                            <a href="{{ url('user/list') }}" class="waves-effect box">
                                <i class="material-icons material-icons-lg left">view_list</i>
                                List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view', 'user/create') }}">
                                <i class="fa fa-user-plus fa-fw left"></i>
                                Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a class="collapsible-header waves-effect waves-teal">
                    <i class="material-icons material-icons-lg left">shop_two</i>
                    Market
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li>
                            <a href="{{ url('market/all') }}" class="waves-effect box">
                                <i class="material-icons material-icons-lg left">shopping_basket</i>
                                View All
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ route('issue.index') }}" class="waves-effect">
            <i class="material-icons material-icons-lg">error_outline</i>
            Issue
        </a>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header waves-effect waves-teal">
                    <i class="material-icons material-icons-lg left">description</i>
                    Documentation
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li>
                            <a href="{{ url('doc/vm') }}" class="waves-effect box">
                                <i class="material-icons material-icons-lg left">computer</i>
                                Virtual Machine
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
</ul>