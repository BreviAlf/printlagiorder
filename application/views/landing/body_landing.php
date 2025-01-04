<script>
    function ViewResp(loc,trigger,pid)
    {
        AddResponseProduct(loc,trigger,pid);
    }


</script>
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
                   <?php if(isset($row_popup)):
                     if(DiscCalculation($row_popup->prod_price,$row_popup->prod_price_disc)){
                        $disc = DiscCalculation($row_popup->prod_price,$row_popup->prod_price_disc);
                    }
                    
                    ?>
                    <div class="modal fade" id="productModalPopUp" tabindex="-1" role="dialog" aria-labelledby="productModalPopUpLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                               
                                <div style="padding-top:10px;" class="modal-header">
                                    <button style="z-index: 5050;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        
                                <div style="margin-top:-51px; padding:0px;" class="modal-body mb-2">
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
                                    <div class="row">
                                <!-- start-->
                                <div style="padding-right:0px;" class="col-7">
                                <div class="info-title-modal mt-0">
                                <p class='p-small mt-0 mb-0'><?php echo $row_popup->prod_name;?></p>
                                <?php if($row_popup->prod_price_disc):?>
                                <p class="p-small mt-1 mb-0" style="text-decoration: line-through;"><span class="badge badge-danger" style="margin-right: 2px;"><?php echo $disc;?></span><?php echo FormatRupiah($row_popup->prod_price);?></p>
                                <p class='price p-large mt-1 mb-0'><?php echo FormatRupiah($row_popup->prod_price_disc);?></p> 
                                <?php else:?>
                                <p class='price p-large mt-1 mb-0'><?php echo FormatRupiah($row_popup->prod_price);?></p>  
                                <?php endif;?>  
                                <div style="padding:0px 0px 0px 0px;" class="d-flex mb-0 mt-1 flex-row">
                                        <span style="font-size: 10px;background-color: #dc3545;color: white;padding:0px 6px 0px 6px;line-height: 1.8em;">Terjual <?php echo $row_popup->prod_dummy_sold;?> pcs</span>
                                    </div>          
                                </div>
                                </div>
                                <div style="padding:0px;" class="col-5">
                                        <?php
                                        $wa_prod = rawurlencode($row_popup->prod_name.'-'.$row_popup->prod_sku);
                                        $link = '';
                                        if (filter_var($row_popup->prod_mp_link_1, FILTER_VALIDATE_URL)) { 
                                            $link = $row_popup->prod_mp_link_1;
                                        }
                                    ?>
                                    <div class="info-button-modal mt-0">
                                        <input type="hidden" id="mp_link_<?php echo $row_popup->prod_id?>" value="<?php echo $link;?>">
                                        <input type="hidden" id="wa_prod_<?php echo $row_popup->prod_id?>" value="<?php echo  $wa_prod;?>">
                                        <p class="p-small mb-1">Order Sekarang :</p>
                                        <div style="float:left">
                                            <div class="btn-wa"></div>
                                                <button type="button" id="prod_popup_to_wa" onclick="AddResponseProduct(0,'dest_wa',<?php echo $row_popup->prod_id?>);" class="btn btn-solid-sm">Whatsapp</button>
                                        </div>
                                        <div style="float:left">
                                            <div class="btn-shopee"></div>
                                            <button type="button" id="prod_popup_to_mp" onclick="AddResponseProduct(0,'dest_mp_tkpd',<?php echo $row_popup->prod_id?>);" class="btn btn-solid-sm">Shopee</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- end-->
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
    <?php if ($row_landing->landing_img_size_url!=''):?>
    <div class="slider-1">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8">
                    <h4 class="mt-2">Panduan Ukuran</h4>
                </div>
                <div class="col-lg-8 mb-4 mt-4">
                    <img style="padding:0px;border-radius:0px;" class="img-thumbnail" width="800" src="<?php echo site_url().''.$row_landing->landing_img_size_url;?>"/>
                </div>
            </div>
        </div> <!-- end of container -->
    </div> <!-- end of basic-3 -->
    <?php endif;?>
    <?php if (count($arr_prod_list)!=0):?>
    <div class="slider-1">
        <div class="container">
            <!--VAR PRODUCT CATALOG -->
            <div class="row">
                <div class="col-lg-12 mb-5" id="catalog-product-title">

                    <h4 class="mb-2">Katalog produk ISAMU.ID </h4>
                    <div style="float:left;margin: auto;height:2px;width:30px;border-bottom:solid 5px rgb(194, 13, 13);"></div>
                   
                </div>

                <?php foreach($arr_prod_list as $row_prod):
                    if(DiscCalculation($row_prod['prod_price'],$row_prod['prod_price_disc'])){
                        $disc = DiscCalculation($row_prod['prod_price'],$row_prod['prod_price_disc']);
                    }
                
                ?>

                <div class="col-lg-3 col-md-4 col-6" id="catalog-product">
                    <div class="catalog mb-0">
                        <div class="mb-0">
                            <a href="#" onclick="ViewResp(0,'view_prod',<?php echo $row_prod['prod_id'];?>)" data-toggle="modal" data-target="#productModal<?php echo $row_prod['prod_id'];?>"><img class="img-catalog" src="<?php echo site_url().''.$row_prod['prod_img_mockup_url'];?>"></a>
                        </div>
                        <div class="info-title mt-0 mb-1">
  
                            <a data-toggle="modal" onclick="ViewResp(0,'view_prod',<?php echo $row_prod['prod_id'];?>)"  data-target="#productModal<?php echo $row_prod['prod_id'];?>" style="text-decoration: none;" href="#"><p style="font-size: 13px;" class='p-small mt-2 mb-0'><?php echo $row_prod['prod_name'];?></p></a>
                            
                            <?php if($row_prod['prod_price_disc']):?>
                            <span class="badge badge-danger mb-0"><?php echo $disc;?></span>
                            <div style="margin-top:-5px;">
                            <span class="mt-0 mb-0" style="font-size: 11px; text-decoration: line-through;"><?php echo FormatRupiah($row_prod['prod_price']);?></span>
                            <span style="font-size: 13px;" class='price mt-0 mb-0'><?php echo FormatRupiah($row_prod['prod_price_disc']);?></span>
                            </div>
                            <?php else:?>
                            <p class='price mt-0 mb-0'><?php echo FormatRupiah($row_prod['prod_price']);?></p>
                            <?php endif;?>

                        </div>

                        <div style="padding:0px 0px 0px 5px;" class="d-flex mb-0 mt-0 flex-row-reverse">
                                <span style="font-size: 10px;background-color: #dc3545;color: white;padding:0px 6px 0px 6px;line-height: 1.8em;">Terjual <?php echo $row_prod['prod_dummy_sold'];?> pcs</span>
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
                        <div style="margin-top:-51px;padding:0px;" class="modal-body mb-3">
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
                            <div class="row">
                                <div class="col-7">
                                    <div class="info-title-modal mt-0">
        
                                    <p class='p-small mt-0 mb-0'><?php echo $row_prod['prod_name'];?></p>
                                    <?php if($row_prod['prod_price_disc']):?>
                                    <span class="badge badge-danger"><?php echo $disc;?></span>
                                    <p class="p-small mt-0 mb-0" style="text-decoration: line-through;"><?php echo FormatRupiah($row_prod['prod_price']);?></p>
                                    <p class='price p-large mt-1 mb-0'><?php echo FormatRupiah($row_prod['prod_price_disc']);?></p> 
                                    <?php else:?>
                                    <p class='price p-large mt-1 mb-0'><?php echo FormatRupiah($row_prod['prod_price']);?></p>  
                                    <?php endif;?> 
                                    <div style="padding:0px 0px 0px 0px;" class="d-flex mb-0 mt-1 flex-row">
                                        <span style="font-size: 10px;background-color: #dc3545;color: white;padding:0px 6px 0px 6px;line-height: 1.8em;">Terjual <?php echo $row_prod['prod_dummy_sold'];?> pcs</span>
                                    </div>           
                                    </div>
                                </div>
                                <div style="padding:0px;" class="col-5">
                                        <?php
                                        $wa_prod = rawurlencode($row_prod['prod_name'].'-'.$row_prod['prod_sku']);
                                        $link = '';
                                   if (filter_var($row_prod['prod_mp_link_1'], FILTER_VALIDATE_URL)) { 
                                            $link = $row_prod['prod_mp_link_1'];
                                        }
                                    ?>
                                <div class="info-button-modal mt-0">
                                    <input type="hidden" id="mp_link_<?php echo $row_prod['prod_id']?>" value="<?php echo $link;?>">
                                    <input type="hidden" id="wa_prod_<?php echo $row_prod['prod_id']?>" value="<?php echo  $wa_prod;?>">
                                    <p class="p-small mb-1">Orders Sekarang :</p>
                                    <div style="float:left;">
                                    <div class="btn-wa"></div>
                                        <button type="button" id="prod_list_to_wa" onclick="AddResponseProduct(0,'dest_wa',<?php echo $row_prod['prod_id']?>);" class="btn btn-solid-sm">Whatsapp</button>
                                    </div>
                                    <div style="float:left">
                                        <div class="btn-shopee"></div>
                                        <button style="float:left;" type="button" id="prod_list_to_mp" onclick="AddResponseProduct(0,'dest_mp_tkpd',<?php echo $row_prod['prod_id']?>);" class="btn btn-solid-sm">Shopee</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    </div>
                </div>
                
                <?php endforeach;?>
            </div> <!-- end of row -->
            <div class="row justify-content-md-center">
                <div style="text-align:center;" class="col-lg-12 mt-3 mb-5">
                    <a href="<?php echo site_url();?>#catalog-landing-title" id="" class="btn-solid-lg" type="button">Lihat Katalog Lainnya!!!</a>
                </div>
            </div>
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