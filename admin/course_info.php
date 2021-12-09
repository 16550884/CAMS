
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 
?>

<?php
$cur_dte=date("Y-m-d");

$sql4="SELECT * FROM facalty_master WHERE status=0";
$result4=mysqli_query($link,$sql4);
$option4 ="";
while($row4=mysqli_fetch_array($result4)){
	$option4 = $option4."<option>$row4[facalty_nme]</option>";			//Load Reagon Name
}

	if(isset($_POST['btn_courseadd'])){
		$n1=$_POST['sele_facalty'];
		$n2=$_POST['txt_course'];
		$n3=$_POST['txt_coursecode'];
		
		$sql6="SELECT * FROM facalty_master WHERE facalty_nme='$n1'";
		$result6=mysqli_query($link,$sql6);
		while($row6=mysqli_fetch_array($result6)){
			$facaltykey=$row6['facalty_key'];
		}
		
		$sql10="SELECT * FROM course_master WHERE course_code='$n3' AND status=0";
		$result10 = mysqli_query($link,$sql10);
		if(mysqli_num_rows($result10)==0){
		
			$sql1="SELECT * FROM course_master WHERE facalty_key='$facaltykey' AND course_nme='$n2' AND status=0";
			$result1 = mysqli_query($link,$sql1);
			if(mysqli_num_rows($result1)==0){
				
				$sql2 = "INSERT INTO course_master (status,course_key,facalty_key,course_nme,course_code) VALUES 
												(0,NULL,'$facaltykey','$n2','$n3')";
				if(mysqli_query($link,$sql2)){
					echo "<script>
							alert('Successfully Entered Course');
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
					// alert('Already Added this information');
					alert('You are trying to enter a course name that was previously entered under the same department');
				</script>";
			}
		}
		else{
			echo "<script>
					alert('Already Added this Course Code');
				</script>";
		}
	}
	
	$sql3="SELECT * FROM course_master WHERE status=0 ORDER BY course_key DESC";
	$result3 = mysqli_query($link,$sql3);
	while($row3=mysqli_fetch_array($result3)){
			
			$e1="txt_coursekey".$row3['course_key'];
			$e2="txt_coursenme".$row3['course_key'];
			$e4="txt_coursecd".$row3['course_key'];
			$e3="sele_facalty".$row3['course_key'];
		
			
			$btn_update1="btn_change".$row3['course_key'];
			$btn_remove1="btn_remove".$row3['course_key'];
			
		if(isset($_POST[$btn_update1])){	
			$t1=$_POST[$e1];
			$t2=$_POST[$e2];
			$t3=$_POST[$e3];
			$t4=$_POST[$e4];
			
			$sql8="SELECT * FROM facalty_master WHERE facalty_nme='$t3'";
			$result8 = mysqli_query($link,$sql8);
			while($row8=mysqli_fetch_array($result8)){
				 	$fac_key=$row8['facalty_key'];
			}
			
			$sql9="UPDATE course_master SET facalty_key='$fac_key',course_nme='$t2',course_code='$t4' WHERE course_key='$t1'";
			if(mysqli_query($link,$sql9)){
					echo "<script>
							alert('Successfully Updated Course');
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
					window.location.href='course_info.php?sd=$t1';
				}
				</script>";
				
		}
	}
	
	if(isset($_GET['sd'])){
				$sql5="UPDATE course_master SET status=1 WHERE course_key='$_GET[sd]' AND status=0";
				if(mysqli_query($link,$sql5)){
					echo "<script>
							alert('Successfully Deleted Course');
							window.location.href='course_info.php';
						</script>";
				}
				else{
					echo "<script>
							alert('Execute Error');
							window.location.href='course_info.php';
						</script>";
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
							<div style="font-size:16px;font-weight:bold;"align="center">Course Information</div>
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
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Department</label> 
									<select class="form-control input-sm" name="sele_facalty" required>
										<?php
                                                 	
													
													  echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													  echo $option4;
													
                                          ?>
									</select>
								</div> 
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Course :</label>   
									<input type="text" class="form-control input-sm" name="txt_course" required placeholder="Please Enter Course Name">
								</div> 
								<div class="form-group">                
									<label class="control-label col-md-4"><font color="red">&lowast;</font>Course Code :</label>   
									<input type="text" class="form-control input-sm" name="txt_coursecode" required placeholder="Please Enter Course Code">
								</div> 
								<button class="btn btn-lg btn-primary btn-block" name='btn_courseadd' type="submit">Add</button>
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
							<table class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
										<th width="50%"><font color="red">&lowast;</font>Course</th>
										<th width="10%"><font color="red">&lowast;</font>Course Code</th>
										<th width="25%"><font color="red">&lowast;</font>Department </th>
										<th width="15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<form method="post" name="f2">
												<?php
													$sql14="SELECT * FROM course_master WHERE status=0 ORDER BY course_key DESC";
													$result14 = mysqli_query($link,$sql14);
													while($row14=mysqli_fetch_array($result14)){
														
														$txt_coukey="txt_coursekey".$row14['course_key'];
														$txt_counme="txt_coursenme".$row14['course_key'];
														$txt_cousecd="txt_coursecd".$row14['course_key'];
														$txt_facos="sele_facalty".$row14['course_key'];
														
														$btn_remove="btn_remove".$row14['course_key'];
														$btn_change="btn_change".$row14['course_key'];
														
														$q1=$row14['course_key'];
														$q2=$row14['course_nme'];
														$q3=$row14['course_code'];
														
														$sql7="SELECT * FROM facalty_master WHERE facalty_key='$row14[facalty_key]'";
														$result7 = mysqli_query($link,$sql7);
														$option1="";
														while($row7=mysqli_fetch_array($result7)){
															 $option1= $option1."<option>$row7[facalty_nme]</option>";	
														}
														echo "<tr>
																
																<td width='40%'>
																<input type='hidden' class='form-control input-sm' name=".$txt_coukey." value=".$q1.">
																<textarea name=".$txt_counme."   required style='height:30px;width:100%;' >".$q2."</textarea>
																</td>
																
																<td width='10%'>
																	<input type='text' class='form-control input-sm' name=".$txt_cousecd." value=".$q3.">
																</td>

																<td width='10%'>
																	<select class='form-control input-sm' name=".$txt_facos." required>
																	   ".$option1."
																		".$option4."
																	</select>
																</td>
																<td width='20%'>
																	<input type='submit' class='btn btn-sm btn-success' value='Change' name=".$btn_change.">
																	<input type='submit' class='btn btn-sm btn-danger' value='Delete' name=".$btn_remove."><br>
																	
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
