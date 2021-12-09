
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

if(isset($_GET['suk']) && isset($_GET['curyr'])){
	
	$sql16="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
															INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
															INNER JOIN course_master ON course_master.course_key=cur_statusofbatch_details.coursemas_key
															INNER JOIN facalty_master ON facalty_master.facalty_key=course_master.facalty_key
															WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$_GET[curyr]' AND 
																 cur_statusofbatch_details.status=0";
	$result16 = mysqli_query($link,$sql16);
	while($row16=mysqli_fetch_array($result16)){
	
		$y7=$row16['batchmas_key'];
								
	}
	
	$sql22="SELECT * FROM lecturedtemgt_details WHERE lecturedtemgtdetail_key='$_GET[lm]' AND status=0";
	$result22 = mysqli_query($link,$sql22);
	while($row22=mysqli_fetch_array($result22)){
		$sdte1=$row22['datos'];
	}
	
	if(isset($_POST['btn_start'])){
		
		$sql2="SELECT * FROM lecturedtemgt_details WHERE datos='$cur_dte' AND subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND lecture_key='$lec_key' AND status=0";
		$result2 = mysqli_query($link,$sql2);
		if(mysqli_num_rows($result2)==0){
			
			$sql30="SELECT MIN(shedule_dte)AS minsheduledte FROM shedule_details WHERE curstausofbatch_key='$_GET[curyr]' AND subject_key='$_GET[suk]' AND complete_status IS NULL AND shedule_dte<='$cur_dte' AND status=0";
			$result30 = mysqli_query($link,$sql30);
			while($row30=mysqli_fetch_array($result30)){
				$minsd1=$row30['minsheduledte'];
			}
																	
			$sql31="SELECT * FROM shedule_details WHERE curstausofbatch_key='$_GET[curyr]' AND subject_key='$_GET[suk]' AND complete_status IS NULL AND shedule_dte='$minsd1' AND status=0";
			$result31 = mysqli_query($link,$sql31);
			while($row31=mysqli_fetch_array($result31)){
				$modulekeybefore1=$row31['sheduledetail_key'];
			}
			
			$sql3="INSERT INTO lecturedtemgt_details(status,lecturedtemgtdetail_key,datos,subject_key,curstateofbatch_key,lecture_key,pending_status,shedule_key,act_person)
										VALUES (0,NULL,'$cur_dte','$_GET[suk]','$_GET[curyr]','$lec_key',1,'$modulekeybefore1','$ukey')";
			if(mysqli_query($link,$sql3)){
				
				$sql7="SELECT * FROM lecturedtemgt_details WHERE datos='$cur_dte' AND subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND lecture_key='$lec_key' AND status=0";
				$result7 = mysqli_query($link,$sql7);
				while($row7=mysqli_fetch_array($result7)){
					$lm=$row7['lecturedtemgtdetail_key'];
				}
				
				echo "<script>
				alert('Successfully Started Process');
				window.location.href='lecture_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&lm=$lm';
				</script>";
			}
		}
		else{
			echo "<script>
				alert('Already Added this Information');
			</script>";
		}
		
		
	}
	
	if(isset($_POST['btn_barcode'])){
		
		$sql10="SELECT * FROM student_master WHERE student_id='$_POST[txt_barcode]' AND status=0";
		$result10 = mysqli_query($link,$sql10);
		if(mysqli_num_rows($result10)==0){
			echo "<script>
				alert('Invalid Student ID');
				</script>";
		}
		else{
			while($row10=mysqli_fetch_array($result10)){
				$stu_keyos=$row10['student_key'];
			}
			$sql9="SELECT * FROM attendance_details WHERE lecturedtemgt_key='$_GET[lm]' AND student_key='$stu_keyos' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
			$result9 = mysqli_query($link,$sql9);
			if(mysqli_num_rows($result9)==0){
				
				$sql11="INSERT INTO attendance_details (status,attendance_key,lecturedtemgt_key,student_key,subject_key,curstatusofbatch_key,act_person) 
												VALUES (0,NULL,'$_GET[lm]','$stu_keyos','$_GET[suk]','$_GET[curyr]','$ukey')";
				if(mysqli_query($link,$sql11)){
					
					echo "<script>
					alert('Successfully Student Attend this subject');
						window.location.href='lecture_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&lm=$_GET[lm]';
					</script>";
				}
				
			}
			else{
				echo "<script>
				alert('Already Attend this Student');
				</script>";
				
			}
			
		}
	}
	
	$sql13="SELECT * FROM student_master WHERE batch_key='$y7' AND status=0";
	$result13 = mysqli_query($link,$sql13);
	while($row13=mysqli_fetch_array($result13)){
		
		$n1="txt_studentkey".$row13['student_key'];
															
		$btn_addss="btn_addstulist".$row13['student_key'];
		$btn_cancelss="btn_cancelstulist".$row13['student_key'];
		
		if(isset($_POST[$btn_addss])){
			
			$sql17="SELECT * FROM attendance_details WHERE lecturedtemgt_key='$_GET[lm]' AND student_key='$_POST[$n1]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
			$result17 = mysqli_query($link,$sql17);
			if(mysqli_num_rows($result17)==0){
				
				$sql18="INSERT INTO attendance_details (status,attendance_key,lecturedtemgt_key,student_key,subject_key,curstatusofbatch_key,act_person) 
												VALUES (0,NULL,'$_GET[lm]','$_POST[$n1]','$_GET[suk]','$_GET[curyr]','$ukey')";
				if(mysqli_query($link,$sql18)){
					
					echo "<script>
					alert('Successfully Student Attend this subject');
						window.location.href='lecture_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&lm=$_GET[lm]';
					</script>";
				}
				
			}
			else{
				echo "<script>
				alert('Already Attend this Student');
				</script>";
			}
			
		}
		
		if(isset($_POST[$btn_cancelss])){
			
			$sql19="UPDATE attendance_details SET status=1 WHERE lecturedtemgt_key='$_GET[lm]' AND student_key='$_POST[$n1]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
			if(mysqli_query($link,$sql19)){
				echo "<script>
					alert('Canceled Student Attend this subject');
						window.location.href='lecture_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&lm=$_GET[lm]';
					</script>";
			}
		}
		
	}
	
	$sql20="SELECT * FROM shedule_details WHERE subject_key='$_GET[suk]' AND curstausofbatch_key='$_GET[curyr]' AND complete_status IS NULL AND status=0";
	$result20=mysqli_query($link,$sql20);
	while($row20=mysqli_fetch_array($result20)){
		
		$r1="txt_shedulekey".$row20['sheduledetail_key'];
		$r2="txt_completehrs".$row20['sheduledetail_key'];
		
		$btn_shdulemon1="btn_shedulemon".$row20['sheduledetail_key'];
		
		if(isset($_POST[$btn_shdulemon1])){
			
			$sql21="UPDATE shedule_details SET complete_status=1,complete_dte='$sdte1',complete_hours='$_POST[$r2]',complete_lecturedtemgt='$_GET[lm]' WHERE sheduledetail_key='$_POST[$r1]' AND status=0";
			if(mysqli_query($link,$sql21)){
				
				$sql23="UPDATE lecturedtemgt_details SET pending_status=null WHERE lecturedtemgtdetail_key='$_GET[lm]'";
				mysqli_query($link,$sql23);
				
				echo "<script>
					alert('Successfully Schedule Complete');
						window.location.href='lecture_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&lm=$_GET[lm]';
					</script>";
			}
			
			echo "<script>
					alert('Are you sure Complete Schedule');
					</script>";
		}
	}
	
	$sql25="SELECT * FROM shedule_details WHERE subject_key='$_GET[suk]' AND curstausofbatch_key='$_GET[curyr]' AND complete_lecturedtemgt='$_GET[lm]' AND status=0";
	$result25=mysqli_query($link,$sql25);
	while($row25=mysqli_fetch_array($result25)){
		$d1="txt_shedulekey".$row25['sheduledetail_key'];
		
		$btn_shdulemon_cancel1="btn_shedulemon_cancel".$row25['sheduledetail_key'];
		
		if(isset($_POST[$btn_shdulemon_cancel1])){
			
			$sql26="UPDATE shedule_details SET complete_status=null,complete_dte=null,complete_hours=null,complete_lecturedtemgt=null WHERE sheduledetail_key='$_POST[$d1]' AND status=0";
			if(mysqli_query($link,$sql26)){
				
				$sql27="SELECT * FROM shedule_details WHERE subject_key='$_GET[suk]' AND curstausofbatch_key='$_GET[curyr]' AND complete_lecturedtemgt='$_GET[lm]' AND status=0";
				$result27=mysqli_query($link,$sql27);
				if(mysqli_num_rows($result27)==0){
					$sql28="UPDATE lecturedtemgt_details SET pending_status=null WHERE lecturedtemgtdetail_key='$_GET[lm]'";
					mysqli_query($link,$sql28);
				}
				
				echo "<script>
					alert('Canceled Schedule Delete');
						window.location.href='lecture_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&lm=$_GET[lm]';
					</script>";
			}
			
		}
	}
	
	if(isset($_POST['btn_termnote'])){
		
		$sql29="UPDATE lecturedtemgt_details SET term_note='$_POST[txt_termnote]',lerning_hours='$_POST[txt_lernhrs]' WHERE lecturedtemgtdetail_key='$_GET[lm]'";
		if(mysqli_query($link,$sql29)){
			
			echo "<script>
					alert('Successfully Updated Information');
						window.location.href='lecture_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&lm=$_GET[lm]';
					</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Lecturer Registration</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
      <link rel="stylesheet" media="screen" href="css/common.css">
	  <style type="text/css">
		<!-- newly added -->
		#chart-container {
		width: 100%;
		height: auto;
		}
		<!-- newly added -->
		#example tbody {
		cursor: pointer;
		}
		
		table.display tbody tr:nth-child(even):hover td{
			background-color:  #80dfff !important
		}
		
		table.display tbody tr:nth-child(odd):hover td{
			background-color:  #80dfff !important
		}
		
		table.display tbody tr:nth-child(even){
			background-color: #2874a6 !important
		}
		table.display tr.even .sorting_1 { 
			background-color:  #2874a6 !important; 
		}
		
		table.display tbody tr:nth-child(odd){
			background-color:  #00ace6 !important
		}
		table.display tr.odd .sorting_1 { 
				background-color:  #00ace6 !important; 
		}
		
		
		.tcontents{
			color:#ffffff;
			font-weight:bold;
			font-size:17px;
		}
		</style>
	  
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php include('navi.php') ?>
       <br>
	   <br>
	   <br>
		
		
				<?php
				if(isset($_GET['suk']) && isset($_GET['curyr'])){
							
							$sql4="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
															INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
															INNER JOIN course_master ON course_master.course_key=cur_statusofbatch_details.coursemas_key
															INNER JOIN facalty_master ON facalty_master.facalty_key=course_master.facalty_key
															WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$_GET[curyr]' AND 
																 cur_statusofbatch_details.status=0";
							$result4 = mysqli_query($link,$sql4);
							while($row4=mysqli_fetch_array($result4)){
								$y1=$row4['facalty_nme'];
								$y2=$row4['course_nme'];
								$y3=$row4['acadamic_yer'];
								$y4=$row4['batch_code'];
								$y5=$row4['year_nme'];
								$y6=$row4['batchmas_key'];
								
							}
							
							$sql5="SELECT * FROM lectureassign_details INNER JOIN subject_master ON lectureassign_details.subject_key=subject_master.subject_key
																		INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																WHERE subject_master.subject_key='$_GET[suk]' 
																	AND lectureassign_details.cur_statusbatch_key='$_GET[curyr]'
																	AND subject_master.status=0
																	AND lectureassign_details.status=0";
							$result5 = mysqli_query($link,$sql5);
							while($row5=mysqli_fetch_array($result5)){
								$y11=$row5['subject_name'];
								$y12=$row5['lecture_nme'];
							}
						?>
						
					
					
                    <div class="row">
							<div class="col-md-2">
							
							</div>
							<div class="col-md-8">
								<section class="panel panel-transparent">
									<div class="panel-body panel-transparent">
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y1." - ".$y2." - ".$y4;?></h2>
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y3." - ".$y5;?></h2>
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y11;?></h2>
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y12;?></h2>
										
										
										<?php
										if(isset($_GET['lm'])){
											$sql6="SELECT * FROM lecturedtemgt_details WHERE lecturedtemgtdetail_key='$_GET[lm]' AND status=0";
											$result6 = mysqli_query($link,$sql6);
											while($row6=mysqli_fetch_array($result6)){
												$sdte=$row6['datos'];
												$snte=$row6['term_note'];
												$lrnhrs=$row6['lerning_hours'];
											}
										?>
											<h2 style="font-weight:bold;font-size:28px;" align="center"><?php echo $sdte;?></h2>
										
										<?php
										}
										else{
										?>
											<h2 style="font-weight:bold;font-size:28px;" align="center"><?php echo $cur_dte;?></h2>
											<form role="form" method="post" name="f1">
												<div class="form-group">
													<button type="submit" name="btn_start" class="btn btn-success btn-lg btn-block">Start Process</button>
												</div>
											</form>
										<?php
										}
										?>
									</div>
									
								</section>
							</div>
					</div>
					<?php
					if(isset($_GET['lm'])){
					?>
							<div class="row">
								<div class="col-md-2">
									
								</div>
								<div class="col-md-8">
									<section class="panel panel-transparent">
										<div class="panel-body panel-transparent">
											<form role="form" method="post" name="f2">
												<div class="form-group">
													<label>Learning Hours</label>
													<input type="number" min="0" name="txt_lernhrs" class="form-control input-sm" value="<?php echo $lrnhrs; ?>">
												</div>
												<div class="form-group">
													<label>Remark</label>
													<textarea class="form-control input-sm" name="txt_termnote"><?php echo $snte; ?></textarea>
												</div>
												<div class="form-group">
													<button type="submit" name="btn_termnote" class="btn btn-primary btn-lg btn-block">Update Info</button>
												</div>
											</form>
										</div>
									</section>
								</div>
							</div>
							
							<div class="row">
									<div class="col-md-6">
										<section class="panel panel-transparent">
											<div class="panel-body panel-transparent">
												<form role="form" method="post" name="f3">
													<div class="form-group">
														<label>Bar-code</label>
														<input type="text" class="form-control input-lg" name="txt_barcode" placeholder="Barcode">
													</div>
													<div class="form-group">
														<button type="submit" name="btn_barcode" class="btn btn-primary btn-lg btn-block">Attend</button>
													</div>
												</form>
												<br>
												<form method="post" name="f4">
												<table class="table table-striped table-bordered" width="100%">
														<thead>
															<tr style="background-color:  #ffffff; ">
																<th width="30%">Student ID</th>
																<th width="60%">Student Name</th>
																<th width="10%">Attend</th>
															</tr>
														</thead>
														<tbody>
															<?php
													
															$sql8="SELECT * FROM student_master WHERE batch_key='$y6' AND status=0";
															$result8 = mysqli_query($link,$sql8);
															while($row8=mysqli_fetch_array($result8)){
																
																$txt_studentkey="txt_studentkey".$row8['student_key'];
															
																$btn_addstulist="btn_addstulist".$row8['student_key'];
																
																$sql12="SELECT * FROM attendance_details WHERE lecturedtemgt_key='$_GET[lm]' AND student_key='$row8[student_key]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
																$result12 = mysqli_query($link,$sql12);
																if(mysqli_num_rows($result12)==0){
																	echo "<tr>
																			
																			<td width='30%'>
																			<input type='hidden' class='form-control input-sm' name=".$txt_studentkey." value=".$row8['student_key'].">
																			".$row8['student_id']."</td>
																			<td width='60%'>".$row8['initial_nme']."</td>
																			<td width='10%'>
																				<input type='submit' class='btn btn-sm btn-primary' value='Attend' name=".$btn_addstulist.">
																			</td>
																		</tr>";
																}
															}
														?>
														</tbody>
												</table>
												</form>
												<h2>Subject Attend Students</h2>
												<form method="post" name="f5">
												<table class="table table-striped table-bordered" width="100%">
														<thead>
															<tr style="background-color:  #ffffff; ">
																<th width="30%">Student ID</th>
																<th width="60%">Student Name</th>
																<th width="10%">Cancel</th>
															</tr>
														</thead>
														<tbody>
															<?php
													
															$sql14="SELECT * FROM student_master WHERE batch_key='$y6' AND status=0";
															$result14 = mysqli_query($link,$sql14);
															while($row14=mysqli_fetch_array($result14)){
																
																$txt_studentkeyaa="txt_studentkey".$row14['student_key'];
															
																$btn_cancelstulist="btn_cancelstulist".$row14['student_key'];
																
																$sql15="SELECT * FROM attendance_details WHERE lecturedtemgt_key='$_GET[lm]' AND student_key='$row14[student_key]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
																$result15 = mysqli_query($link,$sql15);
																if(mysqli_num_rows($result15)>0){
																
																	echo "<tr>
																			
																			<td width='30%'>
																			<input type='hidden' class='form-control input-sm' name=".$txt_studentkeyaa." value=".$row14['student_key'].">
																			".$row14['student_id']."</td>
																			<td width='60%'>".$row14['initial_nme']."</td>
																			<td width='10%'>
																				<input type='submit' class='btn btn-sm btn-danger' value='Cancel' name=".$btn_cancelstulist.">
																			</td>
																		</tr>";
																}
															}
														?>
														</tbody>
												</table>
												</form>
											</div>
										</section>
									</div>
									<div class="col-md-6">
											<section class="panel panel-transparent">
												<div class="panel-body panel-transparent">
													<form method="post" name="f6">
													<table class="table table-striped table-bordered" width="100%">
														<thead>
															<tr style="background-color:  #ffffff; ">
																<th width="15%">Schedule Date</th>
																<th width="55%">Module</th>
																<th width="10%">Academic Week</th>
																<th width="10%">Hours</th>
																<th width="5%">Complete Hours</th>
																<th width="5%">Complete</th>
															</tr>
														</thead>
														<tbody>
															<?php
																$sql1="SELECT * FROM shedule_details WHERE subject_key='$_GET[suk]' AND curstausofbatch_key='$_GET[curyr]' AND complete_status IS NULL AND status=0";
																$result1=mysqli_query($link,$sql1);
																while($row1=mysqli_fetch_array($result1)){
																	$txt_shedulekey="txt_shedulekey".$row1['sheduledetail_key'];
																	$txt_completehrs="txt_completehrs".$row1['sheduledetail_key'];
																	$btn_shedulemon="btn_shedulemon".$row1['sheduledetail_key'];
															?>
																	<tr>
																		<td><?php echo $row1['shedule_dte']?>
																		<input type="hidden" name="<?php echo $txt_shedulekey; ?>" value="<?php echo $row1['sheduledetail_key']; ?>"
																		</td>
																		<td><?php echo $row1['lesson_nme']?></td>
																		<td><?php echo $row1['acadamic_week']?></td>
																		<td><?php echo $row1['hours']?> Hours</td>
																		<td>
																				<input type='number' class='form-control input-sm' name="<?php echo $txt_completehrs;?>">
																		</td>
																		<td>
																				<input type='submit' class='btn btn-sm btn-primary' value='Complete' name="<?php echo $btn_shedulemon;?>">
																		</td>
																	</tr>
															<?php
																}
															?>
														
														</tbody>
													</table>
													<h2>Complete Schedule</h2>
													<table class="table table-striped table-bordered" width="100%">
														<thead>
															<tr style="background-color:  #ffffff; ">
																<th width="15%">Schedule Date</th>
																<th width="55%">Module</th>
																<th width="10%">Academic Week</th>
																<th width="10%">Hours</th>
																<th width="5%">Complete Hours</th>
																<th width="5%">Cancel</th>
															</tr>
														</thead>
														<tbody>
															<?php
																$sql24="SELECT * FROM shedule_details WHERE subject_key='$_GET[suk]' AND curstausofbatch_key='$_GET[curyr]' AND complete_lecturedtemgt='$_GET[lm]' AND status=0";
																$result24=mysqli_query($link,$sql24);
																while($row24=mysqli_fetch_array($result24)){
																	$txt_shedulekey1="txt_shedulekey".$row24['sheduledetail_key'];
																	
																	$btn_shedulemon_cancel="btn_shedulemon_cancel".$row24['sheduledetail_key'];
															?>
																	<tr>
																		<td><?php echo $row24['shedule_dte']?>
																		<input type="hidden" name="<?php echo $txt_shedulekey1; ?>" value="<?php echo $row24['sheduledetail_key']; ?>"
																		</td>
																		<td><?php echo $row24['lesson_nme']?></td>
																		<td><?php echo $row24['acadamic_week']?></td>
																		<td><?php echo $row24['hours']?> Hours</td>
																		<td>
																			<?php echo $row24['complete_hours']?> Hours
																		</td>
																		<td>
																				<input type='submit' class='btn btn-sm btn-danger' value='Cancel' name="<?php echo $btn_shedulemon_cancel;?>">
																		</td>
																	</tr>
															<?php
																}
															?>
														
														</tbody>
													</table>
													</form>
												</div>
											</section>
									</div>
							</div>
				<?php
					}
				}
				?>
		
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
		
			<link rel="stylesheet" type="text/css" href="datatable/dataTables.min.css" />
				<script type="text/javascript" src="datatable/dataTables.min.js"></script> 	
				
				<script type="text/javascript" charset="utf-8">
						$(document).ready(function() {
							$('#example thead th').each( function () {
								 var title = $('#example thead th').eq( $(this).index() ).text();
								
								$(this).html( '<label style="font-size:18px;color:white">'+title+'</label><input type="text" placeholder="'+title+'" style="color:black;" class="form-control input-sm" />' );
							} );
			 
						// DataTable
							var table = $('#example').DataTable({
							});
						
							
							// Apply the search
					
							table.columns().eq( 0 ).each( function ( colIdx ) {
								$( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
									table
										.column( colIdx )
										.search( this.value )
										.draw();
								} );
							} );
						});
				</script>
    </body>
</html>
