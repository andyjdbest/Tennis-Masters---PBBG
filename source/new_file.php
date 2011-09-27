<?php

require_once 'DBconfig.php';

$id = 2;
//obtain the correct academy id
					$select = "SELECT id_team FROM academy WHERE id_user = '$id'";
					$query = mysqli_query($conn,$select);
					$row = mysqli_fetch_row($query);
					$academy = $row[0];
					
					//UPDATE academy
					$query = "UPDATE academy SET id_user = NULL WHERE id_user = '$id'";
					if (!(mysqli_query($conn, $query))) {
                                    		 $errorDormant .= ' Cannot update user id ' . $id . mysqli_error($conn);
                     			}
                     			//UPDATE Users isAssigned field
					$update = "UPDATE users SET isAssigned = 0 WHERE userid = '$id'";
					if (!(mysqli_query($conn, $update))) {
                                     		$errorDormant .= ' Cannot update user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE coaches
                     			$delete = "DELETE FROM coaches WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete coaches user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE training
                     			$delete = "DELETE FROM training_data WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete training user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			/*//DELETE training_report
                     			$delete = "DELETE FROM training_report WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete training report user id ' . $id . mysqli_error($conn);
                     			}
                     			*/
                     			
                     			//DELETE finance
                     			$delete = "DELETE FROM finance WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete finance user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE finance_summary
                     			$delete = "DELETE FROM finance_summary WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete finance summary user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELETE match_order
                     			$delete = "DELETE FROM match_order WHERE id_team = '$academy'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete match_order user id ' . $id . mysqli_error($conn);
                     			}
                     			
                     			//DELete messages
					$delete = "DELETE FROM messages WHERE id_receiver = '$id'";
                     			if (!(mysqli_query($conn, $delete))) {
                                     		$errorDormant .= ' Cannot delete messages user id ' . $id . mysqli_error($conn);
                     			}




?>