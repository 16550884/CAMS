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
                            <a class="navbar-brand" href="dashboard.php">Admin Panel</a>
                        </div>
                        <div class="collapse navbar-collapse main-navbar-collapse">
                            <ul class="nav navbar-nav">
                                
								<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-hover="dropdown">People <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<li><a href="user_registration.php">Admin Registration</a></li>
										<li><a href="lecturerereg_info.php">Lecture Registration</a></li>
										<li><a href="studentreg_menu.php">Student Registration</a></li>
										<li><a href="reset_password.php">Reset Password</a></li>
                                    </ul>
                                </li>
								
								<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-hover="dropdown">College Information<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<li><a href="facalty_info.php">Department Information</a></li>
										<li><a href="course_info.php">Course Information</a></li>
										<li><a href="batch_info.php">Batch Information</a></li>
										<li><a href="startnewsem_info.php">Semester Information</a></li>
                                       
                                    </ul>
                                </li>
								
								<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-hover="dropdown">Subject Mgt <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<!--<li><a href="subject_modulationandshedue_menu.php">Subject Modulation and Scheduling</a></li>-->
										<li><a href="classteacherassign.php">Assign Class Teacher</a></li>
										<li><a href="lectureassign_subjects.php">Lecture Assign Subjects</a></li>
										<li><a href="subjectadd_menu.php">Add Subjects</a></li>
										
                                    </ul>
                                </li>
								<li><a href="sms.php">Send SMS</a></li>
								<li><a href="student_search.php">Search Student</a></li>
															
								<li><a href="timetable.php">Time Table</a></li>
								<!--<li><a href="reports.php">Reports</a></li>-->
								<li><a href="dbbackup.php">Backup</a></li>
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