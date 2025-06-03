<?php
$lat= $_GET['lat'];
$long= $_GET['long'];
?>
<iframe width="100%" height="500" style="margin-bottom: 10px;border-radius: 4px;padding: 4px;border: none;" src="https://maps.google.com/maps?q=<?php echo $lat; ?>,<?php echo $long; ?>&output=embed"></iframe>