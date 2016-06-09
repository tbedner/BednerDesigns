<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
  
  $id = trim($_GET['id']);
  if (strlen($id) > 16){
  exit;
  }
  $id=sql_sanitize($id);
  $cell1 = $_GET['cell1'];
  $cell1 = sql_sanitize($cell1);
  if (!validatePhone($cell1)) {exit;}  
  $cell2 = $_GET['cell2'];
  $cell2 = sql_sanitize($cell2);  
  if (!validatePhone($cell2)) {exit;}  
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND ent_id = '".$id."' AND cell = '".$cell2."'");
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
mysqli_close($conn);
echo '<br />';
echo $lname.', '.$fname;
echo '<br />';
echo 'Are you sure you would like to delete this entry?';
echo '<br />';
echo '<br />';
?>
<div class="navbar2">
<a href="delete_entry2.php?id=<?php echo $id; ?>&amp;cell1=<?php echo $cell1; ?>&amp;cell2=<?php echo $cell2; ?>">Yes</a><br />
<a href="add_book.php">No</a><br /></div>
<?php
display_user_menu();
do_html_footer();
?>
  
  