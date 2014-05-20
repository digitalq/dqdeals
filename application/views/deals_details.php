<?php
	$this->load->view("deal_details_header",array("deal_seo_keyword"=>$deal_seo_keyword,"deal_seo_description"=>$deal_seo_description,"deal_seo_title"=>$deal_title));
	$time_zone=$this->config->item("site_time_zone");
?>
<div id="MainCont_Pro_Des" class="clearfix">
    <!-- Left side-->
    <div id="Pro_des_left" class="clsFloatLeft">
        <div class="clsPro_Avai_Blk">
            <!-- Info -->
            <?php
            	if(isset($expired) and $expired=="yes")
				{
			?>
            <div class="clsInfo_Pro_Exp clearfix">
                <div class="clsInfoPE_Name">
                    <h3><?php echo $deal_title?></h3>
                </div>
                <div class="clsInfoPE_Val clsFloatLeft">
                    <p class="InfoPE_Titt">Value</p>
                    <p class="InfoPE_CrossVal"><rs>&#8377;</rs> <?php if(isset($deal_detail->deal_face_value)) echo $deal_detail->deal_face_value?></p>
                    <p class="InfoPE_Cross"><img src="<?php echo base_url()?>images/info_exp_cross.png" alt="image" /></p>
                </div>
                <div class="clsInfoPE_Dis clsFloatLeft">
                    <p class="InfoPE_Titt">Disc</p>
                    <p class="InfoPE_Val"><?php if(isset($deal_detail->deal_save_percent)) echo $deal_detail->deal_save_percent?>%</p>
                </div>
             </div>
            <?php 
			}
			else
			{
			?>
            <div class="clsInfo_Pro_Des clearfix">
                <div class="clsInfoPD_Name">
                    <h3><?php echo $deal_title?></h3>
                </div>
                <div class="clsInfoPD_Val clsFloatLeft">
                    <p class="InfoPD_Titt">Value</p>
                    <p class="InfoPD_CrossVal"><rs>&#8377;</rs> <?php if(isset($deal_detail->deal_face_value)) echo $deal_detail->deal_face_value?></p>
                    <p class="InfoPD_Cross"><img src="<?php echo base_url()?>images/info_val_cross.png" alt="image" /></p>
                </div>
                <div class="clsInfoPD_Dis clsFloatLeft">
                    <p class="InfoPD_Titt">Disc</p>
                    <p class="InfoPD_Val"><?php if(isset($deal_detail->deal_save_percent)) echo $deal_detail->deal_save_percent?>%</p>
                </div>
                <div class="clsInfoPD_Tim_lft clsFloatLeft">
                	<script type="text/javascript">
						$(document).ready(function(){
							inner_count_down_timer('InfoPD_Val_<?php echo $deal_detail->id?>','<?php echo date('D, d M Y h:i:m',strtotime($deal_detail->deal_end_date))?>')
						})
					</script>
                    <p class="InfoPD_Titt">Time Left</p>
                    <p id="InfoPD_Val_<?php echo $deal_detail->id?>" class="InfoPD_Val"></p>
                </div>
            </div>
            
             <?php 
			 }
			 ?>
            <!-- End of Info -->
            <!-- Product Image -->
            <div class="clsPro_Image_Blk"> <!-- Same div strcture used in Home Page -->
                <div class="clsProduct_Image">
                    <p><a href="<?php echo base_url().'home/deal/'.$deal_detail->slug;?>"><img src="<?php echo base_url()?>uploads/deals/<?php echo $deal_detail->deal_image_url?>" alt="Product" style="width:668px;height:277px;"/></a></p>
                </div>
                <div class="clsBuy_Price">
                		
                    <a href="<?php if(isset($expired) and $expired=="yes")	echo"#";else echo base_url().'home/puchase/'.$deal_detail->slug;
							?>">
                    	<span><p>Price</p></span><span><p><rs>&#8377;</rs><?php if(isset($deal_detail->deal_price)) echo $deal_detail->deal_price?>/-</p></span>
                    </a>
                </div>
                <?php
            	if(isset($expired) and $expired=="yes")
					echo '<div class="clsExpried"><p>&nbsp;</p></div>';
				?>
            </div>
            <!-- End of Product Image -->
            <!-- Content -->
            <div class="clsInfoPD_Cont clearfix">
                <div class="clsInfoPD_ContLeft clsFloatLeft">
                	<h2>Highlights</h2>
                    <br>
                    <div class="ProDes_Sup_Blk">
                    	<?php echo $deal_detail->deals_highlights?>
                    </div>
               </div>
               <div class="clsInfoPD_Status clsFloatLeft">
               	<p class="clsBold"><?php echo $bought?> bought</p>
                <p><?php echo $required_bought?> more needed to get the deal</p>
               </div>
               <div class="clsInfoPD_ContRight clsFloatRight">
                    <p>
						<?php 
							if(isset($expired) and $expired=="yes")
								echo '<a href="javascript:void(0)"class="clsPE_Buy_Link">BUY</a>';
							else
								echo anchor('home/puchase/'.$deal_detail->slug,"BUY",array("class"=>"clsPD_Buy_Link"));
						?>
                    </p>
                    <p>
                    	<iframe src="http://www.facebook.com/plugins/like.php?app_id=255867891112647&amp;href=<?php echo urlencode($share_link)?>&amp;send=false&amp;layout=button_count&amp;width=75&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:23px;" allowTransparency="true"></iframe>
                    </p>
                    <p>
                    	<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo $share_link?>" data-count="horizontal">Tweet</a>
                    </p>
                    <p> <a href="mailto:?subject='<?php echo $deal_detail->deal_title?>.'&body='<?php echo $share_link?>'" class="Off_Mail_Bg">Email</a></p>
               </div>
            </div>
            <!-- End of Content -->
        </div>
        <div class="clsPB_Write_up clearfix">
            <div class="clsWrite_left clsFloatLeft">
                <div id="Location_Blk">
                    <h2>Location</h2>
                    
                    	<?php
							if(isset($mergent_address) && $mergent_address!="")
							{
						?>
                    			<iframe src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $mergent_address?>&output=embed" style="width:180px;height:400px; border:none"></iframe>
                    	<?php 
							}
						/*?><img src="<?php echo base_url()?>images/map.png" alt="image" /><?php */?>
                    
                    <p class="clsView_Det_Link"><a href="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $mergent_address?>">View Detailed Map</a></p>
                    <div class="clsWrite_Add">
                    <br />
                    	<h2>The Company</h2>
                        
                        <p><?php if(isset($mergent_name) && $mergent_name!="") echo '<a href="'.$mergent_site_url.'">'.$mergent_name.'</a>';?></p>
                        <p>
                        	<?php echo str_replace(", ","<br>",$mergent_address)?>
                        </p>
                    </div>
                </div>
                <div id="selAdd_PD">
                    <a href="#"><img src="<?php echo base_url()?>images/add1.png" alt="Add" /></a>
                </div>
            </div>
            <div class="clsWirte_Right clsFloatRight">
                <div class="ProDes_Sup_Blk">
                    <h2>The Fine Print</h2>
                    <p>
                    	<?php echo $deal_detail->deals_fine_prints?>
                    </p>
                </div>
                <div class="ProDes_Sup_Blk">
                    <h2>Need to Know</h2>
                    <?php echo $deal_detail->deal_description?>
                    <br />
                    <div class="fb-comments" data-href="<?php echo base_url().'home/deal/'.$deal_detail->slug;?>" data-num-posts="2" data-width="500"></div>
                </div>
            </div>
             <div style="clear:both"></div>
        </div>
    </div>
    <!-- End of Left side-->
    <div id="Pro_Des_Right" class="clsFloatRight">
		<?php
            if(isset($side_deals) && count($side_deals)!=0)
            {
				$save_value=0;
				
				foreach($side_deals as $side_deal)
				{
					$save_value=$side_deal->deal_face_value-$side_deal->deal_price;
        ?>
        		<script type="text/javascript">
					
					$(document).ready(function(){
							inner_count_down_timer('InfoPD_Side_Val_<?php echo $side_deal->id?>','<?php echo date('D, d M Y H:i:m', strtotime($side_deal->deal_end_date))?>')
					})
				</script>
        		<div class="clsOfferPD_Side">
            <!-- Info -->
            
            <div class="clsInfoPD_Side clearfix">
                <div class="clsInfoPD_Side_Val clsFloatLeft">
                    <p class="InfoPD_Side_Titt">Value</p>
                    <p class="InfoPD_SideCrossVal"><rs>&#8377;</rs>  <?php echo $side_deal->deal_face_value?></p>
                    <p class="InfoPD_Side_Cross"><img src="<?php echo base_url()?>images/info_val_cross1.png" alt="image" /></p>
                </div>
                <div class="clsInfoPD_Side_Dis clsFloatLeft">
                    <p class="InfoPD_Side_Titt">Disc</p>
                    <p class="InfoPD_Side_Val"><?php echo $side_deal->deal_save_percent?>%</p>
                </div>
                <div class="clsInfoPD_Side_Sav clsFloatLeft">
                    <p class="InfoPD_Side_Titt">Save</p>
                    <p class="InfoPD_Side_Val"><rs>&#8377;</rs> <?php echo $save_value?></p>
                </div>
                <div class="clsInfoPD_Side_TimLft clsFloatLeft">
                    <p class="InfoPD_Side_Titt">Time Left</p>
                    <p class="InfoPD_Side_Val" id="InfoPD_Side_Val_<?php echo $side_deal->id?>"></p>
                </div>
            </div>
            <!-- End of Info -->
            <!-- Product Image -->
            <div class="clsProImg_Side_Blk">
                <div class="clsProduct_Image">
                    <p><?php echo anchor("deal/".$side_deal->slug,'<img src="'.base_url().'uploads/deals/'.$side_deal->deal_image_url.'" alt="Product" style="width:284px; height:194px" />')?></p>
                </div>
                <div class="clsBuy_Price_side">
                    <?php echo anchor("puchase/".$side_deal->slug,'<span>Price</span><br /><span>$'.$side_deal->deal_price.'/-</span>')?>
                </div>
            </div>
            <!-- End of Product Image -->
            <!-- Content -->
            <div class="clsInfo_Cont_Side">
                <p><strong><?php echo anchor("deal/".$side_deal->slug,$side_deal->deal_title)?></strong></p>
            </div>
            <!-- End of Content -->
            <!-- End of Left -->
        </div>
        <br />
        <?php
			}
		}
		else
		{
			echo '<div style="text-align:center">'.fan_box().'</div>';
		}
		?>
    </div>
    <div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<!-- Bottom Add -->
<div class="clsPDBttm_Add">
    <img src="<?php echo base_url()?>images/add3.png" alt="Add" />
</div>
<!-- End of Bottom Add -->
<script>(function(d){
  var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
  js = d.createElement('script'); js.id = id; js.async = true;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  d.getElementsByTagName('head')[0].appendChild(js);
}(document));</script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>                
<?php
	$this->load->view("footer");
?>