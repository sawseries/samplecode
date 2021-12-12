
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">

        <!--  Cache -->
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />

        <title>TL Tube V.2.0</title>

        <?php include("inc.head-tags.php"); ?>

        <!-- Custom styles for this template -->
        <link href="libs/css/meshowtime-style.css" rel="stylesheet">

        <!-- iCheck -->
        <link href="libs/plugin/icheck-1.x/skins/all.css?v=1.0.2" rel="stylesheet">

        <!-- Tooltips warning -->
        <link href="libs/plugin/jquery-tooltips-warning/tooltips-warning.css" rel="stylesheet">

   
        <script>
            $(document).ready(function () {
                //alert("document loaded");
            });
//
            function submitform() {
                $("#form_login").submit();
            }
        </script>

        <style>
            label.error {
                color: #f00;
                font-size: 16px;
                text-align:center;
                font-weight:normal;
                width:100%;
            }

            form.cmxform label.error, label.error, div.error {
                /* remove the next line when you have trouble in IE6 with labels in list */
                color: red;	
                font-size:14px;
                font-family:Tahoma, Geneva, sans-serif;
                background:#fde3e3;
                border-top:1px solid #d00;
                border-bottom:2px solid #d00;
                width:100%;
                padding:10px 0 10px 0;
            }



        </style>

    </head>

    <body class="bg-login-page">

        <main role="main" >

<?php include("inc.header.php"); ?>

            <div class="container">



                <div class="row">

                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3 mt-5 mb-5 container">


                        <div class="col-xs-12">
                            <div style="margin-left:100px;"><img src="images-tube/logo-tltube-v2.png" alt="TL Tube"></div>
                        </div>

                        <form action="./index.php?controller=Auth&action=check_login" method="post" name="form_login" id="form_login" autocomplete="off">								
                            <div class="col-xs-10 col-sm-10 col-xs-offset-1 col-sm-offset-1">

                                <div class="error text-center">ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง!!</div>



                                <div class="form-group margin-bottom-5">
                                    <label for="username"></label>
                                    <input type="text" name="username" id="username" class="form-control login-input d-block mx-auto" placeholder="รหัสตัวแทน หรือเลขประจำตัวประชาชน" value="">
                                </div>

                                <div class="form-group margin-bottom-5">
                                    <label for="password"></label>
                                    <input type="password" name="password" id="password" class="form-control login-input d-block mx-auto" placeholder="รหัสผ่านนักขายดิจิทัล" value="">
                                </div>

                                <br>	
                                <input type="hidden" name="act" id="act" value="login">

                                <center>
                                  <button type="submit" class="btn btn-primary" name="btn_reset" id="btn_reset" style="background:none;">เข้าสู่ระบบ</button>
                                
                                </center>
 
                                <br>


                               
                            </div>
                        </form>	
                    </div>				


                    <div class="clearfix"></div>
                </div>		<!-- ./ login-container -->
            </div> <!-- ./ row -->


        </div><!-- ./container-fiuld -->



    </main>





<?php include("inc.footer.php"); ?>
    <?php include("inc.footer-js.php"); ?>

    <!-- Plugin -->
    <script src="libs/plugin/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="libs/plugin/jquery-validation-1.15.0/dist/jquery.validate.min.js"></script>
    <script src="libs/plugin/jquery-tooltips-warning/tooltips-warning.js"></script>

    <!-- iCheck -->
    <script src="libs/plugin/icheck-1.x/icheck.js?v=1.0.2"></script>

    <script>
    $(document).ready(function ($) {
        var ref_url = "<?php echo $ref_url; ?>";



        /*
         $('#is_remember').iCheck({
         checkboxClass: 'icheckbox_minimal',
         radioClass: 'iradio_minimal',
         increaseArea: '20%'
         });
         */

        $(".error").hide();

        $("#btn_login").click(function () {

            $(".error").hide();

            $("div.error").html("");
            var user = $("#username").val();
            var pass = $("#password").val();


            if (user == "")
            {
                $("div.error").html("*กรุณาใส่รหัสตัวแทน หรือเลขประจำตัวประชาชน!!");
                $(".error").show();
                $("#username").focus();
                return false;

            } else if (pass == "") {
                $("div.error").html("*กรุณาใส่รหัสผ่านนักขายดิจิทัล!!");
                $(".error").show();
                $("#password").focus();
                return false;
            } else {

                var url = $("#form_login").attr("action");

                $.ajax({
                    url: url, // url where to submit the request
                    type: "POST", // type of action POST || GET

                    data: $("#form_login").serialize(), // post data || get data
                    success: function (data) {

                        if (data != '') {
                            //$("span.error").html("ชื่อเข้าใช้ หรือ รหัสผ่านไม่ถูกต้อง!!");	
                            $("div.error").html("**" + data);
                            $(".error").show();
                        } else {
                            if (ref_url != "")
                            {
                                window.location.href = ref_url;
                            } else {
                                window.location.href = "index.php";
                            }
                        }

                    }
                });

            }

            return false;





        });

        /*
             
         $("#form_login" ).validate({
             
         rules: {
         username: {
         required: true
         },
         password: {
         required: true
         }
         },	
         messages: {
         username: {
         required: 'โปรดใส่ชื่อเข้าใช้!'
         }, password: {
         required: 'โปรดใส่รหัสผ่าน!'
         }
         },
             
         errorPlacement: function( error, element ) {
         error.insertAfter( element.parent() );
             
         },submitHandler: function(form) { 
             
         var url=$("#form_login").attr("action");
             
         $.ajax({
         url: url, // url where to submit the request
         type : "POST", // type of action POST || GET
             
         data : $("#form_login").serialize(), // post data || get data
         success : function(data) {
             
         if (data!='') {
         //$("span.error").html("ชื่อเข้าใช้ หรือ รหัสผ่านไม่ถูกต้อง!!");	
         $("div.error").html("**"+data);	
         } else {												
         window.location.href="index.php";	
         }
             
         }
         });
         return false;
             
             
             
         }
             
             
             
         });
             
             
         $("#username").focus();
         */

    });


    /*
     var url=$("#form_login").attr("action");
         
     $.ajax({
     url: url, // url where to submit the request
     type : "POST", // type of action POST || GET
     //dataType : 'json', // data type
     data : $("#form_login").serialize(), // post data || get data
     success : function(data) {
         
     if (data=='101') {
     $("span.error").html("ชื่อเข้าใช้ หรือ รหัสผ่านไม่ถูกต้อง!!");	
     } else {
         
     window.location.href="index.php";	
     }
         
     }
     });
         
     return false;
     */

    </script>
</body>
</html>
