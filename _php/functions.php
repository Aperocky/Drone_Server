<?php

// ------------------ DATABASE QUERY FUNCTIONS ----------------------

  // This function insert a regular entree into time_stamps table.
  function insert_subject($subject, $object) {
    global $db;

    $sql = "INSERT INTO ". CURR_TABLE;
    $sql .= " (time, device, payload, picture_location) ";
    $sql .= "VALUES (";
    $sql .= "'" . $subject['time'] . "',";
    $sql .= "'" . $subject['device'] . "',";
    $sql .= "'" . $subject['payload'] . "'";
    if ($object !== 0){
      $sql .= ",'". mysqli_real_escape_string($db, $object) ."'";
    } else {
      $sql .= ",'NULL'";
    }
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // if ($object !== 0){
    //   $sql = "INSERT INTO ". CURR_TABLE;
    //   $sql .= " (picture) ";
    //   $sql .= "VALUES (";
    //   $sql .= "'" . mysqli_real_escape_string($db, $object) . "'";
    //   $sql .= ")";
    //   $result = mysqli_query($db, $sql);
    // }
    // return $sql;
    if($result) {
      return $sql;
    } else {
      $error = mysqli_error($db);
      db_close($db);
      return $error;
    }
  }

// ------------------------- OTHER FUNCTIONS ------------------------

  // Redirection
  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

// ------------------------- QUERY FUNCTIONS ------------------------

  function find_records() {
    global $db;
    $sql = "SELECT * FROM time_stamps ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

?>
