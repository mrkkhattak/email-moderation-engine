<?php
//print header
Utils::getHeader("Flag");

//show menu
Utils::getMenu("Flag");;
?>
	
	<div id="content">
	<form method="post" name="flag" action="">
	
 	<select name="flag" style="width: 125px">
		<option value='1'>High Priority</option>
	</select>
	<br />
	<button type="submit" name="save" class="submit">Save</button>
	
	</form>
	</div>	

<?php 
//print footer
Utils::getFooter();
?>