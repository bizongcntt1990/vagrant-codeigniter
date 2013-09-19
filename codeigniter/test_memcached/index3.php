<?php

require_once('classes/CacheMemcache.php');
$oCache = new CacheMemcache();

if ($oCache->bEnabled) { // if Memcache enabled

    $oCache->delData('my_object'); // removing data from cache server
    $oCache->delData('our_class_object'); // removing data from cache server

    $aMemData = $oCache->getData('my_object'); // lets try to get data again
    $aMemData2 = $oCache->getData('our_class_object');

    echo 'Data from cache server: <pre>'; // lets see what we have from cache server
    print_r($aMemData);
    echo '</pre>';

    echo 'Data from cache server of object of CacheMemcache class: <pre>';
    print_r($aMemData2);
    echo '</pre>';

    echo 'As you can see - all data successfully removed. Great !';

} else {
    echo 'Seems Memcache not installed, please install it to perform tests';
}

?>
