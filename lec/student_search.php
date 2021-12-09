
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

?>

<?php

$sql4="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.status=0";
$result4=mysqli_query($link,$sql4);
$option4 ="";
while($row4=mysqli_fetch_array($result4)){
	$option4 = $option4."<option value=$row4[course_key]>$row4[course_nme]-$row4[facalty_nme]</option>";			//Load Reagon Name
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
			echo "<script>
				window.location.href='stu_info.php?stukey=$stu_keyos';
				</script>";
			
		}
	}
	
	if(isset($_POST['btn_selectbatch'])){
	
		$nm1=$_POST['sele_batch'];
		echo "<script>
				window.location.href='student_search.php?batch=$nm1';
			</script>";
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
				<div class="col-md-1">
				
				</div>
				<div class="col-md-10">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<div style="font-size:16px;font-weight:bold;"align="center">Search Student</div>
						</div>
					</section>
				</div>
			</div>
			<div class="row">
                <div class="col-md-1">
				
				</div>
				<div class="col-md-10">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form role="form" method="post" name="f3">
													<div class="form-group">
														<label>Bar-code Search</label>
														<input type="text" class="form-control input-lg" name="txt_barcode" placeholder="Barcode Search">
													</div>
													<div class="form-group">
														<button type="submit" name="btn_barcode" class="btn btn-primary btn-lg btn-block">Bar-code Search</button>
													</div>
							</form>
							
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
									<label class="control-label"><font color="red">&lowast;</font>Batch </label> 
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
								<button class="btn btn-lg btn-primary btn-block" name='btn_selectbatch' type="submit">Select Batch</button>
							</form>
							
							<?php
							if(isset($_GET['batch'])){
							?>
								<table class="table display" id="example" width="100%">
											<thead>
												<tr style="background-color:  #1b4f72 ">
													<th width="8%">Student ID</th>
													<th width="26%">Full Name</th>
													<th width="15%">Initial Name</th>
													<th width="30%">Address</th>
													<th width="8%">NIC No</th>
													<th width="8%">Date of Birth</th>
													<th width="5%">Find</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sql1="SELECT * FROM batch_master INNER JOIN student_master ON batch_master.batch_mas_key=student_master.batch_key 
																						  INNER JOIN course_master  ON batch_master.course_key=course_master.course_key
																						  INNER JOIN facalty_master ON batch_master.facalty_key=facalty_master.facalty_key
																						  WHERE student_master.batch_key='$_GET[batch]'";
													$result1=mysqli_query($link,$sql1);
													while($row1=mysqli_fetch_array($result1)){
												?>
														<tr class="clickable-row" data-href="stu_info.php?stukey=<?php echo $row1['student_key'];?>">
																	<td width="8%"><div class="tcontents"><?php echo $row1['student_id'];?></div></td>
																	<td width="26%"><div class="tcontents"><?php echo $row1['student_fullnme'];?></div></td>
																	<td width="15%"><div class="tcontents"><?php echo $row1['initial_nme'];?></div></td>
																	<td width="30%"><div class="tcontents"><?php echo $row1['address']?></div></td>
																	<td width="8%"><div class="tcontents"><?php echo $row1['nic_no'];?></div></td>
																	<td width="8%"><div class="tcontents"><?php echo $row1['dob'];?></div></td>
																	<td width="5%">
																		<a href="stu_info.php?stukey=<?php echo $row1['student_key'];?>"><button class='btn btn-sm btn-success'>Find</button></a>
																	</td>
														</tr>
												<?php
													}
												?>
											
											</tbody>
								 </table>
							 <?php
							 }
							 ?>
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
