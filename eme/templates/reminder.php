<?php
//print header
Utils::getHeader("Reminder");

//show menu
Utils::getMenu("Reminder");
?>
	
	<div id="content">
	<form method="post" name="reminder" action="">
	<table class="form">
		<tr class="form-row">
			<td class="form-label"><label for="day">Day:</label></td>
			<td class="form-field">
			<select name="day">
				<option value="">Select</option>
				<option value='01'>01</option>
				<option value='02'>02</option>
				<option value='03'>03</option>
				<option value='04'>04</option>
				<option value='05'>05</option>
				<option value='06'>06</option>
				<option value='07'>07</option>
				<option value='08'>08</option>
				<option value='09'>09</option>
				<option value='10'>10</option>
				<option value='11'>11</option>
				<option value='12'>12</option>
				<option value='13'>13</option>
				<option value='14'>14</option>
				<option value='15'>15</option>
				<option value='16'>16</option>
				<option value='17'>17</option>
				<option value='18'>18</option>
				<option value='19'>19</option>
				<option value='20'>20</option>
				<option value='21'>21</option>
				<option value='22'>22</option>
				<option value='23'>23</option>
				<option value='24'>24</option>
				<option value='25'>25</option>
				<option value='26'>26</option>
				<option value='27'>27</option>
				<option value='28'>28</option>
				<option value='29'>29</option>
				<option value='30'>30</option>
				<option value='31'>31</option>
			</select>
			</td>
			<td class="form-error">									
			</td>
		</tr>
		<tr class="form-row">
			<td class="form-label"><label for="month">Month:</label></td>
			<td class="form-field">
			<select name="month">
				<option value="">Select</option>
				<option value='01'>01</option>
				<option value='02'>02</option>
				<option value='03'>03</option>
				<option value='04'>04</option>
				<option value='05'>05</option>
				<option value='06'>06</option>
				<option value='07'>07</option>
				<option value='08'>08</option>
				<option value='09'>09</option>
				<option value='10'>10</option>
				<option value='11'>11</option>
				<option value='12'>12</option>
			</select>	
			</td>
			<td class="form-error">									
			</td>
		</tr>
		<tr class="form-row">
			<td class="form-label"><label for="year">Year:</label></td>
			<td class="form-field">
			<select name="year">
				<option value="">Select</option>
				<option value='2012'>2012</option>
				<option value='2013'>2013</option>
				<option value='2014'>2014</option>
				<option value='2015'>2015</option>
			</select>				
			</td>
			<td class="form-error">									
			</td>
		</tr>						
		<tr class="form-row">
			<td class="form-label"><label for="hour">Hour:</label></td>
			<td class="form-field">
			<select name="hour">
				<option value="">Select</option>
				<option value='00'>00</option>
				<option value='01'>01</option>
				<option value='02'>02</option>
				<option value='03'>03</option>
				<option value='04'>04</option>
				<option value='05'>05</option>
				<option value='06'>06</option>
				<option value='07'>07</option>
				<option value='08'>08</option>
				<option value='09'>09</option>
				<option value='10'>10</option>
				<option value='11'>11</option>
				<option value='12'>12</option>
				<option value='13'>13</option>
				<option value='14'>14</option>
				<option value='15'>15</option>
				<option value='16'>16</option>
				<option value='17'>17</option>
				<option value='18'>18</option>
				<option value='19'>19</option>
				<option value='20'>20</option>
				<option value='21'>21</option>
				<option value='22'>22</option>
				<option value='23'>23</option>
			</select>
			</td>
			<td class="form-error">									
			</td>
		</tr>	
		<tr class="form-row">
			<td class="form-label"><label for="minutes">Minutes:</label></td>
			<td class="form-field">
			<select name="minutes">
				<option value=""> Select </option>
				<option value='00'>00</option>
				<option value='05'>05</option>
				<option value='10'>10</option>
				<option value='15'>15</option>
				<option value='20'>20</option>
				<option value='25'>25</option>
				<option value='30'>30</option>
				<option value='35'>35</option>
				<option value='40'>40</option>
				<option value='45'>45</option>
				<option value='50'>50</option>
				<option value='55'>55</option>
				<option value='60'>60</option>
			</select>
			</td>
			<td class="form-error">									
			</td>
		</tr>
		<tr class="form-row">
			<td class="form-label"></td>
			<td class="form-field">
			<button type="submit" name="save" class="submit">Save</button>
			</td>
			<td class="form-error">									
			</td>
		</tr>
	</table>														
	</form>
	</div>	

<?php 
//print footer
Utils::getFooter();
?>