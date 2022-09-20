<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');

$allRows = 0;
$Query = "select count(*) as numOfRows from testimonial";
$Result = mysqli_query($connection, $Query);
if (mysqli_num_rows($Result) > 0) {
    $arr = mysqli_fetch_array($Result);
    $allRows = $arr['numOfRows'];
}

$num_rows = 4;

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">testimonials</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">testimonial</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>All testimonials</h4>
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
                            $Query = "select * from testimonial order by id desc limit $num_rows";
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
                <input type="hidden" id="fileName" value="fetchData_testimonial.php">
            </div>
        </div>

    </div>
</div>

<?php
include('./includes/footer.php');
include('./includes/scripts.php');
?>