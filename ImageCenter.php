<?php
ob_start();
session_start();
if(!isset($_SESSION['doctor'])){
	header("Location:index");
	exit();
	}
include_once'includes/autoloadincludes.php';
include_once'classes/autoloadclasses.php';
include_once'Controller/autoloadmodels.php';
include_once'includes/settings.inc.php';
AutoLoadIncludes('defines');
AutoLoadClasses('CI_Connection');
AutoLoadModels('Model_Doctor');
$Model_Doctor= new Model_Doctor();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
    <title>Dr.XXX |
    <?php
	if(isset($_SESSION['doctor'])){  echo"واجهة الطبيب"; }elseif(isset($_SESSION['pharmacy'])){  echo"واجهة الصيدلاني";}
	?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="image/x-icon" href="<?= base_url; ?>images/logo.jpg" rel="icon">
    <link rel="icon" href="<?= base_url; ?>images/logo.jpg" type="image/x-icon"/>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url; ?>images/logo.jpg" />

 	<!-- Animate.css -->
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/animate.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/icomoon.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/magnific-popup.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/style.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/stylesheet.css">
	<script src="<?= base_url; ?>ManagementRx8Files/js/modernizr-2.6.2.min.js"></script>
    <script src="<?= base_url; ?>ManagementRx8Files/js/jquery-latest.min.js"></script>
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/theme.blue.css">
	<script src="<?= base_url; ?>ManagementRx8Files/js/jquery.tablesorter.js"></script>
	<script src="<?= base_url; ?>ManagementRx8Files/js/widget-storage.js"></script>
	<script src="<?= base_url; ?>ManagementRx8Files/js/widget-filter.js"></script>
	<script src="<?= base_url; ?>ManagementRx8Files/js/widget-pager.js"></script>
    <script src="<?= base_url; ?>ManagementRx8Files/js/tablesorter-js1.js"></script>
     <script type="text/javascript" src="<?= base_url; ?>ManagementRx8Files/js/lightbox.min.js"></script>
<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/album-css.css" media="screen" />
<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/css/lightbox.css" media="screen" />
 	</head>
	<body>
 
<?php AutoLoadIncludes('temp__main_header'); ?>
 
	<div id="page">
     <center>
     <div class='img_div'>
    <?php
	 
	$upload=$_GET['method'];
	$id_get=$_GET['id'];
	if(isset($upload) && $upload=="upload"){
 		if(isset($_POST['InsertImg'])){
			$id_p_img = filter_input(INPUT_POST, 'id_p_img', FILTER_DEFAULT);
			$title = filter_input(INPUT_POST, 'title', FILTER_DEFAULT);
 	 
			$fname = $_FILES['img']['name']; 
			$ftemp = $_FILES['img']['tmp_name'];
			$s = rand(1,1000000); 
			$x =  substr($fname,0,-4); 
			$d = str_ireplace($x, $s, $fname); 
			$filsize = $_FILES['img']['size'];
			$filtype = $_FILES['img']['type'];
			  $up = "images";
			$y = move_uploaded_file($ftemp,"$up/$d"); 
		if ($y) {
			 $x = $_SERVER['SERVER_NAME'];
			  $link = "images/".$d;
		}else{  $link = "";}
		
$InsertImage=$Model_Doctor->InsertImage($id_p_img,$title,$link);
 if($InsertImage){ ?>
 <center><div class='row img_r' style='width:100%;'>
	<div class='col-md-12 succssfully' >
	تم تحميل الصورة بنجاح
	</div>
	</div></center>
 	<?php }else{ ?>
    <center><div class='row img_r' style='width:100%;'>
	<div class='col-md-12 failure' >
	هنالك خطأ في التحميل
	</div>
	</div></center>
	<?php }}
		}elseif(isset($upload) && isset($id_get) && $upload=="show"){
			$id_get_a=$_GET['id'];
			$id_get_a= htmlspecialchars($id_get_a, ENT_QUOTES , "utf-8");
			$getIndvImg=$Model_Doctor->getIndvImg($id_get_a);
				if($getIndvImg):
				$max=4;
	            $min=0;?>
                <div class='row row_img'>
                 <?php foreach($getIndvImg as $img): $min++; ?>
                <div class="col-md-3 img_s">
                 <a class='example-image-link' href='<?php echo $img['image']; ?>' data-lightbox='example-2' data-title='<?php echo $img['title']; ?>'>
                 <img class='example-image' src='<?php echo $img['image']; ?>' width="100%" height="200"  /></a>
                </div>
                 <?php if($max==$min){echo"</div><div class='row row_img'>";} endforeach; ?>
                 </div>
                <?php  endif; 
			   }
			elseif(isset($upload) && isset($id_get) && $upload=="Up"){
			?>
			 <div style="height:320px;"><div class="row iformation">
                <div class="col-md-12 upload_img_1-col" >
                 تحميل صورة لـ: 
                 <?php
				  $id_p_1=$_GET['id'];
				  if(isset($id_p_1) && !empty($id_p_1)){
					  $id_p_1=htmlspecialchars($id_p_1,ENT_QUOTES,"utf-8");
					  $getIndvPatient=$Model_Doctor->getIndvPatient($id_p_1);
					   if($getIndvPatient){ ?>
					   <?php   foreach($getIndvPatient as $row_f_im): 
					   echo $row_f_im['Name']." - ID:".$row_f_im['ID_P'];
					    endforeach; ?>
						   <?php
					   }else{
						   // اذا ماكو المريض
						   } }
				 ?>
 
                 </div>
               </div>
               <form action="ImageCenter?method=upload" method="post" enctype="multipart/form-data">
                 <div class="row iformation">
                  <div class="col-md-12 upload_img-col" >
                   <input type="text" name="title" placeholder="Typing Title Image" class="text">
                  </div>
                 </div>
                <div class="row iformation">
                 <div class="col-md-12 upload_img-col" >
                  <div class='image-upload' align="center" >
                   <label for='file-input'>
                   <font size='2'>تحميل صورة
                    <img src='images/plus.png' width='30' height='30'  align='middle' class="img"/>
                   </font>
                  </label>
                  <input type='file' name='img' id='file-input' required /> </div>
                  <input type="hidden" name="id_p_img" value="<?= $id_get; ?>">
                 </div>
                </div>
                <div class="row iformation">
                 <div class="col-md-12 upload_img-col" >
                  <input type="submit" name="InsertImg" value="ادخال" class="submit" style="width:20%">
                 </div>
                </div>
               </form>
              </div>
			<?php
			}else{
			 $Model_Doctor->PatientTableImg();
			}
	?>
	</div></center>
</div>
 
<?php AutoLoadIncludes('temp__footer'); ?>
   

 </body>
</html>