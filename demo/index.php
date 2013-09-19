<?php
include('db.php');
$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");

$key = md5('List 9lessons Demos'); // Unique Words
$cache_result = array();
$cache_result = $memcache->get($key); // Memcached object 

if($cache_result)
{
// Second User Request
$demos_result=$cache_result;
}
else
{
// First User Request 
$v=mysql_query("select * from demos order by id desc");
while($row=mysql_fetch_array($v))
$demos_result[]=$row; // Results storing in array
$memcache->set($key, $demos_result, MEMCACHE_COMPRESSED, 1200); 
// 1200 Seconds
}

// Result 
foreach($demos_result as $row)
{
echo '<a href='.$row['link'].'>'.$row['title'].'</a>';
}

?>

