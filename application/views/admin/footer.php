	</div>
</div>
<div  id="footer">
		<div class="wrap">
            <div id="footer-menu">
            	<br>
                <div style="text-align:right; padding:0 25px 0 0;">
					<?php 
						if($this->config->item('product_name')!="")
							echo ucfirst($this->config->item('product_name'))." ".$this->config->item('product_version'); 
					?>
				</div>
            	<p class="copy_right"><?php echo "&copy; Copyright Cogzidel ".date('Y');?></p>
                 <p align="center">
					<?php echo "Developed by :"; ?>
                    <a target="_blank" href="http://www.cogzidel.com/">
						<?php echo "Cogzidel Technologies P Ltd";?>
                    </a>&nbsp;|&nbsp;
					<?php echo "Designed by :"; ?>
                    <a target="_blank" href="http://www.cogzideltemplates.com/">
						<?php echo "Cogzidel Templates"; ?>
                    </a> 
				</p>
            </div>
	    </div>
</div>
<script type="text/javascript">
// Current Server Time script (SSI or PHP)- By JavaScriptKit.com (http://www.javascriptkit.com)
// For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
// This notice must stay intact for use.

//Depending on whether your page supports SSI (.shtml) or PHP (.php), UNCOMMENT the line below your page supports and COMMENT the one it does not:
//Default is that SSI method is uncommented, and PHP is commented:

//var currenttime = '<!--#config timefmt="%B %d, %Y %H:%M:%S"--><!--#echo var="DATE_LOCAL" -->' //SSI method of getting server date

var currenttime = '<?php echo date("F d, Y H:i:s", time())?>' //PHP method of getting server date

///////////Stop editting here/////////////////////////////////

var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
var serverdate=new Date(currenttime)

function padlength(what){
var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=montharray[serverdate.getMonth()]+" "+padlength(serverdate.getDate())+", "+serverdate.getFullYear()
var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
document.getElementById("show_date_time").innerHTML="<b>"+datestring+"</b>"+"<br><b>"+timestring+"</b>";
}
<?php
if(isAdmin())
{
?>
window.onload=function(){
setInterval("displaytime()", 1000)
}
<?php
}
?>
</script>
</body>
</html>