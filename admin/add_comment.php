<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Comments</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">DashBoard</li>
        <li class="breadcrumb-item">Adding A Comment</li>
    </ol>
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h4>New Comment
                        <a href='./index.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                    </h4>
                </div>

                <div class="card-body">
                    <!-------------------------------------->
                    <form action="./add_comment_code.php" method="POST">
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
                                                <option value="<?= $Author['id'] ?>"><?= $Author['firstname']." ".$Author['lastname']?></option>
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
                                    <option value="en">English</option>
                                    <option value="fr">Frensh</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="Body">Body</label>
                                <textarea name="body" required class="form-control" id="Body"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Cdata">Created At</label>
                                <input type="date" name="cdate" required class="form-control" id="Cdata">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Udata">Updated At</label>
                                <input type="date" name="udate" required class="form-control" id="Udata">
                            </div>
                            <div class="col-md-6 mb-3 flex ">
                                <label for="State">State</label><br>
                                <input type="checkbox" name='state[]' width="100px" height="100px" id="State">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="save_btn" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>

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