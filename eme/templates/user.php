<?php
//print header
Utils::getHeader("Login");
?>
	<div id="content">
	<form method="post">
	<table class="form">
		<tr class="form-row">
			<td class="form-label"><label for="email">Email:</label></td>
			<td class="form-field"><input type="text" name="email" id="email" value="" class="requiredField email" required="required" /></td>
			<td class="form-error">									
			</td>
		</tr>
		<tr class="form-row">
			<td class="form-label"><label for="password">Password:</label></td>
			<td class="form-field"><input type="password" name="password" id="password" value="" class="requiredField password" required="required" /></td>
			<td class="form-error"></td>
		</tr>		
		<tr class="form-row">
			<td class="form-label"></td>
			<td class="form-field"><button type="submit" name="login" class="submit">Send &raquo;</button></td>
			<td class="form-error"></td>
		</tr>
	</table>		
	</form>
	</div>	

<?php
//print footer
Utils::getFooter(); 
?>