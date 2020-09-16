<?php

function callback($buffer)
{
return $buffer;
}

ob_start('callback')
?>
	　　<h1>I am demo.php</h1>
<?php
ob_end_flush()
?>