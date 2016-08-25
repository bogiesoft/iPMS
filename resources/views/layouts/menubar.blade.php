<nav class="navbar navbar-inverse navbar-fixed-top" id="menubar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand"><span>
				<img src="{{ Auth::user()->getAvatarUrl() }}" height="24" width="24" style="border-radius:25px;" />
				{{ Auth::user()->fullname }}
			</span></a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="{{ route('projects.index') }}">
				<span class="glyphicon glyphicon-home"></span><b> iPMS</b><span class="sr-only">(current)</span>
			</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Projects <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="/projects">List Project</a></li>
					<li><a href="/projects/0">Show Project</a></li>
					<li><a href="{{ route('projects.create') }}">New Project</a></li>
					<li><a href="">Add Files</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-calendar"></span> Calendar <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="/schedules/0">Show Calendar</a></li>
					<li><a href="{{ route('schedules.create') }}">Add Calendar</a></li>
				</ul>
			</li>
			<li><a href="#"><span class="glyphicon glyphicon-user"></span> Resource</a></li>
			<li><a href="/statistics">
				<span class="glyphicon glyphicon-equalizer"></span> Statistics</a></li>

@if (Auth::user()->group == 0)
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-calendar"></span> Manage <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="/manage/user">User</a></li>
					<li><a href="/manage/schedule">Schedule</a></li>
				</ul>
			</li>
@endif
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="{{ route('auth.logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</nav>
<br/>&nbsp
