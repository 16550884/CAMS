
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

	if(isset($_POST['btn_batchadd'])){
		$n1=$_POST['sele_course'];
		$n2=$_POST['sele_year'];
		$n3=$_POST['txt_batchcode'];
		
		$sql10="SELECT * FROM course_master WHERE course_key='$n1'";
		$result10=mysqli_query($link,$sql10);
		while($row10=mysqli_fetch_array($result10)){
			$facd_key=$row10['facalty_key'];
		}
		
		$sql1="SELECT * FROM batch_master WHERE facalty_key='$facd_key' AND course_key='$n1' AND batch_year='$n2' AND batch_code='$n3' AND status=0";
		$result1 = mysqli_query($link,$sql1);
		if(mysqli_num_rows($result1)==0){
			
			$sql2 = "INSERT INTO batch_master (status,batch_mas_key,facalty_key,course_key,batch_code,batch_year) VALUES 
											(0,NULL,'$facd_key','$n1','$n3','$n2')";
			if(mysqli_query($link,$sql2)){
				echo "<script>
						alert('Successfully Entered Batch');
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
	
	$sql3="SELECT * FROM batch_master WHERE status=0 ORDER BY batch_mas_key DESC";
	$result3 = mysqli_query($link,$sql3);
	while($row3=mysqli_fetch_array($result3)){
			
			$e1="txt_batchkey".$row3['batch_mas_key'];
			$e2="txt_batchcode".$row3['batch_mas_key'];
			$e3="txt_batchyear".$row3['batch_mas_key'];
			$e4="sele_course".$row3['batch_mas_key'];
		
			
			$btn_update1="btn_change".$row3['batch_mas_key'];
			$btn_remove1="btn_remove".$row3['batch_mas_key'];
			
		if(isset($_POST[$btn_update1])){	
			$t1=$_POST[$e1];
			$t2=$_POST[$e2];
			$t3=$_POST[$e3];
			$t4=$_POST[$e4];
			
			$sql8="SELECT * FROM course_master WHERE course_key='$t4'";
			$result8 = mysqli_query($link,$sql8);
			while($row8=mysqli_fetch_array($result8)){
				 	$fac_key=$row8['facalty_key'];
			}
			
			$sql9="UPDATE batch_master SET facalty_key='$fac_key',course_key='$t4',batch_code='$t2',batch_year='$t3' WHERE batch_mas_key='$t1'";
			if(mysqli_query($link,$sql9)){
					echo "<script>
							alert('Successfully Updated Batch');
						</script>";
			}
			else{
					echo "<script>
							alert('Execute Error');
						</script>";
			}
		}
		
		if(isset($_POST[$btn_remove1])){
				$t1=$_POST[$e1];
				
				echo "<script>
				if (window.confirm('Are you sure you want to delete this item?')) { 
					window.location.href='batch_info.php?sd=$t1';
				}
				</script>";
				
		}
		
		if(isset($_GET['sd'])){
				$sql5="UPDATE batch_master SET status=1 WHERE batch_mas_key='$_GET[sd]' AND status=0";
				if(mysqli_query($link,$sql5)){
					echo "<script>
							alert('Successfully Deleted Batch');
							window.location.href='batch_info.php';
						</script>";
				}
				else{
					echo "<script>
							alert('Execute Error');
							window.location.href='batch_info.php';
						</script>";
				}
		}
			
	}
?>
<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Course Information</title>
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
							<div style="font-size:16px;font-weight:bold;"align="center">Bach Information</div>
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
                                                 	
													if(isset($_POST['sele_year']) || isset($_POST['sele_course'])){
													 				
															$sql15="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.course_key='$_POST[sele_course]' AND  course_master.status=0";
															$result15=mysqli_query($link,$sql15);
															$option15 ="";
															while($row15=mysqli_fetch_array($result15)){
																$option15 = $option15."<option value=$row15[course_key]>$row15[course_nme]-$row15[facalty_nme]</option>";			//Load Reagon Name
															}
														echo $option15;
													    echo $option4;
														
													}
													else{
													  
														echo "<option value='' disabled selected hidden>Please Choose.............</option>";
														echo $option4;
													}
													
                                          ?>
									</select>
								</div> 
								
								<?php
								if(isset($_POST['sele_course'])){
								?>
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Batch Year </label> 
									<select class="form-control input-sm" name="sele_year" required onchange="this.form.submit()">
										<?php
                                                 	if(isset($_POST['sele_year']) || isset($_POST['sele_course'])){
													  echo "<option value='$_POST[sele_year]'>$_POST[sele_year]</option>";
													  echo "<option value='2022'>2022</option>";
													  echo "<option value='2021'>2021</option>";
													  echo "<option value='2020'>2020</option>";
													  echo "<option value='2019'>2019</option>";
													}
													else{
													
													  echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													  echo "<option value='2022'>2022</option>";
													  echo "<option value='2021'>2021</option>";
													  echo "<option value='2020'>2020</option>";
													  echo "<option value='2019'>2019</option>";
													}
													
                                          ?>
									</select>
								</div> 
								<div class="form-group">                
									<label class="control-label"  ><font color="red">&lowast;</font>Batch Code :</label>  
									<?php
									if(isset($_POST['sele_year']) || isset($_POST['sele_course'])){
										$sql16="SELECT * FROM course_master WHERE course_key='$_POST[sele_course]'";
										$result16=mysqli_query($link,$sql16);
										while($row16=mysqli_fetch_array($result16)){
											$cs_code=$row16['course_code'];
											
										}
										
										$cs_cd=$_POST['sele_year']."".$cs_code;
									}
										
									?>
									<input type="text"  class="form-control input-sm" name="txt_batchcode" value="<?php if(isset($_POST['sele_year'])){ echo $cs_cd;} ?>" required placeholder="Please Enter Batch Code">
								</div> 
								<?php
								}
								?>
								<button class="btn btn-lg btn-primary btn-block" name='btn_batchadd' type="submit">Add</button>
								
							</form>
						</div>
					</section>
				</div>
			</div>
	
		
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-1">
							
				</div>
				<div class="col-md-12">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<table class="tables display" id="example" width="100%">
								<thead>
									<tr>
										<th width="40%"><font color="red">&lowast;</font>Course</th>
										<th width="2%"><font color="red">&lowast;</font>Batch Year</th>
										<th width="2%"><font color="red">&lowast;</font>Batch Code</th>
										<th width="50%">Action</th>
									</tr>
								</thead>
								<tbody>
									
												<?php
													$sql14="SELECT * FROM batch_master WHERE status=0 ORDER BY batch_mas_key DESC";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														
														$txt_batkey="txt_batchkey".$row14['batch_mas_key'];
														$txt_batcode="txt_batchcode".$row14['batch_mas_key'];
														$txt_batyear="txt_batchyear".$row14['batch_mas_key'];
														$txt_course="sele_course".$row14['batch_mas_key'];
														
														$btn_remove="btn_remove".$row14['batch_mas_key'];
														$btn_change="btn_change".$row14['batch_mas_key'];
														
														$q1=$row14['batch_mas_key'];
														$q2=$row14['batch_code'];
														$q3=$row14['batch_year'];
														
														$sql7="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.course_key='$row14[course_key]'";
														$result7 = mysqli_query($link,$sql7);
														$option1="";
														while($row7=mysqli_fetch_array($result7)){
															 
															 $option1 = $option1."<option value=$row7[course_key]>c</option>";
															 $nm1=$row7['course_nme']."-".$row7['facalty_nme'];
														}
														
														echo "<tr class='clickable-row'>
															<form method='post' name='f2'>
																<input type='hidden' class='form-control input-sm' name=".$txt_batkey." value=".$q1.">
																<td width='60%'>
																	".$nm1."
																</td>
																<td width='20%'>".$q3."</td>
																<td width='20%'>".$q2." </td>
																<td width='20%'>
																	
																	<input type='submit' class='btn btn-sm btn-danger' value='Delete' name=".$btn_remove.">
																	
																</td>
																</form>
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
		
		<link rel="stylesheet" type="text/css" href="datatable/dataTables.min.css" />
				<script type="text/javascript" src="datatable/dataTables.min.js"></script> 	
	
			<script type="text/javascript" charset="utf-8">
						$(document).ready(function() {
							$('#example thead th').each( function () {
								 var title = $('#example thead th').eq( $(this).index() ).text();
								
								$(this).html( '<label style="font-size:18px;">'+title+'</label><input type="text" placeholder="'+title+'" style="color:black;" class="form-control input-sm" />' );
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
						//......................................................................
						
							
						//.....................................................................
							$(".clickable-row").click(function() {
								
							  });
						});
				
			</script>
    </body>
</html>
