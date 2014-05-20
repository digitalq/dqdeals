<?php
	$this->load->view("header");
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#change_password_form").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
	
	$("#order_amount").numeric();
	
	$("#alerts").hide();
	
	$("#alerts_quanity").hide();
	
	$("#order_amount").keyup(function(){
		var order_amount=parseInt($("#order_amount").val());
		var option_max_purchase=parseInt($("#option_max_purchase_<?php echo $deal_id?>").val())
		var unit_price=parseInt($("#unit_price_<?php echo $deal_id?>").val())
		var deal_quantity=parseInt($("#deal_quantity_<?php echo $deal_id?>").val())
		
		if($("#order_amount").val()=="")
		{
			order_amount=1;
			$("#order_amount").val(1);
		}
			
		if(order_amount==0 || order_amount=='')
			$("#order_amount").val(1);
		else
		{
			/*if(order_amount>option_max_purchase)
			{
				$("#order_amount").val(option_max_purchase);
				order_amount=parseInt($("#order_amount").val());
				$("#alerts").show();
				setTimeout('$("#alerts").hide("slow")',3000);
				
				//delay(800);
				//setTimeout(50000,"$(\"#alerts\").hide()");
			}
			var total=order_amount*unit_price;
			
			$(".currency_html .integer").html(+total);
			$(".clsMyPrice_Span2").html("$ "+total);
			$("#total_price").val(total);*/
		}
		if(order_amount>deal_quantity)
		{
			$("#order_amount").val(1);
				order_amount=parseInt($("#order_amount").val());
			$("#alerts_quanity").show();
			
			setTimeout('$("#alerts_quanity").hide("slow")',3000);
				
			var total=order_amount*unit_price;
			
			$(".currency_html .integer").html(+total);
			$(".clsMyPrice_Span2").html("$ "+total);
			$("#total_price").val(total);
		}
		
	});
}) 
</script>
<style type="text/css">
.clsLoging_Form
{
	margin-left:20px;
}
</style>
<div class="clsFloatLeft" id="Main_left">
	<div class="inner_pages">
    	<h1 class="Main_Tittle"><span><?php echo $title?></span></h1>
         <div class="clsInput_Bg1">
            <div class="inner_content">
            	<div class="clsUr_Purchase_Blk">
                <div id="alerts">
                	<ul class="alerts info">
                    	<li class="info">
                        	<div>
                            	Quantity must be <?php echo $deal_max_purchase; if($deal_max_purchase>1) echo 'or less';?> ; we took care of that for you.
                            </div>
                        </li>
                     </ul>
                 </div>
                  <div id="alerts_quanity">
                	<ul class="alerts info">
                    	<li class="info">
                        	<div>
                            	Quantity Less So you Should Purchase <?php echo $deal_quantity; if($deal_quantity>1) echo ' or less';?>
                            </div>
                        </li>
                     </ul>
                 </div>
                <?php
					$attribute=array("name"=>"paypal_post","id"=>"paypal_post","method"=>"post");
					
					echo form_open("home/paypal_checkout",$attribute)
				?>
            	<table>
                  <thead>
                    <tr>
                      <th class="grid_9 first">Description</th>
                      <th class="grid_2 text_center"><label for="order_amount">Quantity</label></th>
                      <th class="grid_1 text_center">&nbsp;</th>
                      <th class="grid_2 text_center">Price</th>
                      <th class="grid_1 text_center">&nbsp;</th>
                      <th class="grid_2 last text_right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="line_item">
                      <td id="gift_options_container" class="grid_9 first">
                            <p>
                            	<input type="hidden" value="<?php echo $deal_id?>" id="deal_id" name="deal_id">
                                
                                <input type="hidden" value="<?php echo current_url()?>" id="current_pay_url" name="current_pay_url">
                                
                                <input type="hidden" value="<?php echo $deal_price?>" id="unit_price_<?php echo $deal_id?>">
                                <input type="hidden" value="<?php echo $deal_max_purchase?>" id="option_max_purchase_<?php echo $deal_id?>">
                                 <input type="hidden" value="<?php echo $deal_quantity?>" id="deal_quantity_<?php echo $deal_id?>">
                                <?php echo $deal_title?>                                      
                             </p>
                         </td>
                      <td class="grid_2 text_center quantity">
                        <input type="text" value="1" size="3" name="order_amount" maxlength="3" id="order_amount" class="numerical input">
                      </td>
                      <td class="grid_1 text_center">x</td>
                      <td class="grid_2 text_center">
                        <input type="hidden" value="<?php echo $deal_price?>" name="deal_price" id="deal_price">           
                        <span class="deal_price_currency_html">
                        <span class="unit multi_letter"><rs>&#8377;</rs></span>
                        <span class="integer"><?php echo $deal_price?></span></span>
                      </td>
                      <td class="grid_1 text_center">=</td>
                      <td class="grid_2 text_right total">
                        <span class="currency_html">
                            <span class="unit multi_letter"><rs>&#8377;</rs></span>
                            <span class="integer"><?php echo $deal_price?></span>
                        </span>
                      </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="total_price" id="total_price" value="<?php echo $deal_price?>" />
                <div class="clsMy_Price">
                	<p class="clearfix"><span class="clsMyPrice_Span1">My Price:</span><span class="clsMyPrice_Span2"><rs>&#8377;</rs> <?php echo $deal_price?></span></p>
                </div>
                <br />
                <input type="submit" name="complete_order" value="Pay Now" id="complete_order" class="Butt_Bg" style="font-size:9px;"/>
                <?php
					echo form_close();
				?>
                </div>
            </div>
        </div>
   </div>
</div>
<?php
$this->load->view("right_side_bar");
?>    
<?php
	$this->load->view("footer");
?>
