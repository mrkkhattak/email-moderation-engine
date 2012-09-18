<?php
//print header
Utils::getHeader("View");

//show menu
Utils::getMenu("View");;
?>
	<div id="content">	
	<table border="0" cellspacing="0" id="email-view">	
	<?php if (!empty($emailHeaders)){ ?>
		<tr>
			<td width="150">From:</td>
			<td width="450"><?php echo (!empty($emailHeaders["From"])) ? $emailHeaders["From"] : ""; ?></td>
		</tr>
		<tr>
			<td width="150">Date:</td>
			<td width="450"><?php echo (!empty($emailHeaders["Date"])) ? $emailHeaders["Date"] : ""; ?></td>
		</tr>		
		<tr>
			<td width="150">Subject:</td>
			<td width="450"><?php echo (!empty($emailHeaders["Subject"])) ? $emailHeaders["Subject"] : ""; ?></td>
		</tr>		
	<?php 
	}
	//print email body
	if (!empty($emailBody)){
	?>
		<tr>
			<td width="600" colspan="2">
			<?php echo $emailBody; ?>
			</td>
		</tr>		
	
	<?php } ?>	
	</table>	
	</div>	

<?php 
//print footer
Utils::getFooter();
?>