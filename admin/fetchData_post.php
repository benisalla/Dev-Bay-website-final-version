<?php
include('./authCode.php');
$numOfRows = $_POST['numOfRows'];
$amount = 4;


$Query = "select * from post order by id desc limit $numOfRows,$amount";
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