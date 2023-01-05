<?php require_once('header.php'); ?>
<section class="content">
	<!-- Categories -->
	<div class="orders">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title" v-if="headerText">Products</strong>
						<div class="content-header-right float-right">
							<a href="product-add.php" class="btn btn-primary btn-sm">Add New</a>
						</div>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th>ID</th>
										<th>Photo</th>
										<th>Product Name</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Category</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$statement = $pdo->prepare("SELECT
														
														t1.p_id,
														t1.p_name,
													--	t1.p_old_price,
														t1.p_current_price,
														t1.p_qty,
														t1.p_featured_photo,
													
													--	t1.p_is_featured,
													--	t1.p_is_active,
														t1.ecat_id,
														t2.ecat_id,
														t2.ecat_name
							                           	FROM tbl_product t1
														JOIN tbl_end_category t2
														ON t1.ecat_id = t2.ecat_id
														ORDER BY t1.p_id DESC");
									/* 	JOIN tbl_end_category t2
							                           	ON t1.ecat_id = t2.ecat_id
							                           	JOIN tbl_mid_category t3
							                           	ON t2.mcat_id = t3.mcat_id
							                           	JOIN tbl_top_category t4
							                           	ON t3.tcat_id = t4.tcat_id 
							                           --	ORDER BY t1.p_id DESC*/

									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);
									foreach ($result as $row) {
										$i++;
									?>
										<tr>
											<td><?php echo $i; ?></td>
											<td style="width:82px;"><img src="../uploads/<?php echo $row['p_featured_photo']; ?>" alt="<?php echo $row['p_name']; ?>" style="width:80px;"></td>
											<td><?php echo $row['p_name']; ?></td>
											<td><?php echo $row['p_current_price']; ?> <span style="font-size:10px;font-weight:normal;">TND</span></td>
											<td><?php echo $row['p_qty']; ?></td>

											<td><?php echo $row['ecat_name']; ?></td>
											<td>
												<a href="product-edit.php?id=<?php echo $row['p_id']; ?>" class="btn btn-info btn-sm">Edit</a>
												<a href="#" class="btn btn-danger btn-sm" data-href="product-delete.php?id=<?php echo $row['p_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure want to delete this item?</p>
				<p style="color:red;">Be careful! This product will be deleted from the order table, payment table, size table, color table and rating table also.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a class="btn btn-danger btn-ok">Delete</a>
			</div>
		</div>
	</div>
</div>
