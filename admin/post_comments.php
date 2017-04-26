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
                            Post Comments
                        </h1>
                        <hr>

                        <form action="" method="post">
                            <div class="view-posts-form">
                                <div class="row">
                                    <h6>Bulk options</h6>

                                    <div  class="form-group col-sm-12">
                                        <select class="form-control" name="bulk_options" id="">
                                            <option value="">Select Options</option>
                                            <option value="Published">Publish</option>
                                            <option value="Draft">Draft</option>
                                            <option value="delete">Delete</option>
                                            <option value="clone">Clone</option>
                                        </select>

                                    </div>

                                    <input id="apply-bulk" type="submit" name="submit" class="btn btn-primary" value="Apply">
                                    <a id="add-post" href="posts.php?source=add_post" class="btn btn-secondary">Add Post</a>
                                    
                                </div>
                            </div>
                            


                            
                            <div class="table-container">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Post ID</th>
                                            <th>Author</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>In Response to</th>
                                            <th>Date</th>
                                            <th>Approve</th>
                                            <th>Decline</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php displayCommentTable();?>

                                        <?php deleteComments('post');?>

                                        <?php approveComment('post');?>

                                        <?php rejectComment('post');?>

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