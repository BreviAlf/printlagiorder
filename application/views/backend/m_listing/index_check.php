
		<div class="table-responsive table-bordered">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Type</th>
						<th>Area</th>
						<th>Alamat</th>
						<th>Spesifikasi</th>
						<th>Marketing</th>
						<th>Sertfikat</th>
						<th>Harga</th>
						<th>Keterangan</th>
						<th>Expired Date</th>
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
						<td>
							LT : <?php echo $row['luas_tanah'] ?><br>
							LB : <?php echo $row['luas_bangunan'] ?><br>
							KT : <?php echo $row['jml_kt'] ?><br>
							KM : <?php echo $row['jml_km'] ?>
						</td>
						<td>
							ME 1 :<?php echo $row['me_1'];?><br>
							ME 2 :<?php echo $row['me_2'];?><br>
							ME 3 :<?php echo $row['me_3'];?>
						</td>
						<td><?php echo $row['sertifikat'] ?></td>
						<td><?php echo FormatRupiah($row['price_sell']);?></td>
						<td><?php echo $row['ket_prop'] ?></td>
						<td><?php echo GetExpired($row['date_listing'],getOption('expired'))?></td>
					</tr>
				<?php 
					$no++;
					endforeach;
				?>
				</tbody>
			</table>
		</div>