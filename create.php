<?php

  require_once('_php/init.php');

  if(is_post_request()) {
    // Create subjects
    $log_str = '';
    $subject = [];
    $subject['time'] = $_POST['time'] ? $_POST['time'] : '';
    $subject['device'] = $_POST['device'] ? $_POST['device'] : '';
    $subject['payload'] = $_POST['payload'] ? $_POST['payload'] : '';
    $log_str .= $subject['time'] . PHP_EOL;

    // Load Objects, if failed, Object == 0
    $object = 0;
    try{
      $object = $_FILES['files']['tmp_name'];
    } catch(Exception $e){
      $log_str .= $e->getMessage();
    }

    // Select appropriate file for image
    $locpath = NULL;
    if($object !== 0){
      $log_str .= 'Im here';
      $picid = 0;
      while(true){
        $fullid = str_pad($picid, 5, '0', STR_PAD_LEFT);
        $locpath = PROJECT_PATH . '/pics/' . 'pic' . $fullid . '.jpg';
        if(!file_exists($locpath)){
          break;
        }
        $picid ++;
      }
      move_uploaded_file($object, $locpath);
    }

    // Further logging
    $log_str .= $object . PHP_EOL;
    $log_str .= $locpath . PHP_EOL;
    $log_str .= var_export($subject, true) . PHP_EOL;

    // Insert mysql database
    $status = insert_subject($subject, $locpath);
    $log_str .= 'status: ' . $status . PHP_EOL;
    echo($log_str);
    $myfile = file_put_contents('logs.txt', $log_str.PHP_EOL , FILE_APPEND | LOCK_EX);
  } else {
    redirect_to('http://www.google.com');
  }

?>
