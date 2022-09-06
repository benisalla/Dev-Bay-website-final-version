<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Comments</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Editing A Comment</li>
    </ol>
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h4>Edit Comment
                        <a href='./view_comment.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                    </h4>
                </div>

                <div class="card-body">
                    <!-------------------------------------->
                    <?php
                    if (isset($_GET['id'])) :
                        $id = $_GET['id'];
                        $Query = "select * from comment where id = '$id'";
                        $Result = mysqli_query($connection, $Query);

                        if (mysqli_num_rows($Result) > 0) :
                            foreach ($Result as $comment) : ?>

                                <form action="./edit_comment_code.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="Author">Author</label>
                                            <select name="author" id="Author" class="form-control">
                                                <option style="display: none;"> Select Author </option>
                                                <?php
                                                    $AuthorQuery = "select * from users";
                                                    $AuthorResult = mysqli_query($connection, $AuthorQuery);
                                                    if(mysqli_num_rows($AuthorResult) > 0){
                                                        foreach($AuthorResult as $Author){
                                                            ?>
                                                            <option <?= $comment['user_id'] == $Author['id'] ? 'selected' : '' ?> value="<?= $Author['id'] ?>"><?= $Author['firstname']." ".$Author['lastname']?></option>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo "UnKnown";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Lang">Language</label>
                                            <select name="lang" id="Lang" class="form-control">
                                                <option style="display: none;"> Select Language </option>
                                                <option <?= $comment['lang'] == 'en' ? 'selected' : '' ?> value="en">English</option>
                                                <option <?= $comment['lang'] == 'fr' ? 'selected' : '' ?> value="fr">Frensh</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="Body">Body</label>
                                            <textarea name="body" required class="form-control" id="Body"><?= $comment['body']; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Cdata">Created At</label>
                                            <input value="<?= $comment['created_at']; ?>" type="date" name="cdate" required class="form-control" id="Cdata">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Udata">Updated At</label>
                                            <input value="<?= $comment['updated_at']; ?>" type="date" name="udate" required class="form-control" id="Udata">
                                        </div>
                                        <div class="col-md-6 mb-3 flex ">
                                            <label for="State">State</label><br>
                                            <input <?= $comment['state'] == '1' ? 'checked' : '' ?>  type="checkbox" name='state[]' width="100px" height="100px" id="State">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <button value="<?= $id ?>" type="submit" name="save_btn" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>

                            <?php endforeach; ?>

                        <?php else : ?>
                            <h2 class="bg-danger text-center">
                                There is no records !!
                            </h2>
                        <?php endif; ?>
                    <?php else : ?>
                        <h2 class="bg-danger text-center">
                            Oups, There something went wrong !!
                        </h2>
                    <?php endif; ?>

                    <!-------------------------------------->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./includes/footer.php');
include('./includes/scripts.php');
?>