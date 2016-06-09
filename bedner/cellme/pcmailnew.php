<?php
// include function files for this application
require_once('mycell_fns.php');
session_start();
$username = $_SESSION['valid_user'];
do_pcuser_top();

?>
<script src="jquery-1.2.1.pack.js" type="text/javascript"></script>
<script type="text/javascript">

function lookup(inputString) {
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("rpc.php", {queryString: ""+inputString+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup

function fill(thisValue) {
    $('#inputString').val(thisValue);
    $('#suggestions').hide();
}

function fill2(thisValue2) {

    $('#inputString2').val(thisValue2);

}

</script>              
              <table class="member" cellspacing="20"><tr>
              <td width="205px">
                              <div id="valid">
<?php
                pccheck_valid_user();
?>
                </div>
                              <a href="pcsearch.php"><img src="images/search.jpg" alt="Search" border="0" width="75" height="79" /></a><br />
              <a href="pcadd_book.php"><img src="images/friends.jpg" alt="Search" border="0" width="75" height="79" /></a><br />
              <a href="pcemail.php"><img src="images/email.jpg" alt="Search" border="0" width="75" height="79" /></a><br /><br /> 

              </td>
              <td width="615px" align="center">
<?php

?>
<div id="usernav2"> 
<a href="pcemail.php">Inbox</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pcmailnew.php">Compose</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pcmailsent.php">Sent</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div> 
<table id="emailview" width="550px" align="left">

<tr rowspan="2"><td></td><td></td></tr>
<tr><td><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
     <form action="pcmailnew2.php" method="post">
     <br />
     
     
     <div>

       <div>

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <input size="50" id="inputString" name="to" onkeyup="lookup(this.value);" type="text" />
      <br /><br />                                              <input id="inputString2" name="to2" type="hidden" />
    </div>      
    <div class="suggestionsBox" id="suggestions" style="display: none;">

      <img src="upArrow.png" style="position: relative; top: -12px; left: 30px" alt="upArrow" />

      <div class="suggestionList" id="autoSuggestionsList"></div>

    </div>

    </div>
     &nbsp;Subject: <input type="text" name="subject" size="50" />
      <br /><br />
    &nbsp;<textarea id="mail" name="mail" rows="10" cols="65" wrap="virtual" /></textarea><br /><br />
    <input type="hidden" name="from" value="<?php echo $username; ?>" />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="mysubmit" type="submit" value="Send Mail" /> 
    </form> 
     <br /><br />
</td></tr>
<tr><td></td><td></td></tr>
</table>
              </td>
              <td width="220px" rowspan="3">

              <b><i>Updates</i></b><br /><br /> 
              <form action="pcaddupdate.php" method="post">
              <input type="text" name="update" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Update">
              </form> 
                            
              
              
                  <form action="pcupdate.php" method="post">
                  <br />
                  <input id="mysubmit" type="submit" value="See Next 10 Updates"/>
                  
                  </form><br /><br />

<?php
do_pcupdates();
?> 
              </td></tr>
              
              
              </table>
<?php
do_pcuser_bottom();

?>