<?php

        $tanuj_url = 'http://www.tanujc.com/curl.php';
        $ramya_url = 'http://ramyaananth.com/receivePHP.php';
        $simrita_url = 'http://simritakaur.com/receivePHP.php';
        $jayanth_url = 'http://jayanthdiwaker.com/receivePHP.php'

/* Add the required domain names in this array, exclude your domain and add the rest) */
        $array_send = array($tanuj_url, $jayanth_url, $simrita_url);

foreach ($array_send as &$url) {


        //This needs to be the full path to the file you want to send.
        $file_name_with_full_path = realpath('./car.jpg');
        /* curl will accept an array here too.
         * Many examples I found showed a url-encoded string instead.
         * Take note that the 'key' in the array will be the key that shows up in the
         * $_FILES array of the accept script. and the at sign '@' is required before the
         * file name.
         */
        $post = array('extra_info' => '123456','file_contents'=>'@'.$file_name_with_full_path);
        echo "<h2>HELLO!</h2>";
    $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL,$target_url);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result=curl_exec ($ch);
        echo "<h2>$result</h2>";
        curl_close ($ch);
}

?>
