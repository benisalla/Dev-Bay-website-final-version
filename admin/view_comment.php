<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Comments</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Comment</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>All Comments</h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered text-center">

                        <thead>
                            <th>State</th>
                            <th>ID</th>
                            <th>Author Name</th>
                            <th>Author Image</th>
                            <th>Language</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $Query = "select * from comment";
                            $Result = mysqli_query($connection, $Query);
                            ?>
                            <?php if (mysqli_num_rows($Result) > 0) : ?>
                                <?php foreach ($Result as $comment) : ?>
                                    <tr>
                                        <td>
                                            <?= $comment['state'] == '1' ? "<i class='fa fa-eye' style='color: green;'></i>" :
                                                                        "<i class='fa fa-eye-slash' style='color: red;'></i>"  ?>
                                        </td>
                                        <td><?= $comment['id']; ?></td>
                                        <?php 
                                            $id = $comment['user_id'];
                                            $AuthorQuery = "select * from users where id = '$id'";
                                            $AuthorResult = mysqli_query($connection, $AuthorQuery);
                                            if(mysqli_num_rows($AuthorResult) > 0):
                                                foreach($AuthorResult as $Author):?>
                                                    <td><?= $Author['firstname'] ?></td>
                                                    <td>
                                                        <img src="../img/users/<?=$Author['image']?> "width="50px" height="50px"
                                                            style = "border-radius: 50%;">
                                                    </td>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <td>UnKnown</td>
                                                <td>
                                                    <img src="" width="50px" height="50px"
                                                        style = "border-radius: 50%;" alt="UnKnown">
                                                </td>
                                            <?php endif; ?>

                                        <td> 
                                            <?= $comment['lang'] == 'en' ? 'English' : 'Frensh' ?>
                                        </td>
                                        <td><?= $comment['created_at'] ?></td>
                                        <td><?= $comment['updated_at'] ?></td>
                                        <td>
                                            <a href="./edit_comment.php?id=<?= $comment['id'] ?>">
                                                <button class="btn btn-secondary shadow-lg">
                                                    <i class='fas fa-edit' style='color: white;'></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="delete_comment.php" method="POST">
                                                <button type="submit" name="delete_btn" value="<?= $comment['id'] ?>" class="btn btn-secondary shadow-lg">
                                                    <i class='fa fa-trash' style='color: white;'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9" class="bg-danger text-center">
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