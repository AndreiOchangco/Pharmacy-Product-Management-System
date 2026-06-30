<?php
include('topbar.php');
if(empty($_SESSION['login_email']))
    {   
    header("Location: index.php"); 
    }
    else{
	}
      
$email = $_SESSION["login_email"];

$stmt = $dbh->query("SELECT * FROM users where email='$email'");
$row_user = $stmt->fetch();

 
if(isset($_POST["btncreate"]))
{

$name = $_POST['txtfullname'];
$email = $_POST['txtemail'];
$password = $_POST['txtpassword'];
$phone = $_POST['txtphone'];
$groupname = $_POST['cmdtype'];
$last_ip="NA";
$lastaccess="NA";
$status="1";

// Enhanced file upload validation
$upload_error = '';
$file = $_FILES['avatar'];

// Check if file was uploaded
if($file['error'] !== UPLOAD_ERR_OK) {
    $upload_error = 'File upload failed. Please try again.';
} else {
    // Get file information
    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    // Define allowed extensions and MIME types
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
    $allowed_mime_types = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp');
    
    // Check for dangerous file extensions (system files, executables, scripts)
    $dangerous_extensions = array('php', 'php3', 'php4', 'php5', 'phtml', 'htaccess', 'htpasswd', 
                                   'exe', 'bat', 'cmd', 'com', 'sh', 'js', 'vbs', 'asp', 'aspx', 
                                   'jsp', 'py', 'pl', 'cgi', 'dll', 'sys', 'ini', 'conf', 'log');
    
    // Validate file extension
    if(!in_array($file_ext, $allowed_extensions)) {
        $upload_error = 'Invalid file type. Only JPG, JPEG, PNG, GIF, and WEBP files are allowed.';
    }
    // Check for dangerous extensions
    elseif(in_array($file_ext, $dangerous_extensions)) {
        $upload_error = 'Security Error: System files and executable files are not allowed.';
        error_log("Security Alert: Attempted upload of dangerous file: " . $file_name . " by user: " . $email);
    }
    // Validate MIME type
    elseif(!in_array($file_type, $allowed_mime_types)) {
        $upload_error = 'Invalid file format. The file type does not match the extension.';
    }
    // Validate file size (max 5MB)
    elseif($file_size > 5242880) {
        $upload_error = 'File size too large. Maximum allowed size is 5MB.';
    }
    // Verify it's actually an image using getimagesize
    elseif(getimagesize($file_tmp) === false) {
        $upload_error = 'Invalid image file. The file appears to be corrupted or not a valid image.';
    }
    // Check for system files by name
    elseif(preg_match('/^\./', $file_name)) {
        $upload_error = 'System files (hidden files) are not allowed.';
    }
    // Check for double extensions
    elseif(preg_match('/\.(php|php3|php4|php5|phtml|exe|bat|cmd|com|sh|js|vbs|asp|aspx|jsp|py|pl|cgi)\./i', $file_name)) {
        $upload_error = 'Security Error: Files with multiple extensions are not allowed.';
        error_log("Security Alert: Attempted upload of file with multiple extensions: " . $file_name . " by user: " . $email);
    }
    else {
        // All validations passed, proceed with upload
        $image= addslashes(file_get_contents($file_tmp));
        $image_name= addslashes($file_name);
        $image_size= getimagesize($file_tmp);
        
        // Generate unique filename to prevent overwriting
        $new_filename = uniqid() . '_' . time() . '.' . $file_ext;
        $upload_path = "uploadImage/" . $new_filename;
        
        if(move_uploaded_file($file_tmp, $upload_path)) {
            $location = $upload_path;
        } else {
            $upload_error = 'Failed to upload file. Please try again.';
        }
    }
}

if(!empty($upload_error)) {
    $_SESSION['error'] = $upload_error;
    // Don't proceed with database operations if upload failed
} else {
    ///check if email already exist
    $stmt = $dbh->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]); 
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['error'] ='Email Already Exist in our Database ';
    } else {
        // Add User details
        $sql = 'INSERT INTO users(email,password,fullname,lastaccess,last_ip,groupname,phone,status,photo) VALUES(:email,:password,:fullname,:lastaccess,:last_ip,:groupname,:phone,:status,:photo)';
        $statement = $dbh->prepare($sql);
        $statement->execute([
            ':email' => $email,
            ':password' => $password,
            ':fullname' => $name,
            ':lastaccess' => $lastaccess,
            ':last_ip' => $last_ip,
            ':groupname' => $groupname,
            ':phone' => $phone,
            ':status' => $status,
            ':photo' => $location
        ]);
        if ($statement){
            $_SESSION['success'] ='User Added Successfully';
        } else {
            $_SESSION['error'] ='Problem Adding User';
        }
    }
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Admin - Admin Dashboard</title>
  <link rel="shortcut icon" href="../assets/logo.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
	        <span class="brand-text font-weight-light"></span>    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $row_user['photo'];    ?>" alt="User Image" width="140" height="141" class="img-circle elevation-2">        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row_user['fullname'];  ?></a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
		 <?php
			   include('sidebar.php');
			   
			   ?>
		 
		 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">&nbsp;</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create User </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        
		 <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create User </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email </label>
                    <input type="email" class="form-control" name="txtemail" id="exampleInputEmail1" size="77" value="<?php if (isset($_POST['txtemail']))?><?php echo $_POST['txtemail']; ?>" placeholder="Enter Email">
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Fullname </label>
                    <input type="text" class="form-control" name="txtfullname" id="exampleInputEmail1" size="77" value="<?php if (isset($_POST['txtfullname']))?><?php echo $_POST['txtfullname']; ?>" placeholder="Enter Fullname">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="txtpassword" id="exampleInputPassword1" size="77" value="<?php if (isset($_POST['txtpassword']))?><?php echo $_POST['txtpassword']; ?>" placeholder="Enter Password">
                  </div>
                  
				
                  <div class="form-group">
                    <label for="exampleInputPassword1">User Type</label>
                    <?php
			      $sql = "select * from tblgroup where groupname !='Super Admin'";
             $group = $dbh->query($sql);                       
             $group->setFetchMode(PDO::FETCH_ASSOC);
             echo '<select name="cmdtype"  id="cmdtype" class="form-control" >';
			 			     echo '<option value="">Select Group Name</option>';
             while ( $row = $group->fetch() ) 
             {
                echo '<option value="'.$row['groupname'].'">'.$row['groupname'].'</option>';
             }

             echo '</select>';
			     ?>     
           </div>
           <div class="form-group">
                    <label for="exampleInputEmail1">phone </label>
                    <input type="tel" class="form-control" name="txtphone" id="txtphone" size="77" value="<?php if (isset($_POST['txtphone']))?><?php echo $_POST['txtphone']; ?>" placeholder="Enter Phone">
                  </div>
           <div class="form-group">
                    <label for="exampleInputPassword1">Image</label>
                    <p class="text-center">
                        <input type="file" name="avatar" id="avatar" required class="form-control form-control-sm rounded-0" accept="image/png,image/jpeg,image/jpg" onChange="display_img(this)">
                       </p>
								  
                    <p class="text-center">
                   <img src="uploadImage/avatar.png" alt="user image" width="178" height="154" id="logo-img">   
				    </p>
              </div>
				 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btncreate" class="btn btn-primary">Create User</button>
                </div>
              </form>
            </div>
		
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col --><!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)--><!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php include('footer.php');  ?>
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
	
<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong> 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong> 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>
     <script>
    function display_img(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#logo-img').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
   
</script>
</body>
</html>
