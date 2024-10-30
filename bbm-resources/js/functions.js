	
	var title = 0;
	var lat = 1;
	var lng = 2;
	var icon = 3;
	var url = 4;
	var author = 5;
	var authorUrl = 6;
	var description = 7;
	
	function infoWindow(i){
	
		id=0;
	
		 var infoContentTitle = '<a title="Read this blog" onclick="initializeIframe(&quot;'+categories[i][url]+'&quot;,'+id+')"><h2 class="content-title">'+categories[i][title]+'</h2></a>';

		  openMessage = openMessage.replace("%here",'<a  title="'+categories[i][title]+'" onclick="initializeIframe(&quot;'+categories[i][url]+'&quot;,'+id+')">here</a>');
		  
		  var infoContentPrompt = '<p class="content-propmt">'+openMessage+'</p>';
		 
		  var infoContentSocial = '<span class="content-social"> - <a title="FB this mo fo" href="http://www.facebook.com/sharer/sharer.php?u=http://bigblogmap.com/#'+id+'" target="_blank"><i class="icon-facebook"></i></a>   <a title="Tweet this mo fo" href="https://twitter.com/share?url=&text=Travel%20Blogs%20presented%20Geographically%20@BigBlogMap.%20http://www.bigblogmap.com/%23'+id+'" target="_blank"><i class="icon-twitter"></i></a></span>'

		/*	//Author Url
		  if (categories[i][authorUrl] == " " || categories[i][authorUrl] == ""){
		  
		  
		  var infoContentFooter = '<p class="content-footer">by <span class="author-name">'+categories[i][author]+infoContentSocial+'</span></p>';
		  
		  }
		  else
		  {
		  var infoContentFooter = '<p class="content-footer">by <span class="author-name"><a title="'+categories[i][author]+'" target="_blank" href="'+categories[i][authorUrl]+'">'+categories[i][author]+'</a></span>'+infoContentSocial+'</p>';
		  }
		  */
		  
		  
		  var infoContent = infoContentTitle +  infoContentPrompt;
		  
          infowindow.setContent(infoContent);
		  
		  infowindow.setPosition(new google.maps.LatLng(categories[i][1], categories[i][2]));
		  
		  
		  
          if (marker.url ==categories[i][url]){
			infowindow.open(map,marker);
			}
			else
			{
			infowindow.open(map)
			}
		  
		  }


function iframeLoad() {

$('#iframe-container').removeClass("iframe-loading");

};



function initializeIframe(iframeUrl,i){

 
		  

	$('#iframe-container').addClass("iframe-loading");
	
	$('#iframe-container').addClass('expandedIframe');
	
	$('#social-tab').addClass('expandedSocialTab');
	
	
	$("#iframe-container").html('<iframe id="iframe" onload="iframeLoad()" src="'+iframeUrl+'" seamless></iframe>');
	
	$("#btn-close-link").attr("href",iframeUrl);
	
	$('.navbar').addClass('navbar-expanded');
	
	$('#blog-index').attr('value',i);
	
	$('#blog-index').attr('active','1');
	
	
	var facebookUrl = "http://www.facebook.com/sharer/sharer.php?u="+categories[i][4];
	var twitterUrl = 'https://twitter.com/intent/tweet?url='+categories[i][4]+'&text='+encodeURIComponent(categories[i][0]);
		if (twitterHandle !=""){
		twitterUrl= twitterUrl+'%20via%20@'+twitterHandle;
		}
	
	var googleUrl = 'https://plus.google.com/share?url='+categories[i][4];
	
	$('#facebook-social-bar').attr('href',facebookUrl);
	$('#twitter-social-bar').attr('href',twitterUrl);
	$('#google-social-bar').attr('href',googleUrl);
	

	};
	
	
	function closeIframe(){

	$('#iframe-container').removeClass('expandedIframe');

	
	
	$('.navbar').removeClass('navbar-expanded');
	
	$('#social-tab').removeClass('expandedSocialTab');
	
	$('#blog-index').attr('active','0');
	
	window.location.hash = "";
	
	setTimeout(function(){
	
	$('#iframe').remove();
	
	},500);

	};
	
	
	function forwardBlog(){
	
		var openCheck = $('#blog-index').attr('active');
	console.log(openCheck);
	if (openCheck == 0)
	{

	}
	else
	{

	var currentIndex = $('#blog-index').attr('value');
	var maxIndex = ($('#blog-index').attr('max')-1);
	
	if (currentIndex >= maxIndex) {
	currentIndex = 0;
	}
	else
	{
	currentIndex++
	};

	var iframeUrl = locations[(currentIndex)][url];
	
	$("#btn-close-link").attr("href",iframeUrl);
	
	$("#iframe").attr("src",iframeUrl);

	$('#blog-index').attr('value',currentIndex);
	
	window.location.hash = currentIndex;
	};
	
	}
	
	function randomBlog(){
	
	var openCheck = $('#blog-index').attr('active');
	
	var maxIndex = (categories.length)-1;
	var currentIndex = Math.round((Math.random()*maxIndex));
	
	if (openCheck == 0)
	{
	panAndOpen(currentIndex)
	}
	else
	{
	var iframeUrl = locations[(currentIndex+1)][url];
	
	$("#btn-close-link").attr("href",iframeUrl);
	
	$("#iframe").attr("src",iframeUrl);
	window.location.hash = currentIndex;
	
	$('#blog-index').val("currentIndex");
	}
	};
	
	

	//Panoramio
	var panoramioLayer = new google.maps.panoramio.PanoramioLayer();
	
		function onPanoramio(){
		panoramioLayer.setMap(map);
		$('#photos-on').addClass('invisible');
		$('#photos-off').removeClass('invisible');
		
		$('#blog-index').attr('photos','1');
		}
		
		function offPanoramio(){
		panoramioLayer.setMap(null);
		
		$('#photos-on').removeClass('invisible');
		$('#photos-off').addClass('invisible');
		
		$('#blog-index').attr('photos','0');
		}

		
	
	
	
	
	//Animation
	
	$('#contribute-li').hover(($('#icon-contribute').addClass('icon-spin')), ($('#icon-contribute').removeClass('icon-spin')));
	
	
	//Keyboard shortcuts
	
	$(document).keyup(function(e) {

  if (e.keyCode == 27) { 

closeIframe();
  
  }  
	});
	
$(document).keyup(function(r) {

  if (r.keyCode == 82) { 

randomBlog();
  
  }  
	});
	
	
	$(document).keyup(function(p) {

  if (p.keyCode == 80) { 

if ($('#blog-index').attr('photos') == 0){
  
onPanoramio();
  }
  else
  {
  offPanoramio();
  }
  }  
	});
	
	
	
	//Hashtag
	$(window).bind('hashchange', function() {

	if ($('#blog-index').attr('firstRun') 	== 1 && $('#blog-index').attr('active') == 1 && window.location.hash == "") {

	closeIframe();
	}
	
	else{

	}
	
	$('#blog-index').attr('firstRun','1');
});


function panAndOpen(currentIndex){

	var setLat = locations[currentIndex][lat];
	var setLng = locations[currentIndex][lng];
	
	var latLng = new google.maps.LatLng(setLat, setLng); //Makes a latlng
	
	map.panTo(latLng);
	
		infoWindow(currentIndex,latLng);

}


function upperCase (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function categoryButton (text) {
categoryCapitalised = upperCase(text);

$('#category-top').html(categoryCapitalised+'<span class="caret"></span>');
}




//RELOAD MAP WITH CATEGORY
function reloadMap(category,language,firstRun){

if (typeof firstRun == 'undefined' || !firstRun){

initialZoom = map.getZoom();
initialLat = map.getCenter().lat()
initialLon = map.getCenter().lng()
	  
	  }
	  

if (typeof language == 'undefined'){
	
	language = "en";
	  
	  }



	  var mapOptions = {
		  zoom: initialZoom,
          center: new google.maps.LatLng(initialLat,initialLon),
		  
		  minZoom: 2,
		  panControl: false,
      }



categories.length = 0;
categories == [];

//Select based on Cat and Lang
for (var i=0; i<locations.length; i++){

//Set default as English
locations[i][9]='en';

if ((category=="all" || locations[i][3]==category) && (typeof language === 'undefined' || language === '' || locations[i][9]==language)){
categories.push(locations[i]);
console.log(locations[i][0]);
}
}




 var mapOptions = {
		  zoom: initialZoom,
          center: new google.maps.LatLng(initialLat,initialLon),
		  
		  minZoom: 2,
		  panControl: false,

		  
          mapTypeId: google.maps.MapTypeId.ROADMAP,
		      panControl: false,
			  overviewMapControl: true}
		    
	  
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

		var markers = [];
		
		
		
        for (i = 0; i < categories.length; i++) {

		 //CREATION
		 
		 var rnd = Math.floor((Math.random()*3)+1);
		 
		marker = new google.maps.Marker({
        position: new google.maps.LatLng(categories[i][1], categories[i][2]),
        map: map,
		title: categories[i][title],
		icon:  iconUrl,
		id: i,
		url:  categories[i][4]
      });
	  
	  markers.push(marker);
	  
	  
	  
	  
		

		
		/*Event CLICK*/
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
		  popup.close(map,marker);
		  
		  console.log(i);
		  
		  infoWindow(i);

		  //INFO Content
		  

        }
		})(marker, i));
		
		//Listeners
				google.maps.event.addListener(marker, 'dblclick', (function(marker, i) {
        return function() {
		
				returnId(i);
				console.log(id);


		  var iframeUrl = categories[i][url]
		  
		  initializeIframe(iframeUrl,id);
		
        }
		})(marker, i));
		
		/*Event MOUSEOVER*/
	
		google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
		if (infowindow.getMap() != null) {
				}
			else {
			
			//POPUP Content
		  var popupContent = '<h3>' + categories[i][title]+'</h3>';
		  
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
		

		var markerCluster = new MarkerClusterer(map, markers, mcOptions);
		
		
		
		$('#blog-index').attr("max",(i-1));
		
		google.maps.OverlayView.MarkerClusterer = markerCluster;
		
		
		google.maps.event.addListener(google.maps.OverlayView.MarkerClusterer,'clusterclick',
		function(clickedCluster){
		console.log(clickedCluster.getMarkers());
		
		google.maps.OverlayView.clickedCluster = clickedCluster;
		
		//Marker Clusterer Handler
		markersInCluster = clickedCluster.getMarkers();
		
		infowindow.setPosition(clickedCluster.center_);
		
		multipleMessage = multipleMessage.replace("%s",markersInCluster.length);
		
		infoContentHead = "<small>"+multipleMessage+"</small>";
		
		infoContentBody = "<ul style='list-style:none;margin-left:6px;margin-top:-1px;margin-bottom: 6px;'>";
		
		
		maxMarkers = 7;
		
		if (markersInCluster.length > maxMarkers){
		markersCount = maxMarkers;
		}
		else
		{
		markersCount = markersInCluster.length;
		}
			
		for (i=0;i<markersCount;i++){
		
		id="0";
		
		infoContentBody = infoContentBody+'<li><a onclick="initializeIframe(&quot;'+markersInCluster[i].url+'&quot;,'+id+')">'+markersInCluster[i].title+'</a></li>';
		
		}
		
		
		
		infoContentFooter = '<small><a style="cursor:pointer;" onclick="panToCluster(google.maps.OverlayView.clickedCluster.getCenter(),map.getZoom())"><i class="icon-plus"></i> Zoom in</a></small>';
		
		
		infoContentBody = infoContentBody + '</ul>';
		
		infoContent = infoContentHead + infoContentBody + infoContentFooter;
		
		
		infowindow.setContent(infoContent);
		infowindow.open(map);
		  
		infowindow.setPosition(clickedCluster.center_);
		
		
		});
		
		
	
	
		
		} //END RELOAD MAP
		
		
		
		function updatePolylinePath(){
		 
		  var blogCoordinates = [];
		  
		  for (i=0;i<locations.length;i++){
			blogCoordinates.push( new google.maps.LatLng(locations[i][1], locations[i][2]));
		  }
		  
		  return blogCoordinates;
		}
		
		function togglePolylinePath(){
		
		blogPath = map.polyline;
		
		var lineSymbol = {
	  path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
		};
		
		icons = [];
		for (i = 0;i<locations.length;i++){
		iconSingular = {};
		
		iconSingular.icon = lineSymbol;
		iconSingular.offset = ((i/locations.length)*100)+'%';
		
		icons.push(iconSingular);
		}
		
		
		
		
		if (typeof blogPath === 'undefined' || blogPath.map == null){
		
		blogCoordinates = updatePolylinePath();
		
		 var blogPath = new google.maps.Polyline({
			path: blogCoordinates,
			strokeColor: "#FF0000",
			strokeOpacity: 1.0,
			strokeWeight: 2,
			icons: icons
		  });

		  blogPath.setMap(map);	
		  $('#polyline-button').addClass('active');
			}
			
			else
			{
			blogPath.setMap(null);
			$('#polyline-button').removeClass('active');
			}
		
		map.polyline = blogPath;
		}
		
		
		function returnId(i) {

		id = categories[i][8];

		return id;
		}
		
		
		function fitBounds(){
		var LatLngList = new Array (
		);
	
		for (i=0;i<categories.length;i++){
		latLng = new google.maps.LatLng (categories[i][1],categories[i][2]);
		LatLngList.push(latLng);
		}
		
		var bounds = new google.maps.LatLngBounds ();

		
		for (var i = 0, LtLgLen = LatLngList.length; i < LtLgLen; i++) {
		  bounds.extend (LatLngList[i]);
		}
		
		map.fitBounds (bounds);
		}
		
		
		function panToCluster(center,zoom){

		map.panTo(center);
		map.setZoom(zoom+2);
		infowindow.close();
		
			}
			
			
			
function openHash() {if (window.location.hash !== "") {

	
	var currentIndex = window.location.hash;
    
	currentIndex = currentIndex.replace(/#/g, "");

	var setLat = locations[currentIndex][lat];
	var setLng = locations[currentIndex][lng];
	
	var latLng = new google.maps.LatLng(setLat, setLng); //Makes a latlng
	
	map.panTo(latLng);
	
		infoWindow(currentIndex,latLng);
}
else
{
welcomeMessage();
}
}

function welcomeMessage(){


	
	var latLng = new google.maps.LatLng(initialLat,initialLon)

	var contentString = "Test";

	infowindow.setContent(welcome_message);

	infowindow.setPosition(map.getCenter());
	
	infowindow.open(map);

}

function pageLoaded() {

$('body').addClass('loaded');

}

function pageLoaded2() {

$('body').addClass('loaded-2');

}
		