<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;


    if(empty($_POST['ecat_name'])) {
        $valid = 0;
        $error_message .= "Category name can not be empty<br>";
    }

    if($valid == 1) {    	
		// updating into the database
		$statement = $pdo->prepare("UPDATE tbl_end_category SET ecat_name=? WHERE ecat_id=?");
		$statement->execute(array($_POST['ecat_name'],$_REQUEST['id']));

    	$success_message = 'Category is updated successfully.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * 
                            FROM tbl_end_category t1
                            WHERE t1.ecat_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>
<section class="content">
	<!-- Categories -->
	<div class="categories">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title" v-if="headerText">Update Categorie</strong>
						<div class="content-header-right float-right">
							<a href="end-category.php" class="btn btn-primary btn-sm">View All Categories</a>
						</div>
					</div>



<?php							
foreach ($result as $row) {
	$ecat_name = $row['ecat_name'];}
?>

<div class="card-body">

		<?php if($error_message): ?>
		<div class="callout callout-danger">
		
		<p>
		<?php echo $error_message; ?>
		</p>
		</div>
		<?php endif; ?>

		<?php if($success_message): ?>
		<div class="callout callout-success">
		
		<p><?php echo $success_message; ?></p>
		</div>
		<?php endif; ?>

        <form class="form-horizontal" action="" method="post">

        <div class="box box-info">

            <div class="card-body">


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Category Name <span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="ecat_name" value="<?php echo $ecat_name; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                	<label for="" class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-success pull-left" name="form1" >Update</button>
                    </div>
                </div>

            </div>

        </div>

        </form>



    </div>
  </div>
			</div>
		</div>
	</div>
	</

</section>


