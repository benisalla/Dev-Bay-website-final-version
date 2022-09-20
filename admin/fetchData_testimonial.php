<?php
include('./authCode.php');
$numOfRows = $_POST['numOfRows'];
$amount = 4;


$Query = "select * from testimonial order by id desc limit $numOfRows,$amount";
$Result = mysqli_query($connection, $Query);
?>
<?php if (mysqli_num_rows($Result) > 0) : ?>
    <?php foreach ($Result as $testimonial) : ?>
        <tr class="data_class">
            <td>
                <?= $testimonial['state'] == '1' ? "<i class='fa fa-eye' style='color: green;'></i>" :
                    "<i class='fa fa-eye-slash' style='color: red;'></i>"  ?>
            </td>
            <td><?= $testimonial['id']; ?></td>
            <?php
            $id = $testimonial['user_id'];
            $AuthorQuery = "select * from users where id = '$id'";
            $AuthorResult = mysqli_query($connection, $AuthorQuery);
            if (mysqli_num_rows($AuthorResult) > 0) :
                foreach ($AuthorResult as $Author) : ?>
                    <td><?= $Author['firstname'] ?></td>
                    <td>
                        <img src="../img/users/<?= $Author['image'] != '' ? $Author['image'] : 'profile.png' ?> " width="50px" height="50px" style="border-radius: 50%;">
                    </td>
                <?php endforeach; ?>
            <?php else : ?>
                <td>UnKnown</td>
                <td>
                    <img src="../img/users/profile.png" width="50px" height="50px" style="border-radius: 50%;" alt="UnKnown">
                </td>
            <?php endif; ?>

            <td>
                <?= $testimonial['lang'] == 'en' ? 'English' : 'Frensh' ?>
            </td>
            <td><?= $testimonial['created_at'] ?></td>
            <td><?= $testimonial['updated_at'] ?></td>
            <td>
                <a href="./edit_testimonial.php?id=<?= $testimonial['id'] ?>">
                    <button class="btn btn-secondary shadow-lg">
                        <i class='fas fa-edit' style='color: white;'></i>
                    </button>
                </a>
            </td>
            <td>
                <form action="delete_testimonial.php" method="POST">
                    <button type="submit" name="delete_btn" value="<?= $testimonial['id'] ?>" class="btn btn-secondary shadow-lg">
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