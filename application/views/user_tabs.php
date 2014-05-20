<div id="user_tabs">
<ul>
  	<li <?php if(isset($select_tab) && $select_tab=="myaccout") echo 'class="select_tab"';?>><?php echo anchor("my_account","My Account")?></li>
    <li <?php if(isset($select_tab) && $select_tab=="change_password") echo 'class="select_tab"';?>><?php echo anchor("home/change_password","Change Password")?></li>
    <li <?php if(isset($select_tab) && $select_tab=="my_coupon") echo 'class="select_tab"';?>><?php echo anchor("home/my_coupon","My Coupons")?></li>
</ul>
<div class="clear"></div>
</div>