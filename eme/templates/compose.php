<?php
//print header
Utils::getHeader("Compose");

//show menu
Utils::getMenu("Compose");;
?>
	<div id="content">
	<form method="post" name="flag" action="">
	
	<?php include 'message.php'; ?>	
	<table class="form">
		<tr class="form-row">
			<td class="form-label"><label for="to">To:</label></td>
			<td class="form-field"><input type="text" name="to" id="to" value="" class="requiredField to" required="required" /></td>
			<td class="form-error"></td>
		</tr>
		<tr class="form-row">
			<td class="form-label"><label for="cc">CC:</label></td>
			<td class="form-field"><input type="text" name="cc" id="cc" value="" class="requiredField cc" required="required" /></td>
			<td class="form-error"></td>
		</tr>
		<tr class="form-row">
			<td class="form-label"><label for="subject">Subject:</label></td>
			<td class="form-field"><input type="text" name="subject" id="subject" value="" /></td>
			<td class="form-error"></td>
		</tr>		
		<tr class="form-row">
			<td class="form-label"><label for="message"></label></td>
			<td class="form-field">
				<textarea class="txtClass" name="message" id="message" cols="24" rows="8"></textarea>			
			</td>
			<td class="form-error"></td>
		</tr>
		<tr class="form-row">
			<td class="form-label"></td>
			<td class="form-field"><button type="submit" name="send" class="submit">Send &raquo;</button></td>
			<td class="form-error"></td>
		</tr>								
	</table>
	</form>

	</div>	

<?php 
//print footer
Utils::getFooter();
?>