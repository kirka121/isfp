
<script type="text/javascript" src="includes/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.timepicker.css" />
<script type="text/javascript" src="includes/base.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/base.css" />

<?php
if(!$session->isAdmin()){
	die("you should not be here. ip recorded, errors logged.");
}
$connection_ev = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $connection_ev) or die(mysql_error());
$q = "SELECT * FROM pages";
$result = mysql_query($q, $connection_ev);

if(isset($_POST['edit_this_event'])){
	$e_title = str_replace("'", "\'", $_POST['event_title']);
	$e_host = str_replace("'", "\'", $_POST['event_host']);
	$e_location = str_replace("'", "\'", $_POST['event_location']);
	$s_time = str_replace("'", "\'", $_POST['start_time']);
	$e_time = str_replace("'", "\'", $_POST['end_time']);
	$e_fee = str_replace("'", "\'", $_POST['enterance_fee']);
	$e_description = str_replace("'", "\'", $_POST['event_description']);

	$q = "UPDATE events SET event_title = '".$e_title."', event_host = '".$e_host."', event_location = '".$e_location."', start_time = '".$s_time."', end_time = '".$e_time."',enterance_fee = '".$e_fee."', event_description = '".$e_description."', start_hour = '".$_POST['start_hour']."', end_hour = '".$_POST['end_hour']."' WHERE event_id='".$_POST['edit_this_event']."'";
	if(mysql_query($q, $connection_ev)){echo"<div id='blue_notification_message_box'>Success</div>";} else {echo"<div id='red_notification_message_box'>Failure</div>";}
}

if(isset($_POST['create_new_event'])){
	$e_title = str_replace("'", "\'", $_POST['event_title']);
	$e_host = str_replace("'", "\'", $_POST['event_host']);
	$e_location = str_replace("'", "\'", $_POST['event_location']);
	$s_time = str_replace("'", "\'", $_POST['start_time']);
	$e_time = str_replace("'", "\'", $_POST['end_time']);
	$e_fee = str_replace("'", "\'", $_POST['enterance_fee']);
	$e_description = str_replace("'", "\'", $_POST['event_description']);

	$q = "INSERT INTO events SET event_id = 0, event_title = '".$e_title."', event_host = '".$e_host."', event_location = '".$e_location."', start_time = '".$s_time."', end_time = '".$e_time."',enterance_fee = '".$e_fee."', event_description = '".$e_description."', start_hour = '".$_POST['start_hour']."', end_hour = '".$_POST['end_hour']."'";
	if(mysql_query($q, $connection_ev)){echo"<div id='blue_notification_message_box'>Success</div>";} else {echo"<div id='red_notification_message_box'>Failure</div>";}
}

if(isset($_POST['delete_this_event'])){
	$q = "DELETE FROM events WHERE event_id=".$_POST['delete_this_event'];
	if(mysql_query($q, $connection_ev)){echo"<div id='blue_notification_message_box'>Success</div>";} else {echo"<div id='red_notification_message_box'>Failure</div>";}
}

mysql_close($connection_ev);
?>

<table class="edit_data">
	<tr>
		<td>Title</td><td> | </td>
		<td>Host</td><td> | </td>
		<td>Location</td><td> | </td>
		<td>Start Time</td><td> | </td>
		<td>End Time</td><td> | </td>
		<td width="105">Action</td>
	</tr>
		<?php 
			$connection_ev = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
			mysql_select_db(DB_NAME, $connection_ev) or die(mysql_error());
			$q = "SELECT * FROM events";
			$result = mysql_query($q, $connection_ev);
			while($row = mysql_fetch_array($result)){ 
		?>
	<tr>
		<td class="edit_data"><?php echo $row['event_title']; ?></td><td> | </td>
		<td class="edit_data"><?php echo $row['event_host']; ?></td><td> | </td>
		<td class="edit_data"><?php echo $row['event_location']; ?></td><td> | </td>
		<td class="edit_data"><?php echo $row['start_time']; ?></td><td> | </td>
		<td class="edit_data"><?php echo $row['end_time']; ?></td><td> | </td>
		<td class="edit_data">
			<form action="" method="post">
				<input type="hidden" name="edit_event" value='<?php echo $row['event_id']; ?>'>
				<input type="submit" value="Edit">
			</form>
			<form action="" method="post">
				<input type="hidden" name="delete_this_event" value='<?php echo $row['event_id']; ?>'>
				<input type="submit" value="Delete">
			</form>
		</td>
	</tr>
	<?php } 
	mysql_close($connection_ev);?>
	<tr>
		<td colspan="100%">
			<form action="" method="post">
				<input type="hidden" name="create_event" value="1">
				<input type="submit" value="Create an Event">
			</form>
		</td>
	</tr>
</table><br/>

<?php
if(isset($_POST['edit_event'])){
	$e_id = $_POST['edit_event'];
	$connection_ev = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
	mysql_select_db(DB_NAME, $connection_ev) or die(mysql_error());
	$q = "SELECT * FROM events WHERE event_id='".$e_id."'";
	$result = mysql_query($q, $connection_ev);
	$row = mysql_fetch_array($result)
?>
<form action="" method="post">
	<table class="edit_data">
		<tr>
			<td>Title:</td>
			<td colspan="2"><input type="text" name="event_title" value="<?php echo $row['event_title']; ?>"></td>
		</tr>
		<tr>
			<td>Description:</td>
			<td colspan="2">
				<textarea name="event_description" cols="60" rows="10"><?php echo $row['event_description']; ?></textarea>
			</td>
		</tr>
		<tr>
			<td>Hosted by:</td>
			<td colspan="2">
				<input type="text" name="event_host" value="<?php echo $row['event_host']; ?>">
			</td>
		</tr>
		<tr>
			<td>At location: </td>
			<td colspan="2"><input type="text" name="event_location" value="<?php echo $row['event_location']; ?>"></td>
		</tr>
		<tr>
			<td>Time:</td>
			<td>
				<script src="includes/datepair.js"></script>
				<div class="example">
					<p class="datepair" data-language="javascript">
						<input size="10" type="text" class="date start" name="start_time" value="<?php echo $row['start_time']; ?>"/>
						<input size="10" type="text" id="start_hour" name="start_hour" class="time start" value="<?php echo $row['start_hour']; ?>"/> to
						<input size="10" type="text" id="end_hour" name="end_hour" class="time end" value="<?php echo $row['end_hour']; ?>"/>
						<input size="10" type="text" class="date end" name="end_time" value="<?php echo $row['end_time']; ?>"/>
					</p>
				</div>
			</td>
		</tr>
		<tr>
			<td>Enterance fee:</td>
			<td colspan="2"><input type="text" name="enterance_fee" value="<?php echo $row['enterance_fee']; ?>"></td>
		</tr>
		<tr>
			<td colspan="4">
				<input type="hidden" name="edit_this_event" value='<?php echo $e_id; ?>'>
				<input type="submit" value="Save">
			</td>
		</tr>
	</table>
</form>
<?php } 

if(isset($_POST['create_event'])){
?>
<form action="" method="post">
	<table class="edit_data">
		<tr>
			<td>Title:</td>
			<td><input type="text" name="event_title" value="<?php echo $row['event_title']; ?>"></td>
		</tr>
		<tr>
			<td>Description:</td>
			<td>
				<textarea name="event_description" cols="60" rows="10"><?php echo $row['event_description']; ?></textarea>
			</td>
		</tr>
		<tr>
			<td>Hosted by:</td>
			<td>
				<input type="text" name="event_host" value="<?php echo $row['event_host']; ?>">
			</td>
		</tr>
		<tr>
			<td>At location: </td>
			<td><input type="text" name="event_location" value="<?php echo $row['event_location']; ?>"></td>
		</tr>
		<tr>
			<td>Time:</td>
			<td>
				<script src="includes/datepair.js"></script>
				<p class="datepair" data-language="javascript">
					<input size="10" type="text" class="date start" name="start_time" value="<?php echo $row['start_time']; ?>"/>
					<input size="10" type="text" name="start_hour" class="time start" value="<?php echo $row['start_hour']; ?>"/> to
					<input size="10" type="text" name="end_hour" class="time end" value="<?php echo $row['end_hour']; ?>"/>
					<input size="10" type="text" class="date end" name="end_time" value="<?php echo $row['end_time']; ?>"/>
				</p>
			</td>
		</tr>
		<tr>
			<td>Enterance fee:</td>
			<td><input type="text" name="enterance_fee" value="<?php echo $row['enterance_fee']; ?>"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="create_new_event" value="1">
				<input type="submit" value="Create">
			</td>
		</tr>
	</table>
</form>
<?php } ?>