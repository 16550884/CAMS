
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 
?>

<?php
$cur_dte=date("Y-m-d");

$sql4="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.status=0 AND facalty_master.status=0";
$result4=mysqli_query($link,$sql4);
$option4 ="";
while($row4=mysqli_fetch_array($result4)){
$option4 = $option4."<option value=$row4[course_key]>$row4[course_nme]-$row4[facalty_nme]</option>";			//Load Reagon Name
}

	if(isset($_POST['btn_semesteradd'])){
		$n1=$_POST['sele_course'];
		$n2=$_POST['sele_batch'];
		$n3=$_POST['sele_semester'];
		$n4=$_POST['sele_year'];
		$n5=$_POST['txt_startdate'];
		$n6=$_POST['txt_enddte'];
		$n7=$_POST['txt_duration'];
		

		if($n5>$n6){
			echo "<script>
							alert('Semester Start Date or Semester End date Invalid');
				</script>";
		}
		else{
			$sql1="SELECT * FROM cur_statusofbatch_details WHERE acadamic_yer='$n4' AND batchmas_key='$n2' AND coursemas_key='$n1' AND semester_key='$n3' AND status=0";
			$result1 = mysqli_query($link,$sql1);
			if(mysqli_num_rows($result1)==0){
				
				$sql2 = "INSERT INTO cur_statusofbatch_details (status,curstatusbatch_detail_key,acadamic_yer,batchmas_key,coursemas_key,semester_key,semesterstart_date,semesterend_dte,duration,act_person) VALUES 
												(0,NULL,'$n4','$n2','$n1','$n3','$n5','$n6','$n7','$ukey')";
				if(mysqli_query($link,$sql2)){
					echo "<script>
							alert('Successfully Entered New Semester');
						</script>";
				}
				else{
					echo "<script>
							alert('Execute Error');
						</script>";
				}
				
			}
			else{
				echo "<script>
					alert('Already Added this information');
				</script>";
			}
		}
	}
	
	$sql3="SELECT * FROM cur_statusofbatch_details WHERE status=0";
	$result3 = mysqli_query($link,$sql3);
	while($row3=mysqli_fetch_array($result3)){
			
			$e1="txt_semstartdte".$row3['curstatusbatch_detail_key'];
			$e2="txt_semenddte".$row3['curstatusbatch_detail_key'];
			$e3="txt_duration".$row3['curstatusbatch_detail_key'];
			$e4="txt_cursemkey".$row3['curstatusbatch_detail_key'];
		
		
			$btn_update1="btn_change".$row3['curstatusbatch_detail_key'];
			$btn_remove1="btn_remove".$row3['curstatusbatch_detail_key'];
			
		if(isset($_POST[$btn_update1])){	
			$t1=$_POST[$e1];
			$t2=$_POST[$e2];
			$t3=$_POST[$e3];
			$t4=$_POST[$e4];
			
			if($t1>$t2){
				echo "<script>
								alert('Semester Start Date or Semester End date Invalid');
					</script>";
			}
			else{
				$sql9="UPDATE cur_statusofbatch_details SET semesterstart_date='$t1',semesterend_dte='$t2',duration='$t3' WHERE curstatusbatch_detail_key='$t4'";
				if(mysqli_query($link,$sql9)){
						echo "<script>
								alert('Successfully Updated New Semester Detail');
							</script>";
				}
				else{
						echo "<script>
								alert('Execute Error');
							</script>";
				}
			}
		}
		if(isset($_POST[$btn_remove1])){
				$t1=$_POST[$e1];
				
				echo "<script>
				if (window.confirm('Are you sure you want to delete this item?')) { 
					window.location.href='startnewsem_info.php?sd=$t1';
				}
				</script>";
				
		}
		
		if(isset($_GET['sd'])){
				$sql5="UPDATE cur_statusofbatch_details SET status=1 WHERE curstatusbatch_detail_key='$_GET[sd]'";
				if(mysqli_query($link,$sql5)){
					echo "<script>
							alert('Successfully Deleted New Semester Information');
							window.location.href='startnewsem_info.php';
						</script>";
				}
				else{
					echo "<script>
							alert('Execute Error');
							window.location.href='startnewsem_info.php';
						</script>";
				}
		}
		
	}
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Start New Semester</title>
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
							<div style="font-size:16px;font-weight:bold;"align="center">Semester Information</div>
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
									<select class="form-control input-sm" name="sele_course" required onchange="this.form.submit()">
										<?php
                                                 	
												if(isset($_POST['sele_course'])){
													$sql5="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.course_key='$_POST[sele_course]' AND course_master.status=0";
													$result5=mysqli_query($link,$sql5);
													$option2 ="";
													while($row5=mysqli_fetch_array($result5)){
														$option2 = $option2."<option value=$row5[course_key]>$row5[course_nme]-$row5[facalty_nme]</option>";			//Load Reagon Name
													}
													 echo $option2;
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
									<label class="control-label"><font color="red">&lowast;</font>Batch Code </label> 
									<select class="form-control input-sm" name="sele_batch" required>
										<?php
                                                if(isset($_POST['sele_course'])){ 	
													
													$sql6="SELECT * FROM batch_master WHERE course_key='$_POST[sele_course]' ORDER BY batch_mas_key DESC";
													$result6=mysqli_query($link,$sql6);
													$option3 ="";
													while($row6=mysqli_fetch_array($result6)){
														$option3 = $option3."<option value=$row6[batch_mas_key]>$row6[batch_code]</option>";			//Load Reagon Name
													}
													
													  echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													  echo $option3;
												}
                                          ?>
									</select>
								</div> 
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Semester </label> 
									<select class="form-control input-sm" name="sele_semester" required>
										<?php
                                                 	$sql11="SELECT * FROM year_master WHERE status=0";
													$result11=mysqli_query($link,$sql11);
													$option5 ="";
													while($row11=mysqli_fetch_array($result11)){
														$option5 = $option5."<option value=$row11[year_key]>$row11[year_nme]</option>";			//Load Reagon Name
													}
													
													  echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													  echo $option5;
													
                                          ?>
									</select>
								</div> 
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Acadamic Year </label> 
									<select class="form-control input-sm" name="sele_year" required>
										<?php
                                                 	
													
													  echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													  echo "<option value='2022'>2022</option>";
													  echo "<option value='2021'>2021</option>";
													  echo "<option value='2020'>2020</option>";
													  echo "<option value='2019'>2019</option>";
													
                                          ?>
									</select>
								</div> 
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Start Date :</label>   
									<input type="date" class="form-control input-sm" name="txt_startdate" required placeholder="Please Enter Start Date">
								</div> 
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>End Date :</label>   
									<input type="date" class="form-control input-sm" name="txt_enddte" required placeholder="Please Enter End Date">
								</div> 
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Duration (Month) :</label>   
									<input type="text" class="form-control input-sm" name="txt_duration" required placeholder="Please Enter Duration">
								</div> 
								<button class="btn btn-lg btn-primary btn-block" name='btn_semesteradd' type="submit">Add</button>
							</form>
						</div>
					</section>
				</div>
			</div>
	
		
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-1">
							
				</div>
				<div class="col-md-10">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<h4>Current Year <?php echo date("Y"); ?> Semester</h4>
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th width="10%"><font color="red">&lowast;</font>Acadamic Year</th>
										<th width="33%"><font color="red">&lowast;</font>Course</th>
										<th width="10%"><font color="red">&lowast;</font>Batch</th>
										<th width="10%"><font color="red">&lowast;</font>Semester</th>
										<th width="10%"><font color="red">&lowast;</font>Start Date</th>
										<th width="10%"><font color="red">&lowast;</font>End Date</th>
										<th width="7%"><font color="red">&lowast;</font>Duration (Month)</th>
										<th width="10%"><font color="red">&lowast;</font>Action</th>
									</tr>
								</thead>
								<tbody>
									<form method="post" name="f2">
												<?php
													$cur_yeros=date("Y");
													$sql14="SELECT * FROM course_master INNER JOIN cur_statusofbatch_details ON course_master.course_key=cur_statusofbatch_details.coursemas_key
																									INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																									INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																									INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																									WHERE cur_statusofbatch_details.acadamic_yer>='$cur_yeros'
																									  AND cur_statusofbatch_details.status=0";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														
														$txt_semstart="txt_semstartdte".$row14['curstatusbatch_detail_key'];
														$txt_semend="txt_semenddte".$row14['curstatusbatch_detail_key'];
														$txt_semduration="txt_duration".$row14['curstatusbatch_detail_key'];
														$txt_cursemkey="txt_cursemkey".$row14['curstatusbatch_detail_key'];
														
														$btn_remove="btn_remove".$row14['curstatusbatch_detail_key'];
														$btn_change="btn_change".$row14['curstatusbatch_detail_key'];
														
														$q1=$row14['semesterstart_date'];
														$q2=$row14['semesterend_dte'];
														$q3=$row14['duration'];
														$q4=$row14['curstatusbatch_detail_key'];
														
														
														echo "<tr>
																
																<td width='10%'>
																<input type='hidden' class='form-control input-sm' name=".$txt_cursemkey." value=".$q4.">
																".$row14['acadamic_yer']."
																</td>
																<td width='33%'>
																	".$row14['course_nme']."-".$row14['facalty_nme']."
																</td>
																<td width='10%'>
																	".$row14['batch_code']."
																</td>
																<td width='10%'>
																	".$row14['year_nme']."
																</td>
																<td width='10%'>
																	<input type='date' class='form-control input-sm' name=".$txt_semstart." value=".$q1.">
																</td>
																<td width='10%'>
																	<input type='date' class='form-control input-sm' name=".$txt_semend." value=".$q2.">
																</td>
																<td width='7%'>
																	<input type='text' class='form-control input-sm' name=".$txt_semduration." value=".$q3.">
																</td>
																
																<td width='10%'>
																	<input type='submit' class='btn btn-sm btn-success btn-block' value='Change' name=".$btn_change.">
																	<input type='submit' class='btn btn-sm btn-danger btn-block' value='Delete' name=".$btn_remove."><br>
																	
																</td>
															</tr>";
													}
													
													
												?>
									</form>
								</tbody>
							</table>
						</div>
					</section>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-1">
							
				</div>
				<div class="col-md-10">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<h4>Previous Year Semester</h4>
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th width="10%"><font color="red">&lowast;</font>Acadamic Year</th>
										<th width="33%"><font color="red">&lowast;</font>Course</th>
										<th width="10%"><font color="red">&lowast;</font>Batch</th>
										<th width="10%"><font color="red">&lowast;</font>Semester</th>
										<th width="10%"><font color="red">&lowast;</font>Start Date</th>
										<th width="10%"><font color="red">&lowast;</font>End Date</th>
										<th width="8%"><font color="red">&lowast;</font>Duration (Month)</th>
										<th width="10%"><font color="red">&lowast;</font>Action</th>
									</tr>
								</thead>
								<tbody>
									<form method="post" name="f2">
												<?php
													$cur_yeros=date("Y");
													$sql14="SELECT * FROM course_master INNER JOIN cur_statusofbatch_details ON course_master.course_key=cur_statusofbatch_details.coursemas_key
																									INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																									INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																									INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																									WHERE cur_statusofbatch_details.acadamic_yer<'$cur_yeros'
																									  AND cur_statusofbatch_details.status=0";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														
														$txt_semstart="txt_semstartdte".$row14['curstatusbatch_detail_key'];
														$txt_semend="txt_semenddte".$row14['curstatusbatch_detail_key'];
														$txt_semduration="txt_duration".$row14['curstatusbatch_detail_key'];
														$txt_cursemkey="txt_cursemkey".$row14['curstatusbatch_detail_key'];
														
														$btn_remove="btn_remove".$row14['curstatusbatch_detail_key'];
														$btn_change="btn_change".$row14['curstatusbatch_detail_key'];
														
														$q1=$row14['semesterstart_date'];
														$q2=$row14['semesterend_dte'];
														$q3=$row14['duration'];
														$q4=$row14['curstatusbatch_detail_key'];
														
														
														echo "<tr>
																
																<td width='10%'>
																<input type='hidden' class='form-control input-sm' name=".$txt_cursemkey." value=".$q4.">
																".$row14['acadamic_yer']."
																</td>
																<td width='33%'>
																	".$row14['course_nme']."-".$row14['facalty_nme']."
																</td>
																<td width='10%'>
																	".$row14['batch_code']."
																</td>
																<td width='10%'>
																	".$row14['year_nme']."
																</td>
																<td width='10%'>
																	<input type='date' class='form-control input-sm' name=".$txt_semstart." value=".$q1.">
																</td>
																<td width='10%'>
																	<input type='date' class='form-control input-sm' name=".$txt_semend." value=".$q2.">
																</td>
																<td width='8%'>
																	<input type='text' class='form-control input-sm' name=".$txt_semduration." value=".$q3.">
																</td>
																
																<td width='10%'>
																	<input type='submit' class='btn btn-sm btn-success btn-block' value='Change' name=".$btn_change.">
																	<input type='submit' class='btn btn-sm btn-danger btn-block' value='Delete' name=".$btn_remove."><br>
																	
																</td>
															</tr>";
													}
													
													
												?>
									</form>
								</tbody>
							</table>
						</div>
					</section>
				</div>
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
