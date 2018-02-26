<?php

  require_once('_php/init.php');

  // if(is_post_request()) {
    // Create subjects
    $subject = [];
    $subject['time'] = $_POST['time'] ? $_POST['time'] : '';
    $subject['device'] = $_POST['device'] ? $_POST['device'] : '';
    $subject['payload'] = $_POST['payload'] ? $_POST['payload'] : '';

    insert_subject($subject);

    echo var_dump($subject);
    echo 'All is well';
  // } else {
  //   redirect_to()
  // }

?>
