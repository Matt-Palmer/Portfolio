<h1 class="page-header">Add Images</h1>
<hr>





<form id="add-image-form" action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div id="add-images" class="form-group col-sm-12">
            <label for="title">Select Images</label>
            <input type="file" class="form-control" name="image1">
        </div>

        <div class="form-group col-sm-12">
            <label for="title">Album</label>
            <select class="form-control" name="image_album_id" id="album">
                <option value="0">Undefined</option>
                <?php 
                    $edit_query = "SELECT * FROM album";

                    $select_categories_id = mysqli_query($connection, $edit_query);

                    while($row = mysqli_fetch_assoc($select_categories_id)){
                        $album_id = $row['album_id'];
                        $album_title = $row['album_title'];

                        echo "<option value='$album_id'>$album_title</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group col-sm-12">
            <label for="title">Image State</label>
            <select class="form-control" name="image_status" id="image_status">
                <option value="default">Default</option>
                <option value="main">Main</option>
            </select>
        </div>

        <div class="form-group col-sm-12">
            <label for="image_tags">Image Tags</label>
            <input type="text" class="form-control" name="image_tags">
        </div>

        <?php insertGalleryImagesForTemplateTwo()?>

        <div class="form-group col-sm-12">
            <input id="add-image" type="submit" class="btn btn-primary" name="submit-images" value="Add Image">
        </div>
    </div>
</form>

                

