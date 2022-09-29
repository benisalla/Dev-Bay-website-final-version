<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Categories</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>Categories</h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered text-center">

                        <thead>
                            <th>ID</th>
                            <th>Slug</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $Query = "select * from category";
                            $Result = mysqli_query($connection, $Query);
                            ?>
                            <?php if (mysqli_num_rows($Result) > 0) : ?>
                                <?php foreach ($Result as $cate) : ?>
                                    <tr>
                                        <td><?= $cate['id']; ?></td>
                                        <td><?= $cate['slug']; ?></td>
                                        <td><?= $cate['name']; ?></td>
                                        <td><?= $cate['created_at'] ?></td>
                                        <td><?= $cate['updated_at'] ?></td>
                                        <td>
                                            <a href="./edit_category.php?id=<?= $cate['id'] ?>">
                                                <button class="btn btn-secondary shadow-lg">
                                                    <i class='fas fa-edit' style='color: white;'></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="delete_category.php" method="POST">
                                                <button type="submit" name="delete_btn" value="<?= $cate['id'] ?>" class="btn btn-secondary shadow-lg">
                                                    <i class='fa fa-trash' style='color: white;'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="bg-danger text-center">
                                        No Records !!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include('./includes/footer.php');
include('./includes/scripts.php');
?>