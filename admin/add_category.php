<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Adding A Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h4>New Category
                        <a href='./index.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                    </h4>
                </div>

                <div class="card-body">
                    <!-------------------------------------->
                    <form action="./add_category_code.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Slug">Category Slug</label>
                                <input type="text" name="slug" required class="form-control" id="Slug">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Name">Category Name</label>
                                <input type="text" name="name" required class="form-control" id="Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Date">Update At</label>
                                <input type="date" name="date" required class="form-control" id="Date">
                            </div>

                            <div class="col-md-12 mb-3">
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