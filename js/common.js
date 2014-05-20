// JavaScript Document
$(document).ready(function(){
	$("#subscribe #email").focus(function(){
			if($("#email").val()=="Enter your Email Address")
				$("#email").val('');
	});
	$("#subscribe #email").focusout(function(){
		if($("#email").val()=="")
			$("#email").val('Enter your Email Address')	
	});
	
	$("#Input_Blk #email").focus(function(){
			if($("#email").val()=="Enter your Email Address")
				$("#email").val('');
	});
	$("#Input_Blk #email").focusout(function(){
		if($("#email").val()=="")
			$("#email").val('Enter your Email Address')	
	});
})
	
function change_status(id)
{
	var change_status=$("#table_name").val();
	
	var status_image='enable';
	
	var ok=confirm("Are you sure to change a status?")
		if(!ok)
			return false;
	$.ajax({ type: "POST",url: site_admin_url+"/home/cge_status",async: true,data: "id="+id+"&change_status="+change_status, success: function(data)
			{	
				if(data==1)
					status_image="enable";
				else
					status_image="disable";
					
				$("#status_change_"+id).attr("src",base_url+"/css/img/"+status_image+".png")
			}
		  });
}

function delete_record(id)
{
	var change_status=$("#table_name").val();
	
	var status_image='enable';
	
	var ok=confirm("Are you sure to Delete this record?");
		if(!ok)
			return false;
			
	$.ajax({ type: "POST",url: site_admin_url+"/home/delete_record",async: true,data: "id="+id+"&delete_record="+change_status, success: function(data)
			{	
				if(data!=0)
				{
					$("#row_id_"+id).html('<td colspan="7" style="text-align:center;color:red">Record Deleted</td>');
					
					$("#row_id_"+id).delay(800).fadeOut('slow');
				}
				else
					alert("Error");
			}
		  });
}

function show_tabs(cur_title)
{
	$("."+cur_title+" .boxcontent").css("display","block");
	
	var class_name=$("."+cur_title+" .boxtitle a").attr("class");
	
	if(class_name=="closed")
			$("."+cur_title+" .boxtitle a").removeClass("closed");
	else
	$("."+cur_title+" .boxtitle a").addClass("closed");	
}
function custom_form_element()
{
var inputs = document.getElementsByTagName("input"), span = Array(), textnode, option, active;
inputs = document.getElementsByTagName("select");
for(a = 0; a < inputs.length; a++) {
		if(inputs[a].className == "styled") {
			option = inputs[a].getElementsByTagName("option");
			active = option[0].childNodes[0].nodeValue;
			textnode = document.createTextNode(active);
			for(b = 0; b < option.length; b++) {
				if(option[b].selected == true) {
					textnode = document.createTextNode(option[b].childNodes[0].nodeValue);
				}
			}
			span[a] = document.createElement("span");
			span[a].className = "select";
			span[a].id = "select" + inputs[a].name;
			span[a].appendChild(textnode);
			inputs[a].parentNode.insertBefore(span[a], inputs[a]);
			if(!inputs[a].getAttribute("disabled")) {
				inputs[a].onchange = Custom.choose;
			} else {
				inputs[a].previousSibling.className = inputs[a].previousSibling.className += " disabled";
			}
		}
	}
	document.onmouseup = Custom.clear;

}
function count_down_timer(div_id,date_detail)
{
	$('#clsDeal_Time_'+div_id).countdown({
	until: new Date(date_detail),
	format: 'dHMS',
	layout:'{dn}d '+'{hn}h '+'{mn}m '+'{sn}s',
	expiryText:"Expired"
	});
}
function inner_count_down_timer(div_id,date_detail)
{
	//alert(div_id+","+date_detail)
	$('#'+div_id).countdown({
		until: new Date(date_detail),
		format: 'dHMS',
		layout:'{dn}d '+'{hn}h '+'{mn}m '+'{sn}s',
		expiryText:"Expired"
	});
}