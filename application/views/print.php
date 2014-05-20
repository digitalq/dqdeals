<html xmlns="http://www.w3.org/1999/xhtml" id=""><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
	
	<title>Voucher</title>

<style type="text/css">
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}
body{ background:#fff; font-family:arial;}
*{ margin: 0 auto;}
#ecard{ width:660px; margin: 0 auto; clear:both; border:3px solid #abc1f5; margin-top:40px; background:url(<?php echo base_url()."cimages/"?>/body_bg.jpg) no-repeat center top;}
#econ{ width:640px; margin:0 auto; overflow:hidden; padding:10px}
#etop{ padding:0px; margin:0px; height:140px; border-bottom:0px solid #000; color:#000; position:relative; text-align:center;}
#logo{ width: 182px; height: 79px; float:left;}
#welcome{ float:right; font-family:arial; font-size:25px; margin-top:20px; text-align:right; width:300px; margin-bottom:20px; color:#d35b12; line-height:40px; background:url(<?php echo base_url()."cimages/"?>/welcome_right.png) no-repeat center right; padding:0 20px 0 0; font-weight: bold;}
#dealtitle{ width:620px; text-align:left; font-size:20px; font-weight:bold; margin-top:8px; margin-bottom:10px; color:#D35B12; }
#main{ width:620px; margin-bottom:20px;}
#mleft{ float:left; width:320px; line-height:150%; }
#name{ font-size:20px; font-weight:bold; margin-top:10px; color:#D35B12;}
#relname{ font-size:14px; padding-left:8px;}
#coupon{ margin-top:0px; font-size:22px; font-weight:bold; text-align:left; color: #7192DE;}
#coupon p { padding-bottom: 10px; }
#mright{ float:right; width:300px;}
#notice{font-size:12px;padding-top:8px;}
#notice ul{ margin:0px; list-style:none; padding-left:0px;}
#notice ul li{ line-height:26px;}
#server{width:640px; height:30px; font-size:14px; color:#000; margin-top:20px; line-height:30px; text-align:center; clear:both; font-family:arial; position:relative; background:#aecfff;}
@media print { 
	.noprint{display:none;}
}
.clsSolgan {
font-size:13px;
margin:10px 0 0;
}
</style>
</head>
<body>
<div id="ecard" class="panel">

	<div id="econ">

		<!--top -->
		<div id="etop">
			<div id="logo">
            	<img src="<?php echo base_url()."cimages/"?>/logo.png">
                <p class="clsSolgan">Sologan Comes here</p>
            </div>
			<div id="welcome">The best deals from Radical Deals</div>
            <div style="clear:both"></div>
		</div><div style="clear:both"></div>
		<!--endtop -->
		<?php
				$time_zone=$this->config->item("site_time_zone");
				 
				$deal_detail=array();
				$mergent_detail=array();
				$user_name=array();
				if(count($vocher_details)!=0)
				{
					$user_name=get_single_row("users",array("id"=>$vocher_details[0]->user_id));
					
					$mergent_detail=get_single_row("merchants",array("id"=>$vocher_details[0]->mergent_id));
					
					$deal_detail=get_single_row("deals",array("id"=>$vocher_details[0]->deals_id));
				}
		?>	
        
		<div id="dealtitle"><?php if(isset($deal_detail[0]->deal_title)) echo $deal_detail[0]->deal_title?></div>
		
		<!--main -->
		<div id="main">

		<table><tbody><tr><td valign="top">

			<div id="mleft">
				<div id="name">USER</div>
				<div id="relname"><?php if(isset($user_name[0]->email)) echo $user_name[0]->email?></div>

				<div id="name">Valid Date</div>
				<div id="relname">Valid till: <?php if(isset($vocher_details[0]->expire_time)) echo date('Y/m/d', gmt_to_local($vocher_details[0]->expire_time,$time_zone,TRUE))?></div>
				<?php //echo date('D, d M Y h:i:m', gmt_to_local($deal_detail->deal_end_date,$time_zone,TRUE))?>

				<div id="name">Address</div>
				<div id="relname">
					<p><?php if(isset($mergent_detail[0]->company_name)) echo $mergent_detail[0]->company_name?></p>
                    
                    <p><?php if(isset($mergent_detail[0]->address)) echo $mergent_detail[0]->address?></p>
                    
                    <p><?php if(isset($mergent_detail[0]->zipcode)) echo $mergent_detail[0]->zipcode?></p>
                </div>
			</div>
			
		</td><td valign="top">
			<div id="mright">
				<div id="coupon">
					<p>Serial <span style="color:#D35B12;"># <?php if(isset($vocher_details[0]->id)) echo $vocher_details[0]->id?></span></p>
					<p>Authorization code: <span style="color:#D35B12;"><?php if(isset($vocher_details[0]->secret)) echo $vocher_details[0]->secret?></span></p>
					<p><img src="<?php echo base_url()."cimages/"?>/coupon_bar_code.png"></p>
				</div>
			</div>
			
		</td></tr><tr><td valign="middle"><hr style="border:dashed #7192DE; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;"></td><td valign="middle"><hr style="border:dashed #7192DE; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;"></td></tr><tr><td colspan="2" valign="top">
		
			<div id="mright1">
				<div id="name">How to use Voucher</div>
				<div id="notice">
					<ul>
						<li>1. This coupon is only valid at <?php if(isset($mergent_detail[0]->company_name)) echo $mergent_detail[0]->company_name?>.</li>
						<li>2. Print this coupon (with the coupon code on it).</li>
						<li>3. Give to the merchant</li>
					</ul>
				</div>
			</div>
		
		</td></tr></tbody></table>
		
			<div style="clear:both;"></div>
		</div>
		<!--endmain -->

		<div id="server" class="panel">
		Contact number:<?php if(isset($mergent_detail[0]->phone_no)) echo $mergent_detail[0]->phone_no?> Address: <?php if(isset($mergent_detail[0]->address)) echo $mergent_detail[0]->address?></div>

	</div>

</div>

<div class="noprint" style="text-align:center; margin:20px;"><button style="padding:10px 20px; font-size:16px; cursor:pointer;" onClick="window.print();">PrintVoucher</button></div>

</body></html>