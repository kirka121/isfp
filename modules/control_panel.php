<?php
if($session->isAdmin()){
?>
<table class="alinks">
	<tr>
		<td id="align_left" colspan="100%">
			Admin panel: 
		</td>
	</tr>
	<tr>
		<td class="alinks"><a href="index.php?op=control_panel&page=general">Site Settings</a></td><td> | </td>
	    <td class="alinks"><a href="index.php?op=control_panel&page=stats">List Users</a></td><td> | </td>
	    <td class="alinks"><a href="index.php?op=control_panel&page=users">Manage Users</a></td><td> | </td>
	    <td class="alinks"><a href="index.php?op=control_panel&page=useful_links">Useful Links</a></td>
	</tr>
	<tr>
		<td class="alinks"><a href="index.php?op=control_panel&page=manage_pages">Manage Pages</a></td><td> | </td>
	    <td class="alinks"><a href="index.php?op=control_panel&page=manage_events">Manage Events</a></td><td> | </td>
	    <td class="alinks"><a href="index.php?op=control_panel&page=view_reservations">View Reservations</a></td><td> | </td>
	    <td colspan="100%">
	</tr>
</table>
<br />
<?php } ?>
<table class="alinks">
	<tr>
		<td id="align_left" colspan="100%">
			User panel:
		</td>
	</tr>
	<tr>
	    <td class="alinks"><?php echo "<a href=\"index.php?op=control_panel&page=userinfo&user=$session->username\">My Account</a>"; ?></td><td> | </td>
	    <td class="alinks"><a href="index.php?op=control_panel&page=useredit">Update Info</a></td><td> | </td>
	    <td class="alinks"><a href="index.php?op=control_panel&page=reservations">My Reservations</a></td>
	    <td colspan="100%">
	</tr>
</table><br/>
<?php

if($session->isAdmin()){
	if(!isset($_GET['page'])){
		include("includes/login/admin/general.php"); 
	} else {
		$req_page = trim($_GET['page']);
		if (is_file("includes/login/admin/".$req_page.".php")) {
	      	include("includes/login/admin/".$req_page.".php");
	    } else {	
			echo ("<div id='error'>Module could not be found!<br/></div>");
	    }
	}
} else {
	if(!isset($_GET['page'])){
		$_GET['user'] = $session->username;
		include("includes/login/admin/userinfo.php"); 
	} else {
		$req_page = trim($_GET['page']);
		if (is_file("includes/login/admin/".$req_page.".php")) {
	      	include("includes/login/admin/".$req_page.".php");
	    } else {	
			echo ("<div id='error'>Module could not be found!<br/></div>");
	    }
	}
}
?>
