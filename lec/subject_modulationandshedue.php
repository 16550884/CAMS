
<?php
ob_start();	
include 'conn.php';	
include 'sessionhandaler.php';

?>

<?php
$cur_dte=date("Y-m-d");

		if(isset($_GET['suk']) && isset($_GET['curyr'])){
			$r1=$_GET['suk'];
			$r2=$_GET['curyr'];
			
			if($r1==null){
				header("location:dashboard.php");
			}
			else{
				$sql1="SELECT * FROM subject_master WHERE subject_key='$r1' AND status=0";
				$result1 = mysqli_query($link,$sql1);
				if(mysqli_num_rows($result1)==0){
					header("location:dashboard.php");
				}
				else{
					$status=1;
				}
			}
		}
		else{
			header("location:dashboard.php");
		}
?>

<?php
$cur_dte=date("Y-m-d");

if(isset($_GET['suk']) && isset($_GET['curyr'])){
	$sql2="SELECT * FROM lectureassign_details WHERE subject_key='$_GET[suk]' AND cur_statusbatch_key='$_GET[curyr]' AND status=0";
	$result2 = mysqli_query($link,$sql2);
	if(mysqli_num_rows($result2)==0){
		echo "<script>
				alert('First Assign this subject Lecturer');
				window.location.href='dashboard.php';
			</script>";
	}
	
	if(isset($_POST['btn_subjectmodulation'])){
		$nm1=$_POST['txt_lession'];
		$nm2=$_POST['txt_sheduledte'];
		$nm3=$_POST['txt_acadamicweek'];
		$nm4=$_POST['txt_hours'];
		$nm5=$_POST['txt_resourcecost'];
		$nm6=$_POST['txt_serviceutility'];
		$nm7=$_POST['txt_learningprocess'];
		$nm8=$_POST['txt_methodology'];
		$nm9=$_POST['txt_termnoteremark'];
		
		
		$sql4="SELECT * FROM shedule_details WHERE curstausofbatch_key='$_GET[curyr]' AND subject_key='$_GET[suk]' AND lesson_nme='$nm1' AND shedule_dte='$nm2' AND status=0";
		$result4 = mysqli_query($link,$sql4);
		if(mysqli_num_rows($result4)==0){
			$sql5="INSERT INTO shedule_details (status,sheduledetail_key,curstausofbatch_key,subject_key,lesson_nme,shedule_dte,acadamic_week,hours,resource_cost,services_utility,learning_process,methodology,termnote_remark,act_person)
										VALUES (0,NULL,'$_GET[curyr]','$_GET[suk]','$nm1','$nm2','$nm3','$nm4','$nm5','$nm6','$nm7','$nm8','$nm9','$ukey')";
			if(mysqli_query($link,$sql5)){
				echo "<script>
						alert('Successfully Entered Subject Module and schedule');
						window.location.href='subject_modulationandshedue.php?suk=$_GET[suk]&curyr=$_GET[curyr]';
					</script>";
				
			}
		}
		else{
				echo "<script>
						alert('Already Added this Subject Module and schedule');
						
					</script>";
		}
		
	}
	
	$sql7="SELECT * FROM shedule_details WHERE curstausofbatch_key='$_GET[curyr]' AND subject_key='$_GET[suk]' AND status=0";
	$result7 = mysqli_query($link,$sql7);
	while($row7=mysqli_fetch_array($result7)){
	
			$e1="txt_subkeyos".$row7['sheduledetail_key'];
			$e2="txt_sheduleos".$row7['sheduledetail_key'];
			$e3="txt_acadamios".$row7['sheduledetail_key'];
			$e4="txt_houros".$row7['sheduledetail_key'];
			$e5="txt_lessonos".$row7['sheduledetail_key'];
			$e6="txt_resorceos".$row7['sheduledetail_key'];
			$e7="txt_serviceutlityos".$row7['sheduledetail_key'];
			$e8="txt_lerningprocessos".$row7['sheduledetail_key'];
			$e9="txt_methologyos".$row7['sheduledetail_key'];
			$e10="txt_termnoteremrkos".$row7['sheduledetail_key'];
			
			$btn_update1="btn_change".$row7['sheduledetail_key'];
			$btn_remove1="btn_remove".$row7['sheduledetail_key'];
			
			
			if(isset($_POST[$btn_update1])){
				$t1=$_POST[$e1];
				$t2=$_POST[$e2];
				$t3=$_POST[$e3];
				$t4=$_POST[$e4];
				$t5=$_POST[$e5];
				$t6=$_POST[$e6];
				$t7=$_POST[$e7];
				$t8=$_POST[$e8];
				$t9=$_POST[$e9];
				$t10=$_POST[$e10];
				
				$sql8="SELECT * FROM shedule_details WHERE curstausofbatch_key='$_GET[curyr]' AND subject_key='$_GET[suk]' AND lesson_nme='$t5' AND shedule_dte='$t2' AND status=0";
				$result8 = mysqli_query($link,$sql8);
				if(mysqli_num_rows($result8)==0){
					$sql9="UPDATE shedule_details SET shedule_dte='$t2',acadamic_week='$t3',hours='$t4',resource_cost='$t6',services_utility='$t7',learning_process='$t8',methodology='$t9',termnote_remark='$t10',act_person='$ukey' WHERE sheduledetail_key='$t1'";
					if(mysqli_query($link,$sql9)){
							echo "<script>
									alert('Successfully Updated Subject Module and schedule');
									window.location.href='subject_modulationandshedue.php?suk=$_GET[suk]&curyr=$_GET[curyr]';
								</script>";
				
					}
				}
				else{
					echo "<script>
							alert('Already Added this Subject Module and schedule');
							
						</script>";
				}
				
			}
			if(isset($_POST[$btn_remove1])){
				$t1=$_POST[$e1];
				
				$sql10="UPDATE shedule_details SET status=1 WHERE sheduledetail_key='$t1' AND status=0";
				if(mysqli_query($link,$sql10)){
						echo "<script>
									alert('Successfully Deleted Subject Module and schedule');
									window.location.href='subject_modulationandshedue.php?suk=$_GET[suk]&curyr=$_GET[curyr]';
							</script>";
				}
				else{
					echo "<script>
							alert('Execute Error');
						</script>";
				}
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
	   
	   <div class="row">
				<div class="col-md-5">
				
				</div>
				<div class="col-md-6">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<div style="font-size:16px;font-weight:bold;"align="center">Course Information</div>
						</div>
					</section>
				</div>
			</div>
	   
	   
	<?php
	if(isset($_GET['suk']) && isset($_GET['curyr'])){
		
		$sql1="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
										INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
										INNER JOIN course_master ON course_master.course_key=cur_statusofbatch_details.coursemas_key
										INNER JOIN facalty_master ON facalty_master.facalty_key=course_master.facalty_key
										WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$_GET[curyr]' AND 
											 cur_statusofbatch_details.status=0";
		$result1 = mysqli_query($link,$sql1);
		while($row1=mysqli_fetch_array($result1)){
			$y1=$row1['facalty_nme'];
			$y2=$row1['course_nme'];
			$y3=$row1['acadamic_yer'];
			$y4=$row1['batch_code'];
			$y5=$row1['year_nme'];
			
		}
		
		$sql3="SELECT * FROM lectureassign_details INNER JOIN subject_master ON lectureassign_details.subject_key=subject_master.subject_key
													INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
											WHERE subject_master.subject_key='$_GET[suk]' 
											    AND lectureassign_details.cur_statusbatch_key='$_GET[curyr]'
												AND subject_master.status=0
												AND lectureassign_details.status=0";
		$result3 = mysqli_query($link,$sql3);
		while($row3=mysqli_fetch_array($result3)){
			$y11=$row3['subject_name'];
			$y12=$row3['lecture_nme'];
		}
	?>
		
			<div class="row">
                <div class="col-md-5">
				
				</div>
				<div class="col-md-6">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<!--<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y1." - ".$y2." - ".$y4;?></h2>-->
							<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y3." - ".$y5;?></h2>
							<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y11;?></h2>
							<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y12;?></h2>
						</div>
					</section>
				</div>
			</div>
			
			
			<div class="row">
                <div class="col-md-5">
				
				</div>
				<div class="col-md-6">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form role="form" method="post" name="f1">
									
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Lesson :</label>   
									<input type="text" class="form-control input-sm" name="txt_lession" required placeholder="Please Enter Lesson">
								</div> 
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Schedule Date :</label>   
									<input type="date" class="form-control input-sm" name="txt_sheduledte" required placeholder="Please Enter Schedule Date">
								</div>
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Academic week :</label>   
									<select class="form-control input-sm" name="txt_acadamicweek" required>
										<option value="" disabled selected hidden>Please Choose.............</option>
										<option value="1Week">1Week</option>
										<option value="2Week">2Week</option>
										<option value="3Week">3Week</option>
										<option value="4Week">4Week</option>
										<option value="5Week">5Week</option>
										<option value="6Week">6Week</option>
										<option value="7Week">7Week</option>
										<option value="8Week">8Week</option>
										<option value="9Week">9Week</option>
										<option value="10Week">10Week</option>
										<option value="11Week">11Week</option>
										<option value="12Week">12Week</option>
										<option value="13Week">13Week</option>
										<option value="14Week">14Week</option>
										<option value="15Week">15Week</option>
										<option value="16Week">16Week</option>
										<option value="17Week">17Week</option>
										<option value="18Week">18Week</option>
										<option value="19Week">19Week</option>
										<option value="20Week">20Week</option>
										<option value="21Week">21Week</option>
										<option value="22Week">22Week</option>
										<option value="23Week">23Week</option>
										<option value="24Week">24Week</option>
										<option value="25Week">25Week</option>
										<option value="26Week">26Week</option>
										<option value="27Week">27Week</option>
										<option value="28Week">28Week</option>
										<option value="29Week">29Week</option>
										<option value="30Week">30Week</option>
										<option value="31Week">31Week</option>
										<option value="32Week">32Week</option>
										<option value="33Week">33Week</option>
										<option value="34Week">34Week</option>
										<option value="35Week">35Week</option>
										<option value="36Week">36Week</option>
										<option value="37Week">38Week</option>
										<option value="38Week">39Week</option>
										<option value="39Week">40Week</option>
										<option value="40Week">41Week</option>
										<option value="41Week">42Week</option>
									</select>
								</div>
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Hours  :</label>   
									<input type="number" class="form-control input-sm" name="txt_hours" min=0 required placeholder="Please Enter Hours">
								</div>
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Resource and Cost  :</label>   
									<input type="text" class="form-control input-sm" name="txt_resourcecost" required placeholder="Please Enter Resource and Cost">
								</div>
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Services and Utility  :</label>   
									<input type="text" class="form-control input-sm" name="txt_serviceutility" required placeholder="Please Enter Services and Utility">
								</div>
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Learning Process  :</label>   
									<input type="text" class="form-control input-sm" name="txt_learningprocess" required placeholder="Please Enter Learning Process">
								</div>
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Methodology  :</label>   
									<input type="text" class="form-control input-sm" name="txt_methodology" required placeholder="Please Enter Methodology">
								</div>
								
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Term Note Remark  :</label>   
									<textarea class="form-control input-sm" name="txt_termnoteremark" required></textarea>
								</div>
								<button class="btn btn-lg btn-primary btn-block" name='btn_subjectmodulation' type="submit">Add</button>
							
							</form>
						</div>
					</section>
				</div>
			</div>
			
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
											<th width="15%"><font color="red">&lowast;</font>Lesson</th>
											<th width="8%"><font color="red">&lowast;</font>Schedule Date</th>
											<th width="8%"><font color="red">&lowast;</font>Academic Week</th>
											<th width="8%"><font color="red">&lowast;</font>Hours</th>
											<th width="10%"><font color="red">&lowast;</font>Resource and Cost</th>
											<th width="10%"><font color="red">&lowast;</font>Services and Utility</th>
											<th width="10%"><font color="red">&lowast;</font>Learning Process</th>
											<th width="10%"><font color="red">&lowast;</font>Methodology</th>
											<th width="10%"><font color="red">&lowast;</font>Term Note Remark</th>
											<th width="10%"><font color="red">&lowast;</font>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql6="SELECT * FROM shedule_details WHERE curstausofbatch_key='$_GET[curyr]' AND subject_key='$_GET[suk]' AND status=0";
										$result6 = mysqli_query($link,$sql6);
										while($row6=mysqli_fetch_array($result6)){
											
											$txt_subkeyos="txt_subkeyos".$row6['sheduledetail_key'];
											
											$txt_sheduleos="txt_sheduleos".$row6['sheduledetail_key'];
											$txt_acadamios="txt_acadamios".$row6['sheduledetail_key'];
											$txt_houros="txt_houros".$row6['sheduledetail_key'];
											$txt_lessonos="txt_lessonos".$row6['sheduledetail_key'];
											$txt_resorceos="txt_resorceos".$row6['sheduledetail_key'];
											$txt_serviceutlityos="txt_serviceutlityos".$row6['sheduledetail_key'];
											$txt_lerningprocessos="txt_lerningprocessos".$row6['sheduledetail_key'];
											$txt_methologyos="txt_methologyos".$row6['sheduledetail_key'];
											$txt_termnoteremrkos="txt_termnoteremrkos".$row6['sheduledetail_key'];
											
											$btn_remove="btn_remove".$row6['sheduledetail_key'];
											$btn_change="btn_change".$row6['sheduledetail_key'];
											echo "<tr>
																
																<td width='20%'>
																		<input type='hidden' class='form-control input-sm' name=".$txt_subkeyos." value=".$row6['sheduledetail_key'].">
																		<input type='hidden' class='form-control input-sm' name=".$txt_lessonos." value=".$row6['lesson_nme'].">
																		".$row6['lesson_nme']."
																</td>
																<td width='8%'>
																		<input type='date' class='form-control input-sm' name=".$txt_sheduleos." value=".$row6['shedule_dte'].">
																</td>
																<td width='2%'>
																		<select class='form-control input-sm' name=".$txt_acadamios.">
																			<option value=".$row6['acadamic_week'].">".$row6['acadamic_week']."</option>
																			<option value=1Week>1Week</option>
																			<option value=2Week>2Week</option>
																			<option value=3Week>3Week</option>
																			<option value=4Week>4Week</option>
																			<option value=5Week>5Week</option>
																			<option value=6Week>6Week</option>
													<option value=7Week>7Week</option>
													<option value=8Week>8Week</option>
													<option value=9Week>9Week</option>
													<option value=10Week>10Week</option>
													<option value=11Week>11Week</option>
													<option value=12Week>12Week</option>
													<option value=13Week>13Week</option>
													<option value=14Week>14Week</option>
													<option value=15Week>15Week</option>
													<option value=16Week>16Week</option>
													<option value=17Week>17Week</option>
													<option value=18Week>18Week</option>
													<option value=19Week>19Week</option>
													<option value=20Week>20Week</option>
													<option value=21Week>21Week</option>
													<option value=22Week>22Week</option>
													<option value=23Week>23Week</option>
													<option value=24Week>24Week</option>
													<option value=25Week>25Week</option>
													<option value=26Week>26Week</option>
													<option value=27Week>27Week</option>
													<option value=28Week>28Week</option>
													<option value=29Week>29Week</option>
													<option value=30Week>30Week</option>
																		</select>
																</td>
																<td width='2%'>
																		<input type='number' class='form-control input-sm' name=".$txt_houros." value=".$row6['hours'].">
																</td>
																<td width='15%'>
																		<textarea class='form-control input-sm' name=".$txt_resorceos.">".$row6['resource_cost']."</textarea>
																</td>
																<td width='10%'>
																		<textarea class='form-control input-sm' name=".$txt_serviceutlityos.">".$row6['services_utility']."</textarea>
																</td>
																<td width='10%'>
																		<textarea class='form-control input-sm' name=".$txt_lerningprocessos.">".$row6['learning_process']."</textarea>
																</td>
																<td width='10%'>
																		<textarea class='form-control input-sm' name=".$txt_methologyos.">".$row6['methodology']."</textarea>
																</td>
																<td width='10%'>
																		<textarea class='form-control input-sm' name=".$txt_termnoteremrkos.">".$row6['termnote_remark']."</textarea>
																</td>
																<td width='12%'>
																	<input type='submit' class='btn btn-sm btn-success' value='Change' name=".$btn_change.">
																	<input type='submit' class='btn btn-sm btn-danger' value='Delete' name=".$btn_remove."><br>
																</td>
												</tr>";
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
