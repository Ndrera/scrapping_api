<?php
include "lib/simple_html_dom.php";

//#SCRAPE THE SITES DATA
function scrapeWebsite( $url ){
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    $response = curl_exec( $ch );
	curl_close( $ch );

    $html = new simple_html_dom();
    $html->load( $response );

    return $html;

}

//#GET THE SCRAPPED DATA
function getDetails( $html ){
    $i = 0;

    foreach( $html->find('table[id=main_table_countries_today] tbody tr[style=""]') as $post ){   
        if($i == 5) break;

        $trim  = trim($post->plaintext);
        $explode = explode(" ",  $trim );

        $country          = $explode[33];
        $total_cases      = $explode[66];
        $new_cases        = $explode[99];
        $total_deaths     = $explode[164];
        $new_deaths       = $explode[198];
        $total_recovered  = $explode[295];

        $response[] = array( "country" => $country,"total_cases" => $total_cases,"new_cases" => $new_cases,
        "total_deaths" => $total_deaths, "new_deaths" => $new_deaths,"total_recovered" => $total_recovered ); 

        $i++;

    }

    return  $response;


}


?>