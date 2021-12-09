
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 //error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");


?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Student Info</title>
        
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
		#example tbody {
		cursor: pointer;
		}
		
		table.display tbody tr:nth-child(even):hover td{
			background-color:  #FF5733 !important
		}
		
		table.display tbody tr:nth-child(odd):hover td{
			background-color:  #FF5733 !important
		}
		
		table.display tbody tr:nth-child(even){
			background-color: #2874a6 !important
		}
		table.display tr.even .sorting_1 { 
			background-color:  #2874a6 !important; 
		}
		
		table.display tbody tr:nth-child(odd){
			background-color:  #229954 !important
		}
		table.display tr.odd .sorting_1 { 
				background-color:  #229954 !important; 
		}
		
		
		.tcontents{
			color:#ffffff;
			font-weight:bold;
			font-size:17px;
		}
		</style>
    </head>
     <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php //include('navi.php') ?>
       <br>
	   <br>
	   <br>
		
		
				<?php
				if(isset($_GET['stukey'])){
							
						$sql1="SELECT * FROM batch_master INNER JOIN student_master ON batch_master.batch_mas_key=student_master.batch_key 
										  INNER JOIN course_master  ON batch_master.course_key=course_master.course_key
										  INNER JOIN facalty_master ON batch_master.facalty_key=facalty_master.facalty_key
										  WHERE student_master.student_key='$_GET[stukey]'";
						$result1 = mysqli_query($link,$sql1);
						while($row1=mysqli_fetch_array($result1)){
								$y1=$row1['student_id'];
								$y2=$row1['student_fullnme'];
								$y3=$row1['initial_nme'];
								$y4=$row1['dob'];
								$y5=$row1['nic_no'];
								$y6=$row1['address'];
								$y7=$row1['student_img'];
								$y8=$row1['course_nme'];
								$y9=$row1['facalty_nme'];
								$y10=$row1['batch_code'];
								$y11=$row1['batch_mas_key'];
						}
						$img="studentphotosupload/".$y7;
				?>
						
					
					
                    <div class="row">
							<div class="col-md-2">
							
							</div>
							<div class="col-md-8">
								<section class="panel panel-transparent">
									<div class="panel-body panel-transparent">
										<table border="0" width="100%">
											<tr style="font-size:16px;font-weight:bold">
												<td rowspan="9" width="20%"><img src="<?php echo $img; ?>" width="100%" height="120px"></td>
												<td width="2%" ></td>
												<td width="15%" class="srf">Student ID </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y1; ?></td>
											</tr>
											<tr style="font-size:16px;font-weight:bold">
												<td width="2%" ></td>
												<td width="15%" class="srf">Facalty Name </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y9; ?></td>
											</tr>
											<tr style="font-size:16px;font-weight:bold">
												<td width="2%"></td>
												<td width="15%" class="srf">Course Name </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y8; ?></td>
											</tr>
											<tr style="font-size:16px;font-weight:bold">
												<td width="2%"></td>
												<td width="15%" class="srf">Batch </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y10; ?></td>
											</tr>
											<tr style="font-size:16px;font-weight:bold">
												<td width="2%"></td>
												<td width="15%" class="srf">Full Name </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y2; ?></td>
											</tr >
											<tr style="font-size:16px;font-weight:bold">
												<td width="2%"></td>
												<td width="15%" class="srf">Initial Name </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y3; ?></td>
											</tr>
											<tr style="font-size:16px;font-weight:bold">
												<td width="2%"></td>
												<td width="15%" class="srf">NIC No </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y5; ?></td>
											</tr>
											<tr style="font-size:16px;font-weight:bold">
												<td width="2%"></td>
												<td width="15%" class="srf">Date of Birth </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y4; ?></td>
											</tr>
											<tr style="font-size:16px;font-weight:bold">
												<td width="2%"></td>
												<td width="15%" class="srf">Address </td>
												<td width="5%" class="srf">:</td>
												<td width="58%" class="srf"><?php echo $y6; ?></td>
											</tr>
											
										</table>
										
									</div>
									
								</section>
							</div>
					</div>
					
					
					<?php
					$sql2="SELECT * FROM cur_statusofbatch_details WHERE batchmas_key='$y11' AND status=0 ORDER BY curstatusbatch_detail_key DESC";
					$result2 = mysqli_query($link,$sql2);
					while($row2=mysqli_fetch_array($result2)){
					?>
						<div class="row">
								<div class="col-md-1">
								
								</div>
								<div class="col-md-10">
									<section class="panel panel-transparent">
										<div class="panel-body panel-transparent">
											<?php
											$b3=0;
											$b4=0;
											$sql3="SELECT * FROM course_master INNER JOIN cur_statusofbatch_details ON course_master.course_key=cur_statusofbatch_details.coursemas_key
																			   INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																			  WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$row2[curstatusbatch_detail_key]'
																			  AND cur_statusofbatch_details.status=0";
											$result3 = mysqli_query($link,$sql3);
											while($row3=mysqli_fetch_array($result3)){
												$b1=$row3['acadamic_yer'];
												$b2=$row3['year_nme'];
												$b3=$row3['course_key'];
												$b4=$row3['year_key'];
												
											}
											?>
											
												<h2 align="center" style="font-weight:bold"><?php echo $b1."-".$b2; ?></h2>
												<table class="table table-striped table-bordered" width="100%">
													<tbody>
														<?php
														$sql4="SELECT * FROM subject_master WHERE course_key='$b3' AND year_key='$b4' AND status=0";
														$result4 = mysqli_query($link,$sql4);
														while($row4=mysqli_fetch_array($result4)){
														?>
														<tr>
															<td width="100%">
																<h4 align="center" style="font-weight:bold"><?php echo $row4['subject_name'];?></h4>
																
																<?php
																$n2=0;
																$sql5="SELECT * FROM lecturedtemgt_details WHERE subject_key='$row4[subject_key]' AND curstateofbatch_key='$row2[curstatusbatch_detail_key]' AND (pending_status IS NULL OR pending_status=1) AND status=0";
																$result5 = mysqli_query($link,$sql5);
																if(mysqli_num_rows($result5)>0){
																		$n1=mysqli_num_rows($result5);
																		
																	$sql6="SELECT * FROM attendance_details WHERE student_key='$_GET[stukey]' AND subject_key='$row4[subject_key]' AND  curstatusofbatch_key='$row2[curstatusbatch_detail_key]' AND status=0";
																	$result6 = mysqli_query($link,$sql6);
																	$n2=mysqli_num_rows($result6);
																	
																?>
																
																<div align="center" style="font-weight:bold;font-size:17px;">Attendance Information</div>
																<div align="center" style="font-weight:bold;font-size:17px;">
																			Subject Lecturing Total Days : <?php echo $n1; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																			Student Attend Days : <?php echo $n2; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																			Average Attendance : <?php echo ($n2/$n1)*100; ?>%
																</div>
																<br>
																
																<?php
																}
																?>
																
																<?php
																$sql7="SELECT * FROM assignmentmgt_master WHERE subject_key='$row4[subject_key]' AND curstateofbatch_key='$row2[curstatusbatch_detail_key]' AND status=0";
																$result7 = mysqli_query($link,$sql7);
																if(mysqli_num_rows($result7)>0){
																?>
																	<div align="center" style="font-weight:bold;font-size:17px;">Assignment Information</div>
																	
																	<table border="1" width="100%">
																		<thead>
																			<tr>
																				<th width="10%">Assignment Date</th>
																				<th width="70%">Assignment Description</th>
																				<th width="10%">Marks</th>
																				<th width="10%">Student Marks</th>
																			</tr>
																		</thead>
																		<tbody>
																				<?php
																				while($row7=mysqli_fetch_array($result7)){
																					echo "<tr>
																	
																						<td width='10%'> ".$row7['datos']."</td>
																						<td width='70%'> ".$row7['description']."</td>
																						<td width='10%' align='right'> ".$row7['marks']."</td>";
																						$sql8="SELECT * FROM assignment_details WHERE assignmentmgt_key='$row7[assignmentmgtmas_key]' AND student_key='$_GET[stukey]' AND subject_key='$row4[subject_key]' AND curstatusofbatch_key='$row2[curstatusbatch_detail_key]' AND status=0";
																						$result8 = mysqli_query($link,$sql8);
																						if(mysqli_num_rows($result8)>0){
																							while($row8=mysqli_fetch_array($result8)){
																								$mks=$row8['marks'];
																							}
																							echo "<td width='10%' align='right'>".$mks."</td>";
																							
																						}
																						else{
																							echo "<td width='10%'> Absent</td>";
																						}
																						
																					echo "</tr>";
																				}
																				?>
																		</tbody>
																	</table>
																<?php
																}
																?>
															</td>
														</tr>
														<?php
														}
														?>
													</tbody>
												</table>
											
										</div>
										
									</section>
								</div>
								
						</div>
					<?php
					}
					?>
				
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
