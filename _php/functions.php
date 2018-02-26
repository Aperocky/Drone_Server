<?php

// ------------------ DATABASE QUERY FUNCTIONS ----------------------

  // This function insert a regular entree into time_stamps table.
  function insert_subject($subject) {
    global $db;

    $sql = "INSERT INTO ". DBNAME;
    $sql .= " (time, device, payload) ";
    $sql .= "VALUES (";
    $sql .= "'" . $subject['time'] . "',";
    $sql .= "'" . $subject['device'] . "',";
    $sql .= "'" . $subject['payload'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    echo $result;
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_close($db);
      exit;
    }
  }

// ------------------------- OTHER FUNCTIONS ------------------------

  // Redirection
  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }


?>
