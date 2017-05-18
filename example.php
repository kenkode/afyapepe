<?php
session_start();
include_once 'config.php';

//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password) . "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
	$_SESSION['usr_role'] = $row['role'];
$_SESSION['usr_email'] = $row['email'];

				if( $_SESSION['usr_role'] == "Admin"){
             header('Location: admin.php');
			  }elseif ( $_SESSION['usr_role'] == "Writer"){
             header('Location: writer.php');
		     }else{
	           header('Location: index.php');
           }
  } else {
        $errormsg = "Incorrect Email or Password Try again!!!";

    }
}
//set validation error flag as false
$error = false;
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    //name can contain only alpha characters and space
      if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
          $error = true;
          $name_error = "Name must contain only alphabets and space";
      }
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
          $error = true;
          $email_error = "Please Enter Valid Email ID";
      }
      if(strlen($password) < 6) {
          $error = true;
          $password_error = "Password must be minimum of 6 characters";
      }
      if($password != $cpassword) {
          $error = true;
          $cpassword_error = "Password and Confirm Password doesn't match";
      }
if (!$error) {
        if(mysqli_query($con, "INSERT INTO users(name,email,password,role) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "', '" . $role . "')")) {
            $successmsg = "Successfully Registered! Now Login";
        } else {
            $errormsg = "Error in registering...User with that email already exist!";
        }
      }

}


?>

<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title>Guru | writers - All Academic Papers</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/img/guru-logo2.png">

	<!-- Web Fonts -->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=cyrillic,latin">

	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/app.css">
	<link rel="stylesheet" href="assets/css/blocks.css">
	<link rel="stylesheet" href="assets/css/one.style.css">

	<!-- CSS Footer -->
	<link rel="stylesheet" href="assets/css/header-v9.css">
	<link rel="stylesheet" href="assets/css/footer-v7.css">

	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
	<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/plugins/line-icons-pro/styles.css">
	<link rel="stylesheet" href="assets/css/pace-flash.css">
	<link rel="stylesheet" href="assets/plugins/owl-carousel2/assets/owl.carousel.css">
	<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">
	<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">
	<link rel="stylesheet" href="assets/plugins/hover-effects/css/custom-hover-effects.css">

	<!-- CSS Theme -->
	<link rel="stylesheet" href="assets/css/shiping.style.css">

	<!-- CSS Customization -->
	<link rel="stylesheet" href="assets/css/custom.css">
</head>

<!--
	The data-spy and data-target are part of the built-in Bootstrap scrollspy function.
-->
<body id="body" data-spy="scroll" data-target=".header-v9" class="demo-lightbox-gallery">
	<!-- Header -->
	<nav class="header-v9 navbar navbar-default navbar-fixed-top" data-role="navigation">
		<div class="container-fluid no-side-padding bg-1">
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-sm-3 col-xs-4 no-side-padding">
							<a href="#intro" class="logo"><img src="assets/img/guru-logo2.png" alt="Logo"></a>
						</div>

						<div class="col-sm-9 col-xs-8">
							<div class="row">
								<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 topbar-block first">
									<div class="topbar-block-in">
										<ul class="list-unstyled">
											<li class="first-item"><span aria-hidden="true" class="icon-screen-smartphone icon"></span> Call Us</li>
											<li class="second-item">+254 720 205 808</li>
										</ul>
									</div>
								</div>

								<div class="col-lg-3 hidden-md hidden-sm hidden-xs topbar-block">
									<div class="topbar-block-in">
										<ul class="list-unstyled">
											<li class="first-item"><span aria-hidden="true" class="icon-clock icon"></span> Opening time</li>
											<li class="second-item">24 Hour: Support</li>
										</ul>
									</div>
								</div>

								<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 topbar-block">
									<div class="topbar-block-in">
										<ul class="list-unstyled">
											<li class="first-item"><span aria-hidden="true" class="icon-envelope icon"></span> Email us</li>
											<li class="second-item"> info@guruessaywriters.com</li>
										</ul>
									</div>
								</div>
								<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 topbar-block">
									<div class="topbar-block-in">
										<ul class="list-unstyled">
											<li class="first-item"><img src="assets/img/payapal.png" alt="Easy Payents"></li>

										</ul>
									</div>
								</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
		</div>

		<div class="container-fluid bg-2 one-page-nav-scrolling one-page-nav__fixed">
			<div class="container">
				<div class="menu-container page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<div class="menu-container">
						<ul class="nav navbar-nav">
							<li class="page-scroll home">
								<a href="#intro">Home</a>
							</li>
							<li class="page-scroll">
								<a href="#about">About</a>
							</li>
							<li class="page-scroll">
								<a href="#services">Services</a>
							</li>

							<li class="page-scroll">
								<a href="#testimonials">Testimonials</a>
							</li>
							<li class="page-scroll">
								<a href="#contact">Contact</a>
							</li>

							<?php if (isset($_SESSION['usr_id'])) { ?>
						<li class="page-scroll"><a href="#">Signed in as <?php echo $_SESSION['usr_name']; ?></a></li>
							<li class="page-scroll"><a href="changepswd.php">Change Password</a></li>
												 <li class="page-scroll"><a href="logout.php">Log Out</a></li>
												<?php } else { ?>
													<li class="page-scroll">
														<a href="" data-toggle="modal" data-target="#responsive">Login</a>
													</li>
													<li class="page-scroll">
														<a href="reg.php">Register</a>
													</li>

							<?php } ?>

						</ul>

            <?php if (isset($_SESSION['usr_id'])) { ?>
            <a href="order.php" class="btn-u btn-u-lg btn-u-default btn-u-upper rounded">ORDER NOW</a>
            <?php } else { ?>
            <a href="" class="btn-u btn-u-lg btn-u-default btn-u-upper rounded"
               data-toggle="modal" data-target="#responsive">ORDER NOW</a>

            <?php } ?>

           </div>

				</div>
				<!-- /.navbar-collapse -->

			</div>
		</div>
	</nav>
	<!-- End Header -->

	<!-- Intro Section -->
	<section id="intro" class="intro-section">
		<div class="fullscreen-static-image fullheight">
				<!-- Promo Content BEGIN -->
				<div class="container valign__middle">
					<div class="row">


						<div class="col-md-5 col-sm-6 text-center">
							<form class="shipping-form">

						<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
						<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
            <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
            <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
            <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
								<h3>Quick Quote</h3>
								<div class="form-group g-mb-20">
								<select name="typeofdocument" id="essay" class="form-control rounded">
								<option value="1" >Essay</option>
								<option value="2" >Dissertation</option>
								<option value="3" >Term Paper</option>
								<option value="4" >Research Paper</option>
								<option value="5" >Assignments</option>
								<option value="6" >Resume</option>
								</select>
								</div>
								<div class="form-group g-mb-20">
								<select title="Academic level" class="form-control rounded" name="level" id="level">
								<option value="13" >High School</option>
								<option value="14" >College</option>
								<option value="15" >Undergraduate</option>
								<option value="16" >Master</option>
								<option value="17" >Ph. D.</option>
								</select>
							</div>
							<div class="form-group g-mb-20">
							<select title="Number of pages"  class="form-control rounded" name="pages" id="pages">
							<option value="1" >1 page</option>
							<option value="2" >2 pages</option>
							<option value="3" >3 pages</option>
							<option value="4" >4 pages</option>
							<option value="5" >5 pages</option>
							<option value="6" >6 pages</option>
							<option value="7" >7 pages</option>
							<option value="8" >8 pages</option>
							<option value="9" >9 pages</option>
							<option value="10" >10 pages</option>
							<option value="15" >15 pages</option>
							<option value="20" >20 pages</option>
							<option value="30" >30 pages</option>
							<option value="40" >40 pages</option>
							<option value="50" >50 pages</option>
							</select>
							</div>

							<div class="form-group g-mb-20">
							<select title="Paper urgency"  class="form-control rounded" name="deadline" id="deadline">
							<option value="18" >12 hours</option>
							<option value="13" >24 hours</option>
							<option value="6" >7 days</option>
							<option value="5" >30 days</option>
							</select>
							</div>
							<div class="form-group g-mb-20">
							<select name="currency" id="currency" class="form-control rounded" >
							<option value="1" >USD</option>
							<option value="0.93" >EUR</option>
							<option value="1.31" >AUD</option>
              <option value="1.33" >CAD</option>
							</select>
							</div>
              <div class="form-group g-mb-20">
									<div class="row">
										<div class="col-sm-6 g-xs-mb-20">
											<input type="name" name="likd" class="form-control rounded" Value="Amount" Readonly>
										</div>

										<div class="col-sm-6 g-xs-mb-20">

											<input class ="form-control rounded" type="text" placeholder="000" name="amount" id="amount" readonly size="5" />
										</div>
									</div>
								</div>
                <?php if (isset($_SESSION['usr_id'])) { ?>
                <a href="order.php" class="btn-u btn-u-lg btn-u-default btn-u-upper rounded">ORDER NOW</a>
                <?php } else { ?>
                <a href="" class="btn-u btn-u-lg btn-u-default btn-u-upper rounded"
                   data-toggle="modal" data-target="#responsive">ORDER NOW</a>
                <?php } ?>
							</form>

						</div>
						<div class="col-md-7 col-sm-6 intro-section-info">
							<h2>Best Academic<br>  Writers</h2>
							<h3>For Quality and Custom Papers</h3>
							<p>
    For us security is equal to quality that we are offering
    Enjoy 100% confidentiality with us
    All payments are processed through a reliable payment operator
</p>
							<a href="#about" class="btn-u btn-u-lg btn-u-default btn-u-upper rounded">Learn More</a>
						</div>
					</div>
				</div>
				<!-- Promo Content END -->
			</div>
	</section>
	<!-- End Intro Section -->

	<!-- About -->
	<section id="about">
	<!-- Shiping types -->
		<div class="container-fluid no-padding">
			<div class="shiping-types">
				<div class="g-heading-v11 text-center g-mb-70">
					<h2>Why Choose &nbsp;<span>Guru Writers</span></h2>

<p>
	Our mission is providing high quality, plagiarism-free papers tailored to suit your needs.</p>

<p>

The writers in our company have a professional experience of writing and teaching across a broad range of academic
 levels, so they will always ensure that your papers are brilliant. Nevertheless, we understand that you,
 as a client can easily find many other similarly-oriented companies on the web, but rest assured we are not
  like them; we are a smaller company that takes its time and prides itself in what it does.</p>

<p>With us you are guaranteed:
</p>

				</div>

				<div class="shiping-types-list">

					<div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12 no-padding">
						<div class="shiping-type">
							<div class="shiping-type-img">
								<img class="img-responsive" src="assets/img/1.png" alt="original">
							</div>

							<div class="shiping-type-text">
								<h3><a href="#"><strong>Quality</strong> &amp; Original</a></h3>
								<p class="default-p">original and high-quality<br /> paper based on <br />extensive research. </p>

								<p class="onhover-p">You get an original and high-quality paper based on extensive research. The completed work will be correctly formatted,
									 referenced and tailored to your level of study</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12 no-padding">
						<div class="shiping-type">
							<div class="shiping-type-img">
								<img class="img-responsive" src="assets/img/2.png" alt="Loyal to time">
							</div>

							<div class="shiping-type-text">
								<h3><a href="#"><strong>Loyalty</strong> To Deadlines</a></h3>
								<p class="default-p">On-time delivery</p>
								<p class="onhover-p">We strive to deliver quality custom written papers before the deadline.
									That's why you don't have to worry about missing the deadline for submitting your assignment.</p>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12 no-padding">
						<div class="shiping-type">
							<div class="shiping-type-img">
								<img class="img-responsive" src="assets/img/3.png" alt="confidentiality">
							</div>

							<div class="shiping-type-text">
							<h3><a href="#"><strong>Confidentiality</strong></a></h3>
								<p class="default-p">Service <br />Representatives  &amp; Policy</p>
								<p class="onhover-p">We value your privacy. We do not disclose your personal information to any third party without your consent. Your payment data is also safely
									 handled as you process the payment through a secured and verified payment processor..</p>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12 no-padding">
						<div class="shiping-type">
							<div class="shiping-type-img">
								<img class="img-responsive" src="assets/img/4.png" alt="24 hour support">
							</div>

							<div class="shiping-type-text">
								<h3><a href="#"><strong>24/7 Hour</strong> Support</a></h3>
								<p class="default-p">Intuitive, <br />Responsive Support-Centre</p>
								<p class="onhover-p">From answering simple questions to solving any possible issues, we're always
									here to help you in chat and on the phone. We've got you covered at any time, day or night</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="g-heading-v11 text-center g-mb-70">
				<h2><span>100% Satisfaction guarantee!</span></h2>
<p>
We offer fully customized and personalized papers written according to your demands.
Papers written by qualified and professional writers, available 24/7 for your assistance.<br />
<?php if (isset($_SESSION['usr_id'])) { ?>
<a href="order.php" class="btn-u btn-u-lg btn-u-default btn-u-upper rounded">ORDER NOW</a>
<?php } else { ?>
<a href="" class="btn-u btn-u-lg btn-u-default btn-u-upper rounded"
   data-toggle="modal" data-target="#responsive">ORDER NOW</a>
<?php } ?>
</p>
			</div>
		</div>
		<!-- End of Shiping types -->
	</section>
	<!-- End of Main Offers -->

<!-- login modal -->
					<div class="modal fade" id="responsive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel4">Welcome Back</h4>
								</div>
								<div class="modal-body">
              <div class="row">
				      <div class="col-md-6 col-md-offset-1">
						 <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
								 <fieldset>
										 <legend>Login</legend>

										 <div class="form-group">
												 <label for="name">Email</label>
												 <input type="email" name="email" placeholder="Your Email" required class="form-control" />
										 </div>

										 <div class="form-group">
												 <label for="name">Password</label>
												 <input type="password" name="password" placeholder="Your Password" required class="form-control" />
										 </div>

										 <div class="form-group">
												 <input type="submit" name="login" value="Login" class="btn btn-primary" />
										 </div>
								 </fieldset>
						 </form>

				 </div>
		 </div>
		 <div class="row">
	        <div class="col-md-6 col-md-offset-1 text-center">
	        New User? <a href="reg.php">Sign up here</a>
	        </div>
	        <div class="col-md-6 col-md-offset-1 text-center">
         Forgot Password ? <a href="pswd.php">Recover Password</a>
         </div>
	    </div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn-u btn-u-default" data-dismiss="modal">Close</button>

								</div>
							</div>
						</div>
					</div>
					<!-- login modal End -->

	<!-- Our Services -->
	<section id="services">
		<div class="container-fluid no-padding">
			<div class="our-services">
				<div class="container">
					<div class="g-heading-v11 text-center g-mb-70">
						<h2 class="g-color-white">Our Services</h2>
						<p class="g-color-white-darker">
						We offers services that include numerous beneficial free options fair to you and your financial competence. Introducing elementary advantages we guarantee to follow on the agreement respectively:
						</p></p>
					</div>

					<!-- Grid -->
					<div class="service-grid">
						<div class="row equal-height-columns">
							<div class="col-md-4 col-sm-4 service-item">
								<div class="item-in equal-height-column">
									<span class="icon-transport-026 icon-4x" aria-hidden="true"></span>
									<h3>Essay Writing</h3>
									<p>Creative and innovative essays written by professional writers.
Any topic or subject get fully customized essays written exactly according to your needs and demands.</p>
								</div>
							</div>

							<div class="col-md-4 col-sm-4 service-item">
								<div class="item-in equal-height-column">
									<span class="icon-christmas-090 icon-4x" aria-hidden="true"></span>
									<h3>Assignments/Coursework</h3>
									<p>Stuck with coursework? Get professional writing assistance through well
                   trained writers. Most Reliable and Convenient Coursework Help online.</p>
								</div>
							</div>

							<div class="col-md-4 col-sm-4 service-item">
								<div class="item-in equal-height-column">
									<span class="icon-travel-044 icon-4x" aria-hidden="true"></span>
									<h3>Research Papers</h3>
									<p> perfectly researched and referenced research papers. Our proficient
									writers can write non-plagiarized and original research papers
									personalizing in the way you want.</p>
								</div>
							</div>
						</div>

						<div class="row equal-height-columns">
							<div class="col-md-4 col-sm-4 service-item">
								<div class="item-in equal-height-column">
									<span class="icon-hotel-restaurant-249 icon-4x" aria-hidden="true"></span>
									<h3>Dissertation</h3>
									<p>Get help with your dissertation, 100% custom written dissertations written
									by qualified writers. The best genuine dissertation writing service
									available online..</p>
								</div>
							</div>

							<div class="col-md-4 col-sm-4 service-item">
								<div class="item-in equal-height-column">
									<span class="icon-hotel-restaurant-211 icon-4x" aria-hidden="true"></span>
									<h3>Term Papers</h3>
									<p>Offering customized term papers, whether you are in high school, college or
							university. Get quality term papers and leave all your writing tasks in
							the hands of professionals.</p>
								</div>
							</div>

							<div class="col-md-4 col-sm-4 service-item">
								<div class="item-in equal-height-column">
									<span class="icon-hotel-restaurant-234 icon-4x" aria-hidden="true"></span>
									<h3>Thesis</h3>
									<p>Get custom thesis written through our amazing writing service available
									24/7 for your assistance. Get thesis of high standards for college and
									university levels.</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End of grid -->
				</div>
			</div>
		</div>
	</section>
	<!-- End of Our Services -->
	<div class="g-heading-v11 text-center g-mb-70">
		<h2 class="g-color-white"></h2>
		<p class="g-color-white-darker">
		</p></p>
	</div>
	<!-- Testimonials -->
	<section id="testimonials">
		<div class="testo">
			<div class="container">
				<div class="testo-in">
					<div class="g-heading-v11 text-center g-mb-70">
						<h2 class="g-color-white">What do people say about us?</h2>
						<p class="g-color-white-darker"></p>
					</div>

					<!-- Testimonials-v3 -->
					<div class="testimonials-v3">
						<ul class="list-unstyled owl-ts-v1">
							<li class="item">
								<div class="row">
									<div class="col-sm-3 text-right">

									</div>

									<div class="col-sm-9">
										<div class="testimonials-v3-text">
											<p class="g-color-white-darker">
I am not used to such services and I usually write all the papers by myself.
 But this time I got in a very difficult situation and had to order my paper on
 this website. To my surprise it appeared to be quite good. Thank you, it is really nice service.
  Think I'll get back to you soon!
Read more at: https://www.grabmyessay.com/testimonials</p>
											<h5>KEITH,USA</h5>
                    <h5>  Thesis, Management, 34 pages, 14 days, Master's</h5>
										</div>
									</div>
								</div>
							</li>

							<li class="item">
								<div class="row">
									<div class="col-sm-3 text-right">

									</div>

									<div class="col-sm-9">
										<div class="testimonials-v3-text">
											<p class="g-color-white-darker">I want to thank you for the amazing paper that you wrote me.
                        Your service is very professional and one of the best. I will recommend your service to
                        everyone.
                    </p>
											<h5>Nicole, Canada</h5>
										</div>
									</div>
								</div>
							</li>

							<li class="item">
								<div class="row">
									<div class="col-sm-3 text-right">

									</div>

									<div class="col-sm-9">
										<div class="testimonials-v3-text">
											<p class="g-color-white-darker">Phenomenal results. I was a bit overwhelmed taking three
                        course all which had papers due at the same time. Gave this a try and I was not dissatisfied
                        with the product. Highly recommend to anyone, as I myself have used it again!!
                     </p>
											<h5>SONI, USA</h5>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>


	</section>
	<!-- End of Testimonials -->

	<!-- Contact -->
	<section id="contact">
		<div class="contact-us">
			<div class="container-fluid no-padding">
				<div class="g-heading-v11 text-center g-mb-70">
					<h2>Contact Us</h2>
					<p>Lets talk.</p>
				</div>

			</div>

			<div class="container">
				<div class="row ">

					<!-- Contact list -->
					<div class="col-md-4 contact-list ">
              <ul class="list-unstyled">
							<li>phone number <span>+254 720 205 808</span></li>
							<li>Email <span> info@guruessaywriters.com</span></li>

						</ul>
            <div class="contactbg">
					</div>
</div>
					<!-- Contact form -->
					<div class="col-md-8">
						<form action="mail.php" method="post" id="sky-form3" class="sky-form contact-style">
							<fieldset>
								<div class="row g-mb-20">
									<div class="col-md-12 col-md-offset-0">
										<div>
											<input type="text" name="name" id="name" class="form-control rounded" placeholder="Your Name">
										</div>
									</div>
								</div>

								<div class="row g-mb-20">
									<div class="col-md-12 col-md-offset-0">
										<div>
											<input type="text" name="email" id="email" class="form-control rounded" placeholder="Email *">
										</div>
									</div>
								</div>

								<div class="row g-mb-20">
									<div class="col-md-12 col-md-offset-0">
										<div>
										<textarea rows="4" name="message" id="message" class="form-control rounded g-textarea-noresize" placeholder="Message"></textarea>
										</div>
									</div>
								</div>

								<p><button type="submit" class="btn-u btn-u-lg btn-u-default btn-u-upper rounded">Submit</button></p>
							</fieldset>

							<!-- Success Message -->
							<div class="message">
								<i class="rounded-x fa fa-check"></i>
								<p>Your message was successfully sent!</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Copyrights -->
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-3">
						<div class="cr-left">
							<p>&copy; 2016 All right reserved @guruessaywriters.com</p>
						</div>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-9">
            <div class="cr-right">
              <a href="https://www.facebook.com/EssayWritingHelp2016/?" target="_blank" class=" g-ml-10 btn-u btn-u-lg btn-u-default btn-u-upper rounded"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/essay_helper58/?hl=en" target="_blank" class="g-ml-10 btn-u btn-u-lg btn-u-default btn-u-upper rounded"><i class="fa fa-instagram"></i></a>

           </div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End of Contact -->

	<!-- JS Global Compulsory -->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- JS Implementing Plugins -->
	<script src="assets/plugins/smoothScroll.js"></script>
	<script src="assets/plugins/pace/pace.min.js"></script>

	<script src="assets/plugins/counter/waypoints.min.js"></script>
	<script src="assets/plugins/counter/jquery.counterup.min.js"></script>


	<script src="assets/plugins/jquery.easing.min.js"></script>
	<script src="assets/plugins/owl-carousel2/owl.carousel.min.js"></script>
	<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
	<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
	<script src="assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
	<script src="assets/plugins/circles-master/circles.min.js"></script>
	<script src="assets/plugins/backstretch/jquery.backstretch.min.js"></script>

	<!-- JS Page Level-->
	<script src="assets/js/one.app.js"></script>

	<script src="assets/js/plugins/pace-loader.js"></script>
	<script src="assets/js/plugins/owl-carousel2.js"></script>
	<script src="assets/js/plugins/promo.js"></script>
	<script src="assets/js/plugins/circles-master.js"></script>
	<script src="assets/js/plugins/cube-portfolio-3-ns.js"></script>
	<script src="assets/js/forms/contact.js"></script>
	<script type="text/javascript" src="assets/js/plugins/validation.js"></script>
	<script>
		$(function() {
			App.init();
			App.initCounter();
			OwlCarousel.initOwlCarousel();
			CirclesMaster.initCirclesMaster();
			ContactForm.initContactForm();
		});
	</script>
	<script>
$('#level, #deadline, #pages, #currency').change(function(){
    var level = parseFloat($('#level').val()) || 0;
    var deadline = parseFloat($('#deadline').val()) || 0;
		var pages = parseFloat($('#pages').val()) || 0;
		var currency = parseFloat($('#currency').val()) || 0;

    $('#amount').val((level + deadline)*pages*currency);
});</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		Validation.initValidation();

	});
</script>
	<!--[if lt IE 10]>
		<script src="../assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
	<![endif]-->
</body>
</html>
