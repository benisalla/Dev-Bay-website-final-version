<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');

$allRows = 0;
$Query = "select count(*) as numOfRows from post";
$Result = mysqli_query($connection, $Query);
if (mysqli_num_rows($Result) > 0) {
    $arr = mysqli_fetch_array($Result);
    $allRows = $arr['numOfRows'];
}

$num_rows = 4;

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Posts</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>Posts</h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered text-center">

                        <thead>
                            <th>State</th>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Updated_at</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $Query = "select * from post ORDER by id desc LIMIT $num_rows";
                            $Result = mysqli_query($connection, $Query);
                            ?>
                            <?php if (mysqli_num_rows($Result) > 0) : ?>
                                <?php foreach ($Result as $post) : ?>
                                    <tr class="data_class">
                                        <td>
                                            <?= $post['state'] == '1' ? "<i class='fa fa-eye' style='color: green;'></i>" :
                                                "<i class='fa fa-eye-slash' style='color: red;'></i>"  ?>
                                        </td>
                                        <td><?= $post['id']; ?></td>
                                        <td><?php
                                            $user_id = $post['user_id'];
                                            $AuthorQuery = "select * from users where id = '$user_id'";
                                            $AuthorResult = mysqli_query($connection, $AuthorQuery);
                                            if (mysqli_num_rows($AuthorResult) > 0) {
                                                foreach ($AuthorResult as $Author) {
                                                    echo $Author['firstname'] . " " . $Author['lastname'];
                                                }
                                            } else {
                                                echo "UnKnown";
                                            }
                                            ?></td>
                                        <td><?php
                                            $category_id = $post['category_id'];
                                            $CategoryQuery = "select * from category where id = '$category_id'";
                                            $CategoryResult = mysqli_query($connection, $CategoryQuery);
                                            if (mysqli_num_rows($CategoryResult) > 0) {
                                                foreach ($CategoryResult as $category) {
                                                    echo $category['name'];
                                                }
                                            } else {
                                                echo "UnKnown";
                                            }
                                            ?></td>
                                        <td>
                                            <img src="../img/blog/<?= $post['image']!= '' ? $post['image'] : 'event.png'?>" alt="post's image" width="50px" height="50px">
                                        </td>
                                        <td><?= $post['updated_at'] ?></td>
                                        <td>
                                            <a href="./edit_post.php?id=<?= $post['id'] ?>">
                                                <button class="btn btn-secondary shadow-lg">
                                                    <i class='fas fa-edit' style='color: white;'></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="delete_post.php" method="POST">
                                                <button type="submit" name="delete_btn" value="<?= $post['id'] ?>" class="btn btn-secondary shadow-lg">
                                                    <i class='fa fa-trash' style='color: white;'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="12" class="bg-danger text-center">
                                        No Records !!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <hr>

        <div class="d-flex flex-row justify-content-between align-items-center mb-2">
            <div class="shortHint">
                Show More ...
            </div>
            <div>
                <button type="button" class="btn btn-primary display_more"><i class="fa fa-chevron-down"></i></button>
                <input type="hidden" id="numOfRows" value="0">
                <input type="hidden" id="allRows" value="<?= $allRows ?>">
                <input type="hidden" id="fileName" value="fetchData_post.php">
            </div>
        </div>

    </div>
</div>

<?php
include('./includes/footer.php');
include('./includes/scripts.php');
?>