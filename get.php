<html>
<?php

  require_once('_php/init.php');

  if(is_get_request()){
    $passcode = $_GET['pass'] ? $_GET['pass'] : '';
    if($passcode == GET_PASS){
      $results = get_last_element();
      $result = mysqli_fetch_assoc($results);
      // echo var_dump($results);
      ?>
    <head>
      <meta http-equiv="refresh" content="3; URL=get.php?pass=<?php echo $passcode; ?>">
    </head>

      <table class="table">
        <tr>
          <th>ID</th>
          <th>Time</th>
          <th>MAC address</th>
          <th>Message</th>
        </tr>

        <tr>
          <td><?php echo h($result['id']); ?></td>
          <td id='time'><?php echo h($result['time']); ?></td>
          <td id='device'><?php echo h($result['device']); ?></td>
          <td id='payload'><?php echo h($result['payload']); ?></td>
        </tr>
      </table>

      <?php
      // Construct relative path
      if(isset($result['picture_location'])){
        $abspath = $result['picture_location'];
        // echo $abspath;
        $verdict = explode("/", $abspath);
        $verdict = end($verdict);
        // echo $verdict;
        $relpath = 'pics/' . $verdict;
        ?>
        <img src='<?php echo h($relpath); ?>'/>
        <?php
      }
    }
  } else {
    redirect_to('index.php');
  }

?>
