
<!DOCTYPE html>
<?php
  require_once ('php/site_fns.php');
  // catch and sanitize form info
  $flag = $_POST['flag'];
  $name = trim($_POST['name']);
  $name = sql_sanitize($name);
  $name = html_sanitize($name);
  $email = trim($_POST['email']);
  $email = sql_sanitize($email);
  $email = html_sanitize($email);
  $organization = trim($_POST['organization']);
  $organization = sql_sanitize($organization);
  $organization = html_sanitize($organization);
  $phone = trim($_POST['phone']);
  $phone = sql_sanitize($phone);
  $phone = html_sanitize($phone);
  $feedback = trim($_POST['feedback']);
  $feedback = sql_sanitize($feedback);
  $feedback = html_sanitize($feedback);

//static information for email
	$toaddress = "todd@bednerdesigns.com";
	$subject = "Customer Contact from Website";
	$mailcontent =  "Customer name: ".$name."\n\n".
			   		"Customer organization: ".$organization."\n\n".
			   		"Customer phone: ".$phone."\n\n".
			   		"Customer email: ".$email."\n\n".
			   		"Customer comments: ".$feedback."\n";
	$fromaddress = "From: info@bednerdesigns.com";

//validate email address and send email if valid  
if (!valid_email($email) || empty($email)) {
		$sent = 'error'; 
    }
else { 
		mail($toaddress, $subject, $mailcontent, $fromaddress);
		$sent = 'true';
}  
  
?>
<html>
	
	<head>
		<title>Bedner Designs</title>

		<meta charset="utf-8" />
		<meta name="description" content="We are a small design firm that conceptualizes, designs and produces online products that are composed with the goal of giving the end-user a rewarding experience." />

		<link rel="stylesheet" media="all" href="css/main.css" />
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
		<link href='http://fonts.googleapis.com/css?family=Averia+Serif+Libre|Special+Elite|Righteous|Architects+Daughter' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Signika+Negative|Merriweather+Sans|Lemon|Archivo+Narrow' rel='stylesheet' type='text/css'>

		<script src="js/modernizr.custom.37797.js"></script> 
		<!-- Grab Google CDN's jQuery. fall back to local if necessary --> 
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
		<script>!window.jQuery && document.write('<script src="/js/jquery-1.7.1.min.js"><\/script>')</script>
		<script src="js/parallax.js"></script>
		<script src="js/libs/jquery.easing.js"></script>
		<script type="text/javascript" src="js/simplegallery.js"></script>
<script type="text/javascript">
/*var portfoliotext=[
"A Social Media Site Programmed from Scratch<br /><a href='http://www.bednerdesigns.com/cellme/'>Click here</a> and Login - guest, Password - guest.",
"The home page where you can find friends, send emails and access your address book.<br /><br />",
"Search results where you can add and request numbers.",
"Mobile phones are automatically sent to the mobile-friendly version of the site."
] */
var mygallery=new simpleGallery({
	wrapperid: "simplegallery1", //ID of main gallery container,
	dimensions: [750, 400], //width/height of gallery in pixels. Should reflect dimensions of the images exactly
	imagearray: [
		["img/portfolioimg/cellmethumb.png", "http://www.bednerdesigns.com/cellme/", "_new", "A Social Media Site Programmed from Scratch<br />Click image below</a> and Login - guest, Password - guest."],
		["img/portfolioimg/cellme2.png", "http://www.bednerdesigns.com/cellme/", "_new", "The home page where you can find friends, send emails and access your address book."],
		["img/portfolioimg/cellme3.png", "http://www.bednerdesigns.com/cellme/", "_new", "Search results where you can add and request numbers."],
		["img/portfolioimg/iphone.png", "http://www.bednerdesigns.com/cellme/", "_new", "Mobile phones are automatically sent to the mobile-friendly version of the site."],
		["img/portfolioimg/stlouis2.png", "http://www.slsonlinecampus.com/", "_new", "A web-based scholarship application where the client wanted minimal design and full functionality."],
		["img/portfolioimg/stlouis3.png", "http://www.slsonlinecampus.com/application/", "_new", "The site dealt with a large variety of data types and allowed students to smoothly apply for all scholarships they qualified for."],
		["img/portfolioimg/stlouis.png", "http://www.bednerdesigns.com/cellme/", "_new", "A simple login feature where administration could access and review the applications."],
		
	],
	autoplay: [false, 5000, 20], //[auto_play_boolean, delay_btw_slide_millisec, cycles_before_stopping_int]
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 500, //transition duration (milliseconds)
	oninit:function(){ //event that fires when gallery has initialized/ ready to run
		//Keyword "this": references current gallery instance (ie: try this.navigate("play/pause"))
	},
	onslide:function(curslide, i){ //event that fires after each slide is shown
		//Keyword "this": references current gallery instance
		//curslide: returns DOM reference to current slide's DIV (ie: try alert(curslide.innerHTML)
		//i: integer reflecting current image within collection being shown (0=1st image, 1=2nd etc)
		//document.getElementById("portfoliodescription").innerHTML=portfoliotext[i]
	}
})

</script>
		<script type="text/javascript">
if (document.images) {
    img1 = new Image();
    img1.src = "img/home.png";
    img2 = new Image();
    img2.src = "img/home2.png";
    img3 = new Image();
    img3.src = "img/home3.png";
    img4 = new Image();
    img4.src = "img/home4.png";
    img5 = new Image();
    img5.src = "img/home5.png";
    img6 = new Image();
    img6.src = "img/home6.png";
    img7 = new Image();
    img7.src = "img/whatwedo.png";
    img8 = new Image();
    img8.src = "img/bednermarker.png";
    img9 = new Image();
    img9.src = "img/toddbedner.jpg";

}
</script>
    
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
      var map;
      var grayStyles = [
{
                featureType: 'water',
                elementType: 'geometry',
                stylers: [
                        { hue: '#e6e6e6' },
                        { saturation: -100 },
                        { lightness: 41 },
                        { visibility: 'on' }
                ]
        },{
                featureType: 'poi',
                elementType: 'geometry',
                stylers: [
                        { hue: '#e6e6e6' },
                        { saturation: -100 },
                        { lightness: 50 },
                        { visibility: 'on' }
                ]
        },{
                featureType: 'road',
                elementType: 'all',
                stylers: [
                        { hue: '#9c9c9c' },
                        { saturation: -100 },
                        { lightness: -4 },
                        { visibility: 'on' }
                ]
        }


/*        {
          featureType: "all",
          stylers: [
            { lightness: 20 },
            { "hue": "#00ffe6" },
            { saturation: 0 }
          ]
        },
        { featureType: "poi", stylers: [ 
        	{ lightness: -30 },
            { "hue": "#000000" },
            { saturation: -100 } ] 
        	},
        { featureType: "water", stylers: [ 
        	{ lightness: -30 },
            { "hue": "#0ad5ce" },
            { saturation: 50 } ] 
        	},
        { featureType: "road", stylers: [ 
        	{ lightness: -100 },
            { saturation: 100 } ] 
        	},
        {
          featureType: "road",
          elementType: "labels.text",
          stylers: [
            { lightness: 100 },
            { "hue": "#ffffff" },
            { saturation: -100 }
          ]
        },
        {
          featureType: "road",
          elementType: "labels.text.fill",
          stylers: [
            { lightness: -100 },
            { "hue": "#000000" },
            { saturation: 100 }
          ]
        }*/
      ];
      var mapOptions = {
        center: new google.maps.LatLng(21.285538, -157.738632),
        zoom: 13	,
        panControl: false,
        scrollwheel: false,
        zoomControlOptions: {
	    style: google.maps.ZoomControlStyle.SMALL
	    },
        streetViewControl: false,
        styles: grayStyles,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
                
      function addMarker(location) {
        marker = new google.maps.Marker({
            position: location,
            map: map,
            styles: grayStyles,
            animation: google.maps.Animation.BOUNCE,
            title: "Bedner Designs",
            icon: "img/bednermarker.png"           
        });
    }
      function initialize() {
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
      
      BednerDesigns = new google.maps.LatLng(21.285538, -157.738632);
      addMarker(BednerDesigns);
}
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
	</head>

	<body>

		<div id="wrapper">
			
<?php
navigation();
?>			
			<div id="content">
			<section>
				<article id="home">
					<div id="under">
					<header>
						<h1>Bedner Designs</h1>
					</header>
<video id="video_background" preload="auto" autoplay="true" loop="loop" muted="" volume="0"> 
		<source src="img/drops.mp4" type="video/mp4" />
		<source src="img/drops.ogv" type="video/ogg" />
		<source src="img/drops.webm" type="video/webm" />
Video not supported </video>				<p class="quote">
						
<?php					
//quote();						
?>						
						
					</p>
					</div>
					
				</article>
			</section>
			<section>

				<article id="whatwedo">
					<header>
						<h1>What We Do</h1>	
					</header>
					
				        <nav id="filter"></nav>

        <div id="container">
        	<ul id="stage">
            	<li data-tags="Overview"><img src="img/whatwedo.png" alt="What We Do" /></li>
                <li data-tags="Web Design">
	                <div class="photo">
	                <img src="img/HTML5.png" />
	                </div>
	                <div class="caption">
		                <div id="caption1">
	                	Analyze +<br /><hr width="600px" />
	                		<div id="subcaption1">
		                		Before designing anything, we look at our client's big picture. We ask lots of questions to ensure we understand your products, competition, strategy and goals. We also research your user so that we can focus on their needs. Our objective is improved performance of your website; getting more people to visit it and converting more of those visitors into long-term customers.
			                </div>
	                	</div>
	                	<div id="caption2">
		                Create and Design +<br /><hr width="600px" />
		                	<div id="subcaption2">
		                		Starting from paper, wireframes and prototypes, we work with you to develop a mature, fully-functioning website with unique features like social modules and workflow functions to make your user's experience something they will want to talk about. The interface of your website represents you to the consumer and we want that first impression to be as favorable as possible. We also want to make the workflow of your company more efficient with simple and elegant designs and functions.
			                </div>
	                	</div>
	                	<div id="caption3">
		                Build and Review +<br /><hr width="600px" />
		                	<div id="subcaption3">
		                		Your website will be crafted with the latest technologies and will be compliant and functioning for years to come. We use HTML5, CSS3 and Javascript on the front-end and PHP, MySQL and other technologies to complete your web applications on the back-end. We focus on information architecture and the user interfaces, then we come back, test the site functions, review the analytics and survey users to make sure your website is at optimum performance.<br /><br /><br />
		                	</div>
	                	</div>	
	                </div>
                </li>
                <li data-tags="Web Development">
	                <div class="photo">
	                <img src="img/binary.png" width="200px" />
	                </div>
	                <div class="caption">
		                <div id="caption4">
	                	Web Applications +<br /><hr width="600px" />
	                		<div id="subcaption4">
		                		We can integrate existing solutions for social media modules, shopping carts and other membership services, or we can create them from scratch. Whatever you need your website to do, be it billing, customer tracking, or anything else, we can build it for you. Our principle is to design by objectives and then create the specifications to reach your goal. Whether you want to:<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;-increase the number of signups for your site<br />&nbsp;&nbsp;&nbsp;&nbsp;-reduce the bounce rate<br />&nbsp;&nbsp;&nbsp;&nbsp;-up the conversion rate or simply sell more of your product, <br /><br />we can make an app for that.
			                </div>
	                	</div>
	                	<div id="caption5">
		               Content Creation +<br /><hr width="600px" />
		                	<div id="subcaption5">
		                		The number one secret to a successful website? Content, content, content. The number two secret? Ease of access to that content. We develop your site so that content is king and your user can find what they want when they want to. <br /><br /><br /><br /><br /><br /><br />
			                </div>
	                	</div>
	                	<div id="caption6">
		                Database Management Systems +<br /><hr width="600px" />
		                	<div id="subcaption6">
		                		Your data is important. We deal with managing, merging or migrating data to and from a variety of platforms. We can also structure the architecture of your database for scalability and efficiency. Need to look at your data in a new way? Need to add information? We can help. <br /><br /><br /><br /><br /><br />
		                	</div>
	                	</div>	
	                </div>
                </li>
                <li data-tags="UX/UI">
	                <div class="photo">
	                <img src="img/uxui.png" width="200px" />
	                </div>
	                <div class="caption">
		                <div id="caption1">
	                	User Experience (UX) +<br /><hr width="600px" />
	                		<div id="subcaption1">
		                		The experience the user has at your site is your brand and your product. It is important to ensure that experience matches the quality of your company. Images convey information faster than text can, so we create an experience to keep that user engaged in your site.<br /><br />
			                </div>
	                	</div>
	                	<div id="caption2">
		               User Interface (UI) +<br /><hr width="600px" />
		                	<div id="subcaption2">
		                		Visual imagery can simplify the complex and enhance communication. How the user interacts with your site can either drive them away, or convert them into a customer. We design interfaces with your customer in mind.<br /><br /><br /><br />
			                </div>
	                	</div>
	                	<div id="caption3">
		                Trend Analysis +<br /><hr width="600px" />
		                	<div id="subcaption3">
		                		In order to make something better, you have to be able to measure it, then analyze it, and draw practical conclusions. We employ methodology to draw valid, measurable conclusions from your web analytics. We also look for insights into your users' motivations and behavior and then use that information to improve your site.<br /><br /><br /><br />
		                	</div>
	                	</div>	
	                </div>
                </li>
            </ul>
        </div>	
        <script src="js/jquery.quicksand.js"></script>
        <script src="js/script.js"></script>

				</article>
			</section>
			<section>


				<article id="about">
					<header>
						<h1>About Us</h1>	
					</header>
					<div id="bioimg">
					<img src="img/toddbedner.jpg" alt="What We Do" width="200px" height="250px" /><br />
					Todd Bedner, President
					</div>
					<div id="bio">We are a small creative design firm based in Honolulu. We conceptualize, design and build responsive online products and bring ideas to life. Even more importantly, we make them relevant to your customer and profitable for you.
					</div>
				</article>
			</section>
<!--			<section>


				<article id="service">
					<header>
						<h1>Service</h1>	
					</header>
		<div class="wait">
					<p class="list">Under Construction</p>
					<p class="list"></p>
					<p class="list"></p>
					</div>
					
				</article>
			</section>
-->
			<section>
				<article id="portfolio">
				<br /><br /><br />
					<header>
						<h1>Our Portfolio</h1>	
					</header>
					<div id="navigatep">						
<a href="javascript:mygallery.navigate('prev')"><img src="img/leftnav.gif" alt="leftnav" width="14" height="13"> Previous&nbsp;&nbsp;&nbsp;</a>
<a href="javascript:mygallery.navigate('next')">&nbsp;&nbsp;&nbsp;Next Slide <img src="img/rightnav.gif" alt="rightnav" width="14" height="13"></a>
					</div>
					<div id="portfoliodescription"></div>
					<div id="simplegallery1"></div>
					<div id="navigatep">						
<a href="javascript:mygallery.navigate('prev')"><img src="img/leftnav.gif" alt="leftnav" width="14" height="13"> Previous&nbsp;&nbsp;&nbsp;</a>
<a href="javascript:mygallery.navigate('next')">&nbsp;&nbsp;&nbsp;Next Slide <img src="img/rightnav.gif" alt="rightnav" width="14" height="13"></a>
					</div>	
					
				</article>
			</section>
			<section>

				<article id="contact">
				<br /><br />
					<header>
						<h1>Contact</h1>	
					</header>
					<div id="contactform">
					<div id="contactinfo">
					Bedner Designs<br />
					5610 Halekamani Street Ste. A<br />
					Honolulu, HI 96821<br /><br />
					info@bednerdesigns.com<br />
					<a href="http://www.linkedin.com/pub/todd-bedner/12/501/653/" target="_blank"><img src="img/LinkedIn_Logo.png" /></a>
					</div>	
<?php

	if (isset ($flag)) {
	if (!validate_flag($flag)) {exit;}
	if ($sent == 'error') {
		$message = '<div id="message">Please check your email address and resend your message. Thank you.</div>';	
	}
	if ($sent == 'true') {
		$message = '<div id="message">Thank you for your inquiry. We will be in contact with you shortly.</div>';
	}
?>	
		<form action="<?php echo $_SERVER['PHP_SELF']."#contact"; ?>" method="post" autocomplete="on"> 
		<p>
		<?php
		echo $message;
		?>	
		</p>
        <p>
        <input placeholder="Name" type="text" name="name" style="font-size:14pt;height:30px" size="35" value="<?php echo $name; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
        <input placeholder="Organization" type="text" name="organization" style="font-size:14pt;height:30px" size="35" value="<?php echo $organization; ?>" />
        </p> 
        <p>
        <input placeholder="Email" type="text" name="email" style="font-size:14pt;height:30px" size="35" value="<?php echo $email; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
        <input placeholder="Phone Number" type="text" name="phone" style="font-size:14pt;height:30px" size="35" value="<?php echo $phone; ?>" />
        </p> 
        <p>
        <textarea placeholder="Provide any additional comment regarding your inquiry, including project details, scope, background, etc." name="feedback" style="font-size:14pt;" rows="8" cols="58" wrap="virtual" /><?php echo $feedback; ?></textarea></p> 
        <input type="hidden" name="flag" value="1" />     
        <div id="submit"><input id="mysubmit" type="submit" value="Send Inquiry" /></div>
        <br /><br />
        </form>	
                                                                       
<?php

	}

	
	else {
contact();
}
?>					
					</div>
					<div id='map_canvas'>

					</div>
				
					
					
				</article>
			</section>

			</div>
			

		</div>
	
	</body>
  
</html>