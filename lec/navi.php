 <html>

<!-- main / large navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-small" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="dashboard.php">Lecturer Panel</a>
                        </div>
                        <div class="collapse navbar-collapse main-navbar-collapse">
                            <ul class="nav navbar-nav">
										<li><a href="view_scheduling.php">View Scheduling</a></li>
                                        <li><a href="subject_modulationandshedue_menu.php">Subject Modulation and Scheduling</a></li>
										<li><a href="lecture_process_menu.php">Lecture Processing</a></li>
										
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-hover="dropdown">Assignment<b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="assignment_process_menu.php">Assignment Process</a></li>
												<li><a href="assignment_menu.php">Assignment Scheduling</a></li>
												
											</ul>
										</li>
										
										<li><a href="editinformation_menu.php">Edit Information</a></li>
										<li><a href="student_search.php">Search Student</a></li>
										<li><a href="reports.php">Reports</a></li>
										<li><a href="classteacher.php">Class Teacher</a></li>
                            </ul>
							
							<ul class="nav navbar-nav navbar-right">
			
							  <li><a><span class="glyphicon glyphicon-user"></span>  <?php echo $user_check;?></a></li>
							  <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
							
							</ul>
                        </div><!-- /.navbar-collapse -->
                    </div>
                </div>
            </div><!-- /.container -->
        </nav>
</html>