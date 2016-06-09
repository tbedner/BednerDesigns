?>
<script language="JavaScript">
  function showhidefield()
  {
    if (document.frm)
    {
      document.getElementById("hideablearea").style.display = "block";
    }
    else
    {
      document.getElementById("hideablearea").style.display = "none";
    }
  }
</script>
<form name='frm' action='nextpage.asp'>
  <a onclick="showhidefield()">
  Comment</a>
  <br>
  <div id='hideablearea' style='visibility:hidden;'>
    <input type='text'><br>
    <input id="mysubmit" type='submit'>
  </div>
</form>

<head><script>
               function showTextBox(id) {
document.getElementById(id).style.display = "block";
}
function hideTextBox(id) {
document.getElementById(id).style.display = "none";
}
</script></head>

<a href="javascript:showTextBox('box01')">Show Box 1</a> - <a href="javascript:hideTextBox('box01')">Hide Box 1</a><br>
<a href="javascript:showTextBox('box02')">Show Box 2</a> - <a href="javascript:hideTextBox('box02')">Hide Box 2</a><br>
<a href="javascript:showTextBox('box03')">Show Box 3</a> - <a href="javascript:hideTextBox('box03')">Hide Box 3</a><br>
<a href="javascript:showTextBox('box04')">Show Box 4</a> - <a href="javascript:hideTextBox('box04')">Hide Box 4</a><br>

<form>
<input type="text" name="box01" id="box01" value="Box 1" style="display:none">
<input type="text" name="box01" id="box02" value="Box 2" style="display:none">
<input type="text" name="box01" id="box03" value="Box 3" style="display:none">
<input type="text" name="box01" id="box04" value="Box 4" style="display:none"> 
</form>
<?php 
  
  
  
