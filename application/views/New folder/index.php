<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description"content="<?php echo $row_landing->landing_meta_desc;?>">
    <meta name="author" content="isamu">
    <meta name="keywords" content="<?php echo $row_landing->landing_meta_key;?>">
    <meta property="og:site_name" content="isamu.id" /> <!-- website name -->
    <meta property="og:site" content="https://isamu.id" /> <!-- website link -->
    <meta property="og:title" content="<?php echo $row_landing->landing_page_title;?>" />
    <meta property="og:description" content="<?php echo $row_landing->landing_meta_desc;?>" />
    <meta property="og:image" content="<?php echo site_url().''.$row_landing->landing_meta_img_url;?>" />
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->

    <!-- Webpage Title -->
    <title><?php echo $row_landing->landing_page_title;?></title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap"rel="stylesheet">
    <link href="<?php echo site_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo site_url();?>assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="<?php echo site_url();?>assets/css/swiper2.css" rel="stylesheet">
    <link href="<?php echo site_url();?>assets/css/magnific-popup.css" rel="stylesheet">
    <link href="<?php echo site_url();?>assets/css/styles7.css" rel="stylesheet">
    <link href="<?php echo site_url();?>assets/css/color1.css" rel="stylesheet">
    <link href="<?php echo site_url();?>assets/css/responsive.css" rel="stylesheet">

    <script src="<?php echo site_url();?>assets/js/frontpage/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <!-- Favicon  -->
    <link rel="icon" href="<?php echo site_url();?>assets/img/icon.png">

    <?php if(isset($row_popup)):?>
    <script>
        const myTimeout = setTimeout(myGreeting, 20000);
        function myGreeting() {
            var uid = $('#uid').val();
            AddResponseEvent('load','load_page',uid);
            $('#productModalPopUp').modal('show')
        }
    </script>
    <?php endif;?>

    <script>
        $(document).ready(function(){
            var uid = $('#uid').val();
            
            $("#event_header").click(function(){
                AddResponseEvent('btn','event_header',uid);
            });

            $("#event_header_mobile").click(function(){
                AddResponseEvent('btn','event_header_mobile',uid);
            });

            $("#event_content").click(function(){
                AddResponseEvent('btn','event_content',uid);
            });

            $("#event_footer").click(function(){
                AddResponseEvent('btn','event_footer',uid);
            });
        });

        function AddResponseEvent(type,trigger,uid) 
        {

            var uid = uid;
            var resp_type_trigger = trigger;
            var resp_type = type;
            var cat_id = $('#cat_id').val();
            var landing_id = $('#landing_id').val();
            var niche_id = $('#niche_id').val();
            $.ajax({
					url: '<?php echo site_url().'/landing/AddResponseEvent'?>',
					cache: false,
					type: 'POST',
					data: {
						uid		    :uid,
						resp_type		    :resp_type,
						resp_type_trigger	:resp_type_trigger,
						cat_id		    :cat_id,
						landing_id		:landing_id,
						niche_id		:niche_id,
					},
					success: function(result) {
                        if(type!='load'){
                            window.open("https://api.whatsapp.com/send?phone=<?php echo $row_landing->landing_cta_wa_number?>&text=<?php echo $row_landing->landing_cta_event_text;?>",'_blank');
                        }
						
            
					},
					failure: function(errMsg) {
						alert(errMsg);
					}
				});
        }
    </script>
    <?php
        $wa_text = rawurlencode($row_landing->landing_cta_wa_text);
    ?>
    <script>
        function AddResponseProduct(loc,trigger,pid) 
        {


            if(loc == 0){
                var link = $('#mp_link_'+pid).val();
                var wa_prod = $('#wa_prod_'+pid).val();
            }else{
                var link = $('#mp_link_pu_'+pid).val();
                var wa_prod = $('#wa_prod_pu_'+pid).val();
            }
            var uid = $('#uid').val();
            var uid = uid;
            var resp_type_trigger = trigger;
            var cat_id = $('#cat_id').val();
            var prod_id = pid;
            var landing_id = $('#landing_id').val();
            var niche_id = $('#niche_id').val();
            $.ajax({
					url: '<?php echo site_url().'/landing/AddResponseProduct'?>',
					cache: false,
					type: 'POST',
					data: {
						uid		    :uid,
                        prod_id     :prod_id,
						resp_type_trigger	:resp_type_trigger,
						cat_id		    :cat_id,
						landing_id		:landing_id,
						niche_id		:niche_id,
					},
					success: function(result) {
                        if(resp_type_trigger=='dest_wa'){
                            window.open("https://api.whatsapp.com/send?phone=<?php echo $row_landing->landing_cta_wa_number?>&text=<?php echo $wa_text;?>%20"+wa_prod,'_blank');
                        }else{
                            window.open(link+'?uid='+uid,'_blank');
                        }
					},
					failure: function(errMsg) {
						alert(errMsg);
					}
				});
        }

    </script>

    <style>
        
        .modal-content {
            border-radius: 0px;
        }
        .kedip {
            animation: blink-animation 1s steps(5, start) infinite;
            -webkit-animation: blink-animation 1s steps(5, start) infinite;
        }

        @keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }

        @-webkit-keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }
        .img-thumbnail {

            border: 0px;
        }

        .bgfootermobile {
            background: url('<?php echo site_url().''.$row_landing->landing_footer_img_url_mobile;?>') center center no-repeat;
            padding-top: 5rem;
            padding-bottom: 5rem;
            background-size: cover;
            text-align: center;
        }

        @media (min-width: 1200px) {
            .header {
                background: url('<?php echo site_url().''.$row_landing->landing_header_img_url;?>') center center no-repeat;
                background-size: cover;
                overflow-x: hidden;
            }
        }
        @media (min-width: 992px) {
            .header {
                background: url('<?php echo site_url().''.$row_landing->landing_header_img_url;?>') center center no-repeat;
                background-size: cover;
                padding-bottom: 7rem;
                text-align: left;
            }
        }

        @media (min-width: 768px) {
            .header {
                background: url('<?php echo site_url().''.$row_landing->landing_header_img_url;?>') center center no-repeat;
                background-size: cover;
                padding-bottom: 7rem;
                text-align: left;
            }

        }
        @media (max-width:768px) {
            .header {
                background: url('<?php echo site_url().''.$row_landing->landing_header_img_url_mobile;?>') center center no-repeat;
                padding-top: 7rem;
                padding-bottom: 2.5rem;
                background-size: cover;
                text-align: center;
            }
        	.bgfootermobile {
                background: url('<?php echo site_url().''.$row_landing->landing_footer_img_url_mobile;?>') center center no-repeat;
                padding-top: 5rem;
                padding-bottom: 5rem;
                background-size: cover;
                text-align: center;
            }
        }
    </style>
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            <input type="hidden" id="uid" value='<?php echo $uid;?>'>
            <input type="hidden" id="landing_id" value='<?php echo $landing_id;?>'>
            <input type="hidden" id="niche_id" value='<?php echo $niche_id;?>'>
            <input type="hidden" id="cat_id" value='<?php echo $cat_id;?>'>

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Kora</a> -->

            <!-- Image Logo -->
            <div class="logo-image"></div>
            
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header-->
    <header id="header" class="header">
        <div id="cardmobileshow">
            <div class="text-container">
                <div class="backtrans p-3">
                     <!-- VAR HEADER MOBILE-->
                     <?php echo $row_landing->landing_hedaer_content_mobile;?>
                      <!-- END OF VAR HEADER MOBILE-->
                </div>
            </div> 
            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div id="cardmobile">
                    </div>
                    <div id="cardweb">
                        <div class="text-container">
                            <div class="backtrans p-4">
                                  <!-- VAR HEADER DESKTOP-->
                                  <?php echo $row_landing->landing_hedaer_content;?>
                                  <!-- END OF VAR HEADER DESKTOP-->
                            </div>
                        </div> <!-- end of text-container -->
                    </div>
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- Customers -->

                    <!-- Modal -->
                   <?php if(isset($row_popup)):?>
                    <div class="modal fade" id="productModalPopUp" tabindex="-1" role="dialog" aria-labelledby="productModalPopUpLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                               
                                <div style="padding-top:10px;" class="modal-header">
                                    <button style="z-index: 5050;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        
                                <div style="margin-top:-51px; padding:0px;" class="modal-body mb-4">
                                    <div id="carouselExampleControlsPopUp" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicatorsPopUp" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicatorsPopUp" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicatorsPopUp" data-slide-to="3"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="<?php echo site_url().''. $row_popup->prod_img_banner_url;?>" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="<?php echo site_url().''. $row_popup->prod_img_mockup_url;?>" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="<?php echo site_url().''. $row_popup->prod_img_design_url;?>" alt="Second slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControlsPopUp" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControlsPopUp" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    
                                    <div style="text-align:center" class="info-title-modal mb-4">
                                    <p class='p-medium mt-0 mb-0'><?php echo $row_popup->prod_name;?></p>
                                    <p style="font-size: small;font-weight: bold;" class='mb-0 mt-0'><?php echo $row_popup->prod_sku;?></p></a>
                                    <p class="p-small mt-1 mb-0" style="text-decoration: line-through;"><?php echo FormatRupiah($row_popup->prod_price);?></p>
                                    <p class='price mt-0 mb-0'><?php echo FormatRupiah($row_popup->prod_price_disc);?></p> 
                                    </div>
                                    <?php
                                        $wa_prod = rawurlencode($row_popup->prod_name.'-'.$row_popup->prod_sku);
                                        $link = '';
                                        if (filter_var($row_popup->prod_mp_link_1, FILTER_VALIDATE_URL)) { 
                                            $link = $row_popup->prod_mp_link_1;
                                        }
                                    ?>
                                    <input type="hidden" id="mp_link_pu_<?php echo $row_popup->prod_id;?>" value="<?php echo $link;?>">
                                    <input type="hidden" id="wa_prod_pu_<?php echo $row_popup->prod_id;?>" value="<?php echo  $wa_prod;?>">
                                        <div style="text-align:center" class="mt-4">
                                            <button onclick="AddResponseProduct(1,'dest_wa',<?php echo $row_popup->prod_id;?>);" type="button" class="btn btn-solid-sm">Beli Via Whatsapp</button>
                                            <button onclick="AddResponseProduct(1,'dest_mp_tkpd',<?php echo $row_popup->prod_id;?>);" type="button" class="btn btn-solid-sm">Beli Via Marketplace</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
            

    <div id="firstcontent" class="slider-1">
        <div class="container">
            <!-- VAR CONTENT_1 -->
            <?php echo $row_landing->landing_body_content_1;?>
            <!-- END OF VAR CONTENT_1 -->
        </div> <!-- end of container -->
    </div> <!-- end of slider-1 -->
    <!-- end of customers -->

    <div style="background-color: rgb(245, 248, 248);padding-top: 0px;" class="slider-1">
        <div class="container">
            <!-- VAR CONTENT_2 -->
            <?php echo $row_landing->landing_body_content_2;?>
             <!-- END OF VAR CONTENT_2 -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-3 -->
    <!-- end of details 2 -->
    <div class="slider-1">
        <div class="container">
            <!-- VAR CONTENT_3 -->
            <?php echo $row_landing->landing_body_content_3;?>
            <!-- END OF VAR CONTENT_3 -->
        </div> <!-- end of container -->
    </div> <!-- end of slider-1 -->
    <div style="background-color: rgb(245, 248, 248);padding-top: 0px;" class="slider-1">
        <div class="container">
            <!-- VAR CONTENT_4 -->
            <?php echo $row_landing->landing_body_content_4;?>
            <!-- END OF VAR CONTENT_4 -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-3 -->
    <?php if (count($arr_prod_list)!=0):?>
    <div class="slider-1">
        <div class="container">
            <!--VAR PRODUCT CATALOG -->
            <div class="row">
                <div class="col-lg-12 mb-5">

                    <h4 class="mb-2">Katalog produk ISAMU.ID </h4>
                    <div style="margin: auto;height:2px;width:30px;border-bottom:solid 5px rgb(194, 13, 13);"></div>
                   
                </div>

                <?php foreach($arr_prod_list as $row_prod):?>

                <div class="col-lg-4 col-md-6 col-md-12 col-6" id="catalog-product">
                    <div class="catalog mb-0">
                        <div class="mb-0">
                            <a href="#" data-toggle="modal" data-target="#productModal<?php echo $row_prod['prod_id'];?>"><img class="img-catalog" src="<?php echo site_url().''.$row_prod['prod_img_mockup_url'];?>"></a>
                        </div>
                        <div class="info-title mt-0 mb-0">
                        <a data-toggle="modal" data-target="#productModal<?php echo $row_prod['prod_id'];?>" style="text-decoration: none;" href="#"><p class='p-small mt-2 mb-0'><?php echo $row_prod['prod_name'];?></p>
                        <p style="font-size: x-small;font-weight: bold;" class='mb-0 mt-0'><?php echo $row_prod['prod_sku'];?></p></a>
                        <p class="p-small mt-1 mb-0" style="text-decoration: line-through;"><?php echo FormatRupiah($row_prod['prod_price']);?></p>
                        <p class='price mt-0 mb-0'><?php echo FormatRupiah($row_prod['prod_price_disc']);?></p>
                        </div>
                    </div>
                </div> <!-- end of col -->

                <!-- Modal -->
                <div class="modal fade" id="productModal<?php echo $row_prod['prod_id']?>" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div style="padding-top:10px;" class="modal-header">
                            <button style="z-index: 5050;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div style="margin-top:-51px;padding:0px;" class="modal-body mb-4">
                            <div id="carouselExampleControls<?php echo $row_prod['prod_id']?>" class="carousel slide mb-0" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators<?php echo $row_prod['prod_id']?>" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators<?php echo $row_prod['prod_id']?>" data-slide-to="1"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?php echo site_url().''. $row_prod['prod_img_mockup_url'];?>" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100" src="<?php echo site_url().''. $row_prod['prod_img_design_url'];?>" alt="Second slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $row_prod['prod_id']?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls<?php echo $row_prod['prod_id']?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                           
                            <div class="info-title-modal mt-0 mb-3">
                                <p class='p-medium mt-0 mb-0'><?php echo $row_prod['prod_name'];?></p>
                                <p style="font-size: small;font-weight: bold;" class='mb-0 mt-0'><?php echo $row_prod['prod_sku'];?></p></a>
                                <p class="p-small mt-1 mb-0" style="text-decoration: line-through;"><?php echo FormatRupiah($row_prod['prod_price']);?></p>
                                <p class='price mt-0 mb-0'><?php echo FormatRupiah($row_prod['prod_price_disc']);?></p>             
                            </div>
                            <?php
                                $wa_prod = rawurlencode($row_prod['prod_name'].'-'.$row_prod['prod_sku']);
                                $link = '';
                                if (filter_var($row_prod['prod_mp_link_1'], FILTER_VALIDATE_URL)) { 
                                    $link = $row_prod['prod_mp_link_1'];
                                }
                            ?>

                            <input type="hidden" id="mp_link_<?php echo $row_prod['prod_id']?>" value="<?php echo $link;?>">
                            <input type="hidden" id="wa_prod_<?php echo $row_prod['prod_id']?>" value="<?php echo  $wa_prod;?>">
                            <button type="button" onclick="AddResponseProduct(0,'dest_wa',<?php echo $row_prod['prod_id']?>);" class="btn btn-solid-sm">Beli Via Whatsapp</button>
                            <button type="button" onclick="AddResponseProduct(0,'dest_mp_tkpd',<?php echo $row_prod['prod_id']?>);" class="btn btn-solid-sm">Beli Via Marketplace</button>
                        </div>
                    </div>
                    </div>
                </div>
                
                <?php endforeach;?>
            </div> <!-- end of row -->
            <!--END OF VAR PRODUCT CATALOG -->
        </div> <!-- end of container -->
    </div>
    <?php endif;?>


    <!-- end of testimonials -->

    <div class="slider-1 pt-0 pb-0">
        <div class="bgfootermobile">
            <div class="container">
                <!-- VAR CONTENT_5 -->
                <?php echo $row_landing->landing_body_content_5;?>
                <!-- END OF VAR CONTENT_5 -->
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalGratis" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="pt-2 pb-2 pr-2 pl-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 offset-xl-3">
                                <div class="text-box mt-3 mb-5">
                                    <div id="showform">
                                        <p style="text-align: center;" class="mb-4">Isi nama anda dan dapatkan sample
                                            GRATIS!!!</p>
                                        <!-- Sign Up Form -->
                                        <form id="reg_free_sample">
                                            <div class="form-group">
                                                <input type="text" name="form_field_1" class="form-control-input"
                                                    id="name" required="">
                                                <label class="label-control" for="form_field_1">Nama</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="form_field_2" class="form-control-input"
                                                    id="email" required="">
                                                <label class="label-control" for="form_field_2">Email</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="number" name="form_field_3" class="form-control-input"
                                                    id="mobile" required="">
                                                <label class="label-control" for="form_field_3">No HP</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="g-recaptcha"
                                                    data-sitekey="6LfZM-UcAAAAAO9uCaMiFE3PlF1wKgDAw1_6B85I"></div>
                                            </div>
                                            <input type="hidden" name="form_field_4" class="form-control-input"
                                                value="Hardbox">
                                            <input type="hidden" id="form_field_5" name="form_field_5"
                                                class="form-control-input" value="">
                                            <div class="form-group">
                                                <button id="cta_free_submit" type="submit"
                                                    class="form-control-submit-button">Kirim</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="hideform">
                                        <div class="alert alert-success" role="alert">
                                            Terima kasih atas pastisipasi anda, tim spesialis kami akan segera
                                            menghubungi anda!
                                        </div>
                                    </div>

                                    <!-- end of sign up form -->

                                </div> <!-- end of text-box -->
                            </div> <!-- end of col -->
                        </div> <!-- end of row -->
                    </div> <!-- end of container -->
                </div>
            </div>
        </div>
    </div>




    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row justify-content-md-center mt-1">
                <div class="col-lg-12">
                        <h6>Tersedia di</h6>
  
                            <a id="cta_free_open" class="btn-solid-sm-tokped" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">Tokopedia</a>
                            <a id="cta_free_open" class="btn-solid-sm-shopee" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">Shopee</a>

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright©<a href="#">isamu.id</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->

    <script src="<?php echo site_url();?>assets/js/frontpage/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="<?php echo site_url();?>assets/js/frontpage/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="<?php echo site_url();?>assets/js/frontpage/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="<?php echo site_url();?>assets/js/frontpage/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="<?php echo site_url();?>assets/js/frontpage/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>