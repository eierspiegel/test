<?php

	
	if ($_GET['mode'] == "send"){
		$sql_stmt = "
			INSERT INTO chats (
				text, person, zeit, gelesen1, gelesen2
			) VALUES (
				'" . $_GET['text'] . "', '" . $_GET['person'] . "', '" . $_GET['zeit'] . "', '0', '0'
			);";
		$db_erg = mysqli_query($db, $sql_stmt);
		
	}
	elseif ($_GET['mode'] == "read"){
		if($_GET['person'] == "p1"){
			//echo "testtttt_send, other, 5";
			$sql_stmt = "
				SELECT text, person, zeit
				FROM chats
				where gelesen1 = 0
			";
		}
		elseif($_GET['person'] == "p2"){
			//echo "testtttt_send, other, 5";
			$sql_stmt = "
				SELECT text, person, zeit
				FROM chats
				where gelesen2 = 0
			";
		}
		else{
			echo "error";
		}
		$db_erg = mysqli_query($db, $sql_stmt);
		while($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC)){
			$text = $zeile['text'];
			$person = $zeile['person'];
			$zeit = $zeile['zeit'];
			echo $text . ", ";
			echo $person . ", ";
			echo $zeit;
		}
		if($_GET['person'] == "p1"){
			$sql_stmt = "
				Update chats 
				SET gelesen1=1
				Where zeit='" . $zeit . "'";
			$db_erg = mysqli_query($db, $sql_stmt);
		}
		elseif($_GET['person'] == "p2"){
			$sql_stmt = "
				Update chats 
				SET gelesen2=1
				Where zeit='" . $zeit . "'";
			$db_erg = mysqli_query($db, $sql_stmt);
		}
	}
?>
