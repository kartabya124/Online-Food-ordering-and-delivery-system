<div class="container-fluid" style="margin-top:98px">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="partials/handleuser.php" method="post" enctype="multipart/form-data">
				<div class="card mb-3">
					<div class="card-header" style="background-color: rgb(111 202 203);">
						ADD New Resturant
				  	</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">UserName: </label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<textarea cols="30" rows="3" class="form-control" name="email" required></textarea>
							</div>
                            <div class="form-group">
								<label class="control-label">Phone</label>
								<input type="number" class="form-control" name="phone" required min="10">
							</div>	
							<div class="form-group">
								<label class="control-label">User Type</label>
								<select name="usertype" id="usertype" class="custom-select browser-default" required>
								<option hidden disabled selected value>None</option>
								<option value="1">1 Resturant</option>
								<option value="2">2 Users</option>

                               
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Address</label>
								<input type="text" class="form-control" name="address" required>
							</div>
							<div class="form-group">
								<label class="control-label">Password</label>
								<input type="text" class="form-control" name="password" required>
							</div>
							<div class="form-group">
								<label for="image" class="control-label">Image</label>
								<input type="file" name="image" id="image" class="form-control" required style="border:none;">
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="mx-auto">
								<button type="submit" name="createUser" class="btn btn-sm btn-primary"> ADD</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover mb-0">
							<thead style="background-color: rgb(111 202 203);">
								<tr>
									<th class="text-center" style="width:7%;">Resturant. Id</th>
									<th class="text-center">Img</th>
									<th class="text-center" style="width:58%;">Item Detail</th>
									<th class="text-center" style="width:18%;">Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php
                                $sql = "SELECT * FROM user WHERE usertype=1";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $uid = $row['id'];
                                    $username = $row['username'];
                                    $email = $row['email'];
                                    $phone = $row['phone'];
                                    $address = $row['Address'];


                                    ?>
                                    <tr>
                                            <td class="text-center"><?=$uid;?></td>
                                            <td>
                                                <img src="img/<?=$row['Photo'];?>" alt="image for this item" width="150px" height="150px">
                                            </td>
                                            <td>
                                                <p>Name : <b><?=$username;?></b></p>
                                                <p>Email : <b class="truncate"><?=$email;?></b></p>
                                                <p>Phone : <b><?=$phone;?></b></p>
                                                 <p>Address : <b><?=$address;?></b></p>
                                            </td>
                                            <td class="text-center">
												<div class="row mx-auto" style="width:112px">
													<button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#updateItem<?=$uid;?>">Edit</button>
													<form action="partials/handleuser.php" method="POST">
														<button name="removeItem" class="btn btn-sm btn-danger" style="margin-left:9px;">Delete</button>
														<input type="hidden" name="uid" value="'<?=$uid?>'">
													</form>
												</div>
                                            </td>
                                        </tr>
                               <?php   }
                            ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	
</div>
<?php 
    $sql = "SELECT * FROM `user`";
    $Result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($Result)){
       $uid = $row['id'];
	    $username = $row['username'];
	    $email = $row['email'];
	    $phone = $row['phone'];
	    $address = $row['Address'];
	?>

<!-- Modal -->
<div class="modal fade" id="updateItem<?php echo $uid; ?>" tabindex="-1" role="dialog" aria-labelledby="updateItem<?php echo $uid; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="updateItem<?php echo $uid; ?>">Resturant Id: <?php echo $uid; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="partials/handleuser.php" method="post">
            <div class="text-left my-2">
                <b><label for="name">Userame</label></b>
                <input class="form-control" id="name" name="username" value="<?php echo $username; ?>" type="text" required>
            </div>
			<div class="text-left my-2 row">
				<div class="form-group col-md-6">
                	<b><label for="price">Email</label></b>
                	<input class="form-control" id="email" name="email" value="<?php echo $email; ?>" type="email" required>
				</div>
				<div class="form-group col-md-6">
					<b><label for="catId">Phone</label></b>
                	<input class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" type="number" min="1" required>
				</div>
            </div>
            <div class="text-left my-2">
                <b><label for="desc">Address</label></b>
                <textarea class="form-control" id="address" name="address" rows="2" required minlength="6"><?php echo $address; ?></textarea>
            </div>
            <input type="hidden" id="id" name="uid" value="<?php echo $uid; ?>">
            <button type="submit" class="btn btn-success" name="updateItem">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
	}
?>