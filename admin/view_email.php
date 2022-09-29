<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');

$allRows = 0;

$Query = "select count(*) as numOfRows from email";
$Result = mysqli_query($connection, $Query);
if (mysqli_num_rows($Result) > 0) {
    $arr = mysqli_fetch_array($Result);
    $allRows = $arr['numOfRows'];
}

$num_rows = 4;
?>


<div class="container">
    <div class="row">
        <div class="d-flex  justify-content-between bg-light py-2">
            <h4>Emails</h4>
            <a href='./index.php'><button class="btn btn-primary float-end rounded">Back</button></a>
        </div>

        <div class="col-lg-12">
            <div class="btn-toolbar float-end mb-3" role="toolbar">
                <div class="btn-group">
                    <button type="button" class="btn btn-success"><i class="fa fa-inbox"></i></button>
                    <button type="button" class="btn btn-success"><i class="fa fa-star"></i></button>
                    <button type="button" class="btn btn-success"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default m-t-20">
        <div class="panel-body">
            <table class="table table-hover mails">
                <tbody>
                    <?php

                    $Query = "select * from email ORDER by id desc LIMIT $num_rows";
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
                                        <button type="submit" name="delete_btn" value="<?= $email['id'] ?>"
                                            style="background-color: rgba(255, 255, 255, 0); border: none">
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
                </tbody>
            </table>

            <hr>

            <div class="d-flex flex-row justify-content-between align-items-center mb-2">
                <div class="shortHint">
                    Show More ...
                </div>
                <div>
                    <button type="button" class="btn btn-primary display_more"><i class="fa fa-chevron-down"></i></button>
                    <input type="hidden" id="numOfRows" value="0">
                    <input type="hidden" id="allRows" value="<?= $allRows ?>">
                    <input type="hidden" id="fileName" value="fetchData_Email.php">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./includes/footer.php');
include('./includes/scripts.php');
?>