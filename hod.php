<?php
include('plugins/timetable/connection.php');
session_start();
if(isset($_SESSION['hod']) and $_SESSION['hod']=='hod')
{
	if(isset($_SESSION['designationHOD'],$_SESSION['first_nameHOD'],$_SESSION['last_nameHOD'],$_SESSION['deptHOD'],$_SESSION['emailHOD']))
	{
		$con= mysqli_connect(constant('host'),constant('user'),constant('password'),constant('db')); 
		$room=0;
		$teacher=0; 
		$visitor=0;
		$subject=0;
		$dept=$_SESSION['deptHOD'];
		$q=mysqli_query($con,"select * from room where dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{ 
			$room++;
		}	
		$q=mysqli_query($con,"select * from subject where dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{ 
			$subject++;
		}
        $q=mysqli_query($con,"select * from teacher where designation!='visitor' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{ 
			$teacher++;
		}	
        $q=mysqli_query($con,"select * from teacher where designation='visitor' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{ 
			$visitor++;
		}
		if($dept=='if')
		{
			$department='Information Teachnology(IF)';
		}
		else if($dept=='co')
		{
			$department='Computer Science(CO)';
		}
		else if($dept=='me')
		{
			$department='Mechanical Department(ME)';
		}
		$hodName=$_SESSION['first_nameHOD']." ".$_SESSION['last_nameHOD'];
		$q=mysqli_query($con,"select * from content where field='hod' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$hodName=$row['value'];
		} 
		$phone=$_SESSION['phoneHOD'];
		$email=$_SESSION['emailHOD'];
		$q=mysqli_query($con,"select * from teacher where designation='hod' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$phone=$row['phone_no'];
			$email=$row['email'];
		}
		if(isset($_POST['logout']))
		{
			session_unset(); 
			session_destroy();
			header("Location:index.php");
		}
	}
}
else
{
	header("Location:index.php");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Government Polytechnic Mumbai</title>
	<link rel="icon" href="dist/img/card.png" type="image/gif">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	
<style>

</style>
</head>
<body class="skin-blue">
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="#" class="logo"><b> GP </b>Mumbai</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu" >
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a>
								<i class="ion ion-person"></i>
								<span class="hidden-xs"><?php echo $hodName;?></span>
							</a>
						</li>
						<!---logout--->
					    <li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle">
								<form method="post" style="margin-top:-55%;padding-top:39%"> 
									<button type="submit" name="logout" style="background-color:transparent" ><i class="fa fa-bell-o"></i></button>
								</form>
							</a>    
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar" >
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
						<li class="treeview active">
							<a href="#">
								<i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
							</a>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-edit"></i> <span>Forms</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="pages/hodforms/teacherform.php"><i class="fa fa-circle-o"></i> Teacher </a></li>
								<li><a href="pages/hodforms/subjectform.php"><i class="fa fa-circle-o"></i> Subject </a></li>
								<li><a href="pages/hodforms/roomform.php"><i class="fa fa-circle-o"></i> Room </a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-table"></i> <span>Time Table</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="pages/hodtables/simple.php"><i class="fa fa-circle-o"></i> Simple</a></li>
								<li><a href="pages/hodtables/master.php"><i class="fa fa-circle-o"></i> Master</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-database"></i> <span>Data Table</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="pages/hodforms/teachersubject.php"><i class="fa fa-circle-o"></i>Teacher</a>
								</li>
								<li>
									<a href="pages/hodforms/assignsubject.php"><i class="fa fa-circle-o"></i>Subject</a>
								</li>         
							</ul>
						</li>
					</ul>
			</section>
			<!-- /.sidebar -->
		</aside>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Information
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content ">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua shadow2">
                <div class="inner">
                  <h3><?php echo $subject; ?></h3>
                  <p>Subjects</p>
                </div>
                <div class="icon">
                  <i class="glyphicon glyphicon-book" style="font-size:80%"></i>
                </div>
                <a href="pages/hodforms/subject.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green shadow2">
                <div class="inner">
                  <h3><?php echo $room; ?><sup style="font-size: 20px"></sup></h3>
                  <p>Room</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="pages/hodforms/room.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow shadow2">
                <div class="inner">
                  <h3><?php echo $teacher; ?></h3>
                  <p>Teachers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="pages/hodforms/teacher.php" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red shadow2 ">
                <div class="inner">
                  <h3><?php echo $visitor; ?></h3>
                  <p>Visiting Faculty</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="pages/hodforms/visitor.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row ">
            <!-- Left col -->
            <section class="col-lg-12">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
			  <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <li class="active" id="label"><a href="#"><?php echo "$department"; ?></a></li>
                  <li class="pull-left header"><i class="fa fa-inbox"></i> Time Table</li>
                </ul>
				<div class="tab-content no-padding">
                  <!-- all department -->
                  <div class="chart tab-pane active" style="position: relative;">
				  <!----form----->
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<div class="well well-sm">
									<form action="plugins/timetable/maker.php" onsubmit="return hodLoaderForm();" method="post" >
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="semester">Semester</label>
													<select id="sem" onchange="run();" name="semester" class="form-control">
														<option value="odd">Odd</option>
														<option value="even">Even</option>
													</select>
												</div>
											
												<div class="form-group">
													<label for="dept">
													Subject</label>
													<div class="form-group">
														<select id="subject" name="subject" class="form-control">
															<option value="default">Subject</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="subject">
														Teacher</label>
													<div class="form-group">
														<select id="teacher" name="teacher" class="form-control">
															<option value="default">Teacher</option>	
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="subject">
														Shift</label>
													<select id="shift" name="shift" class="form-control">
														<option value="default">Shift</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="subject">
														Type</label>
													<select id="type" name="type" class="form-control">
														<option value="default">Type</option>
													</select>
												</div>
												<div class="form-group">
													<label>Batch</label>
													<div class="form-check">
														<input type="checkbox" id="checkBatchA" name="batch1"> <span class="label-text">&nbsp; A</span>
													</div>
													<div class="form-check">
														<input type="checkbox" id="checkBatchB" name="batch2"> <span class="label-text">&nbsp; B</span>
													</div>
													<div class="form-check">
														<input type="checkbox" id="checkBatchC" name="batch3"> <span class="label-text">&nbsp; C</span>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<button type="submit" class="btn btn-primary pull-right" name="hod" id="btnContactUs">
												Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-2">
								<form>
									<legend><span class="glyphicon glyphicon-globe"></span> Profile</legend>
										<address>
											<strong><?php echo strtoupper($_SESSION['deptHOD']); ?>, GPM.</strong><br>
											 <?php echo ucfirst($hodName); ?>,<br>
											Head Of Department.<br>
											<abbr title="Phone">
											P:</abbr>
											<?php echo $phone; ?>
										</address>
										<address>
											<strong>Email</strong><br>
												<a href="mailto:#"><?php echo $email;?></a>
										</address>
								</form>
							</div>
						</div>
					</div>
					<!-------form----->
				  </div>
                </div>	
              </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>IF</b> GPM
        </div>
        <strong>Copyright &copy; 2017-2018, <a href="#">Manish Kumar Yadav & Team </a>.</strong> All rights reserved.
      </footer>
	  
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
	<!-- page script -->
	<script src="dist/js/allpages.js" type="text/javascript"></script>
	<!-- datetime script -->
	<script src="../../dist/js/datetime.js" type="text/javascript"></script>
	<script>
	run();
	var mon;
	function run()
	{
		
		var dept="<?php echo $dept;?>";
		load_data(dept,dept);
	}
	function deptVal()
	{
		return "<?php echo $dept;?>";
	}
	function deptVal2()
	{
		return "<?php echo $dept;?>";
	} 


	</script>
  </body>
</html>
