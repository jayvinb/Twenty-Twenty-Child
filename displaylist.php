<?php 

global $wpdb;
$tablename = $wpdb->prefix."customplugin";
//Eddit Record
if(isset($_POST['but_submit'])){

	$name = $_POST['txt_name'];
	$uname = $_POST['txt_uname'];
	$email = $_POST['txt_email'];
	$id = $_POST['id'];
	
	$tablename = $wpdb->prefix."customplugin";
    
			echo '<script>alert("grrh")</script>';
	$wpdb->query($wpdb->prepare("UPDATE $tablename SET name='$name', username='$uname' , email='$email' WHERE id=$id"));
	echo "update sucessfully.";
		
	
}
if(isset($_GET['updateid'])){
	$updateid = $_GET['updateid'];
	$updateList = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE id=".$updateid);
	$idupdate = $updateList[0]->id;
	$nameupdate = $updateList[0]->name;
	$unameupdate = $updateList[0]->username;
	$emailupadte = $updateList[0]->email;
	
	
	?>
	<h1>eddit Entry</h1>
	<form method='post' action=''>
		<table>
			<tr>
				<td>Name</td>
				<td><input type='text' name='txt_name' value="<?php echo $nameupdate ?>"></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input type='text' name='txt_uname' value="<?php echo $unameupdate ?>"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type='text' name='txt_email' value="<?php echo $emailupdate ?>"></td>
				<input type="hidden" id="id" name="id" value="<?php echo $idupdate ?>">
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type='submit' name='but_submit' value='update'></td>
			</tr>
		</table>
	</form>
	<?php
}

// Delete record
if(isset($_GET['delid'])){
	$delid = $_GET['delid'];
	$wpdb->query("DELETE FROM ".$tablename." WHERE id=".$delid);
}
?>
<h1>All Entries</h1>

<table width='100%' border='1' style='border-collapse: collapse;'>
	<tr>
		<th>S.no</th>
		<th>Name</th>
		<th>Username</th>
		<th>Email</th>
		<th>&nbsp;</th>
	</tr>
	<?php
	// Select records
	$entriesList = $wpdb->get_results("SELECT * FROM ".$tablename." order by id desc");
	if(count($entriesList) > 0){
		$count = 1;
		foreach($entriesList as $entry){
		    $id = $entry->id;
		    $name = $entry->name;
		    $uname = $entry->username;
		    $email = $entry->email;

		    echo "<tr>
		    	<td>".$count."</td>
		    	<td>".$name."</td>
		    	<td>".$uname."</td>
		    	<td>".$email."</td>
		    	<td><a href='?page=allentries&delid=".$id."'>Delete</a></td>
				<td><a href='?page=allentries&updateid=".$id."'>Eddit</a></td>
		    </tr>
		    ";
		    $count++;
		}
	}else{
		echo "<tr><td colspan='5'>No record found</td></tr>";
	}
	

	?>
</table>