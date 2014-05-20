CREATE TABLE IF NOT EXISTS `admins` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `admin_name` varchar(64) character set utf8 NOT NULL,
  `password` varchar(32) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `ad_banner` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL,
  `bannername` varchar(200) NOT NULL,
  `code` text NOT NULL,
  `status` int(11) NOT NULL default '1',
  `views` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `add_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ad_group` (
  `id` int(11) NOT NULL auto_increment,
  `group_name` varchar(250) NOT NULL,
  `width` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `rotating` int(11) NOT NULL,
  `status` int(11) NOT NULL default '1',
  `add_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 NOT NULL,
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `country` int(11) NOT NULL,
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `city` (`id`, `name`, `slug`, `country`, `status`) VALUES
(1, 'Washington DC', 'washington-dc', 2, 1),
(2, 'denver', 'denver', 2, 1),
(3, 'New york', 'new-york', 2, 1),
(4, 'Atlanta', 'atlanta', 2, 1),
(5, 'lexington', 'lexington', 2, 1),
(7, 'Las Vegas', 'las-vegas', 2, 1),
(8, 'Auckland', 'auckland', 4, 1);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 NOT NULL,
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `country` (`id`, `name`, `status`) VALUES
(1, 'india', 1),
(2, 'USA', 1),
(4, 'New Zealand', 1),
(5, 'china', 1);

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0',
  `mergent_id` int(10) unsigned NOT NULL default '0',
  `deals_id` int(10) unsigned NOT NULL default '0',
  `order_id` int(10) unsigned NOT NULL default '0',
  `secret` varchar(10) default NULL,
  `expire_time` int(10) unsigned NOT NULL default '0',
  `create_time` int(10) unsigned NOT NULL default '0',
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `deals` (
  `id` int(11) NOT NULL auto_increment,
  `slug` varchar(500) NOT NULL,
  `deal_title` varchar(500) NOT NULL,
  `deal_city` int(150) NOT NULL,
  `deal_description` text NOT NULL,
  `deals_highlights` text NOT NULL,
  `deals_fine_prints` text NOT NULL,
  `deal_category` int(11) NOT NULL,
  `deal_price` double NOT NULL,
  `deal_face_value` double NOT NULL,
  `deal_save_percent` int(100) unsigned NOT NULL,
  `deal_merchant_percent` varchar(20) NOT NULL,
  `deal_groupon_percent` varchar(20) NOT NULL,
  `deal_sold_out` int(100) unsigned NOT NULL default '1',
  `deal_start_date` datetime NOT NULL,
  `deal_end_date` datetime NOT NULL,
  `deal_voucher_start_date` datetime NOT NULL,
  `deal_voucher_end_date` datetime NOT NULL,
  `deal_min_count` int(11) unsigned NOT NULL,
  `deal_max_count` int(11) unsigned NOT NULL,
  `deal_max_purchase_limit` int(11) unsigned NOT NULL,
  `deal_max_gift_limit` int(11) unsigned NOT NULL,
  `division_lat` varchar(100) NOT NULL,
  `division_lng` varchar(100) NOT NULL,
  `deal_image_url` varchar(200) NOT NULL,
  `merchent` int(11) unsigned NOT NULL,
  `seo_keyword` text NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `seo_description` text NOT NULL,
  `status` int(11) NOT NULL default '1',
  `post_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `facebook_match` (
  `id` int(11) NOT NULL auto_increment,
  `facebook_id` varchar(300) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `faq` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `question` varchar(128) character set utf8 NOT NULL,
  `faq_content` text character set utf8 NOT NULL,
  `status` tinyint(4) NOT NULL default '1',
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `faq` (`id`, `question`, `faq_content`, `status`, `created`) VALUES
(1, 'How its works?', '<div id="side3">\n<div class="about-content js-page-content {''user_type'':''1''}">\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed  ullamcorper  feugiat augue, sed luctus quam fermentum fringilla.  Vestibulum et  dictum dolor. Fusce at ligula malesuada velit sodales  auctor a ac est.  In accumsan imperdiet lorem. Morbi imperdiet, elit eu  scelerisque  congue, est neque hendrerit nisl, vel dictum neque lorem et  mi. Aenean  commodo, mauris eleifend hendrerit fringilla, tortor diam  feugiat eros,  id dictum erat nulla sed odio. Fusce at eros eros.  Praesent lobortis  vehicula arcu non elementum. Duis urna odio, tempor  sed mollis vel,  mollis nec felis. Suspendisse mauris libero, sodales ac  sollicitudin  eget, pellentesque vitae nisi.</p>\n<p>Morbi et purus nec quam rhoncus ullamcorper ut vitae lectus.  Vestibulum  rutrum egestas lacinia. Nullam dapibus sagittis magna ut  vestibulum.  Curabitur urna justo, ornare eu pulvinar ac, luctus eget  nisi. Nulla  ornare ultricies hendrerit. Donec vitae sem quam, a blandit  lacus. Ut  faucibus urna sed quam dictum sed rutrum elit vehicula.  Mauris tincidunt  sagittis tempus. Cras varius suscipit convallis.  Phasellus a enim nec  metus hendrerit imperdiet eu a arcu.</p>\n<p>Nulla risus sem, dignissim laoreet imperdiet in, bibendum vitae  lacus.  Curabitur consequat lobortis quam at pharetra. Cras molestie  cursus ante  porta facilisis. Morbi ullamcorper enim ac urna pretium vel  sodales  nisi facilisis. Proin sagittis enim eget lacus dictum congue.  Lorem  ipsum dolor sit amet, consectetur adipiscing elit. In hac  habitasse  platea dictumst. Ut vestibulum rhoncus arcu vel consectetur.  Phasellus a  porta risus. Cras quis mi metus. Aenean elit nunc, pharetra  vel  vulputate sed, faucibus sit amet nulla.</p>\n</div>\n</div>', 1, '2011-09-09 15:23:28');

CREATE TABLE IF NOT EXISTS `gateway_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `table` varchar(100) NOT NULL,
  `product_type` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `gateway_type` (`id`, `name`, `table`, `product_type`) VALUES
(1, 'paypal', 'paypal', 0);

CREATE TABLE IF NOT EXISTS `mail_settings` (
  `id` int(11) NOT NULL auto_increment,
  `mailer` varchar(500) NOT NULL,
  `sendmail_path` varchar(500) NOT NULL,
  `smtp_server` varchar(500) NOT NULL,
  `smtp_port` varchar(100) NOT NULL,
  `smtp_prefix` varchar(100) NOT NULL,
  `smtp_auth` varchar(500) NOT NULL,
  `smtp_username` varchar(500) NOT NULL,
  `smtp_password` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `mail_settings` (`id`, `mailer`, `sendmail_path`, `smtp_server`, `smtp_port`, `smtp_prefix`, `smtp_auth`, `smtp_username`, `smtp_password`) VALUES
(1, 'mail', '/usr/sbin/sendmail', 'ssl://smtp.googlemail.com', '465', 'tls', '1', 'karthi.intel2004@gmail.com', 'esaiwa9');

CREATE TABLE IF NOT EXISTS `media_ad` (
  `id` int(11) NOT NULL auto_increment,
  `media_name` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `media_duration` varchar(100) NOT NULL,
  `media_ad_url` varchar(500) NOT NULL,
  `media_file` varchar(500) NOT NULL,
  `clicks` int(11) NOT NULL default '0',
  `views` int(11) NOT NULL default '0',
  `status` int(11) NOT NULL default '1',
  `add_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `merchants` (
  `id` int(11) NOT NULL auto_increment,
  `company_name` varchar(300) NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `last_name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `site_url` varchar(300) NOT NULL,
  `phone_no` varchar(300) NOT NULL,
  `division_lat` varchar(30) NOT NULL,
  `division_lng` varchar(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `address` text NOT NULL,
  `company_detail` text NOT NULL,
  `logo` varchar(300) NOT NULL,
  `status` int(11) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL auto_increment,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(200) NOT NULL default '0',
  `quantity` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `form_debug` text NOT NULL,
  `date_insert` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `page` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `url` varchar(64) character set utf8 NOT NULL,
  `name` varchar(128) character set utf8 NOT NULL,
  `page_title` varchar(128) character set utf8 NOT NULL,
  `content` text character set utf8 NOT NULL,
  `is_active` tinyint(4) NOT NULL default '1',
  `created` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `page` (`id`, `url`, `name`, `page_title`, `content`, `is_active`, `created`) VALUES
(1, 'deals-bought', 'Deals Bought', 'Deals Bought', '<h3>Are you looking for your deals?</h3>\r\n<p>Yipit does not actually sell any of the deals we list. We are simply a  search engine, which means that we search other deal sites to find you  the best deals. When you find a deal you like on Yipit, we actually send  you to the individual deal site where you end up purchasing the deal.  It''s very similar to Google.com and Kayak.com.</p>\r\n<p>&nbsp;</p>\r\n<p>If you are looking for a deal you purchased, please try the following:</p>\r\n<p>&nbsp;</p>\r\n<ul class="bullets">\r\n<li><strong>Check Your Email.</strong> If you bought a deal, the  service who sold you the deal will have sent you an email with your  receipt. Sometimes that email gets caught in your spam filter.</li>\r\n<li><strong>Check Your Credit Card.</strong> If you can''t find the  email receipt, you could also contact your credit card company and they  will provide you the number associated with the company that charged you  for the deal you purchased.</li>\r\n<li><strong>Check Our Provider List</strong> If you remember the deal site you purchased the deal from, check our&nbsp;<a href="http://yipit.com/about/services/"></a> with corresponding contact information (where available).</li>\r\n</ul>\r\n<p>We''re sorry you are having trouble finding your deal. We are working  very hard to make the process of buying deals simpler so that this  doesn''t happen to you in the future.</p>', 1, 1312869009);

CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(300) NOT NULL,
  `gateway_type` int(11) NOT NULL,
  `email_config` varchar(100) NOT NULL,
  `status` int(11) NOT NULL default '1',
  `postes_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `payment_gateways` (`id`, `name`, `gateway_type`, `email_config`, `status`, `postes_date`) VALUES
(1, 'payapal', 1, 'karthikeyan@cogzidel.com', 1, '2011-08-26 01:56:06');

CREATE TABLE IF NOT EXISTS `payment_log` (
  `id` int(11) NOT NULL auto_increment,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `retrun_array` text NOT NULL,
  `date_of_insert` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `paypal` (
  `id` int(11) NOT NULL auto_increment,
  `gateways` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `account_email` varchar(200) NOT NULL,
  `site_url` varchar(500) NOT NULL,
  `paypal_mode` tinyint(4) NOT NULL,
  `cus_sub` tinyint(4) NOT NULL,
  `updated_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `paypal` (`id`, `gateways`, `name`, `account_email`, `site_url`, `paypal_mode`, `cus_sub`, `updated_date`) VALUES
(1, 1, 'payapal', 'ramesh_1307678071_biz@yahoo.com', 'http://demo.cogzidel.com/karthi_facebook/facebook_post.php', 0, 0, '2011-09-07 02:53:45');

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(12) unsigned NOT NULL auto_increment,
  `code` varchar(100) character set utf8 NOT NULL,
  `name` varchar(255) character set utf8 NOT NULL,
  `setting_type` char(1) character set utf8 NOT NULL,
  `value_type` char(1) character set utf8 NOT NULL,
  `int_value` int(12) default NULL,
  `string_value` varchar(255) character set utf8 default NULL,
  `text_value` text character set utf8,
  `created` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

INSERT INTO `settings` (`id`, `code`, `name`, `setting_type`, `value_type`, `int_value`, `string_value`, `text_value`, `created`) VALUES
(1, 'SITE_TITLE', 'Site Title', 'S', 'S', 0, 'Cogzidel Groupon Clone', NULL, 1310971604),
(2, 'SITE_SLOGAN', 'Site Slogan', 'S', 'S', 0, 'Best Group Buying Product', NULL, 2009),
(3, 'SITE_STATUS', 'Site status', 'S', 'I', 0, '', NULL, 2009),
(4, 'OFFLINE_MESSAGE', 'Offline Message', 'S', 'T', 0, '', 'Updation is going on...we will run this system very soon', 2009),
(9, 'SITE_ADMIN_MAIL', 'Site Admin Mail', 'S', 'S', NULL, 'karthikeyan@cogzidel.com', NULL, 1310971604),
(10, 'PAYMENT_SETTINGS', 'minimum maintanace amount', 'S', 'I', 0, 'initial payment details', NULL, 2009),
(11, 'LANGUAGE_CODE', 'Language', 'S', 'S', NULL, 'english', NULL, 2009),
(12, 'FEATURED_PROJECTS_LIMIT', 'Featured project list', 'S', 'I', 0, NULL, NULL, 2009),
(13, 'URGENT_PROJECTS_LIMIT', 'Urgent Projects list', 'S', 'I', 0, NULL, NULL, 2009),
(14, 'LATEST_PROJECTS_LIMIT', 'Latest Projects list', 'S', 'I', 0, NULL, NULL, 2009),
(15, 'FEATURED_PROJECT_AMOUNT', 'featured project minimum amount', 'S', 'I', 0, NULL, NULL, 2009),
(16, 'URGENT_PROJECT_AMOUNT', 'urgent project minimum', 'S', 'I', 0, NULL, NULL, 2009),
(17, 'HIDE_PROJECT_AMOUNT', 'hide project minimum amount', 'S', 'I', 0, NULL, NULL, 2009),
(19, 'USER_FILE_LIMIT', 'File management', 'S', 'I', 0, NULL, NULL, 2009),
(18, 'PROVIDER_COMMISSION_AMOUNT', 'Provider commission', 'S', 'I', 0, NULL, NULL, 2009),
(20, 'ESCROW_PAGE_LIMIT', 'escrow pagination limit', 'S', 'I', 10, NULL, NULL, 2009),
(21, 'TRANSACTION_PAGE_LIMIT', 'transaction pagination limit', 'S', 'I', 10, NULL, NULL, 2009),
(22, 'MAIL_LIMIT', 'define the mail limit', 'S', 'I', 10, NULL, NULL, 2009),
(23, 'PROJECT_PERIOD', 'project period limit', 'S', 'I', 14, NULL, NULL, 2009),
(24, 'BASE_URL', 'site url', 'S', 'S', NULL, 'http://demo.cogzidel.com/groupon/', NULL, 1310971604),
(25, 'UPLOAD_LIMIT', 'Maximum Upload Limit', 'S', 'I', 10, NULL, NULL, 0),
(27, 'HOSTNAME', 'hostname', 'S', 'S', NULL, 'localhost', NULL, 0),
(28, 'TWITTER_USERNAME', 'twitter username', 'S', 'S', NULL, '0', NULL, 0),
(29, 'TWITTER_PASSWORD', 'twitter password', 'S', 'S', NULL, '0', NULL, 0),
(32, 'PRIVATE_PROJECT_AMOUNT', 'private project amount', 'S', 'I', 0, NULL, NULL, 2009),
(34, 'JOBLISTING_PROJECT_AMOUNT', 'joblisting_project_amount', 'S', 'I', 0, NULL, NULL, 0),
(35, 'FORCED_ESCROW', 'forced escrow', 'S', 'T', 1, NULL, '0', 0),
(36, 'FEATURED_PROJECT_AMOUNT_CM', 'featured_project_amount_cm', 'S', 'I', 0, NULL, NULL, 0),
(37, 'URGENT_PROJECT_AMOUNT_CM', 'urgent_project_amount_cm', 'S', 'I', 0, NULL, NULL, 0),
(38, 'PRIVATE_PROJECT_AMOUNT_CM', 'private_project_amount_cm', 'S', 'I', 0, NULL, NULL, 0),
(39, 'PRODUCT_MODE', 'product_mode', 'S', 'I', 1, NULL, NULL, 0),
(40, 'JOBLIST_VALIDITY_LIMIT', 'joblist validity limits', 'S', 'I', 0, NULL, NULL, 0),
(41, 'GOOGLE_AD_SENSE', 'google_ad_sence', 'S', 'T', 0, '', 'SEPT 0.1', 0),
(42, 'SITE_LOGO', 'site_logo_image', 'S', 'T', 0, 'I', 'logo.png', 0),
(43, 'META_TAGS', 'site_meta_tag', 'S', 'T', NULL, NULL, 'Daily, Deals, Groupon, LivingSocial, Tippr', 0),
(44, 'META_TAGS_DESCRIPTION', 'site_meta_description', 'S', 'T', NULL, NULL, 'Get all the best daily deals from Groupon, LivingSocial, Tippr in just ONE email that''s filtered for the stuff you want.', 0),
(45, 'PRODUCT_NAME', 'product_name', 'S', 'S', NULL, 'sept', 'sept', 0),
(46, 'PRODUCT_VERSION', 'product_version', 'S', 'S', NULL, '0.1', '0.1', 0),
(47, 'SITE_TIME_ZONE', 'site_time_zone', 'S', 'T', NULL, NULL, 'UP55', 0);

CREATE TABLE IF NOT EXISTS `social_site_settings` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

INSERT INTO `social_site_settings` (`id`, `name`, `value`) VALUES
(1, 'facebook_url', ''),
(2, 'facebook_api_key', ''),
(3, 'facebook_secret_key', ''),
(4, 'twiter_page_url', ''),
(5, 'twitter_consumer_key', ''),
(6, 'twitter_consumer_secret', ''),
(7, 'you_tube_url', 'http://www.youtube.com/user/Cogzidel'),
(8, 'google_analytics', ''),
(9, 'fanbox_href', ''),
(10, 'fanbox_show_faces', 'true'),
(11, 'fanbox_height', '290'),
(12, 'fanbox_width', '194'),
(13, 'fanbox_stream', 'true');

CREATE TABLE IF NOT EXISTS `subscribe` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `email` varchar(128) default NULL,
  `city_id` int(10) unsigned NOT NULL default '0',
  `secret` varchar(32) default NULL,
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_e` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(300) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL default '1',
  `tags` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `user_name` varchar(200) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `time_zone` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `city_subscriptions` varchar(500) NOT NULL,
  `email_frequency` int(11) NOT NULL default '0',
  `status` int(11) NOT NULL default '1',
  `date_insert` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `text_ad` (
  `id` int(11) NOT NULL auto_increment,
  `text_ad_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `text_ad_url` varchar(1000) NOT NULL,
  `views` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `status` int(11) NOT NULL default '1',
  `add_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `text_ad` (
  `id` int(11) NOT NULL auto_increment,
  `text_ad_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `text_ad_url` varchar(1000) NOT NULL,
  `views` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `status` int(11) NOT NULL default '1',
  `add_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;