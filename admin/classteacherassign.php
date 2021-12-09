
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");

	$sql4="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.status=0";
	$result4=mysqli_query($link,$sql4);
	$option4 ="";
	while($row4=mysqli_fetch_array($result4)){

		$option4 = $option4."<option value=$row4[course_key]>$row4[course_nme]-$row4[facalty_nme]</option>";
		
	}
	
	
	
		if(isset($_POST['btn_asin'])){
			
			$nm1=$_POST['sele_course'];
			$nm3=$_POST['sele_semester'];
			$nm4=$_POST['sele_lecture'];
			
			$sql8="SELECT * FROM classteacherassign_details WHERE cur_statusbatch_key='$nm3' AND status=0";
			$result8=mysqli_query($link,$sql8);
			if(mysqli_num_rows($result8)==0){
				
				$sql3="INSERT INTO classteacherassign_details (status,classteacherassign_details_key,lecture_key,cur_statusbatch_key,act_person ) VALUES
															(0,NULL,'$nm4','$nm3','$ukey')";
				if(mysqli_query($link,$sql3)){
					echo "<script>
								alert('Successfuly Added Class Teacher ');
								
					</script>";
				}
				else{
					
					echo "<script>
								alert('Execute Error ');
								
					</script>";
				}
				
			}
			else{
				
				echo "<script>
								alert('Alredy Added this Class Teacher ');
								
					</script>";
				
			}
					
			
		}				
		
	
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Lecturer Assign Subjects</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
      <link rel="stylesheet" media="screen" href="css/common.css">
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php include('navi.php') ?>
       <br>
	   <br>
	   <br>
			<div class="row">
				<div class="col-md-6">
				
				</div>
				<div class="col-md-5">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<div style="font-size:16px;font-weight:bold;"align="center">Assign lecturer for Subject</div>
						</div>
					</section>
				</div>
			</div>
			<div class="row">
                <div class="col-md-6">
				
				</div>
				<div class="col-md-5">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form method="post" name="f1">
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Course </label> 
									<select class="form-control input-sm" name="sele_course" onchange="this.form.submit();">
										<?php
                                                if(isset($_POST['sele_course'])){
													$sql7="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
															  WHERE course_master.course_key='$_POST[sele_course]'";
													$result7 = mysqli_query($link,$sql7);
													while($row7=mysqli_fetch_array($result7)){
														$course_key=$row7['course_key'];
														$couse_nme1=$row7['course_nme']." - ".$row7['facalty_nme'];
													}

													echo "<option value=$course_key>$couse_nme1</option>";
													echo $option4;
												}
												else{
												
													  echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													  echo $option4;
												}
												
													
                                          ?>
									</select>
								</div> 
								
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Semester</label> 
									<select class="form-control input-sm" name="sele_semester" required>
											<?php
											
											if(isset($_POST['sele_course'])){
												$sql1="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
																		 INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
																		WHERE cur_statusofbatch_details.coursemas_key='$_POST[sele_course]' AND 
																			  cur_statusofbatch_details.status=0
																		ORDER BY cur_statusofbatch_details.curstatusbatch_detail_key DESC";
												$result1=mysqli_query($link,$sql1);
												$option1 ="";
												while($row1=mysqli_fetch_array($result1)){
															
															$option1 = $option1."<option value=$row1[curstatusbatch_detail_key]>$row1[acadamic_yer]-$row1[batch_code]-$row1[year_nme]</option>";
												}
												
												echo "<option value='' disabled selected hidden>Please Choose.............</option>";
												echo $option1;
											}
                                        ?>
									</select>
								</div>
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Lecture</label> 
									<select class="form-control input-sm" name="sele_lecture" required>
										<?php
											  
													
													$sql16="SELECT * FROM lecture_master ORDER BY lecturemas_key DESC";
													$result16=mysqli_query($link,$sql16);
													$option7 ="";
													while($row16=mysqli_fetch_array($result16)){
														$option7 = $option7."<option value=$row16[lecturemas_key]>$row16[lecture_nme]</option>";			//Load Reagon Name
													}
													
													  echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													  echo $option7;
												
                                        ?>
									</select>
								</div>
								<button class="btn btn-lg btn-primary btn-block" name='btn_asin' type="submit">Asin Lecture</button>
							</form>
						</div>
					</section>
				</div>
			</div>
			
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
    </body>
</html>
