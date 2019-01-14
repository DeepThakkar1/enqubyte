<!-- get_header('Page Name','Title')-->
<!doctype html>
<html class="no-js" lang="zxx">
	
<head>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132387534-1"></script>
		<script>
		  	window.dataLayer = window.dataLayer || [];
		  	function gtag(){dataLayer.push(arguments);}
		  	gtag('js', new Date());

		  	gtag('config', 'UA-132387534-1');

			gtag('set', {'user_id': 'USER_ID'}); // Set the user ID using signed-in user_id.
			ga('set', 'userId', 'USER_ID'); // Set the user ID using signed-in user_id.
		</script>


		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Enqubyte - Your business assistant</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CRoboto:400,500,700,900%7CPlayfair+Display:400,700,700i,900,900i%7CWork+Sans:400,500,600,700" rel="stylesheet">

		<!-- signatra-font -->
		<link rel="stylesheet" href="/assets/css/signatra-font.css">

		<link rel="icon" type="image/png" href="">
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
		<!-- Place favicon.ico in the root directory -->
		<link rel="apple-touch-icon" href="apple-touch-icon.html">
		<link rel="stylesheet" href="/assets/css/font-awesome.min.css">

		<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="/assets/css/animate.css">
		<link rel="stylesheet" href="/assets/css/iconfont.css">
		<link rel="stylesheet" href="/assets/css/magnific-popup.css">
		<link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
		<link rel="stylesheet" href="/assets/css/swiper.min.css">
		<link rel="stylesheet" href="/assets/css/rev-settings.css">

		<!--For Plugins external css-->
		<link rel="stylesheet" href="/assets/css/plugins.css" />

		<!--Theme custom css -->
		<link rel="stylesheet" href="/assets/css/style.css">

		<!--Theme Responsive css-->
		<link rel="stylesheet" href="/assets/css/responsive.css" />
	</head>
    
	<body>
        

		<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<!-- Your customer chat code -->
		<div class="fb-customerchat"
		  attribution=install_email
		  page_id="359699814831143">
		</div>

	   <main id="content">
            @yield('content')
        </main>

		<!-- footer section end -->	
		<!-- js file start -->
		<script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/Popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/scrollax.js"></script>
        <script src="assets/js/jquery.ajaxchimp.min.js"></script>
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/swiper.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyDeZubzJTQgtjreqsdaGMGXxaxP-pv6pSk"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>
        <script src="assets/js/delighters.js"></script>
        <script src="assets/js/typed.js"></script>
        <script src="assets/js/jquery.parallax.js"></script>
        <script src="assets/js/jquery.themepunch.tools.min.js"></script>
        <script src="assets/js/jquery.themepunch.revolution.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.carousel.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.migration.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.parallax.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="assets/js/extensions/revolution.extension.video.min.js"></script>
        <script src="assets/js/skrollr.min.js"></script>
        <script src="assets/js/shuffle-letters.js"></script>
        <script src="assets/js/main.js"></script>		<!-- End js file -->
	</body>

</html>