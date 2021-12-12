<?php

require_once './class/View.php';
require_once './class/Base.php';
require_once './class/config.php';

class MasterController extends Base {

    public function index() {


        if (isset($_SESSION["ss_flag_login"]) == true) {

            $last_upload = $this->setvdo_last_upload();

            $category_list_box = $this->category_listbox('', false);
            $vdo_popular = $this->setvdo_popular();
            $vdo_recommend = $this->setvdo_recommend();

            $channel_recommend = $this->setchannal_recommend();
            $channel_hit = $this->setchannal_hit();
            // echo $channel_recommend;
            return View::backs("Master/index", array("last_upload" => $last_upload,
                        "category_list_box" => $category_list_box,
                        "vdo_popular" => $vdo_popular,
                        "channel_recommend" => $channel_recommend,
                        "channal_hit" => $channel_hit,
                        "vdo_recommend" => $vdo_recommend));
        } else {

            View::redirects("Auth/login");
        }
    }

    public function setvdo_last_upload() {

        $last_upload = '';
        $sql_latest = "SELECT vdo_id, cat_id, PERID, vdo_name, vdo_file, vdo_image, upload_date, is_status , is_admin 
			FROM vdo 
			WHERE is_status='2'
			AND vdo_active_by_user='1'
			ORDER BY upload_date DESC
			LIMIT 10
			";

        $para = Base::DB()
                ->query($sql_latest)
                ->fetchAll();

        $img_path_url = FILE_VDO_IMAGE_PATH;

        if ($para->num_rows > 0) {
            foreach ($para as $row) {

                $vdo_id = $row['vdo_id'];
                $vdo_name = stripslashes($row['vdo_name']);
                $vdo_file = $row['vdo_file'];
                $vdo_image = $row['vdo_image'];
                $upload_date = $row['upload_date'];
                $is_status = $row['is_status'];
                $is_admin = $row['is_admin'];
                $PERID = $row['PERID'];

                //จำนวนคน view
                //$n_view=0;
                $n_view = $this->count_vdo_view($vdo_id);
                //echo $vdo_id."<br>";

                if ($vdo_image != "") {
                    $image = '<img src="' . $img_path_url . '/' . $vdo_image . '"  class="img-fluid">';
                } else {
                    $image = '<img src="images/thumb02.gif" width="190" height="110" border="0" />';
                }


                //ดึงค่าชื่อผู้โพสต์ ถ้าเป็น admin ก็ไม่ต้อง
                $poster_name = "";
                if ($is_admin == '1') {
                    $poster_name = $PERID;
                } else {
                    $poster_name = $this->poster_name($PERID);
                }

                $upload = $upload_date;

                // $upload=humanTiming(strtotime($upload_date));

                $last_upload .= '<div class="item whiteWhite">
					<div class="card">
					<div class="img-poster"><a href="watch.php?PERID=' . $PERID . '&id=' . $vdo_id . '">' . $image . '</a></div>
					<div class="card-body">
					<h5 class="card-title text-left">' . $vdo_name . '</h5>
					<p class="card-text video-by text-left">อัปโหลดโดย :  ' . $poster_name . '<br><i class="far fa-clock"></i> ' . $upload . ' <br> <i class="far fa-eye"></i> ดู ' . number_format($n_view) . ' ครั้ง</p>
				</div>
				</div>
				</div>';
            }
        }


        return $last_upload;
    }

    function count_vdo_view($id) {

        $sql = "SELECT SUM(view_count) AS num_view FROM vdo_view WHERE  vdo_id='$id' ";

        $view_count = Base::DB()
                ->query($sql)
                ->first();

        return $view_count["num_view"];
    }

    function poster_name($id) {

        $sql = "SELECT FNAME_T,LNAME_T FROM profile1 WHERE PERID='$id' LIMIT 1;";

        $re = Base::DB()
                ->query($sql)
                ->first();

        $name = '';

        if (count($re) > 0) {
            $name = $re['FNAME_T'] . " " . $re['LNAME_T'];
        }

        return $name;
    }

//    function poster_name($id) {
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, 'http://uat.thailife.com:8080/DaOperation/rest/member/saleinfo/' . $id);
//        //curl_setopt($ch,CURLOPT_URL, AUTHEN_URL."/".$id);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $sess = curl_exec($ch);
//        $arr = json_decode($sess, true);
//
//        $firstname = $arr["responseRecord"]["saleInformationList"][0]["firstName"];
//        $lastname = $arr["responseRecord"]["saleInformationList"][0]["lastName"];
//
//        $name = $firstname . " " . $lastname;
//        curl_close($ch);
//
//        return $name;
//    }

    function category_listbox($id, $upload = false) {
        $listbox = '';
        $sql;
        if ($upload) { //กำหนดให้ user อัพโหลดได้เฉพาะที่กำหนด
            $sql = "SELECT * FROM vdo_category WHERE is_active='1' AND user_upload='1' ORDER BY sort_order ";
        } else {
            $sql = "SELECT * FROM vdo_category WHERE is_active='1' ORDER BY sort_order ";
        }

        $result = Base::DB()
                ->query($sql)
                ->fetchAll();

        if ($result->num_rows > 0) {

            foreach ($result as $row) {

                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_name'];
                $select = (($id != "" && $id == $cat_id) ? ' selected="selected" ' : '');

                $listbox .= '<option value="' . $cat_id . '" ' . $select . '>' . $cat_name . '</option>';
            }
        }

        return $listbox;
    }

    function setvdo_popular() {
        //////วิดีโอยอดนิยม 10 รายการ
        $vdo_popular = '';
        $id = '';
        $num_view = '';

        $sql_popular1 = "SELECT vdo_id, SUM(view_count) AS num_view 
						FROM vdo_view 
						GROUP BY vdo_id 
						ORDER BY num_view DESC LIMIT 10 ";

        $result = Base::DB()
                ->query($sql_popular1)
                ->fetchAll();


        if ($result->num_rows > 0) {

            foreach ($result as $row) {


                $id = $row["vdo_id"];
                $num_view = $row['num_view'];

                //วิดีโอที่อัปโหลดล่าสุด 10 รายการ
                $sql_popular2 = "	SELECT vdo_id, cat_id, vdo_name, vdo_file, vdo_image, upload_date, is_status, PERID, is_admin
							FROM " . TBL_VDO . " 
							WHERE is_status='2'	
								AND vdo_active_by_user='1'
								AND vdo_id='$id' 
							LIMIT 1
							";

                $re_top = Base::DB()
                        ->query($sql_popular2)
                        ->fetchAll();


                if ($re_top->num_rows > 0) {

                    foreach ($re_top as $row2) {

                        $vdo_id = $row2['vdo_id'];
                        $vdo_name = ($row2['vdo_name']);
                        $vdo_file = $row2['vdo_file'];
                        $vdo_image = $row2['vdo_image'];
                        $upload_date = $row2['upload_date'];
                        $is_status = $row2['is_status'];
                        $pop_image = '';

                        $is_admin = $row2['is_admin'];
                        $PERID = $row2['PERID'];
                        //Image
                        if ($vdo_image != "") {
                            $pop_image = '<img src="' . FILE_VDO_IMAGE_PATH . '/' . $vdo_image . '" width="190" height="110" border="0" />';
                        } else {
                            $pop_image = '<img src="images/thumb02.gif" width="190" height="110" border="0" />';
                        }

                        //จำนวนคน view
                        $n_view = $this->count_vdo_view($vdo_id);
                        $poster_name = '';
                        //ดึงค่าชื่อผู้โพสต์ ถ้าเป็น admin ก็ไม่ต้อง
                        if ($is_admin == '1') {
                            $poster_name = $PERID;
                        } else {
                            $poster_name = $this->poster_name($PERID);
                        }
//                                                
//                                                
//                                                //						//วันที่อัปโหลด
//						//$upload=ShortDateTimeThai(strtotime($upload_date),'no');
//						//$upload=date_when($upload_date);
                        //$upload=$this->humanTiming(strtotime($upload_date));
                        $upload = $upload_date;
//
//						
//                                                
                        //$vdo_name=limit_char($vdo_name,50);
                        //$poster_name=limit_name($poster_name);
                        $vdo_popular .= '<div class="item whiteWhite">
													 <div class="card">
														<div class="img-poster"><a href="watch.php?PERID=' . $PERID . '&id=' . $vdo_id . '">' . $pop_image . '</a></div>
														<div class="card-body">
														  <h5 class="card-title text-left">Digitools : ' . $vdo_name . ' : </h5>
														  <p class="card-text video-by text-left">อัปโหลดโดย :  ' . $poster_name . '<br><i class="far fa-clock"></i> ' . $upload . ' <br> <i class="far fa-eye"></i> ดู ' . number_format($n_view) . ' ครั้ง</p>
														</div>
													  </div>
											</div>';
                    }
//                                
//                                
                }
            }
        }
        return $vdo_popular;
    }

    function setvdo_recommend() {
        //////วิดีโอแนะนำ
        $vdo_recommend = '';
        $sql_recommend1 = "SELECT A.vdo_id, A.cat_id, A.vdo_name, A.vdo_file, A.vdo_file_type, A.vdo_image, A.upload_date, A.is_status, A.ip_address, A.update_date,B.sug_id, B.vdo_id, B.create_date
				FROM vdo AS A,
				     vdo_suggestion AS B
				WHERE 
				     A.vdo_id=B.vdo_id
				ORDER BY 
				     A.upload_date DESC
			";

        $result = Base::DB()
                ->query($sql_recommend1)
                ->fetchAll();

        if ($result->num_rows > 0) {

            foreach ($result as $row) {

                $id = $row["vdo_id"];
                $num_like = $row['num_like'];
                //วิดีโอที่อัปโหลดล่าสุด 10 รายการ
                $sql_recommend2 = "SELECT vdo_id, cat_id, vdo_name, vdo_file, vdo_image, upload_date, is_status, PERID, is_admin
							FROM vdo 
							WHERE is_status='2'	
							AND vdo_active_by_user='1'
							AND vdo_id='$id' 
							LIMIT 1
							";
                $re_top = Base::DB()
                        ->query($sql_recommend2)
                        ->fetchAll();
//				
                if ($re_top->num_rows > 0) {

                    foreach ($re_top as $row44) {
                        $vdo_id = $row44['vdo_id'];
                        $vdo_name = ($row44['vdo_name']);
                        $vdo_file = $row44['vdo_file'];
                        $vdo_image = $row44['vdo_image'];
                        $upload_date = $row44['upload_date'];
                        $is_status = $row44['is_status'];

                        $is_admin = $row44['is_admin'];
                        $PERID = $row44['PERID'];
//	
//						//Image
                        if ($vdo_image != "") {
                            $image = '<img src="' . FILE_VDO_IMAGE_PATH . '/' . $vdo_image . '"  class="img-fluid">';
                        } else {
                            $image = '<img src="images/thumb02.gif" class="img-fluid" height="110" >';
                        }
//						
//			//จำนวนคน view
                        $n_view = $this->count_vdo_view($vdo_id);
//						
//						//ดึงค่าชื่อผู้โพสต์ ถ้าเป็น admin ก็ไม่ต้อง
                        $poster_name = '';
                        if ($is_admin == '1') {
                            $poster_name = $PERID;
                        } else {
                            $poster_name = $this->poster_name($PERID);
                        }
//					
//						
//						
//						//วันที่อัปโหลด
//						//$upload=ShortDateTimeThai(strtotime($upload_date),'no');
//						//$upload=date_when($upload_date);
                        //$upload=humanTiming(strtotime($upload_date));
//
//						/*
//						
//						$vdo_recommend.='<div class="ca-item">
//															<div class="tube-box-title">
//																<div class="tube-icon-play-small"></div>
//																<a href="watch.php?id='.$vdo_id.'" class="link-title">'.$image.'</a>
//																<a href="watch.php?id='.$vdo_id.'" class="link-title"><h3>'.$vdo_name.'</h3></a>
//																 <p class="tube-mini-info">อัปโหลดโดย '.$poster_name.'<br />'.$upload.'<br />ดู '.number_format($n_view).' ครั้ง</p>                                            
//															</div>                                        
//													</div>';
//						*/
//						
//						$vdo_name=limit_char($vdo_name,50);
//						$poster_name=limit_name($poster_name);
//  
                        $upload = $upload_date;
                        $vdo_recommend .= '<div class="item whiteWhite">
								<div class="card">
							        <div class="img-poster"><a href="watch.php?PERID=' . $PERID . '&id=' . $vdo_id . '">' . $image . '</a></div>
							        <div class="card-body">
								<h5 class="card-title text-left">' . $vdo_name . '</h5>
								<p class="card-text video-by text-left">อัปโหลดโดย : ' . $poster_name . '<br><i class="far fa-clock"></i> ' . $upload . ' <br> <i class="far fa-eye"></i> ดู ' . number_format($n_view) . '  ครั้ง</p>
								</div>
								</div>
					</div>';
                    }
                }
            }
        }
        return $vdo_recommend;
    }

    function setchannal_recommend() {


        ////channel แนะนำ
        $channel_recommend = '';
        $sql_channel_rec = "SELECT * FROM channel_suggestion";

        $s3 = Base::DB()
                ->query($sql_channel_rec)
                ->fetchAll();

        if ($s3->num_rows > 0) {
//
            foreach ($s3 as $row3) {
                $chan_sug_id = $row3["chan_sug_id"];
                $channel_id = $row3["channel_id"];
                $channel_PERID = $row3['channel_PERID'];
                $create_date = $row3['create_date'];

                $my_channel_name = $this->poster_name($channel_PERID);
                $avatar = $this->mini_picture_profile($channel_PERID);
                //$image_avatar = '<img src="'.$avatar.'" class="rounded-circle profile-image"  width="100" height="100">';
                $my_avata = '<img src="'.$avatar.'"  class="rounded-circle profile-image"  width="100" height="100">';

                $channel_recommend .= '<div class="item whiteWhite text-center ">
					<a href="channel.php?PERID=' . $channel_PERID . '&m=h">' . $my_avata . '</a>
					<h5>' . $my_channel_name . '</h5>
				    </div>';
            }
        }

        return $channel_recommend;
    }

    function setchannal_hit() {
        ////channel ฮิต
        $channel_hit = '';
        $channel_name = '';

        $sql_channel_hit = "SELECT * FROM channel WHERE channel_active='1' LIMIT 10; ";

        $result = Base::DB()
                ->query($sql_channel_hit)
                ->fetchAll();

        if ($result->num_rows > 0) {

            foreach ($result as $row) {

                $channel_id = $row["id"];
                $channel_PERID = $row['PERID'];
                $channel_name = $this->poster_name($channel_PERID);

                $avatar = $this->mini_picture_profile($channel_PERID);

                $image_avatar = '<img src="'.$avatar.'"class="rounded-circle profile-image"  width="100" height="100">';
                $channel_hit .= '<div class="item text-center ">
				<a href="channel.php?PERID='.$channel_PERID.'&m=h">'.$image_avatar . '</a>
				<h5>'.$channel_name.'</h5>
				</div>';
//        
            }
        }
        return $channel_hit;
    }

    //รูปภาพ profile 
    public function mini_picture_profile($userid) {

        $image_profile = '';

        $sql = "SELECT agent_profile_picture FROM agent WHERE agent_username='$userid' LIMIT 1; ";

        $profile = Base::DB()
                ->query($sql)
                ->first();

        define('IMG_PROFILE_PATH_TL', 'http://assets.thailife.com/IT/ca/upload_file/sale_pic');

        if (count($profile) > 0) {

            $profile_picture = $profile['agent_profile_picture'];

            if ($profile_picture == "") {

                $headers = get_headers(IMG_PROFILE_PATH_TL . "/$userid.jpg");
                if (preg_match("|200|", $headers[0])) {
                    $image_profile = IMG_PROFILE_PATH_TL . "/$userid.jpg";
                } else {

                    $image_profile = "images-tube/icon-poster2.png";
                }
            } else {

                $headers = get_headers(IMG_PROFILE_PATH_TL . "/$userid.jpg");
                if (preg_match("|200|", $headers[0])) {
                    $image_profile = IMG_PROFILE_PATH_TL . "/$userid.jpg";
                } else {
                    $image_profile = "images-tube/icon-poster2.png";
                }
            }
        } else {

            $headers = get_headers(IMG_PROFILE_PATH_TL . "/$userid.jpg");
            if (preg_match("|200|", $headers[0])) {
                $image_profile = IMG_PROFILE_PATH_TL . "/$userid.jpg";
            } else {

                $image_profile = "images-tube/icon-poster2.png";
            }
        }

        return $image_profile;
    }

}
