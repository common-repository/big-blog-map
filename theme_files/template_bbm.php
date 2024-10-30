<?php /* Template Name: Map	  */ ?>
<html><?php $options = get_option('bbm_options'); ?>

<?php 
$bbmDirectory = plugins_url() . "/blog-map/bbm-resources/";


$fullName = get_bloginfo('name');

$mapUrl=$options[mapUrl];

$siteUrl=home_url();

if ($options[logoUrl] != ""){
$logoUrl=$options[logoUrl];
$logoTitle = "Blog Map - ".$fullName;
}
else
{
$logoUrl=$bbmDirectory . "img/logo.png";
$logoTitle = "Change this icon under 'Settings -> Big Blog Map'";
}


if ($options[iconUrl] != ""){
$iconUrl=$options[iconUrl];
}
else
{
$iconUrl = $bbmDirectory . 'icons/default.png';
}


$twitterHandle=$options[twitterHandle];
$twitter="@".$twitterHandle;
$twitterUrl="http://twitter.com/".$twitterHandle;


if ($initialLat != ""){
$initialLat=$options[initialLat];
}
else
{
$initialLat=20;
}

if ($initialLon !=""){
$initialLon=$options[initialLon];
}
else
{
$initialLon=34.327960895575146;
}


if ($initialZoom !=""){
$initialZoom=$options[initialZoom];
}
else
{
$initialZoom = 2;
}


if ($options[welcomeMessage] !=""){
$welcomeMessage=$options[welcomeMessage];
}
else if ($options[welcomeMessage] == "blank"){
$welcomeMessage = "";
}
else
{
$settings_url = home_url().'/wp-admin/options-general.php?page=bbm_options';
$posts_url = home_url().'/wp-admin/edit.php';

$welcomeMessage = '<h2>Welcome to your Map</h2><p><strong>Update your settings</strong><br/>To get started, go to the <a target="_blank" href="'.$settings_url.'">settings page</a> and upload a header image to replace the default logo.</p><p><strong>Add your posts</strong><br/>To include your posts on the map, go and <a target="_blank" href="'.$posts_url.'">edit a post</a>. You will see a map at the bottom of the edit page. Choose a location and the post will be automatically included.</p><p><strong>Help & Inpiration</strong><br/>Check out the documentation for <a target="_blank" href="http://bigblogmap.com/your-map/#support">support and F&Qs</a> and <a target="_blank" href="http://bigblogmap.com/your-map/#support">examples</a>.</p><small>Changing the welcome message will get rid of this notification</small>';
}


$panoramio = $options['panoramio'];

$random = $options['random'];

$polyline = $options['polyline'];


if ($options['multipleMessage'] !=""){
$multipleMessage = $options['multipleMessage'];
}
else
{
$multipleMessage = "There are %s markers here";
}

if ($options['openMessage'] !=""){
$openMessage = $options['openMessage'];
}
else
{
$openMessage = "Click %here to open it";
}


if ($options['iframeDisplay'] !=""){
$iframeDisplay = $options['iframeDisplay'];
}
else
{
$iframeDisplay = "fullScreen";
}


$post_type = 'post';

//Premium
$flags = true;


$noAds = $options['noAds'];


	$categories_filter_names = array();
	$categories_filter_slugs = array();
	$categories_filter_images = array();
	
$categoryDropdown = $options['categoryDropdown']
	
?>






  <head>
    <title>Map - <?php echo $fullName?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" content="text/html;charset=utf-8">
	<meta name="description" content="<?php echo $fullName ?> Blog Map">
    <style>
      html, body, #map_canvas {
        margin: 0;
        padding: 0;
        height: 100%;
      }
    </style>
	
	<script>
	//PHP Variables
	
	var mapUrl = "<?php echo $mapUrl?>";
	
	var siteUrl = "<?php echo $siteUrl?>";
	
	var twitterHandle = "<?php echo $twitterHandle?>";
	
	/*Problems*/
	
	var iconDirectory = '<?php echo $bbmDirectory ?>icons/';
	
	var imageDirectory = '<?php echo $bbmDirectory ?>img/';
	
	var initialLat = <?php echo $initialLat?>;
	var initialLon = <?php echo $initialLon?>;
	var initialZoom = <?php echo $initialZoom?>;
	
	var iconUrl = "<?php echo $iconUrl ?>";
	
	var welcome_message = '<?php echo $welcomeMessage?>';
	
	//Premium
	var flags = "<?php echo $flags?>";
	
	var multipleMessage = "<?php echo $multipleMessage;?>";
	
	var openMessage = "<?php echo $openMessage;?>";
	
	
	
	<?php
	
	$locations = array();
	
	$args = array( 'post_type' => $post_type,
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'ASC');
	$loop = new WP_Query( $args );
	$count = 0;
	
	while ( $loop->have_posts() ) : $loop->the_post();
		
	$count++;
	
	$location = array();
	
	$id = get_the_ID();
	$title = get_the_title();
	
	$latitude = get_post_meta($id,'bbm_latitude',true);
	$longitude = get_post_meta($id,'bbm_longitude',true);
			
	
	/*
	$categories =  get_the_category();
	
	
	
	$cat_name = $categories[0]->name;
	$cat_slug = $categories[0]->slug;
	
	if (!(in_array($cat_name,$categories_filter_names))){
	array_push($categories_filter_names,$cat_name);
	array_push($categories_filter_slugs,$cat_slug);
	
	
		$category_icon = get_field('category_map_marker', 'category_21');
		
		if ($category_icon != ""){
		array_push($categories_filter_images,$category_icon);
		}
		else{
		array_push($categories_filter_images,$iconUrl);
		}
	
	}

	
	
	

	$category = $cat_slug;
	*/
	
	$url = get_permalink();
	
	
	array_push($location,$title);
	array_push($location,$latitude);
	array_push($location,$longitude);
	array_push($location,$category);
	array_push($location,$url);
	array_push($location,$id);
	
	
	if ($latitude != 0 && $latitude != ""){
	array_push($locations,$location);
	}
	
	/*
	
	*/
	endwhile;
	
	
	echo 'locations = ';
	echo json_encode($locations);
	echo ';';
	
?>
	
	
	</script>
	
	<!--<link rel="icon" type="image/x-icon" href="img/favicon.ico" />-->
	<!--<link rel="shortcut icon" href="http://travelsofadam.com/favicon.ico" type="image/x-icon" />-->
	
	<script src="<?php echo $bbmDirectory?>js/jquery.js"></script>
	
	<script src="<?php echo $bbmDirectory?>js/markerclusterer.js" type="text/javascript"></script>
	
	
	<script>MarkerClusterer.IMAGE_PATH = "<?php echo $bbmDirectory;?>/img/cluster";</script>
	
	
	<link rel="stylesheet" href="<?php echo $bbmDirectory?>bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $bbmDirectory?>css/css.css">
	
	<link rel="stylesheet" href="<?php echo $bbmDirectory?>fontawesome/css/font-awesome.css">
	
    <script src="https://maps.googleapis.com/maps/api/js?libraries=panoramio&sensor=false"></script>
	
	
	
	<script>
	  var csvOptions = {separator:"`"};
	  
	  var categories = [];
	  var mcOptions = {maxZoom: 8, zoomOnClick:false, title:"There are multiple blogs. Zoom in to read."};
	  
	</script>
	
   
	



	
  </head>
  <body>
 

  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" id="nav-bar-container">


	
		  <a class="brand" href="<?php echo $siteUrl ?>" title="<?php echo $logoTitle;?>"><img id="brand-image" alt="" src="<?php echo $logoUrl?>"></img><span></span></a>
		
          <div class="nav-collapse collapse visible-desktop">
            <ul class="nav" id="nav-buttons">
			
			  <?php if ($panoramio == 'true'){
			  ?>
			  <li>
			  <a onclick="onPanoramio()" id="photos-on" data-toggle="tooltip" data-placement="bottom" title data-original-title="Turn photos on (p)" class=""><i class="icon-camera"></i></a>
			  <a onclick="offPanoramio()" id="photos-off" data-toggle="tooltip" data-placement="bottom" title data-original-title="Turn photos off (p)" class="invisible"><i class="icon-camera"></i></a>
			  </li>
			  <?php
			  }
			  ?>
			  
			<?php if ($random == 'true'){
			  ?>
              <li class="">
                <a title="Random Blog (r)" data-toggle="tooltip" data-placement="bottom" onclick="randomBlog();"><i class="icon-random"></i></a>
              </li>
			  <?php
			  }
			  ?>
			  
			  
			  <?php if ($polyline == 'true'){
			  ?>
              <li class="">
                <a  id="polyline-button" title="Connect the markers" data-toggle="tooltip" data-placement="bottom" onclick="togglePolylinePath();"><i class="icon-exchange"></i></a>
              </li>
			  <?php
			  }
			  ?>
			  
			  
				<div class="on-loaded addthis_toolbox addthis_default_style ">
				
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="" data-text="<?php echo $fullName?> Blog Map" data-via="<?php twitterHandle?>">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


				
				</div>

			<?php if ($categoryDropdown =="true"){
			?>
			   <div class="btn-group visible-desktop" id="category-div">
				  <a class="btn dropdown-toggle" id="category-top" data-toggle="dropdown" href="#">
					All Blogs <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu">
					<?php
					echo '<li><a onclick="reloadMap(\'all\');categoryButton(\'All Blogs\');" id="category-blog">All Blogs</a></li>';
					
					for ($i = 0; $i < sizeof($categories_filter_names); $i++) {
						echo '<li><a onclick="reloadMap(\''.$categories_filter_slugs[$i].'\');categoryButton(\''.$categories_filter_names[$i].'\');" id="category-blog">'.$categories_filter_names[$i].'</a></li>';
					}
					?>
				  </ul>
				</div>
				<?php
				}
				?>
			  
            </ul>
          </div>
		  <a style="display:none;"title="View this blog in a new window" id="btn-close-link" href="http://www.bigblogmap.com">
			X
		  </a>
		  <div class="social-tab visible-desktop" id="social-tab">
		  
		  <span class="social-share-button"><a class="facebook" title="Share this blog on Facebook" id="facebook-social-bar" href="http://www.facebook.com/sharer/sharer.php?u=http://bigblogmap.com/#'+i+'" target="_blank"><i class="icon-facebook"></i></a>   <a class="twitter" title="Share this blog on Twitter" id="twitter-social-bar" href="https://twitter.com/share?url=&text=Travel%20Blogs%20presented%20Geographically%20@BigBlogMap.%20http://www.bigblogmap.com/%23'+i+'" target="_blank"><i class="icon-twitter"></i></a>   <a class="google_plus" title="Share this blog on Google Plus" id="google-social-bar" href="https://plus.google.com/share?url=http://www.bigblogmap.com/#'+i+'" target="_blank"><i class="icon-google-plus"></i></a></span>
		  <a title="Close this tab (esc)" id="btn-back-x" onclick="closeIframe()">
			<img src="<?php echo $bbmDirectory?>img/close.png"></img>
		  </a>
		  
		  </div>
        </div>
      </div>
    </div>

<textarea style="display:none" id="blog-database" > <?php include 'http://bigblogmap.com/data/append.csv'; ?>
</textarea>



  
    <div id="map_canvas";"></div>
	

	<div id="iframe-container" class="iframe <?php echo $iframeDisplay;?>">
	
	
		
		
	</div>
	
<script src="<?php echo $bbmDirectory?>js/functions.js"></script>


<div id="blog-index" value="0" max="1" active="0" firstRun="0" photos="0"></div>



 <script>
      var map;
	  
      function initialize() {
	  reloadMap("all","en",true);
	  
	  if (locations.length >0){
	  fitBounds();
	  }
	  
	
	
	setTimeout(function(){openHash()},3000);
	setTimeout(function(){openHash()},3010);
	
	
	<?php if ($noAds != "true"){
	echo 'setTimeout(function(){loadExtras()},3000);';
	}?>
	
	setTimeout(function(){pageLoaded()},5000);
	setTimeout(function(){pageLoaded2()},7000);

      }  //End initialise
	  
	  


//Defaults
var contentString = '<?php echo $welcomeMessage?>';
	
var popupContent = 'Travel Blog';





      google.maps.event.addDomListener(window, 'load', initialize);
	  


    </script>
	

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>

	<script src="<?php echo $bbmDirectory?>js/modal.js"></script>
	<script src="<?php echo $bbmDirectory?>js/transition.js"></script>
	<!--<script src="js/tooltip.js"></script>-->
	<script src="<?php echo $bbmDirectory?>js/dropdown.js"></script>
	 
  
  
  <?php echo 'NO ads: ';
  echo $noAds;?>
<?php
if ($noAds == 'true'){
?>
  <a id="button-modal" href="#bigblogmap-modal" role="button" class="btn btn-primary" data-toggle="modal">Get a map</a>
   
   <div id="bigblogmap-modal" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3><a href="<?php echo $siteUrl?>"><?php echo $fullName?></a> - About the Map</h3>
  </div>
  <div class="modal-body">
	<p>This map is developed on the <a href="http://bigblogmap.com" target="_blank" title="The Big Blog Map">Big Blog Map</a> platform, a project trying to Geo-tag the world's best travel blogs.
	<br/>
	<a id="bigblogmap-screenshot" href="http://bigblogmap.com" target="_blank" title="The Big Blog Map"><img alt="Big Blog Map Screenshot" id="modal-screenshot" src="http://bigblogmap.com/img/bigblogmapscreenshot.png"></img></a>
	<br /><p>Do you want your own map? Click <a href="http://bigblogmap.com/your-map" target="_blank" title="Get your own map">here</a>.
	</p>
  </div>
  <div class="modal-footer">
	<a href="http://bigblogmap.com/about" title="About Page" class="btn">Read more</a>
    <a href="" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</a>
  </div>
</div>
<?php
}
?>


<script>
var extras = [
['About this Map',62.186014,-45.703125,"http://bigblogmap.com/about","btb",'This project is based on the <a href="http://BigBlogMap.com/" target="_blank" title="Big Blog Map">Big Blog Map</a>, a project to geotag the best travel blogs. Check out the project <a href="http://BigBlogMap.com/" target="_blank" title="Big Blog Map">here</a><br/><br />Do you want your own map? Get <a href="http://bigblogmap.com/map" target="_blank">in touch</a> with the developer for a quote.']
]

function loadExtras() {

        for (i = 0; i < extras.length; i++) { 
		
		
		
		
		
		 //CREATION 
		 
		   marker = new google.maps.Marker({
        position: new google.maps.LatLng(extras[i][lat], extras[i][lng]),
        map: map,
		title: extras[i][title],
		icon: '<?php echo $bbmDirectory?>icons/mushroom.png'
      });
	  
	  /*Event CLICK*/
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
		  popup.close(map,marker);
		  
		  

		  //INFO Content
		  
		  var infoContentTitle = '<h2 class="content-title">'+extras[i][title]+'</h2>';
		  var infoContentBody = '<p class="content-extra">'+extras[i][5]+'</p>'

		  
		  
		  
		  
		
		  var infoContent = infoContentTitle +  infoContentBody
		  
          infowindow.setContent(infoContent);
          infowindow.open(map, marker);
        }
		})(marker, i));
		
		
		
	
	
		/*Event MOUSEOVER*/
	
		google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
		if (infowindow.getMap() != null) {
				}
			else {
			
			//POPUP Content
		  var popupContent = '<h3>' + extras[i][title]+'</h3>';
		  
          popup.setContent(popupContent);
          popup.open(map, marker);
        }
		}
		
		})(marker, i));
		
		
		/*Event MOUSEOut*/
	
		google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
        return function() {
		  popup.close(map,marker);

        }

		})(marker, i));
	
	
		
	 } //End FOR
	 
	 }

</script>

<script>

			var infowindow = new google.maps.InfoWindow({
			});

			var popup = new google.maps.InfoWindow({
			});

</script>

   

  </body>
</html>

