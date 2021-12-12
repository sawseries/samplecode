<?php

require_once './class/View.php';
require_once './class/Base.php';
require_once './class/config.php';

class AuthController extends Base {
    
    
    public function check_login(){
        
      
               
        $user=$this->clean_input($_POST['username']);
	$pass=$this->clean_input($_POST['password']);		
					
			//Check login			
			$sql="SELECT A.PERID, A.PWD, B.FNAME_T, B.LNAME_T
                              FROM ".TBL_LOGIN_PROFILE." AS A,
				   ".TBL_PROFILE1." AS B
					WHERE 
						A.PERID='$user' 
						AND A.PWD = '$pass' 						
						AND A.PERID=B.PERID
					LIMIT 1; ";
		
                        $login = Base::DB()->query($sql)->first();

                        if (count($login)) { 	
                                                session_start();
						$Firstname=$login['FNAME_T'];
						$Lastname=$login['LNAME_T'];
			
					
						$_SESSION['ss_flag_login']=TRUE;	
						$_SESSION['ss_PERID']=$user;
						$_SESSION['ss_agent_name']="$Firstname $Lastname";						
                                        return View::url("Master","index");				
			} else {
                            
                            return View::redirects("Auth/login");
			}
            
            
    }
    
        public function adminlogin(){
            //echo "admin";
            return View::redirects("admin/index");
        }
    
        public function check_admin_login(){
        
      
               
        $user=$this->clean_input($_POST['username']);
	$pass=$this->clean_input($_POST['password']);		
					
			//Check login			
			$sql="SELECT A.PERID, A.PWD, B.FNAME_T, B.LNAME_T
                              FROM ".TBL_LOGIN_PROFILE." AS A,
				   ".TBL_PROFILE1." AS B
					WHERE 
						A.PERID='$user' 
						AND A.PWD = '$pass' 						
						AND A.PERID=B.PERID
					LIMIT 1; ";
		
                        $login = Base::DB()->query($sql)->first();

                        if (count($login)) { 	
                                                session_start();
						$Firstname=$login['FNAME_T'];
						$Lastname=$login['LNAME_T'];
			
					
						$_SESSION['ss_flag_login']=TRUE;	
						$_SESSION['ss_PERID']=$user;
						$_SESSION['ss_agent_name']="$Firstname $Lastname";						
                                        return View::url("Master","index");				
			} else {
                            
                            return View::redirects("Auth/login");
			}
            
            
    }
    
    
    public function logout(){
        
        session_unset();
        session_destroy();
         return View::url("Master","index");
        
    }

    //สำหรับ clean url  paramiter
	function clean_input($input) {
  
		if(get_magic_quotes_gpc()) {
			$input = stripslashes($input);
		}
					
		$input = strip_tags($input);
                return $input;
		//return mysqli_real_escape_string($input);	
	}
    
    
}