<?php include "includes/admin_header.php";?>
<?php include "functions.php"; ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php 
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }else{
                                $source = '';
                            }
                        
                            switch($source){

                                case 'add_image':
                                include 'includes/add_image.php';
                                break;

                                case 'view_all':
                                include 'includes/view_all_images.php';
                                break;

                                case 'view_albums':
                                include 'includes/view_albums.php';
                                break;

                                case '98':
                                echo '';
                                break;
                            }
                        ?>
                    </div>   
                </div>
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        
<?php include "includes/admin_footer.php";?>