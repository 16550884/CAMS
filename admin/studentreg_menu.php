
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 
?>

<?php
$cur_dte=date("Y-m-d");

$sql4="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.status=0";
$result4=mysqli_query($link,$sql4);
$option4 ="";
while($row4=mysqli_fetch_array($result4)){
$option4 = $option4."<option value=$row4[course_key]>$row4[course_nme]-$row4[facalty_nme]</option>";			//Load Reagon Name
}

if(isset($_POST['btn_selectbatch'])){
	
	$nm1=$_POST['sele_batch'];
	echo "<script>
			window.location.href='student_reg.php?batch=$nm1';
		</script>";
}

?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Student Registration</title>
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
							<div style="font-size:16px;font-weight:bold;"align="center">Student Registration</div>
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
    </body>
</html>
