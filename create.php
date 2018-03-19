<?php

  require_once('_php/init.php');

  // if(is_post_request()) {
    // Create subjects
    $log_str = '';

    $subject = [];
    $subject['time'] = $_POST['time'] ? $_POST['time'] : '';
    $subject['device'] = $_POST['device'] ? $_POST['device'] : '';
    $subject['payload'] = $_POST['payload'] ? $_POST['payload'] : '';
    $log_str .= $subject['time'] . PHP_EOL;

    $object = 0;
    try{
      $object = $_FILES['files']['tmp_name'];
    } catch(Exception $e){
      $log_str .= $e->getMessage();
    }
    $new_loc = PROJECT_PATH . '/pics/' . $subject['time'] . '.jpg';

    // Move uploaded file to directory
    move_uploaded_file($object, $new_loc);

    $log_str .= $object . PHP_EOL;

    $log_str .= $new_loc . PHP_EOL;

    $log_str .= var_export($subject, true) . PHP_EOL;

    $status = insert_subject($subject, $new_loc);

    $log_str .= 'status: ' . $status . PHP_EOL;
    // $log_str .= mysqli_real_escape_string($imageContent);
    $myfile = file_put_contents('logs.txt', $log_str.PHP_EOL , FILE_APPEND | LOCK_EX);
  // } else {
  //   redirect_to()
  // }

?>
