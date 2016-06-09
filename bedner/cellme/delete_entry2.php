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
  
    echo '<br />';
    echo 'Deleted Entry: ';
    echo $lname.', '.$fname;
    echo '<br />';
    echo $city;
    echo '<br />';
    echo $cell;
    echo '<br />';
  $conn = db_connect();
  $result = $conn->query("delete from add_book
                            where username = '".$_SESSION['valid_user']."' AND ent_id = '".$id."' AND cell = '".$cell2."'");
  $result = $conn->query("delete from add_book
                            where username = '".$id."' AND ent_id = '".$_SESSION['valid_user']."' AND cell = '".$cell1."'");



mysqli_close($conn);

display_user_menu();
do_html_footer();
?>
  
  