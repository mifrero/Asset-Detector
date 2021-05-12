<?php 
$counter = file_get_contents('stats.txt') + 1;
file_put_contents('stats.txt', $counter);

define('MAX_FILE_SIZE', 2000000); // Simple HTML parser has a low limit of 600000

if($_GET['url']) :
  $url	= $_GET['url'];
endif;

include('classes/loader.php'); 

?>

<!doctype html>
<html lang="en">
  <head>

    <title>Assets detector</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" href="assets/images/favicon.png"/>

  </head>
  <body>

  <div class="container-fluid">
 <h2>List CSS files, JS files and Inline JS</h2>   
  
   	<form class="form-inline" method="get" action="index.php">	    
       <input name="url" class="form-control" size="100" type="url" placeholder="URL to analyize" aria-label="Search" value="<?php echo $url?>">
       <button class="btn btn-dark" type="submit">List assets</button>
    </form>

<?php 
	
if ($url) : 

	// GET SITE HTML
	$html = new html(); 
	$site_html = $html->get_html($url);
	$rocket = new Rocket( $site_html, $url );
 
 	// info - CSS files
	$widget = new widget();
	$css_files = $rocket->css_files;
	$css_files_number = count($css_files);
	echo '
	<div class="widget information">
	<div class="title"><h4><span class="badge badge-dark">'.$css_files_number.'</span> CSS Files</h4></div>
	<div class="body align-middle">
	';

	foreach( $css_files as $css_file){
		echo $css_file . '<br>
		';
	}
	
	echo '
	</div>
	</div>
	'; 


	//info - JS files
	$widget = new widget();
	$javascript_files = $rocket->javascript_files;
	$javascript_files_number = count($javascript_files);
  
	echo '
	<div class="widget information">
	<div class="title"><h4><span class="badge badge-dark">'.$javascript_files_number.'</span> JS Files</h4></div>
	<div class="body align-middle">
	';
	  
	foreach( $javascript_files as $javascript_file ){
		echo  $javascript_file . '<br>
		';
	}
	echo '
	</div>
	</div>
	 '; 
 
	//info - Inline JS files
	$widget = new widget();
	$inline_javascript_files = $rocket->inline_javascript;
	$inline_javascript_files_number = count($inline_javascript_files);

	echo '<div class="widget information js">
	<div class="title"><h4><span class="badge badge-dark">'.$inline_javascript_files_number.'</span> Inline JS</h4></div>
	<div class="body align-middle">
	';
	  
	foreach( $inline_javascript_files as $inline_javascript_file ){
		echo  '<p><code>' . jsInliner($inline_javascript_file) . '</code></p>
	';
	}
	echo '
	</div>
	</div>
	'; 


endif; 

?>
</div> <!-- grid -->

</div> <!-- container -->


    </body>
</html>
