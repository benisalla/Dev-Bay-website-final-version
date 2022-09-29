<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');

$allRows = 0;
$Query = "select count(*) as numOfRows from users";
$Result = mysqli_query($connection, $Query);
if (mysqli_num_rows($Result) > 0) {
    $arr = mysqli_fetch_array($Result);
    $allRows = $arr['numOfRows'];
}

$num_rows = 4;

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Users</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4>Registered Users</h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered text-center">

                        <thead>
                            <th>Image</th>
                            <th>State</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Profession</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>ID</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $Query = "select * from users order by id limit $num_rows";
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
                        </tbody>
                    </table>

                    <a href='./add_user_page.php'><button class="btn btn-secondary float-end">
                            <i class='fa fa-user-plus' style='color: white'></i>
                        </button></a>
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
                <input type="hidden" id="fileName" value="fetchData_user.php">
            </div>
        </div>



    </div>
</div>

<?php
include('./includes/footer.php');
include('./includes/scripts.php');
?>