<?php
include('./authCode.php');
$numOfRows = $_POST['numOfRows'];
$amount = 4;

$Query = "select * from email ORDER by id desc LIMIT $numOfRows,$amount";
$Result = mysqli_query($connection, $Query);
if (mysqli_num_rows($Result) > 0) :
    foreach ($Result as $email) : ?>
        <tr class="text-center align-middle rounded data_class">
            <td class="mail-select py-3">
                <label class="cr-styled">
                    <input type="checkbox"><i class="fa"></i>
                </label>
            </td>
            <td class="mail-rateing">
                <i class="fa fa-star"></i>
                <!-- <i class="fa fa-star text-primary"></i> -->
            </td>
            <td>
                <?= $email['fullname'] ?>
            </td>
            <td>
                <i class="fa fa-info-circle me-2 text-primary"></i><?= $email['title'] ?>
            </td>
            <td class="text-right"><i class="fa fa-clock me-2 text-primary"></i>
                <?php
                $date = DateTime::createFromFormat('Y-m-d h:m:s', $email['created_at']);
                echo $date->format('h:m:s') . "  ";
                echo $date->format('d') . "/" . $date->format('m') . "/" . $date->format('Y');
                ?>
            </td>
            <td>
                <form action="./delete_email.php" method="POST">
                    <button type="submit" name="delete_btn" value="<?= $email['id'] ?>" style="background-color: rgba(255, 255, 255, 0); border: none">
                        <i class="fa fa-trash text-primary"></i>
                    </button>
                </form>
            </td>
            <?php if ($email['state'] == '0') : ?>
                <td><a href="./view_requist.php?id=<?= $email['id'] ?>"><i class="fa fa-envelope"></a></i></td>
            <?php else : ?>
                <td><a href="./view_requist.php?id=<?= $email['id'] ?>"><i class="fa fa-envelope-open"></a></i></td>
            <?php endif; ?>
        </tr>
    <?php endforeach;
    ?>
<?php else : ?>
    <tr>
        <td colspan="5">
            No Results
        </td>
    </tr>
<?php endif; ?>