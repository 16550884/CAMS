
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

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
										
										<table width="100%" border="0">
											<thead>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Course</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y2; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Faculty</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y1; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Batch </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y4; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Semester </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y3."-".$y5; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Subject </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y11; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Lecturer </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y12; ?></th>
												</tr>
												
											</thead>
										</table>
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
										<h1>Lecture Process Details</h1>
										<table class="table display" id="example" width="100%">
													<thead>
														<tr style="background-color:  #1b4f72 ">
															<th width="20%">Date</th>
															<th width="70%">Term Note</th>
															<th width="10%">Change</th>
															
														</tr>
													</thead>
													<tbody>
														<?php
															$sql1="SELECT * FROM lecturedtemgt_details WHERE subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND (pending_status IS NULL OR pending_status=1) AND status=0";
															$result1=mysqli_query($link,$sql1);
															while($row1=mysqli_fetch_array($result1)){
														?>
																<tr class="clickable-row" data-href="lecture_processing.php?suk=<?php echo $_GET['suk'] ?>&curyr=<?php echo $_GET['curyr'] ?>&lm=<?php echo $row1['lecturedtemgtdetail_key']; ?>">
																	<td><div class="tcontents"><?php echo $row1['datos']?></div></td>
																	<td><div class="tcontents"><?php echo $row1['term_note']?></div></td>
																	<td><a href="lecture_processing.php?suk=<?php echo $_GET['suk'] ?>&curyr=<?php echo $_GET['curyr'] ?>&lm=<?php echo $row1['lecturedtemgtdetail_key']; ?>"><button class='btn btn-sm btn-primary btn-block'>Change</button></a></td>
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
						
						
						<div class="row">
							<div class="col-md-1">
							
							</div>
							<div class="col-md-10">
								<section class="panel panel-transparent">
									<div class="panel-body panel-transparent">
										<h1>Assignment Information</h1>
										<table class="table display" id="example2" width="100%">
													<thead>
														<tr style="background-color:  #1b4f72 ">
															<th width="20%">Date</th>
															<th width="60%">Assignment Description</th>
															<th width="10%">Total Marks</th>
															<th width="10%">Change</th>
															
														</tr>
													</thead>
													<tbody>
														<?php
															$sql2="SELECT * FROM assignmentmgt_master WHERE subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND status=0";
															$result2=mysqli_query($link,$sql2);
															while($row2=mysqli_fetch_array($result2)){
														?>
														
																<tr class="clickable-row" data-href="assignment_processing.php?suk=<?php echo $_GET['suk'] ?>&curyr=<?php echo $_GET['curyr'] ?>&ak=<?php echo $row2['assignmentmgtmas_key']; ?>">
																	<td><div class="tcontents"><?php echo $row2['datos']?></div></td>
																	<td><div class="tcontents"><?php echo $row2['description']?></div></td>
																	<td><div class="tcontents"><?php echo $row2['marks']?></div></td>
																	<td><a href="assignment_processing.php?suk=<?php echo $_GET['suk'] ?>&curyr=<?php echo $_GET['curyr'] ?>&ak=<?php echo $row2['assignmentmgtmas_key']; ?>"><button class='btn btn-sm btn-primary btn-block'>Change</button></a></td>
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
							
							//.......................................................................
							
							$('#example2 thead th').each( function () {
								 var title1 = $('#example2 thead th').eq( $(this).index() ).text();
								
								$(this).html( '<label style="font-size:18px;color:white">'+title1+'</label><input type="text" placeholder="'+title1+'" style="color:black;" class="form-control input-sm" />' );
							} );
			 
							var table1 = $('#example2').DataTable({
							});
						
							
					
							table1.columns().eq( 0 ).each( function ( colIdx ) {
								$( 'input', table1.column( colIdx ).header() ).on( 'keyup change', function () {
									table1
										.column( colIdx )
										.search( this.value )
										.draw();
								} );
							} );
						
						//.......................................................................
						
						});
				</script>
    </body>
</html>
