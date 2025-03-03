<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title;?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">

  <script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>

  <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
  <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>


  <script type="text/javascript">
    $(window).on('load', function() {
       // $('#ModalBatch').modal('show');
    });
</script>
  
  <script type="text/javascript">

      // A $( document ).ready() block.
    $( document ).ready(function() {


          $('#AddVarianModal').on('hidden.bs.modal', function(e) {
            $(this).find('#add_varian')[0].reset();
          });


          $("#inputspk").on("keypress", function(e){
              if(e.which == 13){
                 GoSpkInput();
              }
          });

          $("#inputscan").on("keypress", function(e){
              if(e.which == 13){
                GoInputScan();
              }
          });


          $("#inputtrack").on("keypress", function(e){
              if(e.which == 13){
                 GoTrack();
              }
          });

          $("#inputinv").on("keypress", function(e){
              if(e.which == 13){
                 GoInvInput();
              }
          });

          $("#spk_inv_mp").focusout(function(){
            CheckInvMp();
            ConvInv();
          });

          //
          //$("#spk_qty_finish").change(function(){
            //CheckQty();
         // });

          $("#spk_qty_finish").keyup(function(){
            CheckQty();
          });

          $("#spk_qty_material").keyup(function(){
            CheckApproval();
          });




         $('#ModalUploadCust').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
           
        })

        $('#ModalUploadProduct').on('show.bs.modal', function () {
            $("#load_data").html("");
        })

         $('#ModalUploadProduct').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
           
        })


        $("#<?php echo $sidebar_active;?>").attr("class", "active");
        $("#<?php echo $collapse_active;?>").attr("class", "nav-content collapse show");
        $('#product_list').DataTable();

        tinymce.init({
          selector: "#content_header",
          relative_urls : false,
          remove_script_host : false,
          convert_urls : true,
          plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
          ],
          height: 250,
          toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify  | link image | code fullscreen"
        });

        tinymce.init({
          selector: "#content_header_mobile",
          plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
          ],
          height: 250,
          toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify  | link image | code fullscreen"
        });

        tinymce.init({
              selector: "#content1",
              relative_urls : false,
              remove_script_host : false,
              convert_urls : true,
              plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste"
              ],
              height: 250,
              toolbar:
                "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link image | code fullscreen"
            });

        tinymce.init({
          selector: "#content2",
          relative_urls : false,
          remove_script_host : false,
          convert_urls : true,
          plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
          ],
          height: 250,
          toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link image | code fullscreen"
        });

        tinymce.init({
          selector: "#content3",
          relative_urls : false,
          remove_script_host : false,
          convert_urls : true,
          plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
          ],
          height: 250,
          toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link image | code fullscreen"
        });
        tinymce.init({
          selector: "#content4",
          relative_urls : false,
          remove_script_host : false,
          convert_urls : true,
          plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
          ],
          height: 250,
          toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link image | code fullscreen"
        });
        tinymce.init({
          selector: "#content5",
          relative_urls : false,
          remove_script_host : false,
          convert_urls : true,
          plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
          ],
          height: 250,
          toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link image | code fullscreen"
        });
      });  
 </script>


  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
<style>

.blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}

</style>


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color:#bec957;">



    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">SISPRINT OFFLINE</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar pt-2">
      <?php GetNotif(); ?>
      
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <!-- <li class="nav-item dropdown"> -->

          <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a> -->
          <!-- End Notification Icon -->

          <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li> 

          </ul> -->
          <!-- End Notification Dropdown Items -->

        </li>
        <!-- End Notification Nav -->

        <!-- <li class="nav-item dropdown">

           <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a> -->
          <!-- End Messages Icon -->

          <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul> -->
          <!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?php echo base_url()?>assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $this->session->userdata("user_display_name");?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $this->session->userdata("user_display_name");?></h6>
              <span><?php echo $this->session->userdata("user_role");?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url();?>login/doLogout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


      <li class="nav-item">

        <li class="nav-item">
          <a id="sidebar_dashboard" class="nav-link " href="<?php echo site_url().'backend/dashboard';?>">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <a class="nav-link collapsed active" data-bs-target="#spk-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>SPK</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="spk-nav" class="nav-content collapse " data-bs-parent="#spk-nav">
          <li>
            <a id="sidebar_spk" href="<?php echo site_url().'backend/spk';?>">
              <i class="bi bi-circle"></i><span>New</span>
            </a>
          </li>
          <li>
            <a id="sidebar_spk_layout" href="<?php echo site_url().'backend/spk/layout';?>">
              <i class="bi bi-circle"></i><span>Layout</span>
            </a>
          </li>
          <li>
          <a id="sidebar_spk_process" href="<?php echo site_url().'backend/spk/process';?>">
              <i class="bi bi-circle"></i><span>Process</span>
            </a>
          </li>
          <li>
          <!-- <a id="sidebar_spk_done" href="<?php// echo site_url().'backend/spk/done';?>"> -->
          <a id="sidebar_spk_done" href="<?php echo site_url().'backend/spk/s2/0';?>">
              <i class="bi bi-circle"></i><span>Selesai</span>
            </a>
          </li>

        </ul>
      </li><!-- End Tables Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed active" data-bs-target="#bspk-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-checklist"></i><span>Batch SPK</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="bspk-nav" class="nav-content collapse " data-bs-parent="#bspk-nav">
          <li>
            <a id="sidebar_bspk" href="<?php echo site_url().'backend/batchspk';?>">
              <i class="bi bi-circle"></i><span>New</span>
            </a>
          </li>
          <li>
            <a id="sidebar_bspk_history" href="<?php echo site_url().'backend/history';?>">
              <i class="bi bi-circle"></i><span>History</span>
            </a>
          </li>
          <li hidden>
            <a id="sidebar_bspk_print" href="<?php echo site_url().'backend/batchspk/done_print';?>">
              <i class="bi bi-circle"></i><span>Print</span>
            </a>
          </li>
          <li>
            <a id="sidebar_bspk_done" href="<?php echo site_url().'backend/batchspk/done';?>">
              <i class="bi bi-circle"></i><span>Scan Done</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed active" data-bs-target="#pack-nav" data-bs-toggle="collapse" href="#">
          <i class="ri ri-dropbox-fill"></i><span>Packing List</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="pack-nav" class="nav-content collapse " data-bs-parent="#pack-nav">
          <li>
            <a id="sidebar_pack" href="<?php echo site_url().'backend/packing';?>">
              <i class="bi bi-circle"></i><span>New</span>
            </a>
          </li>
          <li>
            <a id="sidebar_pack_history" href="<?php echo site_url().'backend/packing/history';?>">
              <i class="bi bi-circle"></i><span>History</span>
            </a>
          </li>
          

        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed active" data-bs-target="#track-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-search"></i><span>Tracking</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="track-nav" class="nav-content collapse " data-bs-parent="#track-nav">
          <li>
            <a id="sidebar_trackspk" href="<?php echo site_url().'backend/tracking';?>">
              <i class="bi bi-circle"></i><span>SPK / Invoice</span>
            </a>
          </li>
          <li>
            <a id="sidebar_trackresi" href="<?php echo site_url().'backend/tracking/resi';?>">
              <i class="bi bi-circle"></i><span>Resi</span>
            </a>
          </li>

        </ul>
      </li><!-- End Tables Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#product-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
          <a id="sidebar_product" href="<?php echo site_url().'backend/product';?>">
              <i class="bi bi-circle"></i><span>Product</span>
            </a>
          </li>
          <li>
            <a id="sidebar_category" href="<?php echo site_url().'backend/category';?>">
              <i class="bi bi-circle"></i><span>Category</span>
            </a>
          </li>
          <li>
            <a id="sidebar_material" href="<?php echo site_url().'backend/material';?>">
              <i class="bi bi-circle"></i><span>Material</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Forms Nav -->
      
      
        <a class="nav-link collapsed" href="<?php echo site_url().'backend/report/export_report_csv';?>">
          <i class="bi bi-upload"></i><span>Export</span>
        </a>
      </li><li>


      <?php if($this->session->userdata('user_rule')=='sysadmin'):?>
            <a class="nav-link collapsed" href="<?php echo site_url().'backend/User_crud';?>">
              <i class="bi bi-circle"></i><span>User</span>
            </a>
          </li>
      <?php endif;?>
      <!-- End Profile Page Nav -->
      <!-- 
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li>
      -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

  



  <div class="modal fade" id="ModalBatch" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>BATCH 1 BELUM DIBUAT</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="Skip()" class="btn btn-warning">Skip Proses</button>
        <button type="button" onclick="GoToProduct()" class="btn btn-primary">Ke Halaman Produk</button>
      </div>
    </div>
  </div>
</div>

    <section class="section dashboard">
    <?php $this->view('backend/'.$template);?>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SISPRINT</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="#/">PRINTLAGI</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url()?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/chart.js/chart.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/quill/quill.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url()?>assets/js/main.js"></script>



</body>

</html>