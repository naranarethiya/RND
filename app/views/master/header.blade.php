	<header class="header">
		<a href="{{URL::to('/')}}" class="logo">Aura Salon & Spa</a>
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			    <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{Auth::user()->name}} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="treeview">
                                    <a href="{{URL::to('')}}">
                                        <i class="fa fa-sign-out"></i>
                                        <span>SignOut</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
		</nav>
	</header>