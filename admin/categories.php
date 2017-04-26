<?php include "includes/admin_header.php";?>
<?php include "functions.php"; ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

    

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            Categories
                        </h1>
                        <hr>

                            <?php insertCategories(); ?>

                            <form action="" method="post">
                                <div class="add-category-form">
                                <div class="row">
                                    <h6>Bulk options</h6>

                                    <div class="form-group col-sm-12">
                                        <label for="cat_title">Add Category</label>
                                        <input class="form-control" type="text" name="cat_title" placeholder="Insert category name...">
                                    </div>

                                    <input id="add-category" class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                    
                                    <input id="delete-categories" type="submit" class="btn btn-secondary" value="Delete Categories" name="bulk_options">

                                    
                                </div>
                                </div>
                            

                            <?php if(isset($_GET['edit'])){ include "includes/update_categories.php"; } ?>

                            

                        <div class="table-container">

                            

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><input id="select-all" type="checkbox"></th>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!--FIND AND DISPLAY ALL CATEGORIES QUERY-->
                                    <?php displayCategories(); ?>

                                    <!--DELETE CATEGORIES-->
                                    <?php deleteCategories(); ?>

                                </tbody>
                            </table>
                        </div>
                        
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    

<?php include "includes/admin_footer.php";?>