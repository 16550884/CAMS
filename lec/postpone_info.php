
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

if(isset($_GET['suk']) && isset($_GET['curyr']) && isset($_GET['shk'])){
	
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
	
	if(isset($_POST['btn_postpone'])){
		
		$sql2="SELECT * FROM lecturedtemgt_details WHERE datos='$cur_dte' AND subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND lecture_key='$lec_key' AND status=0";
		$result2 = mysqli_query($link,$sql2);
		if(mysqli_num_rows($result2)==0){
			$sql3="INSERT INTO lecturedtemgt_details(status,lecturedtemgtdetail_key,datos,subject_key,curstateofbatch_key,lecture_key,pending_status,term_note,shedule_key,act_person)
										VALUES (0,NULL,'$cur_dte','$_GET[suk]','$_GET[curyr]','$lec_key',2,'$_POST[txt_termnote]','$_GET[shk]','$ukey')";
			if(mysqli_query($link,$sql3)){
				
				$sql7="SELECT * FROM lecturedtemgt_details WHERE datos='$cur_dte' AND subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND lecture_key='$lec_key' AND status=0";
				$result7 = mysqli_query($link,$sql7);
				while($row7=mysqli_fetch_array($result7)){
					$lm=$row7['lecturedtemgtdetail_key'];
				}
				
				echo "<script>
				alert('Successfully Postpone this schedule');
				window.location.href='postpone_info.php?suk=$_GET[suk]&curyr=$_GET[curyr]&shk=$_GET[shk]&lm=$lm';
				</script>";
			}
		}
		else{
			$sql8="UPDATE lecturedtemgt_details SET term_note='$_POST[txt_termnote]' WHERE datos='$cur_dte' AND subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND lecture_key='$lec_key' AND pending_status=2 AND status=0";
			if(mysqli_query($link,$sql8)){
				echo "<script>
					alert('Successfully Update Postpone Details');
					window.location.href='postpone_info.php?suk=$_GET[suk]&curyr=$_GET[curyr]&shk=$_GET[shk]&lm=$_GET[lm]';
				</script>";
			}
		}
		
		
	}
	
	
}
?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Postpone Details</title>
        
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
											}
										?>
											<h2 style="font-weight:bold;font-size:28px;" align="center"><?php echo $sdte;?></h2>
											
											
															<form role="form" method="post" name="f2">
																<div class="form-group">
																	<label>Term Note</label>
																	<textarea class="form-control input-sm" name="txt_termnote"><?php echo $snte; ?></textarea>
																</div>
																<div class="form-group">
																	<button type="submit" name="btn_postpone" class="btn btn-danger btn-lg btn-block">Update</button>
																</div>
															</form>
													
										<?php
										}
										else{
										?>
											<h2 style="font-weight:bold;font-size:28px;" align="center"><?php echo $cur_dte;?></h2>
											<form role="form" method="post" name="f2">
																<div class="form-group">
																	<label>Term Note</label>
																	<textarea class="form-control input-sm" name="txt_termnote"></textarea>
																</div>
																<div class="form-group">
																	<button type="submit" name="btn_postpone" class="btn btn-danger btn-lg btn-block">Postpone</button>
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
