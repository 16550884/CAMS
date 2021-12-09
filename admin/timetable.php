
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
	$option4 = $option4."<option value=$row4[course_key]>$row4[course_nme]-$row4[facalty_nme]</option>";			//Load Reagon Name
}



$sql5="SELECT * FROM lecture_master WHERE status=0";
$result5=mysqli_query($link,$sql5);
$option2 ="";
while($row5=mysqli_fetch_array($result5)){
	$option2 = $option2."<option value=$row5[lecturemas_key]>$row5[lecture_nme]</option>";			//Load Reagon Name
}

if(isset($_POST['btn_sele'])){
	
	$nm1=$_POST['sele_course'];
	$nm2=$_POST['sele_semester'];
	
	echo "<script>
			window.location.href='timetable.php?cs=$nm1&curyr=$nm2';
		</script>";
}


if(isset($_GET['cs']) && isset($_GET['curyr'])){
	$sql8="SELECT * FROM cur_statusofbatch_details WHERE curstatusbatch_detail_key='$_GET[curyr]'";
	$result8 = mysqli_query($link,$sql8);
	while($row8=mysqli_fetch_array($result8)){
		$sem_key=$row8['semester_key'];
	}
	
	$sql14="SELECT DISTINCT(lecture_key) AS distinceleckey FROM lecture_master INNER JOIN lectureassign_details ON lecture_master.lecturemas_key=lectureassign_details.lecture_key WHERE 
																lectureassign_details.cur_statusbatch_key='$_GET[curyr]' AND 
																lectureassign_details.status=0";
																
	$result14 = mysqli_query($link,$sql14);
	$option5 ="";
	while($row14=mysqli_fetch_array($result14)){
		$sql15="SELECT * FROM lecture_master WHERE lecturemas_key='$row14[distinceleckey]' AND status=0";
		$result15 = mysqli_query($link,$sql15);
		while($row15=mysqli_fetch_array($result15)){
			$lecdisnme=$row15['lecture_nme'];
		}
		
		$option5 = $option5."<option value=$row14[distinceleckey]>$lecdisnme</option>";			//Load Reagon Name
	}
	
	
	if(isset($_POST['btn_add'])){
		
		for($i=1;$i<=56;$i++){
			
			$n1="txt_day".$i;
			$n2="txt_time".$i;
			$n3="sele_class".$i;
			
			if($_POST[$n3]==0){
				$sql17="UPDATE timetable_details SET status=1 WHERE curstatusofbatch_key='$_GET[curyr]' AND dayos='$_POST[$n1]' AND timess='$_POST[$n2]' AND status=0";
				mysqli_query($link,$sql17);
			}
			else{
				$sql16="SELECT * FROM timetable_details WHERE curstatusofbatch_key='$_GET[curyr]' AND dayos='$_POST[$n1]' AND timess='$_POST[$n2]' AND status=0";
				$result16 = mysqli_query($link,$sql16);
				if(mysqli_num_rows($result16)==0){
					
					$sql17="INSERT INTO timetable_details (status,timetable_key,curstatusofbatch_key,lecture_key,dayos,timess,act_person)
												VALUES (0,NULL,'$_GET[curyr]','$_POST[$n3]','$_POST[$n1]','$_POST[$n2]','$ukey')";
					mysqli_query($link,$sql17);
					
				}
			}
		}
	}
}
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Time Table</title>
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
							<div style="font-size:16px;font-weight:bold;"align="center">Time Table</div>
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
                                                if(isset($_GET['cs'])){
													
													$sql2="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
															  WHERE course_master.course_key='$_GET[cs]'";
													$result2 = mysqli_query($link,$sql2);
													while($row2=mysqli_fetch_array($result2)){
														$couse_nme=$row2['course_nme']." - ".$row2['facalty_nme'];
													}

													echo "<option value=$_GET[cs]>$couse_nme</option>";
													
												}
												else if(isset($_POST['sele_course'])){
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
									<label class="control-label"><font color="red">&lowast;</font>Semester </label> 
									<select class="form-control input-sm" name="sele_semester" required>
										<?php
											if(isset($_GET['curyr'])){
												
												$sql1="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
																		 INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
																		WHERE cur_statusofbatch_details.coursemas_key='$_GET[cs]' AND 
																			  cur_statusofbatch_details.status=0
																		ORDER BY cur_statusofbatch_details.curstatusbatch_detail_key DESC";
												$result1=mysqli_query($link,$sql1);
												$option1 ="";
												while($row1=mysqli_fetch_array($result1)){
															
															$option1 = $option1."<option value=$row1[curstatusbatch_detail_key]>$row1[acadamic_yer]-$row1[batch_code]-$row1[year_nme]</option>";
												}
												
												$sql3="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
																		 INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
																		WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$_GET[curyr]' AND 
																			  cur_statusofbatch_details.status=0";
												$result3=mysqli_query($link,$sql3);
												$option3 ="";
												while($row3=mysqli_fetch_array($result3)){
															
															$option3 = $option3."<option value=$row1[curstatusbatch_detail_key]>$row3[acadamic_yer]-$row3[batch_code]-$row3[year_nme]</option>";
												}
												
												echo $option3;
												echo $option1;
											}
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
								<button class="btn btn-lg btn-primary btn-block" name='btn_sele' type="submit">Select</button>
							</form>
						</div>
					</section>
				</div>
			</div>
			
			<?php
			if(isset($_GET['cs']) && isset($_GET['curyr'])){
			?>
			
			
			<div class="row">
                <div class="col-md-1">
				
				</div>
				<div class="col-md-12">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form method="post" name="f2">
							
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<!--<th width="10%"><font color="red">&lowast;</font>Day</th>
										<th width="90%"><font color="red">&lowast;</font>Time </th>
										<th width="40%"><font color="red">&lowast;</font>Lecturer</th>-->
									</tr>
								</thead>

								<tbody>
									<tr>
										<td rowspan="1">Time</td>
										<td>8.30AM – 9.30AM</td>
										<td>9.30AM – 10.30AM</td>
										<td>10.30AM – 11.30AM</td>
										<td>11.30AM – 12.30PM</td>
										<td>1.00PM – 2.00PM</td>
										<td>2.00PM – 3.00PM</td>
										<td>3.00PM – 4.00PM</td>
										<td>4.00PM – 5.00PM</td>
									</tr>
									<tr>
										<td rowspan="1">Monday</td>	
																			
										<td>
											<input type="hidden" name="txt_day1" value="Monday">
											<input type="hidden" name="txt_time1" value="8.30AM to 9.30AM">
											<select class="form-control input-sm" name="sele_class1">
												<?php
												$sql5="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Monday' AND 
																			  timetable_details.timess='8.30AM to 9.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result5 = mysqli_query($link,$sql5);
												if(mysqli_num_rows($result5)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row5=mysqli_fetch_array($result5)){
														echo "<option value=$row5[lecturemas_key]>$row5[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
										
									
										<td>
											<input type="hidden" name="txt_day2" value="Monday">
											<input type="hidden" name="txt_time2" value="9.30AM to 10.30AM">
											<select class="form-control input-sm" name="sele_class2">
												<?php
												$sql6="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Monday' AND 
																			  timetable_details.timess='9.30AM to 10.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result6 = mysqli_query($link,$sql6);
												if(mysqli_num_rows($result6)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row6=mysqli_fetch_array($result6)){
														echo "<option value=$row6[lecturemas_key]>$row6[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day3" value="Monday">
											<input type="hidden" name="txt_time3" value="10.30AM to 11.30AM">
											<select class="form-control input-sm" name="sele_class3">
											<?php
													$sql8="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Monday' AND 
																				  timetable_details.timess='10.30AM to 11.30AM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result8 = mysqli_query($link,$sql8);
													if(mysqli_num_rows($result8)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row8=mysqli_fetch_array($result8)){
															echo "<option value=$row8[lecturemas_key]>$row8[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day4" value="Monday">
											<input type="hidden" name="txt_time4" value="11.30AM to 12.30PM">
											<select class="form-control input-sm" name="sele_class4">
											<?php
													$sql9="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Monday' AND 
																				  timetable_details.timess='11.30AM to 12.30PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result9 = mysqli_query($link,$sql9);
													if(mysqli_num_rows($result9)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row9=mysqli_fetch_array($result9)){
															echo "<option value=$row9[lecturemas_key]>$row9[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day5" value="Monday">
											<input type="hidden" name="txt_time5" value="1.00PM to 2.00PM">
											<select class="form-control input-sm" name="sele_class5">
											<?php
													$sql10="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Monday' AND 
																				  timetable_details.timess='1.00PM to 2.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result10 = mysqli_query($link,$sql10);
													if(mysqli_num_rows($result10)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row10=mysqli_fetch_array($result10)){
															echo "<option value=$row10[lecturemas_key]>$row10[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day6" value="Monday">
											<input type="hidden" name="txt_time6" value="2.00PM to 3.00PM">
											<select class="form-control input-sm" name="sele_class6">
											<?php
													$sql11="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Monday' AND 
																				  timetable_details.timess='2.00PM to 3.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result11 = mysqli_query($link,$sql11);
													if(mysqli_num_rows($result11)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row11=mysqli_fetch_array($result11)){
															echo "<option value=$row11[lecturemas_key]>$row11[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day7" value="Monday">
											<input type="hidden" name="txt_time7" value="3.00PM to 4.00PM">
											<select class="form-control input-sm" name="sele_class7">
											<?php
													$sql12="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Monday' AND 
																				  timetable_details.timess='3.00PM to 4.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result12 = mysqli_query($link,$sql12);
													if(mysqli_num_rows($result12)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row12=mysqli_fetch_array($result12)){
															echo "<option value=$row12[lecturemas_key]>$row12[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day8" value="Monday">
											<input type="hidden" name="txt_time8" value="4.00PM to 5.00PM">
											<select class="form-control input-sm" name="sele_class8">
											<?php
													$sql13="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Monday' AND 
																				  timetable_details.timess='4.00PM to 5.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result13 = mysqli_query($link,$sql13);
													if(mysqli_num_rows($result13)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row13=mysqli_fetch_array($result13)){
															echo "<option value=$row13[lecturemas_key]>$row13[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									</tr>
									
									<!-- end Monday Session-->
									
													
									
									
									<tr>
										<td rowspan="1">Tuesday</td>
										
										<td>
											<input type="hidden" name="txt_day9" value="Tuesday">
											<input type="hidden" name="txt_time9" value="8.30AM to 9.30AM">
											<select class="form-control input-sm" name="sele_class9">
												<?php
												$sql5="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Tuesday' AND 
																			  timetable_details.timess='8.30AM to 9.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result5 = mysqli_query($link,$sql5);
												if(mysqli_num_rows($result5)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row5=mysqli_fetch_array($result5)){
														echo "<option value=$row5[lecturemas_key]>$row5[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
										
									
										<td>
											<input type="hidden" name="txt_day10" value="Tuesday">
											<input type="hidden" name="txt_time10" value="9.30AM to 10.30AM">
											<select class="form-control input-sm" name="sele_class10">
												<?php
												$sql6="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Tuesday' AND 
																			  timetable_details.timess='9.30AM to 10.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result6 = mysqli_query($link,$sql6);
												if(mysqli_num_rows($result6)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row6=mysqli_fetch_array($result6)){
														echo "<option value=$row6[lecturemas_key]>$row6[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day11" value="Tuesday">
											<input type="hidden" name="txt_time11" value="10.30AM to 11.30AM">
											<select class="form-control input-sm" name="sele_class11">
											<?php
													$sql8="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Tuesday' AND 
																				  timetable_details.timess='10.30AM to 11.30AM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result8 = mysqli_query($link,$sql8);
													if(mysqli_num_rows($result8)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row8=mysqli_fetch_array($result8)){
															echo "<option value=$row8[lecturemas_key]>$row8[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day12" value="Tuesday">
											<input type="hidden" name="txt_time12" value="11.30AM to 12.30PM">
											<select class="form-control input-sm" name="sele_class12">
											<?php
													$sql9="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Tuesday' AND 
																				  timetable_details.timess='11.30AM to 12.30PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result9 = mysqli_query($link,$sql9);
													if(mysqli_num_rows($result9)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row9=mysqli_fetch_array($result9)){
															echo "<option value=$row9[lecturemas_key]>$row9[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day13" value="Tuesday">
											<input type="hidden" name="txt_time13" value="1.00PM to 2.00PM">
											<select class="form-control input-sm" name="sele_class13">
											<?php
													$sql10="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Tuesday' AND 
																				  timetable_details.timess='1.00PM to 2.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result10 = mysqli_query($link,$sql10);
													if(mysqli_num_rows($result10)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row10=mysqli_fetch_array($result10)){
															echo "<option value=$row10[lecturemas_key]>$row10[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day14" value="Tuesday">
											<input type="hidden" name="txt_time14" value="2.00PM to 3.00PM">
											<select class="form-control input-sm" name="sele_class14">
											<?php
													$sql11="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Tuesday' AND 
																				  timetable_details.timess='2.00PM to 3.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result11 = mysqli_query($link,$sql11);
													if(mysqli_num_rows($result11)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row11=mysqli_fetch_array($result11)){
															echo "<option value=$row11[lecturemas_key]>$row11[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day15" value="Tuesday">
											<input type="hidden" name="txt_time15" value="3.00PM to 4.00PM">
											<select class="form-control input-sm" name="sele_class15">
											<?php
													$sql12="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Tuesday' AND 
																				  timetable_details.timess='3.00PM to 4.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result12 = mysqli_query($link,$sql12);
													if(mysqli_num_rows($result12)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row12=mysqli_fetch_array($result12)){
															echo "<option value=$row12[lecturemas_key]>$row12[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day16" value="Tuesday">
											<input type="hidden" name="txt_time16" value="4.00PM to 5.00PM">
											<select class="form-control input-sm" name="sele_class16">
											<?php
													$sql13="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Tuesday' AND 
																				  timetable_details.timess='4.00PM to 5.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result13 = mysqli_query($link,$sql13);
													if(mysqli_num_rows($result13)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row13=mysqli_fetch_array($result13)){
															echo "<option value=$row13[lecturemas_key]>$row13[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									</tr>
									
									
									
									
									
									<!-- end Tuesday Session-->
									
									
									
									<tr>
										<td rowspan="1">Wednesday </td>
										
										<td>
											<input type="hidden" name="txt_day17" value="Wednesday">
											<input type="hidden" name="txt_time17" value="8.30AM to 9.30AM">
											<select class="form-control input-sm" name="sele_class17">
												<?php
												$sql5="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Wednesday' AND 
																			  timetable_details.timess='8.30AM to 9.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result5 = mysqli_query($link,$sql5);
												if(mysqli_num_rows($result5)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row5=mysqli_fetch_array($result5)){
														echo "<option value=$row5[lecturemas_key]>$row5[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
										
									
										<td>
											<input type="hidden" name="txt_day18" value="Wednesday">
											<input type="hidden" name="txt_time18" value="9.30AM to 10.30AM">
											<select class="form-control input-sm" name="sele_class18">
												<?php
												$sql6="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Wednesday' AND 
																			  timetable_details.timess='9.30AM to 10.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result6 = mysqli_query($link,$sql6);
												if(mysqli_num_rows($result6)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row6=mysqli_fetch_array($result6)){
														echo "<option value=$row6[lecturemas_key]>$row6[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day19" value="Wednesday">
											<input type="hidden" name="txt_time19" value="10.30AM to 11.30AM">
											<select class="form-control input-sm" name="sele_class19">
											<?php
													$sql8="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Wednesday' AND 
																				  timetable_details.timess='10.30AM to 11.30AM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result8 = mysqli_query($link,$sql8);
													if(mysqli_num_rows($result8)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row8=mysqli_fetch_array($result8)){
															echo "<option value=$row8[lecturemas_key]>$row8[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day20" value="Wednesday">
											<input type="hidden" name="txt_time20" value="11.30AM to 12.30PM">
											<select class="form-control input-sm" name="sele_class20">
											<?php
													$sql9="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Wednesday' AND 
																				  timetable_details.timess='11.30AM to 12.30PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result9 = mysqli_query($link,$sql9);
													if(mysqli_num_rows($result9)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row9=mysqli_fetch_array($result9)){
															echo "<option value=$row9[lecturemas_key]>$row9[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day21" value="Wednesday">
											<input type="hidden" name="txt_time21" value="1.00PM to 2.00PM">
											<select class="form-control input-sm" name="sele_class21">
											<?php
													$sql10="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Wednesday' AND 
																				  timetable_details.timess='1.00PM to 2.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result10 = mysqli_query($link,$sql10);
													if(mysqli_num_rows($result10)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row10=mysqli_fetch_array($result10)){
															echo "<option value=$row10[lecturemas_key]>$row10[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day22" value="Wednesday">
											<input type="hidden" name="txt_time22" value="2.00PM to 3.00PM">
											<select class="form-control input-sm" name="sele_class22">
											<?php
													$sql11="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Wednesday' AND 
																				  timetable_details.timess='2.00PM to 3.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result11 = mysqli_query($link,$sql11);
													if(mysqli_num_rows($result11)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row11=mysqli_fetch_array($result11)){
															echo "<option value=$row11[lecturemas_key]>$row11[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day23" value="Wednesday">
											<input type="hidden" name="txt_time23" value="3.00PM to 4.00PM">
											<select class="form-control input-sm" name="sele_class23">
											<?php
													$sql12="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Wednesday' AND 
																				  timetable_details.timess='3.00PM to 4.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result12 = mysqli_query($link,$sql12);
													if(mysqli_num_rows($result12)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row12=mysqli_fetch_array($result12)){
															echo "<option value=$row12[lecturemas_key]>$row12[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day24" value="Wednesday">
											<input type="hidden" name="txt_time24" value="4.00PM to 5.00PM">
											<select class="form-control input-sm" name="sele_class24">
											<?php
													$sql13="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Wednesday' AND 
																				  timetable_details.timess='4.00PM to 5.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result13 = mysqli_query($link,$sql13);
													if(mysqli_num_rows($result13)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row13=mysqli_fetch_array($result13)){
															echo "<option value=$row13[lecturemas_key]>$row13[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									</tr>
									
									<!-- end Wednesday Session-->
									
									
									<tr>
										<td rowspan="1">Thursday </td>
										
										<td>
											<input type="hidden" name="txt_day25" value="Thursday">
											<input type="hidden" name="txt_time25" value="8.30AM to 9.30AM">
											<select class="form-control input-sm" name="sele_class25">
												<?php
												$sql5="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Thursday' AND 
																			  timetable_details.timess='8.30AM to 9.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result5 = mysqli_query($link,$sql5);
												if(mysqli_num_rows($result5)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row5=mysqli_fetch_array($result5)){
														echo "<option value=$row5[lecturemas_key]>$row5[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
										
									
										<td>
											<input type="hidden" name="txt_day26" value="Thursday">
											<input type="hidden" name="txt_time26" value="9.30AM to 10.30AM">
											<select class="form-control input-sm" name="sele_class26">
												<?php
												$sql6="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Thursday' AND 
																			  timetable_details.timess='9.30AM to 10.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result6 = mysqli_query($link,$sql6);
												if(mysqli_num_rows($result6)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row6=mysqli_fetch_array($result6)){
														echo "<option value=$row6[lecturemas_key]>$row6[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day27" value="Thursday">
											<input type="hidden" name="txt_time27" value="10.30AM to 11.30AM">
											<select class="form-control input-sm" name="sele_class27">
											<?php
													$sql8="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Thursday' AND 
																				  timetable_details.timess='10.30AM to 11.30AM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result8 = mysqli_query($link,$sql8);
													if(mysqli_num_rows($result8)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row8=mysqli_fetch_array($result8)){
															echo "<option value=$row8[lecturemas_key]>$row8[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day28" value="Thursday">
											<input type="hidden" name="txt_time28" value="11.30AM to 12.30PM">
											<select class="form-control input-sm" name="sele_class28">
											<?php
													$sql9="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Thursday' AND 
																				  timetable_details.timess='11.30AM to 12.30PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result9 = mysqli_query($link,$sql9);
													if(mysqli_num_rows($result9)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row9=mysqli_fetch_array($result9)){
															echo "<option value=$row9[lecturemas_key]>$row9[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day29" value="Thursday">
											<input type="hidden" name="txt_time29" value="1.00PM to 2.00PM">
											<select class="form-control input-sm" name="sele_class29">
											<?php
													$sql10="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Thursday' AND 
																				  timetable_details.timess='1.00PM to 2.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result10 = mysqli_query($link,$sql10);
													if(mysqli_num_rows($result10)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row10=mysqli_fetch_array($result10)){
															echo "<option value=$row10[lecturemas_key]>$row10[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day30" value="Thursday">
											<input type="hidden" name="txt_time30" value="2.00PM to 3.00PM">
											<select class="form-control input-sm" name="sele_class30">
											<?php
													$sql11="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Thursday' AND 
																				  timetable_details.timess='2.00PM to 3.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result11 = mysqli_query($link,$sql11);
													if(mysqli_num_rows($result11)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row11=mysqli_fetch_array($result11)){
															echo "<option value=$row11[lecturemas_key]>$row11[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day31" value="Thursday">
											<input type="hidden" name="txt_time31" value="3.00PM to 4.00PM">
											<select class="form-control input-sm" name="sele_class31">
											<?php
													$sql12="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Thursday' AND 
																				  timetable_details.timess='3.00PM to 4.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result12 = mysqli_query($link,$sql12);
													if(mysqli_num_rows($result12)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row12=mysqli_fetch_array($result12)){
															echo "<option value=$row12[lecturemas_key]>$row12[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day32" value="Thursday">
											<input type="hidden" name="txt_time32" value="4.00PM to 5.00PM">
											<select class="form-control input-sm" name="sele_class32">
											<?php
													$sql13="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Thursday' AND 
																				  timetable_details.timess='4.00PM to 5.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result13 = mysqli_query($link,$sql13);
													if(mysqli_num_rows($result13)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row13=mysqli_fetch_array($result13)){
															echo "<option value=$row13[lecturemas_key]>$row13[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									</tr>
									
									<!-- end Thursday Session-->
									
									
									
									<tr>
										<td rowspan="1">Friday </td>
										
										<td>
											<input type="hidden" name="txt_day33" value="Friday">
											<input type="hidden" name="txt_time33" value="8.30AM to 9.30AM">
											<select class="form-control input-sm" name="sele_class33">
												<?php
												$sql5="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Friday' AND 
																			  timetable_details.timess='8.30AM to 9.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result5 = mysqli_query($link,$sql5);
												if(mysqli_num_rows($result5)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row5=mysqli_fetch_array($result5)){
														echo "<option value=$row5[lecturemas_key]>$row5[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
										
									
										<td>
											<input type="hidden" name="txt_day34" value="Friday">
											<input type="hidden" name="txt_time34" value="9.30AM to 10.30AM">
											<select class="form-control input-sm" name="sele_class34">
												<?php
												$sql6="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Friday' AND 
																			  timetable_details.timess='9.30AM to 10.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result6 = mysqli_query($link,$sql6);
												if(mysqli_num_rows($result6)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row6=mysqli_fetch_array($result6)){
														echo "<option value=$row6[lecturemas_key]>$row6[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day35" value="Friday">
											<input type="hidden" name="txt_time35" value="10.30AM to 11.30AM">
											<select class="form-control input-sm" name="sele_class35">
											<?php
													$sql8="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Friday' AND 
																				  timetable_details.timess='10.30AM to 11.30AM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result8 = mysqli_query($link,$sql8);
													if(mysqli_num_rows($result8)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row8=mysqli_fetch_array($result8)){
															echo "<option value=$row8[lecturemas_key]>$row8[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day36" value="Friday">
											<input type="hidden" name="txt_time36" value="11.30AM to 12.30PM">
											<select class="form-control input-sm" name="sele_class36">
											<?php
													$sql9="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Friday' AND 
																				  timetable_details.timess='11.30AM to 12.30PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result9 = mysqli_query($link,$sql9);
													if(mysqli_num_rows($result9)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row9=mysqli_fetch_array($result9)){
															echo "<option value=$row9[lecturemas_key]>$row9[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day37" value="Friday">
											<input type="hidden" name="txt_time37" value="1.00PM to 2.00PM">
											<select class="form-control input-sm" name="sele_class37">
											<?php
													$sql10="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Friday' AND 
																				  timetable_details.timess='1.00PM to 2.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result10 = mysqli_query($link,$sql10);
													if(mysqli_num_rows($result10)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row10=mysqli_fetch_array($result10)){
															echo "<option value=$row10[lecturemas_key]>$row10[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day38" value="Friday">
											<input type="hidden" name="txt_time38" value="2.00PM to 3.00PM">
											<select class="form-control input-sm" name="sele_class38">
											<?php
													$sql11="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Friday' AND 
																				  timetable_details.timess='2.00PM to 3.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result11 = mysqli_query($link,$sql11);
													if(mysqli_num_rows($result11)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row11=mysqli_fetch_array($result11)){
															echo "<option value=$row11[lecturemas_key]>$row11[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day39" value="Friday">
											<input type="hidden" name="txt_time39" value="3.00PM to 4.00PM">
											<select class="form-control input-sm" name="sele_class39">
											<?php
													$sql12="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Friday' AND 
																				  timetable_details.timess='3.00PM to 4.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result12 = mysqli_query($link,$sql12);
													if(mysqli_num_rows($result12)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row12=mysqli_fetch_array($result12)){
															echo "<option value=$row12[lecturemas_key]>$row12[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day40" value="Friday">
											<input type="hidden" name="txt_time40" value="4.00PM to 5.00PM">
											<select class="form-control input-sm" name="sele_class40">
											<?php
													$sql13="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Friday' AND 
																				  timetable_details.timess='4.00PM to 5.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result13 = mysqli_query($link,$sql13);
													if(mysqli_num_rows($result13)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row13=mysqli_fetch_array($result13)){
															echo "<option value=$row13[lecturemas_key]>$row13[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									</tr>
									
									
									<!-- end Friday Session-->
									
									<tr>
										<td rowspan="1">Saturday </td>
										
										<td>
											<input type="hidden" name="txt_day41" value="Saturday">
											<input type="hidden" name="txt_time41" value="8.30AM to 9.30AM">
											<select class="form-control input-sm" name="sele_class41">
												<?php
												$sql5="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Saturday' AND 
																			  timetable_details.timess='8.30AM to 9.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result5 = mysqli_query($link,$sql5);
												if(mysqli_num_rows($result5)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row5=mysqli_fetch_array($result5)){
														echo "<option value=$row5[lecturemas_key]>$row5[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
										
									
										<td>
											<input type="hidden" name="txt_day42" value="Saturday">
											<input type="hidden" name="txt_time42" value="9.30AM to 10.30AM">
											<select class="form-control input-sm" name="sele_class42">
												<?php
												$sql6="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Saturday' AND 
																			  timetable_details.timess='9.30AM to 10.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result6 = mysqli_query($link,$sql6);
												if(mysqli_num_rows($result6)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row6=mysqli_fetch_array($result6)){
														echo "<option value=$row6[lecturemas_key]>$row6[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day43" value="Saturday">
											<input type="hidden" name="txt_time43" value="10.30AM to 11.30AM">
											<select class="form-control input-sm" name="sele_class43">
											<?php
													$sql8="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Saturday' AND 
																				  timetable_details.timess='10.30AM to 11.30AM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result8 = mysqli_query($link,$sql8);
													if(mysqli_num_rows($result8)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row8=mysqli_fetch_array($result8)){
															echo "<option value=$row8[lecturemas_key]>$row8[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day44" value="Saturday">
											<input type="hidden" name="txt_time44" value="11.30AM to 12.30PM">
											<select class="form-control input-sm" name="sele_class44">
											<?php
													$sql9="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Saturday' AND 
																				  timetable_details.timess='11.30AM to 12.30PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result9 = mysqli_query($link,$sql9);
													if(mysqli_num_rows($result9)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row9=mysqli_fetch_array($result9)){
															echo "<option value=$row9[lecturemas_key]>$row9[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day45" value="Saturday">
											<input type="hidden" name="txt_time45" value="1.00PM to 2.00PM">
											<select class="form-control input-sm" name="sele_class45">
											<?php
													$sql10="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Saturday' AND 
																				  timetable_details.timess='1.00PM to 2.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result10 = mysqli_query($link,$sql10);
													if(mysqli_num_rows($result10)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row10=mysqli_fetch_array($result10)){
															echo "<option value=$row10[lecturemas_key]>$row10[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day46" value="Saturday">
											<input type="hidden" name="txt_time46" value="2.00PM to 3.00PM">
											<select class="form-control input-sm" name="sele_class46">
											<?php
													$sql11="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Saturday' AND 
																				  timetable_details.timess='2.00PM to 3.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result11 = mysqli_query($link,$sql11);
													if(mysqli_num_rows($result11)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row11=mysqli_fetch_array($result11)){
															echo "<option value=$row11[lecturemas_key]>$row11[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day47" value="Saturday">
											<input type="hidden" name="txt_time47" value="3.00PM to 4.00PM">
											<select class="form-control input-sm" name="sele_class47">
											<?php
													$sql12="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Saturday' AND 
																				  timetable_details.timess='3.00PM to 4.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result12 = mysqli_query($link,$sql12);
													if(mysqli_num_rows($result12)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row12=mysqli_fetch_array($result12)){
															echo "<option value=$row12[lecturemas_key]>$row12[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day48" value="Saturday">
											<input type="hidden" name="txt_time48" value="4.00PM to 5.00PM">
											<select class="form-control input-sm" name="sele_class48">
											<?php
													$sql13="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Saturday' AND 
																				  timetable_details.timess='4.00PM to 5.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result13 = mysqli_query($link,$sql13);
													if(mysqli_num_rows($result13)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row13=mysqli_fetch_array($result13)){
															echo "<option value=$row13[lecturemas_key]>$row13[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									</tr>
									
									<!-- end Saturday Session-->
									
									
									<tr>
										<td rowspan="1">Sunday </td>
										
										<td>
											<input type="hidden" name="txt_day49" value="Sunday">
											<input type="hidden" name="txt_time49" value="8.30AM to 9.30AM">
											<select class="form-control input-sm" name="sele_class49">
												<?php
												$sql5="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Sunday' AND 
																			  timetable_details.timess='8.30AM to 9.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result5 = mysqli_query($link,$sql5);
												if(mysqli_num_rows($result5)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row5=mysqli_fetch_array($result5)){
														echo "<option value=$row5[lecturemas_key]>$row5[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
										
									
										<td>
											<input type="hidden" name="txt_day50" value="Sunday">
											<input type="hidden" name="txt_time50" value="9.30AM to 10.30AM">
											<select class="form-control input-sm" name="sele_class50">
												<?php
												$sql6="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																		INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																		INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																		INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																		WHERE timetable_details.dayos='Sunday' AND 
																			  timetable_details.timess='9.30AM to 10.30AM' AND 
																			  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																			  timetable_details.status=0";
												$result6 = mysqli_query($link,$sql6);
												if(mysqli_num_rows($result6)==0){
													echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													echo $option5;
												}
												else{
													while($row6=mysqli_fetch_array($result6)){
														echo "<option value=$row6[lecturemas_key]>$row6[lecture_nme]</option>";
													}
														echo "<option value=0>Delete</option>";
														echo $option5;
												}
												?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day51" value="Sunday">
											<input type="hidden" name="txt_time51" value="10.30AM to 11.30AM">
											<select class="form-control input-sm" name="sele_class51">
											<?php
													$sql8="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Sunday' AND 
																				  timetable_details.timess='10.30AM to 11.30AM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result8 = mysqli_query($link,$sql8);
													if(mysqli_num_rows($result8)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row8=mysqli_fetch_array($result8)){
															echo "<option value=$row8[lecturemas_key]>$row8[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day52" value="Sunday">
											<input type="hidden" name="txt_time52" value="11.30AM to 12.30PM">
											<select class="form-control input-sm" name="sele_class52">
											<?php
													$sql9="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Sunday' AND 
																				  timetable_details.timess='11.30AM to 12.30PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result9 = mysqli_query($link,$sql9);
													if(mysqli_num_rows($result9)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row9=mysqli_fetch_array($result9)){
															echo "<option value=$row9[lecturemas_key]>$row9[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day53" value="Sunday">
											<input type="hidden" name="txt_time53" value="1.00PM to 2.00PM">
											<select class="form-control input-sm" name="sele_class53">
											<?php
													$sql10="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Sunday' AND 
																				  timetable_details.timess='1.00PM to 2.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result10 = mysqli_query($link,$sql10);
													if(mysqli_num_rows($result10)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row10=mysqli_fetch_array($result10)){
															echo "<option value=$row10[lecturemas_key]>$row10[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day54" value="Sunday">
											<input type="hidden" name="txt_time54" value="2.00PM to 3.00PM">
											<select class="form-control input-sm" name="sele_class54">
											<?php
													$sql11="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Sunday' AND 
																				  timetable_details.timess='2.00PM to 3.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result11 = mysqli_query($link,$sql11);
													if(mysqli_num_rows($result11)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row11=mysqli_fetch_array($result11)){
															echo "<option value=$row11[lecturemas_key]>$row11[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day55" value="Sunday">
											<input type="hidden" name="txt_time55" value="3.00PM to 4.00PM">
											<select class="form-control input-sm" name="sele_class55">
											<?php
													$sql12="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Sunday' AND 
																				  timetable_details.timess='3.00PM to 4.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result12 = mysqli_query($link,$sql12);
													if(mysqli_num_rows($result12)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row12=mysqli_fetch_array($result12)){
															echo "<option value=$row12[lecturemas_key]>$row12[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									
										<td>
											<input type="hidden" name="txt_day56" value="Sunday">
											<input type="hidden" name="txt_time56" value="4.00PM to 5.00PM">
											<select class="form-control input-sm" name="sele_class56">
											<?php
													$sql13="SELECT * FROM cur_statusofbatch_details INNER JOIN timetable_details ON cur_statusofbatch_details.curstatusbatch_detail_key=timetable_details.curstatusofbatch_key
																			INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																			INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			INNER JOIN lecture_master ON timetable_details.lecture_key=lecture_master.lecturemas_key
																			WHERE timetable_details.dayos='Sunday' AND 
																				  timetable_details.timess='4.00PM to 5.00PM' AND 
																				  timetable_details.curstatusofbatch_key='$_GET[curyr]' AND 
																				  timetable_details.status=0";
													$result13 = mysqli_query($link,$sql13);
													if(mysqli_num_rows($result13)==0){
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option5;
													}
													else{
														while($row13=mysqli_fetch_array($result13)){
															echo "<option value=$row13[lecturemas_key]>$row13[lecture_nme]</option>";
														}
															echo "<option value=0>Delete</option>";
															echo $option5;
													}
											?>
											</select>
										</td>
									</tr>
									
									<!-- end Sunday Session-->
									
								</tbody>
							</table>
							<input type="submit" class="btn btn-lg btn-primary btn-block" name='btn_add' value="Confirm">
							</form>
						</div>
					</section>
				</div>
			</div>
			<?php
			}
			?>
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
    </body>
</html>
