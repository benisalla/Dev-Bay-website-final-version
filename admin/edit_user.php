<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Editting A User</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">

                <div class="card-header">
                    <h4>Registered Users
                        <a href='./registered_users.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                    </h4>
                </div>

                <div class="card-body">
                    <!-------------------------------------->
                    <?php
                    if (isset($_GET['id'])):
                        $id = $_GET['id'];
                        $Query = "select * from users where id = '$id'";
                        $Result = mysqli_query($connection, $Query);
                    
                        if (mysqli_num_rows($Result) > 0) :
                            foreach ($Result as $user) : ?>

                                <form action="./update_user.php" method="POST">
                                    <input type="text" name='id' value="<?= $user['id']?>" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="Fname">First Name</label>
                                            <input value="<?= $user['firstname'] ?>" type="text" name="fname" required class="form-control" id="Fname">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Lname">Last Name</label>
                                            <input value="<?= $user['lastname'] ?>" type="text" name="lname" required class="form-control" id="Lname">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Email">Email</label>
                                            <input value="<?= $user['email'] ?>" type="email" name="email" required class="form-control" id="Email">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Password">Password</label>
                                            <input type="password" name="password" required class="form-control" id="Password">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Role">Role</label>
                                            <select name="role" id="Role" required class="form-control">
                                                <option style="display: none;"> Select The Role </option>
                                                <option value="1" <?= $user['role_as'] == '1' ? 'selected' : '' ?>>Admin</option>
                                                <option value="0" <?= $user['role_as'] == '0' ? 'selected' : '' ?>>User</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3 flex ">
                                            <label for="Status">Status</label>
                                            <input <?= $user['status'] == '1' ? 'checked' : '' ?> type="checkbox" name='status[]' width="80px" height="80px" id="Status">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <button type="submit" name="save_btn" class="btn btn-primary">Save</button>
                                        </div>

                                    </div>

                                </form>

                            <?php endforeach; ?>
                        <?php else : ?>
                            <h2 class="bg-danger text-center">
                                There is no records !!
                            </h2>
                        <?php endif; ?>

                    <?php else : ?>
                        <h2 class="bg-danger text-center">
                            Oups, There something went wrong !!
                        </h2>
                    <?php endif; ?>

                    <!-------------------------------------->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./includes/footer.php');
include('./includes/scripts.php');
?>