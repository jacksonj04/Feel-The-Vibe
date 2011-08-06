<?php
if (isset($_POST['hello']))
{
	echo 'yay';
	die;
}
?>
<form method="post">
	<input type="submit" name="hello" id="hello" value="test">
</form>