      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Filter Date</h5>
                  <div class="row">
                    <form id="addprod" action="<?php echo site_url() ?>backend/dashboard/" method="post" class="mt-0 row g-3 needs-validation" novalidate>
                      <div class="col-sm-4 mt-0 mb-1">
                        <input name="filter_date" type="date" value="<?php echo $filter_date;?>" class="form-control">
                      </div>
                      <div class="col-sm-4 mt-0">
                        <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <!--
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                  
                </div>
                -->


                <div class="card-body">
                  <h5 class="card-title">Created <span>| SPK</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $new;?></h6>
                      <!--<span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>-->

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Layout <span>| SPK</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $layout;?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">

              <div class="card info-card revenue-card">



                <div class="card-body">
                  <h5 class="card-title">Process <span>| SPK</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-printer"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $process;?></h6>
                     

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">

              <div class="card info-card sales-card">



                <div class="card-body">
                  <h5 class="card-title">Done <span>| SPK</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $done;?></h6>
                     

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">

              <div class="card info-card customers-card">



                <div class="card-body">
                  <h5 class="card-title">Packing <span>| Order</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="ps-3">
               
                    <h6><?php echo $pack_order;?></h6>
                    <p>SPK : <?php echo $packing;?></p>
                     

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">

              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">Delivered <span>| Order</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bicycle"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?php echo $delivered_order;?></h6>
                    <p>SPK : <?php echo $delivered;?></p>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">Material Consumption <span>| By SPK</span></h5>

              <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 400px; display: block; box-sizing: border-box; height: 228.8px; width: 459.2px;" width="574" height="286"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      labels: <?php echo $json_mat_name;?>,
                      datasets: [{
                        label: 'Bar Chart',
                        data: <?php echo $json_mat_qty;?>,
                        backgroundColor: [
                          'rgba(35, 192, 192, 0.5)']
                        
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bar CHart -->

            </div>
          </div>

               
            </div><!-- End Reports -->

                        <!-- Reports -->
        <div class="col-12">
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">SPK Product <span>| By SPK</span></h5>

              <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Qty Material</th>
                        <th scope="col">Qty PCS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($arr_group_spk as $row):?>
                      <tr>
                        <td><?php echo $row['spk_prod_name'];?></td>
                        <td><?php echo $row['count'];?></td>
                        <td><?php echo $row['sum_mat'];?></td>
                        <td><?php echo $row['sum_pcs'];?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
              <!-- End Bar CHart -->
                </div>           
            </div>
          </div>

            <!-- Recent Sales -->
            <div class="col-xxl-4 col-md-6">
              <div class="card recent-sales">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Cutting <span>| Today</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Cutting</th>
                        <th scope="col">Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($arr_cutting as $row):?>
                      <tr>
                        <th scope="row"><?php echo $row['spk_cutting'];?></th>
                        <td><?php echo $row['total'];?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
            <!-- Recent Sales -->
            <div class="col-xxl-4 col-md-6">
              <div class="card recent-sales">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Finishing <span>| By SPK</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Finishing</th>
                        <th scope="col">Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($arr_finish as $key => $value):?>
                      <tr>
                        <th scope="row"><?php echo $key;?></th>
                        <td><?php echo $value;?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
            <!-- Recent Sales -->
            <div class="col-xxl-4 col-md-6">
              <div class="card recent-sales">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Lamination <span>| By SPK</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Laminasi</th>
                        <th scope="col">Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($arr_lam as $row):?>
                      <tr>
                        <th scope="row"><?php echo $row['spk_lamination']?></th>
                        <td><?php echo $row['total']?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

           

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
          <!-- Website Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">SPK Type</h5>

              <div id="trafficChart" style="min-height: 283px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Access From',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: <?php echo $json_type;?>
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Website Traffic -->

          <!-- News & Updates Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Top 10 <span>| SPK</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">SPK NO</th>
                        <th scope="col">INV NO</th>
                        <th scope="col">Qty Material</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($arr_top as $row):?>
                      <tr>
                        <th scope="row"><?php echo $row['spk_no']?></th>
                        <td><?php echo $row['spk_inv_mp']?></td>
                        <td><?php echo $row['spk_qty_material']?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
              
            </div>
            
          </div><!-- End News & Updates -->
                    <!-- News & Updates Traffic -->
                    <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">SPK Create By User</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Nama Admin</th>
                        <th scope="col">Jml SPK</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($arr_create as $row_create):?>
                      <tr>
                        <th scope="row"><?php echo $row_create['user_name']?></th>
                        <td><?php echo $row_create['count_spk']?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
              
            </div>
            
          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>