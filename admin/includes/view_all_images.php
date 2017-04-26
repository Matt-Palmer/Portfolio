<!-- Page Heading -->
<h1 class="page-header">Categories</h1>
<?php

if(isset($_POST['checkboxArray'])){
    foreach($_POST['checkboxArray'] as $checkboxValue){
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options){

            case 'delete':
            $query = "DELETE FROM gallery WHERE image_id = '$checkboxValue'";
            $delete_query = mysqli_query($connection, $query);
            break;

            case 'clone':
            $clone_query = "SELECT * FROM gallery WHERE image_id = '$checkboxValue'";
            $clone_posts = mysqli_query($connection, $clone_query);

            while($row = mysqli_fetch_assoc($clone_posts)){

                $imageOne = $row['image_one'];
                $image_tags = $row['image_tags'];
                $date = gmdate("y-m-d h:i:s");

            }

            $query = "INSERT INTO gallery(image_tags, image_date, image_one) ";
            $query .= "VALUES('$image_tags', '$date', '{$imageOne}')";

            $create_image_query = mysqli_query($connection, $query);

            if(confirmQuery($create_image_query)){
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
    <div class="view-images-form">
        <div class="row">
            <h6>Bulk options</h6>

            <div  class="form-group col-sm-12">
                <select class="form-control" name="bulk_options" id="">
                    <option value="">Select Options</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                </select>
            </div>

            <input id="apply-bulk" type="submit" name="submit" class="btn btn-primary" value="Apply">
            <a id="add-image" href="gallery.php?source=add_image" class="btn btn-secondary">Add Image</a>
        </div>
    </div>


    <div class="table-container">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><input id="select-all" type="checkbox"></th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $display_images = "SELECT * FROM gallery";
                    $display_images_query = mysqli_query($connection, $display_images);

                    while($row = mysqli_fetch_assoc($display_images_query)){

                        $image_id = $row['image_id'];
                        $image_one = $row['image_one'];
                        $image_date = $row['image_date'];

                        echo "</tr>";
                        echo "<td><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='{$image_id}'></td>";
                        echo "<td>{$image_id}</td>";
                        echo "<td>"; 
                        echo '<div class="image-container">';
                        echo "<img src='../images/$image_one'>";
                        echo '</div>';
                        echo "</td>";
                        echo "<td>{$image_date}</td>";
                        echo "</tr>";

                    }
                ?>
            </tbody>
        </table>
    </div>
</form>  

