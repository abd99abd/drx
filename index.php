<?php
ob_start();
session_start();
if(isset($_SESSION['doctor'])  || isset($_SESSION['pharmacy'])){
	header("Location:Home");
	exit();
	}
include_once'includes/autoloadincludes.php';
include_once'classes/autoloadclasses.php';
include_once'Controller/autoloadmodels.php';
include_once'includes/settings.inc.php';
AutoLoadIncludes('defines');
AutoLoadClasses('CI_Connection');

 

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Dr.XXX | الدخول</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="image/x-icon" href="<?= base_url; ?>images/logo.jpg" rel="icon">
    <link rel="icon" href="<?= base_url; ?>images/logo.jpg" type="image/x-icon"/>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url; ?>images/logo.jpg" />
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/login/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">تسجيل الدخول</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-6">
                <div  class="row">
                 <?php
				if(isset($_POST['Login'])){
					AutoLoadClasses('login');
				  $identifer = filter_input(INPUT_POST, 'identifer', FILTER_DEFAULT);
				  $password = filter_input(INPUT_POST, 'Password', FILTER_DEFAULT);
				  if(empty($identifer) || empty($password)){ ?>
					 <div class="col-md-12"><div class="alert alert-danger text_modify"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> الرجاء ملئ كافة البيانات المطلوبة <span class="fa fa-close"></span></div></div>
			<?php  }else{
					 $identifer= htmlspecialchars($identifer, ENT_QUOTES , "utf-8");
					 $identifer=strtolower($identifer);
					 $password= htmlspecialchars($password, ENT_QUOTES , "utf-8");
					 $login=new Login();
					 if($login->loginActive($identifer,$password)) {
						exit();
					 } else { $login->printMsg(); }}
					}
                    $display_error=$_GET['ErrorLogin'];
					$attempt=$_GET['attempt'];
					 if($display_error=="1"){ ?>
                     <div class="col-md-12"><div class="alert alert-danger text_modify"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>المعلومات المقدمة خاطئة <span class="fa fa-close"></span></div></div>
						 <?php }
						 elseif(isset($display_error) && $display_error=="incorrectInformation"){  ?>
                     <div class="col-md-12"><div class="alert alert-danger text_modify"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> المعلومات المقدمة خاطئة  <span class="fa fa-close"></span></div></div>
						 <?php }
					 elseif(isset($attempt) && $attempt=="3" && $display_error=="4"){  ?>
                     <div class="col-md-12"><div class="alert alert-danger text_modify"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> المعلومات المقدمة خاطئة  <span class="fa fa-close"></span></div></div>
						 <?php }
					 elseif(isset($attempt) && $attempt !=="3" && $display_error=="4" || $display_error=="5"){  ?>
                     <div class="col-md-12"><div class="alert alert-danger text_modify"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> المعلومات المقدمة خاطئة  <span class="fa fa-close"></span></div></div>
						 <?php }
					  elseif($display_error=="2"){ ?>
                      <div class="col-md-12"><div class="alert alert-danger text_modify"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>المعلومات المقدمة خاطئة  <span class="fa fa-close"></span></div></div>
						 <?php  }
					  elseif($display_error=="3"){  ?>
                      <div class="col-md-12"><div class="alert alert-danger text_modify"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>المعلومات المقدمة خاطئة  <span class="fa fa-close"></span></div></div>
						 <?php }  ?>
                         </div>
 					<div class="wrap ">
 						<div class="login-wrap p-4  ">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">تسجيل الدخول</h3>
			      		</div>
 			      	</div>
							<form action="" class="signin-form" method="post">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">اسم المستخدم او رقم الهاتف او البريد الألكتروني</label>
			      			<input type="text" class="form-control" placeholder="اسم المستخدم او رقم الهاتف او البريد الألكتروني" name="identifer" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">كلمة المرور</label>
		              <input type="password" class="form-control" placeholder="كلمة المرور"  name="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-3" name="Login"> الدخول</button>
		            </div>
 		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="<?= base_url; ?>ManagementRx8Files/login/js/jquery.min.js"></script>
  <script src="<?= base_url; ?>ManagementRx8Files/login/js/popper.js"></script>
  <script src="<?= base_url; ?>ManagementRx8Files/login/js/bootstrap.min.js"></script>
  <script src="<?= base_url; ?>ManagementRx8Files/login/js/main.js"></script>

	</body>
</html>


