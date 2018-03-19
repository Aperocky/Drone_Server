<?php require_once('_php/init.php'); ?>

<?php $page_title = 'List of Displays'; ?>
<?php require_once('_php/parts/head.php');
  $subject_set = find_records();
 ?>

 <table class="table">
  <tr>
    <th>ID</th>
    <th>Time</th>
    <th>MAC address</th>
    <th>Message</th>
  </tr>

  <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
   <tr>
     <td><?php echo h($subject['id']); ?></td>
     <td><?php echo h($subject['time']); ?></td>
     <td><?php echo h($subject['device']); ?></td>
     <td><?php echo h($subject['payload']); ?></td>
   </tr>
  <?php } ?>
</table>

<?php require_once('_php/parts/footer.php'); ?>
