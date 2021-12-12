<?php
date_default_timezone_set("Asia/Bangkok");
error_reporting(error_reporting() & ~E_NOTICE);

//root (base dir) ของ TL Tube
//define("TL_TUBE_URL","http://localhost/web/tl-tube");
//define("TL_TUBE_URL","http://113.53.233.68/TL-tube");
//define("TL_TUBE_URL","http://thailife.aitstreaming.com/TL-tube");
//define("TL_TUBE_URL","http://localhost/TL-Tube%20V.2.0");

//define("TL_TUBE_URL","http://www.cmscompact.com/clients/TL-Tube-V2");
//define("TL_TUBE_URL","http://localhost/web/TL-Tube-V2");
//define("TL_TUBE_URL","http://111.223.53.112/v2");
define("TL_TUBE_URL","http://tltube.thailife.com");

//define("TL_TUBE_URL","http://localhost:8080/web/TL-Tube-V2");

/*
define("TL_TUBE_URL","http://thailife.aitstreaming.com/TL-tube");
define('IMG_PROFILE_PATH_TL','http://www.thailife.com/IT/ca/upload_file/sale_pic'); //รูปภาพ profile ของ user
define('IMG_PROFILE_PATH','assets/profile'); //ที่เก็บรูปภาพ profile (ถ้ามี)
*/

//define('IMG_PROFILE_PATH_TL','http://direct.thailife.com/IT/ca/upload_file/sale_pic');
define('IMG_PROFILE_PATH_TL','http://assets.thailife.com/IT/ca/upload_file/sale_pic');

//define("AUTHEN_URL","http://uat.thailife.com:8080/DaOperation/rest/member/saleinfo");
define("AUTHEN_URL","http://da.thailife.com:8080/DaOperation/rest/member/saleinfo");


//Table in database
define('TBL_LOGIN_PROFILE','login_profile');
define('TBL_AGENT','agent');
define('TBL_PROFILE1','profile1');
define('TBL_PROFILE8','profile8');

define('TBL_VDO_ADMIN','vdo_admin');
define('TBL_VDO','vdo');
define('TBL_VDO_CATEGORY','vdo_category');
define("TBL_VDO_COMMENT",' vdo_comment');
define('TBL_VDO_VIEW',' vdo_view');
define('TBL_VDO_LIKE',' vdo_like');

define("FILE_VDO_PATH","assets/vdo");
define("FILE_VDO_IMAGE_PATH","assets/vdo-img");
define("FILE_CATEGORY_PATH","assets/tube-category.txt");


define("MAX_VDO_UPLOAD_SIZE",1100); //MB
define("MAX_IMAGE_UPLOAD_SIZE",1); //MB

define("TIMEOUT_ADD_VIEW",60); // (หน่วยเป็นนาที) สำหรับการเช้มชมเวลาซ้ำ ทิ้งช่วงเวลา xx นาที (แต่ไม่เกิน 1 วัน คือ 1440 นาที) ถึงจะนับการเข้าชมเพิ่มอีก 1


//TL Tube Live  Update Oct, 2016  by CMS
define("TBL_LIVE","live");
define("TBL_LIVE_LIKE","live_like");
define("TBL_LIVE_VIEW","live_view");
define("TBL_LIVE_CHAT","live_chat");
define("TBL_LIVE_VDO_RECOMMEND","live_vdo_recommend");
define("TBL_LIVE_OFF","live_off");
define("FILE_LIVE_PATH","assets/live");

// End of TL Tube Live  


//new table DEC 2018 by CMS
define("TBL_CHANNEL","channel");
define("TBL_CHANNEL_FOLLOW","channel_follow");
define("TBL_BRANCH","branch");
define("TBL_VDO_SUGGESTION","vdo_suggestion");
define("TBL_CHANNEL_SUGGESTION","channel_suggestion");
define("TBL_VDO_PERMISSION","vdo_permission");
define("TBL_NOTI_COMMENT","vdo_noti_comment");
define("TBL_VDO_FOLLOW","vdo_follow");

//new table dec 2019 by cms
define("TBL_CHANNEL_NOTI","channel_noti");

define("FILE_COVER_PATH","assets/cover-image");


//FTP
//define("FTP_HOST","vdocdn2.eazystreaming.com");
define("FTP_HOST","liveedge1.eazystreaming.com");
define("FTP_USER","thailife_user");
//define("FTP_PASS","MjZkM2Y0MmRiMzIyM2FkZTUzMzg5NmE5OTAwN2JjOGZ3bXBAMjAxNw==");
define("FTP_PASS","q8DAybenhWRgYm4=");
define("FTP_PATH","/");


session_start();
if (isset($_SESSION['Auth'])){
	echo '<meta http-equiv="refresh" content="0;URL=./index.php?controller=Master?action=index" />';
	exit;
}

?>