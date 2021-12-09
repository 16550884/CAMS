
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

?>

<<!DOCTYPE html>
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
							<div style="font-size:16px;font-weight:bold;"align="center">Assignment Process</div>
						</div>
					</section>
				</div>
			</div>
			<div class="row">
                
				<div class="col-md-12">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<table class="table display" id="example" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
												
												<th width="8%">Date</th>
												<th width="25%">Course</th>
												<th width="10%">Batch</th>
												<th width="14%">Semester</th>
												<th width="11%">Subject</th>
												<th width="6%">Method</th>
												<th width="15%">Description</th>
												<th width="5%">Total Marks</th>
												<th width="5%">View Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql1="SELECT * FROM subject_master INNER JOIN assignmentmgt_master ON subject_master.subject_key=assignmentmgt_master.subject_key
																						  INNER JOIN lectureassign_details ON lectureassign_details.subject_key=subject_master.subject_key
																						  INNER JOIN course_master ON subject_master.course_key=course_master.course_key
																						   INNER JOIN year_master ON subject_master.year_key=year_master.year_key
																						   INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																						   INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																						   INNER JOIN cur_statusofbatch_details ON lectureassign_details.cur_statusbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
																						   INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																						   WHERE cur_statusofbatch_details.acadamic_yer='$cur_yr'
																							 AND lecture_master.lecturemas_key='$lec_key'
																						     AND cur_statusofbatch_details.status=0
																							 AND assignmentmgt_master.complete_status IS NULL 
																							 AND assignmentmgt_master.status=0
																							 ORDER BY assignmentmgt_master.datos ASC";
												$result1=mysqli_query($link,$sql1);
												while($row1=mysqli_fetch_array($result1)){
											?>
													<tr class="clickable-row" data-href="assignment_processing.php?suk=<?php echo $row1['subject_key'];?>&curyr=<?php echo $row1['curstatusbatch_detail_key'];?>&ak=<?php echo $row1['assignmentmgtmas_key'];?>">
														<td><div class="tcontents"><?php echo $row1['datos']?></div></td>
														<td><div class="tcontents"><?php echo $row1['course_nme']."-".$row1['facalty_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['batch_code']?></div></td>
														<td><div class="tcontents"><?php echo $row1['year_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['subject_name']?></div></td>
														<td><div class="tcontents"><?php echo $row1['method']?></div></td>
														<td><div class="tcontents"><?php echo $row1['description']?></div></td>
														<td><div class="tcontents"><?php echo $row1['marks']?></div></td>
														<td><a href="assignment_processing.php?suk=<?php echo $row1['subject_key'];?>&curyr=<?php echo $row1['curstatusbatch_detail_key'];?>&ak=<?php echo $row1['assignmentmgtmas_key'];?>"><button class='btn btn-sm btn-primary btn-block'>Process</button></a></td>
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
