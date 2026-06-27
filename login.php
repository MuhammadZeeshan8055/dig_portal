<?php

session_start();
include('database.php');

if ($_SERVER['HTTP_HOST'] == 'localhost') {
   $base_url = "http://localhost/dig_portal/";
} else {
   $base_url = "https://dhotharinternational.com/dig_portal/";
}

$errormsg = "";

$obj = new Database();

if (isset($_POST['login'])) {

   $email = trim($_POST['email']);
   $password = trim($_POST['password']);

   $obj->select(
       "staff_login",
       "*",
       null,
       "email = '$email'"
   );

   $result = $obj->getResult();

   if (!empty($result)) {

       $user = $result[0];

       if (password_verify($password, $user['password'])) {

           $_SESSION['staff_id'] = $user['id'];
           $_SESSION['email'] = $user['email'];
           $_SESSION['firstname'] = $user['firstname'];
           $_SESSION['lastname'] = $user['lastname'];
           $_SESSION['role'] = $user['role'];

           header("Location: attendance/attendance_dashboard");
           exit;

       } else {

           $errormsg = "<p style='text-align:center;padding:10px;background:#992a2a;color:#fff;margin-top:10px'>
                           Invalid Email or Password
                       </p>";
       }

   } else {

       $errormsg = "<p style='text-align:center;padding:10px;background:#992a2a;color:#fff;margin-top:10px'>
                       Invalid Email or Password
                   </p>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta name="description" content="Dhothar International" />
   <meta name="author" content="Laborator.co" />
   <link rel="icon" href="<?= $base_url ?>assets/images/favicon.ico">


   <title>Dhothar International | Login</title>
   <link rel="stylesheet" href="<?= $base_url ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1">
   <link rel="stylesheet" href="<?= $base_url ?>assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
   <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"
      id="style-resource-3">
   <link rel="stylesheet" href="<?= $base_url ?>assets/css/bootstrap.css" id="style-resource-4">
   <link rel="stylesheet" href="<?= $base_url ?>assets/css/neon-core.css" id="style-resource-5">
   <link rel="stylesheet" href="<?= $base_url ?>assets/css/neon-theme.css" id="style-resource-6">
   <link rel="stylesheet" href="<?= $base_url ?>assets/css/neon-forms.css" id="style-resource-7">
   <link rel="stylesheet" href="<?= $base_url ?>assets/css/custom.css" id="style-resource-8">
   <script src="<?= $base_url ?>assets/js/jquery-1.11.3.min.js"></script>
</head>

<body class="page-body login-page login-form-fall" data-url="https://demo.neontheme.com">

   <div class="login-container">
      <div class="login-header login-caret">
         <div class="login-content">
            <a href="#" class="logo" style="display:flex;align-items:center;gap:10px">
               <img src="dig.png" width="80px" height="80px" alt />
               <h2 style="font-weight:bolder;color:white">Dhothar DIG Portal</h2>
            </a>

         </div>
      </div>

      <div class="login-form">
         <div class="login-content">

            <form method="post" role="form">
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-addon"> <i class="entypo-user"></i> </div>
                     <input type="text" class="form-control" name="email" id="username" placeholder="email"
                        autocomplete="off" />
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-addon"> <i class="entypo-key"></i> </div>
                     <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        autocomplete="off" />
                  </div>
               </div>
               <div class="form-group">
                  <button type="submit" name="login" class="btn btn-primary btn-block btn-login">
                     <i class="entypo-login"></i>
                     Log In
                  </button>
               </div>
               <p>
                  <?php echo $errormsg ?>
               </p>
            </form>
         </div>
      </div>
   </div>
   <script src="<?= $base_url ?>assets/js/gsap/TweenMax.min.js" id="script-resource-1"></script>
   <script src="<?= $base_url ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
   <script src="<?= $base_url ?>assets/js/bootstrap.js" id="script-resource-3"></script>
   <script src="<?= $base_url ?>assets/js/joinable.js" id="script-resource-4"></script>
   <script src="<?= $base_url ?>assets/js/resizeable.js" id="script-resource-5"></script>
   <script src="<?= $base_url ?>assets/js/neon-api.js" id="script-resource-6"></script>
   <script src="<?= $base_url ?>assets/js/cookies.min.js" id="script-resource-7"></script>
   <script src="<?= $base_url ?>assets/js/jquery.validate.min.js" id="script-resource-8"></script>
   <script src="<?= $base_url ?>assets/js/neon-login.js" id="script-resource-9"></script>
   <script src="<?= $base_url ?>assets/js/neon-custom.js" id="script-resource-10"></script>
   <script src="<?= $base_url ?>assets/js/neon-demo.js" id="script-resource-11"></script>
   <script src="<?= $base_url ?>assets/js/neon-skins.js" id="script-resource-12"></script>

</body>

</html>