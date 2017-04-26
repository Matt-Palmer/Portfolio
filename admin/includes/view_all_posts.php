<h1 class="page-header">
    Posts
</h1>

<?php

    if(isset($_POST['checkboxArray'])){
        foreach($_POST['checkboxArray'] as $checkboxValue){
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options){

                case 'Published':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$checkboxValue'";
                $bulk_publish_update_query = mysqli_query($connection, $query);
                break;

                case 'Draft':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$checkboxValue'";
                $bulk_draft_update_query = mysqli_query($connection, $query);
                break;

                case 'delete':
                $query = "DELETE FROM posts WHERE post_id = '$checkboxValue'";
                $delete_query = mysqli_query($connection, $query);
                break;

                case 'clone':
                $clone_query = "SELECT * FROM posts WHERE post_id = '$checkboxValue'";
                $clone_posts = mysqli_query($connection, $clone_query);

                while($row = mysqli_fetch_assoc($clone_posts)){

                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_content = $row['post_content'];
                    $post_category_id = $row['post_category_id'];
                    $date = gmdate("y-m-d h:i:s");
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_status = $row['post_status'];

                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '$date', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

                $create_post_query = mysqli_query($connection, $query);

                if(confirmQuery($create_post_query)){
                    echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Post could not be created</h4>";
                }else{
                    echo "<h4 class='bg-success text-success' style='padding: 5px'>Post successfully created</h4>";

                }
                break;

            }
        }
    }

?>

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
                    <th><input id="select-all" type="checkbox"></th>
                    <th>Post ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>

                <?php displayPostData(); ?>

                <?php deletePost(); ?>

            </tbody>
        </table>
    </div>

</form>