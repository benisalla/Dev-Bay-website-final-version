<?php
include('./authCode.php');
$numOfRows = $_POST['numOfRows'];
$amount = 4;


$Query = "select * from users order by id desc limit $numOfRows,$amount";
$Result = mysqli_query($connection, $Query);
?>

<?php if (mysqli_num_rows($Result) > 0) : ?>
    <?php foreach ($Result as $user) : ?>
        <tr class="data_class">
            <td>
                <img src="../img/users/<?= $user['image'] !== '' ? $user['image'] : 'profile.png' ?>" width="50px" height="50px" style="border-radius: 50%;">
            </td>
            <td><?= $user['status']; ?></td>
            <td><?= $user['firstname']; ?></td>
            <td><?= $user['lastname']; ?></td>
            <td><?= $user['profession']; ?></td>
            <td><?= $user['email'] ?></td>
            <td><?php
                if ($user['role_as'] == '1') {
                    echo "<i class='fas fa-user-tie' style='color:#350ff0'></i>";
                } else {
                    echo "<i class='fa fa-user' style='color:#2d2a2a'></i>";
                }
                ?></td>
            <td><?= $user['id'] ?></td>
            <td>
                <a href="./edit_user.php?id=<?= $user['id'] ?>">
                    <button class="btn btn-secondary shadow-lg">
                        <i class='fas fa-user-cog' style='color: white;'></i>
                    </button>
                </a>
            </td>
            <td>
                <form action="delete_user.php" method="POST">
                    <button type="submit" name="delete_btn" value="<?= $user['id'] ?>" class="btn btn-secondary shadow-lg">
                        <i class='fa fa-user-minus' style='color: white;'></i>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td>
            <h2 class="bg-danger text-center">
                No Records !!
            </h2>
        </td>
    </tr>
<?php endif; ?>