<?php 
include('functions/function.php');

$html =  scrapeWebsite("https://www.worldometers.info/coronavirus/");
$postDetail = getDetails( $html );

echo json_encode( $postDetail );

?>



