<?php

require_once('classes/CacheMemcache.php');
$oCache = new CacheMemcache();

if ($oCache->bEnabled) { // if Memcache enabled

    $aMemData = $oCache->getData('my_object'); // getting data from cache server
    $aMemData2 = $oCache->getData('our_class_object'); // getting data from cache server about our class

    echo 'Data from cache server: <pre>'; // lets see what we have from cache server
    print_r($aMemData);
    echo '</pre>';

    echo 'Data from cache server of object of CacheMemcache class: <pre>';
    print_r($aMemData2);
    echo '</pre>';

    echo 'As you can see - all data read successfully, now lets remove data from cache server and check results, click <a href="index3.php">here</a> to continue';

} else {
    echo 'Seems Memcache not installed, please install it to perform tests';
}

?>
