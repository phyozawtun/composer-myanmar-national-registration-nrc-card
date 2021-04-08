<pre>
<?php
include("myanmar-nrc.php");

// getNRC ( null|int|array $state_id, bool|null $associative)

// $array = getNRC();
// var_dump($array);

// $array1 = getNRC(12);
// var_dump($array1);

$state_ids = array(2,12);
$array2 = getNRC($state_ids);
var_dump($array2);



//getNRC();

// isNRC ( null|int|array $state_id, bool|null $associative)


?>
