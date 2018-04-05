<?php

  require_once('_php/init.php');

  if(is_get_request()){
    $passcode = $_GET['pass'] ? $_GET['pass'] : '';
    if($passcode == GET_PASS){
      $results = get_last_element();
      $result = mysqli_fetch_assoc($results);

      // Restful API
      $return_arr = array();
      $return_arr['data'] = $result;
      $relpath = '';
      if(isset($result['hook'])){
        $abspath = $result['hook'];
        $verdict = explode("/", $abspath);
        $verdict = end($verdict);
        $relpath = WEB_ROOT . '/test/pics/' . $verdict;
      }
      echo $relpath;
      $return_arr['link'] = $relpath;
      echo json_encode($return_arr, JSON_UNESCAPED_SLASHES);
    }
  } else {
    redirect_to('index.php');
  }

?>
