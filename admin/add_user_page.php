<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Adding A User</li>
    </ol>
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h4>New User
                        <a href='./registered_users.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                    </h4>
                </div>

                <div class="card-body">
                    <!-------------------------------------->
                    <form action="./add_user_code.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Fname">First Name</label>
                                <input type="text" name="fname" required class="form-control" id="Fname">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Lname">Last Name</label>
                                <input type="text" name="lname" required class="form-control" id="Lname">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Profession">Profession</label>
                                <input type="text" name="profession" required class="form-control" id="Profession">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Email">Email</label>
                                <input type="email" name="email" required class="form-control" id="Email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Password">Password</label>
                                <input type="password" name="password" required class="form-control" id="Password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Role">Role</label>
                                <select name="role" id="Role" required class="form-control">
                                    <option style="display: none;"> Select The Role </option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Image">Image</label>
                                <input type="file" name="image" required class="form-control" id="Image">
                            </div>
                            <div class="col-md-6 mb-3 flex ">
                                <label for="Status">Status</label>
                                <input type="checkbox" name='status[]' width="80px" height="80px" id="Status">
                            </div>

                            <div class="col-md-6 mb-3">
                                <button type="submit" name="save_btn" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>

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