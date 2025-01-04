
	<div class="text-right">
		<button type="button" id="detail_listing" onClick="ExportPDF()" class="btn btn-primary">Export PDF</button>
		<br /><br />
	</div>
		<div class="table-responsive table-bordered">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Type</th>
						<th>Area</th>
						<th>Alamat</th>
						<th>LT</th>
						<th>LB</th>
						<th>KT</th>
						<th>KM</th>
						<th>Sertfikat</th>
						<th class="col-md-2">Marketing</th>
						<th class="col-md-2">Harga</th>
						<th>Keterangan</th>
						<th class="col-md-1">Expired Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					foreach($res as $row):
				?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row['type'] ?></td>
						<td><?php echo $row['area']?></td>
						<td><?php echo $row['addres_show'] ?></td>
						<td><?php echo $row['luas_tanah'] ?></td>
						<td><?php echo $row['luas_bangunan'] ?></td>
						<td><?php echo $row['jml_kt'] ?></td>
						<td><?php echo $row['jml_km'] ?></td>
						<td><?php echo $row['sertifikat'] ?></td>
						<td>
						
							<?php if ($row['me_1']!=''):echo 'ME 1 : '.$row['me_1'];endif;?><br>
							<?php if ($row['me_2']!=''):echo 'ME 2 : '.$row['me_2'];endif;?><br>
							<?php if ($row['me_3']!=''):echo 'ME 3 : '.$row['me_3'];endif;?>
						
						</td>
						<td>
						
						<?php if ($row['price_sell']!=0):echo 'Jual : '.FormatRupiah($row['price_sell']);endif;?><br>
						<?php if ($row['price_rent']!=0):echo 'Sewa : '.FormatRupiah($row['price_rent']);endif;?><br>
						
						</td>
						<td><?php echo $row['ket_prop'] ?></td>
						<td><?php echo GetExpired($row['date_listing'],getOption('expired'))?></td>
						<td>
						<td>
							<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
								<span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
								<li><a href="#" onClick="DetailListingUmum(<?php echo $row["id_listing"];?>)">Lihat Umum</a></li>
								<li><a href="#" onClick="DetailListing(<?php echo $row["id_listing"];?>)">Lihat Detail</a></li>
								<li class="divider"></li>
								<li><a href="#" onClick="EditListing(<?php echo $row["id_listing"];?>)">Edit</a></li>
								</ul>
							</div>
						</td>
					</tr>
				<?php 
					$no++;
					endforeach;
				?>
				</tbody>
			</table>
		</div>
	

				