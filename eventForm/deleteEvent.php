<?php
  
  include 'connection.php';
  include 'selectEvents.php';

  // get 'eventID to delete'
  $id = $_GET['event_id'];

  if($id == $id)
    {
      $stmt = $conn->prepare("DELETE FROM wdv341_event WHERE event_id = '$id'");
      $stmt->execute();
     
      echo "<h1>"."Record Event Id Was Deleted: ".$id."</h1>";
    }
    else
    {
      echo "<h1>Record was not deleted!</h1>";
    }

?>  