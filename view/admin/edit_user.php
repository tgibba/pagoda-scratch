<script type="text/javascript">
$(document).ready(function(){

	$("select[name=userID]").change(function(){
		var user = $(this).val();

		$.getJSON("<?php echo BASEPATH; ?>/include/ajax/getprofile.php?id=" + user ,
			function(data) {
			//Should be renamed in future
			$('input[name=fullname]').val(data.fullName); 
			$('input[name=email]').val(data.emailAddress);
			$('input[name=address]').val(data.address);
			});
	
	});
	
});

</script>

<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($edited)):
$this->RenderMsg("User edited.");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Edit User Profile</h2>
	<form action="" method="POST">
		<label for="username">Username:  </label>
			
		<select name="userID">
		<option value="" selected="selected" disabled="disabled">Select</option>
		<?php

		//is this necessary?
		/*foreach($roles as $role)
		echo "<option value=\"".$role["Role"]["RolesID"]."\">".$role["Role"]["role"]."</option>";
	*/
		
			foreach($users as $user)
			{
				echo "<option value=\"".$user["User"]["UserID"]."\">".$user["User"]["username"]."</option>";
			}
		?>
		</select>
		
		<h3>Profile:</h3>
		<table>
		<tr>		
		<td><label for="fullname">Full Name:  </label></td><td><input type="text" name="fullname" /></td>
		</tr>
		<tr>
		<td><label for="email">Email:  </label></td><td><input type="text" name="email" /></td>
		</tr>
		<tr>
		<td><label for="address">Address:  </label></td><td><input type="text" name="address" size="60"/></td>
		</tr>
		<tr><td></td>
		<td><input type="submit" name="submit" value="submit"/></td>
		</tr>
		</table>
		</form>
		
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>