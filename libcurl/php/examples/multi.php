<?php

$urls = array(
   "http://www.google.com/",
   "http://www.altavista.com/",
   "http://www.yahoo.com/"
   );

$mh = curl_multi_init();

foreach ($urls as $i => $url) {
       $conn[$i]=curl_init($url);
       curl_setopt($conn[$i],CURLOPT_RETURNTRANSFER,1);//return data as string 
       curl_setopt($conn[$i],CURLOPT_FOLLOWLOCATION,1);//follow redirects
       curl_setopt($conn[$i],CURLOPT_MAXREDIRS,2);//maximum redirects
       curl_setopt($conn[$i],CURLOPT_CONNECTTIMEOUT,10);//timeout
       curl_multi_add_handle ($mh,$conn[$i]);
}

do {
  $n=curl_multi_exec($mh,$active);

  /* without this, we will busy-loop here and use 100% CPU */
  curl_multi_select($mh, 0.7);
} while ($active);

foreach ($urls as $i => $url) {
       $res[$i]=curl_multi_getcontent($conn[$i]);
       curl_multi_remove_handle($mh,$conn[$i]);
       curl_close($conn[$i]);
}
curl_multi_close($mh);

print_r($res);

?>