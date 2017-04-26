<h1 class="page-header">
    Add Post
</h1>
<hr>
<form id="add-post-form" action="" method="post" enctype="multipart/form-data">

    <?php addPost(); ?>
    <div class="row">

        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
        </div>         

        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                <label for="category">Category</label>
                <select class="form-control" name="post_category_id" id="">
                    <option value="">Select option</option>
                    <?php 
                        $edit_query = "SELECT * FROM categories";

                        $select_categories_id = mysqli_query($connection, $edit_query);

                        while($row = mysqli_fetch_assoc($select_categories_id)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<option value='$cat_id'>$cat_title</option>";
                        }
                    ?>
                </select>
        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="author">Post Author</label>
            <input type="text" class="form-control" name="author">
        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                <label for="publish-options">Publish Options</label>
                <select class="form-control" name="status" id="">
                    <option value="Draft">Select option</option>
                    <option value="Draft">Draft</option>
                    <option value="Published">Publish</option>
                </select>
        </div>

        <div  class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="">Post Image</label>
            <input id="image-select" type="file" id="file" name="image" class="form-control">
        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="tags">Post Tags</label>
            <input type="text" class="form-control" name="tags">
        </div>

        <div id="post-content" class="form-group col-sm-12">
            <label for="content">Post Content</label>
            <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group col-sm-12 ">
            <input id="publish-post" type="submit" class="btn btn-primary" name="create-post" value="Publish Post">
        </div>
    </div>
</form>