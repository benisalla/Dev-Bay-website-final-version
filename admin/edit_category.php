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
                    <h4>Edit Category
                        <a href='./view_category.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                    </h4>
                </div>

                <div class="card-body">
                    <!-------------------------------------->
                    <?php
                        if (isset($_GET['id'])):
                            $id = $_GET['id'];
                            $Query = "select * from category where id = '$id'";
                            $Result = mysqli_query($connection, $Query);
                        
                            if (mysqli_num_rows($Result) > 0) :
                                foreach ($Result as $cate) : ?>

                                    <form action="./edit_category_code.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="Slug">Category Slug</label>
                                                <input value="<?= $cate['slug'] ?>" type="text" name="slug" required class="form-control" id="Slug">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="Name">Category Name</label>
                                                <input value="<?= $cate['name'] ?>" type="text" name="name" required class="form-control" id="Name">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="UDate">Update At</label>
                                                <input value="<?= $cate['updated_at'] ?>" type="date" name="udate" required class="form-control" id="UDate">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="CDate">Created At</label>
                                                <input value="<?= $cate['created_at'] ?>" type="date" name="cdate" required class="form-control" id="CDate">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <button value="<?= $cate['id'] ?>" type="submit" name="save_btn" class="btn btn-primary">Save</button>
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