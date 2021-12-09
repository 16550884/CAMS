<?php
//error_reporting(0);
include 'conn.php';		
?>
<?php

$temadmin="Admin";
session_start();
$user_check =$_SESSION['login_user'];
$user_level =$_SESSION['userlevel'];


if(!isset($_SESSION['login_user'])|| $user_level!==$temadmin){
    header("location:../Admin/index.php");
}

$cur_dte=date("Y-m-d");

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Reports Panel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme-change-size.css">

        <!-- Vendors -->
        <link rel="stylesheet" media="screen" href="vendors/easypiechart/jquery.easy-pie-chart.css">
        <link rel="stylesheet" media="screen" href="vendors/easypiechart/jquery.easy-pie-chart_custom.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
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
    <body style="background-position:center;
            background-attachment:fixed;
            background-size:100% 100%;">
        <!-- small navbar -->
        <?php include('navi.php') ?>

        

        <div class="container">
                    <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">New Vacancies</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table display" id="example" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
												<th width="20%">Post Date</th>
												<th width="40%">Job Title</th>
												<th width="20%">Salary</th>
												<th width="10%">Closing Date</th>
												<th width="5%">Applications</th>
												<th width="5%">Interview Call List</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql1="SELECT * FROM vacancy_master WHERE finact=0 AND complete_status IS NULL AND closing_date>='$cur_dte' ORDER BY date DESC";
												$result1=mysqli_query($link,$sql1);
												while($row1=mysqli_fetch_array($result1)){
											?>
													<tr>
														<td><div class="tcontents"><?php echo $row1['date']?></div></td>
														<td><div class="tcontents"><?php echo $row1['job_titel']?></div></td>
														<td><div class="tcontents"><?php echo $row1['salary']?></div></td>
														<td><div class="tcontents"><?php echo $row1['closing_date']?></div></td>
														<td><a href="tcpdf/reports/application_report.php?pcd=<?php echo $row1['vacancymas_key'];?>" target="_blank"><button class='btn btn-sm btn-primary btn-block'>Application</button></a></td>
														<td><a href="tcpdf/reports/interview_report.php?pcd=<?php echo $row1['vacancymas_key'];?>" target="_blank"><button class='btn btn-sm btn-warning btn-block'>Interview Call</button></a></td>
													</tr>
											<?php
												}
											?>
										
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
					
					<div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Expire Vacancies</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="tables display" id="example2" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
                                               <th width="20%">Post Date</th>
												<th width="40%">Job Title</th>
												<th width="20%">Salary</th>
												<th width="10%">Closing Date</th>
												<th width="5%">Applications</th>
												<th width="5%">Interview Call List</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql2="SELECT * FROM vacancy_master WHERE finact=0 AND complete_status IS NULL AND closing_date<'$cur_dte' ORDER BY date DESC";
												$result2=mysqli_query($link,$sql2);
												while($row2=mysqli_fetch_array($result2)){
											?>
													<tr>
														<td><div class="tcontents"><?php echo $row2['date']?></div></td>
														<td><div class="tcontents"><?php echo $row2['job_titel']?></div></td>
														<td><div class="tcontents"><?php echo $row2['salary']?></div></td>
														<td><div class="tcontents"><?php echo $row2['closing_date']?></div></td>
														<td><a href="tcpdf/reports/application_report.php?pcd=<?php echo $row2['vacancymas_key'];?>" target="_blank"><button class='btn btn-sm btn-primary btn-block'>Application</button></a></td>
														<td><a href="tcpdf/reports/interview_report.php?pcd=<?php echo $row2['vacancymas_key'];?>" target="_blank"><button class='btn btn-sm btn-warning btn-block'>Interview Call</button></a></td>
													</tr>
											<?php
												}
											?>
										
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
					
					<div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Complete Vacancies</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table display" id="example3" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
                                               <th width="20%">Post Date</th>
												<th width="40%">Job Title</th>
												<th width="20%">Salary</th>
												<th width="5%">Closing Date</th>
												<th width="5%">Applications</th>
												<th width="5%">Interview Call List</th>
												<th width="5%">Vacancy Select List</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql3="SELECT * FROM vacancy_master WHERE finact=0 AND complete_status=1 ORDER BY date DESC";
												$result3=mysqli_query($link,$sql3);
												while($row3=mysqli_fetch_array($result3)){
											?>
													<tr>
														<td><div class="tcontents"><?php echo $row3['date']?></div></td>
														<td><div class="tcontents"><?php echo $row3['job_titel']?></div></td>
														<td><div class="tcontents"><?php echo $row3['salary']?></div></td>
														<td><div class="tcontents"><?php echo $row3['closing_date']?></div></td>
														<td><a href="tcpdf/reports/application_report.php?pcd=<?php echo $row3['vacancymas_key'];?>" target="_blank"><button class='btn btn-sm btn-primary btn-block'>Application</button></a></td>
														<td><a href="tcpdf/reports/interview_report.php?pcd=<?php echo $row3['vacancymas_key'];?>" target="_blank"><button class='btn btn-sm btn-warning btn-block'>Interview Call</button></a></td>
														<td><a href="tcpdf/reports/vacancyselect_report.php?pcd=<?php echo $row3['vacancymas_key'];?>" target="_blank"><button class='btn btn-sm btn-success btn-block'>Vacancies Select</button></a></td>
													</tr>
											<?php
												}
											?>
										
                                        </tbody>
                                    </table>
                                </div>
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
								
								$(this).html( '<label style="font-size:18px;color:white">'+title+'</label><input type="text" placeholder="'+title+'" style="color:black;" class="form-control input-sm" />' );
							} );
			 
						// DataTable
							var table = $('#example').DataTable({
							});
						
							var state = table.state.loaded();
							if ( state ) {
							  table.columns().eq( 0 ).each( function ( colIdx ) {
								var colSearch = state.columns[colIdx].search;
								
								if ( colSearch.search ) {
								  $( 'input', table.column( colIdx ).header() ).val( colSearch.search );
								}
							  } );
							  
							  table.draw();
							}
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
						
							$('#example2 thead th').each( function () {
								 var title1 = $('#example2 thead th').eq( $(this).index() ).text();
								
								$(this).html( '<label style="font-size:18px;color:white">'+title1+'</label><input type="text" placeholder="'+title1+'" style="color:black;" class="form-control input-sm" />' );
							} );
			 
							var table1 = $('#example2').DataTable({
							});
						
							var state1 = table1.state.loaded();
							if ( state1 ) {
							  table1.columns().eq( 0 ).each( function ( colIdx ) {
								var colSearch1= state1.columns[colIdx].search;
								
								if ( colSearch1.search ) {
								  $( 'input', table1.column( colIdx ).header() ).val( colSearch1.search );
								}
							  } );
							  
							  table1.draw();
							}
							// Apply the search
					
							table1.columns().eq( 0 ).each( function ( colIdx ) {
								$( 'input', table1.column( colIdx ).header() ).on( 'keyup change', function () {
									table
										.column( colIdx )
										.search( this.value )
										.draw();
								} );
							} );
						
						//.......................................................................
						
							$('#example3 thead th').each( function () {
								 var title2 = $('#example3 thead th').eq( $(this).index() ).text();
								
								$(this).html( '<label style="font-size:18px;color:white">'+title2+'</label><input type="text" placeholder="'+title2+'" style="color:black;" class="form-control input-sm" />' );
							} );
			 
							var table3 = $('#example3').DataTable({
							});
						
							var state3 = table3.state.loaded();
							if ( state3 ) {
							  table3.columns().eq( 0 ).each( function ( colIdx ) {
								var colSearch3= state3.columns[colIdx].search;
								
								if ( colSearch3.search ) {
								  $( 'input', table3.column( colIdx ).header() ).val( colSearch3.search );
								}
							  } );
							  
							  table3.draw();
							}
							// Apply the search
					
							table3.columns().eq( 0 ).each( function ( colIdx ) {
								$( 'input', table3.column( colIdx ).header() ).on( 'keyup change', function () {
									table
										.column( colIdx )
										.search( this.value )
										.draw();
								});
							} );
						//.....................................................................
							$(".clickable-row").click(function() {
								window.location = $(this).data("href");
							  });
							});
				
			</script>
    </body>
</html>