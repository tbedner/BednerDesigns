<?php
// include function files for this application
require_once('mycell_fns.php');
session_start();

do_pcuser_top();

?>
              
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
                  <p><h3>Search the listings</h3></p>
    <p>
    <br /><br />
    

<div class="mid" id="Personal" style="DISPLAY: block" >
<font color="#00B0F0">Personal Listings</font>
    <form action="pcsearch_results.php" method="post">
     
    <input type="hidden" value="personal" name="list_type" /><br />
    First Name<br />
    <input type="text" name="firstname" /><br /><br />
    Last Name<br />
    <input type="text" name="lastname" /><br /><br />
    City<br />
    <input type="text" name="city" /><br />
    <input id="mysubmit" type="submit" value="search"/>
        <br /><br />
    
    <input type="hidden" value="1" name="go"/>
<a onclick ="javascript:ShowHide('Personal');HideShow('Business')" href="javascript:;" ><font color="#00B0F0">For Business Listings, Click Here</font></a> 

  </div>
              </form>
<script language="JavaScript">
function ShowHide(divId)
{
if(document.getElementById(divId).style.display == 'block')
{
document.getElementById(divId).style.display='none';
}
else
{
document.getElementById(divId).style.display = 'block';
}
}
</script>
 
    
    
<div class="mid" id="Business" style="DISPLAY: none" >

Business Listings
    <form action="pcsearch_results.php" method="post">
    <input type="hidden" value="business" name="list_type" /><br />
    <font color="#00B0F0">Business Name</font><br />
    <input type="text" name="firstname" /><br /><br />
    <font color="#00B0F0">Contact Name</font><br />
    <input type="text" name="lastname" /><br /><br />
    <font color="#00B0F0">City</font><br />
    <input type="text" name="city" /><br />
    <input id="mysubmit" type="submit" value="search"/>
        <br /><br />
    
    <input type="hidden" value="1" name="go"/>
<a onclick ="javascript:ShowHide('Personal');HideShow('Business')" href="javascript:;" >For Personal Listings, Click Here</a> 

    </div></form>
<script language="JavaScript">
function HideShow(divId)
{
if(document.getElementById(divId).style.display == 'none')
{
document.getElementById(divId).style.display='block';
}
else
{
document.getElementById(divId).style.display = 'none';
}
}
</script>
       </p>
    

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