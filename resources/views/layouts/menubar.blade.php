<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><span>
				<img src="{{ Auth::user()->getAvatarUrl() }}" height="24" width="24" style="border-radius:25px;" />
				{{ Auth::user()->fullname }}
			</span></a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">
				<b>iPMS</b><span class="sr-only">(current)</span>
			</a></li>

			<li><a href="#"><span class="glyphicon glyphicon-home"></span> Summary</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Projects <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="/projects">List Project</a></li>
					<li><a href="/projects/0">Show Project</a></li>
					<li><a href="{{ route('projects.create') }}">New Project</a></li>
				</ul>
			</li>

			<li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Calendar</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-user"></span> Resource</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span> Statistics</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Manage</a></li> 
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="{{ route('auth.logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</nav>
<br>&nbsp
