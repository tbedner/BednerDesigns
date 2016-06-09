<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
?>

    <!-- page content -->

    <p><h3>Search the listings</h3></p>
    <p>
    <form action="search_results.php" method="post">
    Personal Listings
    <input type="radio" checked="checked" value="personal" name="list_type" /><br />
    Business Listings
    <input type="radio" value="business" name="list_type" /><br />
    Name<br />
    <input type="text" name="name" /><br />
    City<br />
    <input type="text" name="city" /><br />
    <input id="mysubmit" type="submit" value="search"/>
        <br />
    <div>
    <input type="hidden" value="1" name="go"/>
    </div>
    </form> 
    <br />
    </p>
<?php
display_user_menu();

    do_html_footer();
?>