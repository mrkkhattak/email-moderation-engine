<?php
//print header
Utils::getHeader("Inbox");

//show menu
Utils::getMenu("Inbox");;
?>
<script>

//timer for refreshing page after starting any service 
var secs
var timerID = null
var timerRunning = false
var delay = 1000

function InitializeTimer(){
	// Set the length of the timer, in seconds
	secs = 30
	StopTheClock()
	StartTheTimer()
}

function StopTheClock(){
	if(timerRunning)
		clearTimeout(timerID)
	timerRunning = false
}

function StartTheTimer(){
    if (secs==0)
    {
        StopTheClock()
        // refresh the page after the set time to show correct status of services
        self.location = "<?php echo APP_URL ."index.php?action=followup"; ?>";        
    }
    else
    {
        self.status = secs
        secs = secs - 1
        timerRunning = true
        timerID = self.setTimeout("StartTheTimer()", delay)
    }
}

InitializeTimer();
</script>
	
	<div id="content">
	
	<?php include 'message.php'; ?> 

	<?php if (!empty($priority_listing)) {?>
	<div align="center"><strong>Priority Inbox</strong></div>	
	<table border="0" cellspacing="0" id="priority-inbox">
		<tr>
			<th width="25">#</th>
			<th width="200">Subject</th>
			<th width="125">From</th>
			<th width="175">Date</th>
			<th width="75">Flag</th>
			<th width="100">Reminder</th>
		</tr>
		<?php
		foreach ($emails as $p_email){			
			//get specific email headers
			$retPEmail = $pop3->getParsedHeaders($p_email->getMsgID());			
			
			//show in table format
			echo "<tr>";
			echo "<td>". $p_email->getMsgID() ."</td>";
			echo "<td>";
			if (empty($retPEmail["Subject"])) {
				echo "<a href='". APP_URL ."index.php?action=view&mid=". $p_email->getMsgID() ."'>no subject</a>"; 	
			}	
			else {
				echo "<a href='". APP_URL ."index.php?action=view&mid=". $p_email->getMsgID() ."'>". $retPEmail["Subject"] ."</a>";
			}
			echo "</td>";
			echo "<td>". $retPEmail["From"] ."</td>";
			echo "<td>". substr($retPEmail["Date"], 0, 25) ."</td>";
			echo "<td><a href='". APP_URL ."index.php?action=flag&delete=1&uid=". $p_email->getUID() ."'>Remove</a></td>";
			echo "<td>";
			$reminder = $p_email->getReminder();
			if (!empty($reminder)){
				echo "<a href='". APP_URL ."index.php?action=reminder&delete=1&uid=". $p_email->getUID() ."'>Remove</a>";
			}
			else {
				echo "<a href='". APP_URL ."index.php?action=reminder&uid=". $p_email->getUID() ."'>Set</a>";
			}	
			echo "</td>";			
			echo "</tr>";
		}
		?>
	</table>
	<br />
	<?php } ?>
	
	<?php if (!empty($listing)) {?>	
	<div align="center"><strong>Inbox</strong></div>
	<table border="0" cellspacing="0" id="inbox">
		<tr>
			<th width="25">#</th>
			<th width="200">Subject</th>
			<th width="125">From</th>
			<th width="175">Date</th>
			<th width="175">Flag</th>
		</tr>			
		<?php 
		foreach ($listing as $email){			
			//get specific email headers
			$retEmail = $pop3->getParsedHeaders($email["msg_id"]);			
			
			//show in table format
			echo "<tr>";
			echo "<td>". $email["msg_id"] ."</td>";
			echo "<td>";
			if (empty($retEmail["Subject"])) {
				echo "<a href='". APP_URL ."index.php?action=view&mid=". $email["msg_id"] ."'>no subject</a>"; 	
			}	
			else {
				echo "<a href='". APP_URL ."index.php?action=view&mid=". $email["msg_id"] ."'>". $retEmail["Subject"] ."</a>";
			}
			echo "</td>";
			echo "<td>". $retEmail["From"] ."</td>";
			echo (!empty($retEmail["Date"])) ? "<td>". substr($retEmail["Date"], 0, 25) ."</td>" : "";
			//echo "<td>". substr($retEmail["Date"], 0, 25) ."</td>";
			echo "<td><a href='". APP_URL ."index.php?action=flag&uid=". $email["uidl"] ."'>Set</a></td>";
			echo "</tr>";
		}
		?>
	</table> 
	<?php } else { ?>
	<div align="center"><strong>Inbox is empty.</strong></div>
	<?php } ?>
	
	</div>	

<?php 
//print footer
Utils::getFooter();
?>