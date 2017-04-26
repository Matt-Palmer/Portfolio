

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php 
                            if(isset($_GET['template-style'])){
                                $template_style = $_GET['template-style'];
                            }else{
                                $template_style = '';
                            }
                        
                            switch($template_style){

                                case '1':
                                include 'templates/template_one.php';
                                break;

                                case 'edit_post':
                                include 'includes/edit_post.php';
                                break;

                                case '23':
                                echo '';
                                break;

                                case '98':
                                echo '';
                                break;

                                
                            }
                        ?>
                    </div>   
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        