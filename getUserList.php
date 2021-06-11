<?php
	session_start();
	require('includes/config.php');
	$cid = $_SESSION['cid'];
	if( !empty($_POST["keyword"]) )
	{
		$query = "SELECT name,mobile FROM members WHERE name like '" . $_POST["keyword"] . "%' and cid = ".$cid." ORDER BY id LIMIT 0,10";
		$result = mysqli_query( $con,$query );
		if( !empty($result) ) {
			echo '<ul id="search-list">';
			foreach( $result as $members ) {
			?>
				<li onClick="selectUser('<?php echo $members["name"]; ?>' , <?php echo $members["mobile"]; ?>);"><?php echo $members["name"]; ?></li>			
			<?php
			} 
			echo '</ul>';
		}
	}
?>