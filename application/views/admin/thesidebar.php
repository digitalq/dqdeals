<script type="text/javascript">
$(document).ready(function(){
	$(".boxtitle").click(function(){
		var current_title=$(this).parent().attr("class");
		var class_titles=Array();
		class_titles=current_title.split(" ");
		var cur_title=class_titles[1];
		$("."+cur_title+" .boxcontent").toggle();
		
		var class_name=$("."+cur_title+" .boxtitle a").attr("class");
		if(class_name=="closed")
			$("."+cur_title+" .boxtitle a").removeClass("closed");
		else
			$("."+cur_title+" .boxtitle a").addClass("closed");
	})
})
</script>
<div id="thesidebar">
 <div id="form">
  
   <div class="box dashboard">
   	<div class="boxtitle closed">
    	  <a class="closed" href="<?php echo admin_url('home')?>">Dashboard</a>
    </div>
    </div>
   
    <?php /*?><div class="box db_back_up">
        <div class="boxtitle closed">
              <a class="closed" href="<?php echo admin_url('siteSettings/dbBackup')?>">Database Backup</a>
        </div>
    </div><?php */?>
     	
   <div class="box city_box">
   	<div class="boxtitle closed">
    	  <a class="closed" href="javascript:void(0)">Manage City</a>
    </div>
    <div class="boxcontent">
     <ul>
      <li><a href="<?php echo admin_url('home/view_city')?>">View Cities</a></li>
      <li><a href="<?php echo admin_url('home/add_city')?>">Add Cities</a></li>
     </ul>
    </div>
   </div>
   <div class="box country_box">
    <div class="boxtitle closed">
     <a class="closed" href="javascript:void(0)">Manage Country</a>
    </div>
    <div class="boxcontent">
     <ul>
      <li><a href="<?php echo admin_url('home/view_country')?>">View Country</a></li>
      <li><a href="<?php echo admin_url('home/add_country')?>">Add Country</a></li>
     </ul>
    </div>
   </div>
   
   <div class="box manage_user_box">
   	<div class="boxtitle closed">
     <a class="closed" href="javascript:void(0)">Manage Users</a>
    </div>
    <div class="boxcontent">
     <ul>
	    <li><a href="<?php echo admin_url('users')?>">View</a></li>
        <li><a href="<?php echo admin_url('users/add_user')?>">Add User</a></li>
        <li><a href="<?php echo admin_url('users/view_subscribers')?>">Subscribers</a></li>
     </ul>
    </div>
   </div>
   
   
   <div class="box category_box">
   	<div class="boxtitle closed">
     <a class="closed" href="javascript:void(0)">Manage Category</a>
    </div>
    <div class="boxcontent">
     <ul>
      <li><a href="<?php echo admin_url('home/add_category')?>">Add Category</a></li>
      <li><a href="<?php echo admin_url('home/view_category')?>">View Category</a></li>
     </ul>
    </div>
   </div>
   
   <div class="box setting_box">
   	<div class="boxtitle closed">
     <a class="closed" href="javascript:void(0)">Settings</a>
    </div>
    <div class="boxcontent">
     <ul>
     	<li><a href="<?php echo admin_url('siteSettings')?>">Site Settings</a></li>
         <li><a href="<?php echo admin_url('mail_setting')?>">Mail Settings</a></li>
        <li><a href="<?php echo admin_url('siteSettings/ch_pew')?>">Change Password</a></li>
     </ul>
    </div>
   </div>
   
   <div class="box payment_box">
   	<div class="boxtitle closed">
     <a class="closed" href="javascript:void(0)">Orders &amp; Pay Gateway</a>
    </div>
    <div class="boxcontent">
     <ul>
     	<li><a href="<?php echo admin_url('payment/orders')?>">Orders</a></li>
        <li><a href="<?php echo admin_url('payment/coupon')?>">Manage Coupons</a></li>
      	<li><a href="<?php echo admin_url('payment/manage')?>">Manage Pay Gateway</a></li>
        <?php /*<li><a href="<?php echo admin_url('payment/add')?>">Add Pay Gateway</a></li>*/?>
        <li><a href="<?php echo admin_url('payment/gate_way_log')?>">Logs of All Gateways</a></li>
     </ul>
    </div>
   </div>
   
   <div class="box social_link_box">
   	<div class="boxtitle closed">
   		<a class="closed" href="javascript:void(0)">Manage Social Links</a>
   	</div>
    
    <div class="boxcontent">
     <ul>
     	<li><a href="<?php echo admin_url('social/managesocial')?>">Manage</a></li>
     </ul>
    </div>
   </div>
   
   <div class="box ventor_box">
   	<div class="boxtitle closed">
   		<a class="closed" href="javascript:void(0)">Merchant</a>
   	</div>
    <div class="boxcontent">
     <ul>
      <li><a href="<?php echo admin_url('merchant/view')?>">Manage</a></li>
      <li><a href="<?php echo admin_url('merchant/add')?>">Add New</a></li>
     </ul>
    </div>
   </div>
   
    <div class="box deals_box">
   	<div class="boxtitle closed">
   		<a class="closed" href="javascript:void(0)">Deals</a>
   	</div>
    <div class="boxcontent">
     <ul>
      <li><a href="<?php echo admin_url('deals/view')?>">Manage</a></li>
      <li><a href="<?php echo admin_url('deals/add')?>">Add New</a></li>
     </ul>
    </div>
   </div>
   
   
   <div class="box faq_manage_box">
   	<div class="boxtitle closed">
   		<a class="closed" href="javascript:void(0)">Faq</a>
   	</div>
    <div class="boxcontent">
     <ul>
      <li><a href="<?php echo admin_url('faq/viewFaqs')?>">Manage</a></li>
      <li><a href="<?php echo admin_url('faq/addfaq')?>">Add New</a></li>
     </ul>
    </div>
   </div>
   
    <div class="box static_page_box">
   	<div class="boxtitle closed">
   		<a class="closed" href="javascript:void(0)">Static Pages</a>
   	</div>
    <div class="boxcontent">
     <ul>
      <li><a href="<?php echo admin_url('page/viewPages')?>">Pages</a></li>
      <li><a href="<?php echo admin_url('page/addPage')?>">Add New</a></li>
     </ul>
    </div>
   </div>
   
  <?php
  	/*<div class="box email_box">
   	<div class="boxtitle closed">
   		<a class="closed" href="javascript:void(0)">Email Template</a>
   	</div>
    <div class="boxcontent">
     <ul>
     	 <li><a href="<?php echo admin_url('mail_setting')?>">Mail Settings</a></li>
     	 <li><a href="<?php echo admin_url('page/viewPages')?>">Manage</a></li>
     	 <li><a href="<?php echo admin_url('page/addPage')?>">Mass Mail</a></li>
     </ul>
    </div>
   </div>
   */
   ?>
   
   <div class="box site_map_box">
   	<div class="boxtitle closed">
   		<a class="closed" href="javascript:void(0)">Site Map file</a>
   	</div>
    <div class="boxcontent">
     <ul>
      <li><a href="<?php echo admin_url('sitemap/upload')?>">Update</a></li>
      <li><a href="<?php echo base_url()?>sitemap.xml">View</a></li>
     </ul>
    </div>
   </div>
   
   <?php /*?>
   
    <div class="box advertice_box">
   	<div class="boxtitle closed">
   		<a class="closed" href="javascript:void(0)">Advertising</a>
   	</div>
    <div class="boxcontent">
     <ul>
      <li>
        <div>Manage Advertise</div>
        <ul>
            <li><a href="<?php echo admin_url('advertise/viewbanner')?>">Banner</a></li>
            <li><a href="<?php echo admin_url('advertise/viewmedia')?>">Media</a></li>
            <li><a href="<?php echo admin_url('advertise/viewtext')?>">Text</a></li>
            <li><a href="<?php echo admin_url('advertise/viewgroups')?>">Groups</a></li>
        </ul>
      </li>
      <li>
        <div>Add Advertise</div>
        <ul>
        	<li><a href="<?php echo admin_url('advertise/addbanner')?>">Add Banner</a></li>
            <li><a href="<?php echo admin_url('advertise/addmedia')?>">Add Media</a></li>
            <li><a href="<?php echo admin_url('advertise/addtext')?>">Add Text</a></li>
            <li><a href="<?php echo admin_url('advertise/addgroup')?>">Add Groups</a></li>
        </ul>
      </li>
     </ul>
    </div>
   </div><?php */?>
   
 </div>
</div>