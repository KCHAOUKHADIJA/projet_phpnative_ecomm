<?php require_once('header.php'); ?>
<section class="content">
	<!-- Categories -->
	<div class="orders">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title" v-if="headerText">Categories</strong>
						<div class="content-header-right float-right">
							<a href="end-category-add.php" class="btn btn-primary btn-sm">Add New</a>
						</div>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th>ID</th>
										<th>Category Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$statement = $pdo->prepare("SELECT * 
                                    FROM tbl_end_category t1
                                    ORDER BY t1.ecat_id DESC
                                    ");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);
									foreach ($result as $row) {
										$i++;
									?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['ecat_name']; ?></td>
											<td>
												<a href="end-category-edit.php?id=<?php echo $row['ecat_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
												<a href="#" class="btn btn-danger btn-sm" data-href="end-category-delete.php?id=<?php echo $row['ecat_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
											</td>
										</tr>
									<?php
									}
									?>

								</tbody>
							</table>
						</div> <!-- /.table-stats -->
					</div>
				</div> <!-- /.card -->
			</div> <!-- /.col-lg-8 -->


		</div>
	</div>
	<!-- /.orders -->



</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure want to delete this category?</p>
				<p style="color:red;">Be careful! All products under this category will be deleted.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a class="btn btn-danger btn-ok">Delete</a>
			</div>
		</div>
	</div>
</div>