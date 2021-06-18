<?php
ob_start();
session_start();
include 'engine/database.php';
if (isset($_SESSION['id']))
{
    $kimlik = $_SESSION['id'];
    $sql = $con->prepare("SELECT * FROM admin");
    $sql->execute();
    $adminInfo=$sql->fetchAll(PDO::FETCH_OBJ);
    $classQuery = $con->prepare("SELECT * FROM policy_page");
    $classQuery->execute();
    $ClassCek=$classQuery-> fetchAll(PDO::FETCH_OBJ);
    $array = 1;
    $query  = $con -> prepare("SELECT * FROM policy_page WHERE id = :id");
    $query -> execute(['id' => $array]);
    $row    = $query -> fetchAll(PDO::FETCH_ASSOC);

}

else
{
    echo "403!";
    header('location:login.php?forbidden');
}
if (isset($_POST['kaydet'])) {
    // code...
    $icerik = $_POST['icerik'];
    try {
       $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sorgula = $con->prepare("UPDATE policy_page SET content = ? WHERE id = 1");
       $sorgula->bindParam(1, $icerik, PDO::PARAM_STR);
       $sorgula->execute();
        ?>
        <div class="alert alert-success alert-dismissible fade in">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    Sayfa Güncellendi. Panel Yenileniyor !
                                                </div>
                                        <?php
                                        header('refresh:2;url=settings.php');
    } catch (PDOException $e) {
        die($e->getMessage());
    }

  }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Yönetim Paneli | İçerik Yönetimi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://cdn.ckeditor.com/4.8.0/standard-all/ckeditor.js"></script>
    <link rel="shortcut icon" href="vendor/assets/images/favicon.ico">
    <link href="vendor/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="vendor/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="vendor/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="vendor/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <link href="vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="vendor/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>


    <link href="vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- Summernote css -->
    <link href="vendor/assets/plugins/summernote/summernote.css" rel="stylesheet" />
        <!--bootstrap-wysihtml5-->
        <link rel="stylesheet" type="text/css" href="vendor/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css">

        <link href="vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="vendor/assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

<div id="wrapper">

    <?php include "vendor/parts/topbar.php";?>

    <!-- ========== Left Sidebar Start ========== -->


    <!--- Divider -->
    <?php include "vendor/parts/sidebar.php";?>
    <div class="clearfix"></div>
</div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->

<!-- Start right Content here -->

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Code Here -->
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Kullanım Sözleşmesi Sayfası İçeriği</h4>
                        <div class="clearfix"></div>
                        
                    </div>
                    <div class="row">
                            <div class="col-sm-12">
                            <form action="" method="post">

                                <div class="panel panel-primary">
                                    <div class="panel-heading"><h3 class="panel-title">İçerik Editörü</h3></div>
                                    <div class="container">
                                    <br>
	                                <textarea id="editor1" name="icerik">
                                    <?php
                                                           foreach ($row as $item) {
                                                             echo $item['content'];
                                                            } ?>
	                                </textarea>
</div>
<script>
	CKEDITOR.replace( 'editor1', {
		// Define the toolbar: https://ckeditor.com/docs/ckeditor4/latest/features/toolbar.html
		// The standard preset from CDN which we used as a base provides more features than we need.
		// Also by default it comes with a 2-line toolbar. Here we put all buttons in a single row.
		toolbar: [
			{ name: 'clipboard', items: [ 'Undo', 'Redo' ] },
			{ name: 'styles', items: [ 'Styles', 'Format' ] },
			{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
			{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
			{ name: 'links', items: [ 'Link', 'Unlink' ] },
			{ name: 'insert', items: [ 'Image', 'EmbedSemantic', 'Table' ] },
			{ name: 'tools', items: [ 'Maximize' ] },
			{ name: 'editing', items: [ 'Scayt' ] }
		],

		// Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
		// One HTTP request less will result in a faster startup time.
		// For more information check https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-customConfig
		customConfig: '',

		// Enabling extra plugins, available in the standard-all preset: https://ckeditor.com/cke4/presets-all
		extraPlugins: 'autoembed,embedsemantic,image2,uploadimage,uploadfile',

		/*********************** File management support ***********************/
		// In order to turn on support for file uploads, CKEditor has to be configured to use some server side
		// solution with file upload/management capabilities, like for example CKFinder.
		// For more information see https://ckeditor.com/docs/ckeditor4/latest/guide/dev_ckfinder_integration.html

		// Uncomment and correct these lines after you setup your local CKFinder instance.
		// filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
		// filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		/*********************** File management support ***********************/

		// Remove the default image plugin because image2, which offers captions for images, was enabled above.
		removePlugins: 'image',

		// Make the editing area bigger than default.
		height: 200,

		// An array of stylesheets to style the WYSIWYG area.
		// Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
		contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/standard-all/contents.css', 'mystyles.css' ],

		// This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
		bodyClass: 'article-editor',

		// Reduce the list of block elements listed in the Format dropdown to the most commonly used.
		format_tags: 'p;h1;h2;h3;pre',

		// Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
		removeDialogTabs: 'image:advanced;link:advanced',

		// Define the list of styles which should be available in the Styles dropdown list.
		// If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
		// (and on your website so that it rendered in the same way).
		// Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
		// that file, which means one HTTP request less (and a faster startup).
		// For more information see https://ckeditor.com/docs/ckeditor4/latest/features/styles.html
		stylesSet: [
			/* Inline Styles */
			{ name: 'Marker',			element: 'span', attributes: { 'class': 'marker' } },
			{ name: 'Cited Work',		element: 'cite' },
			{ name: 'Inline Quotation',	element: 'q' },

			/* Object Styles */
			{
				name: 'Special Container',
				element: 'div',
				styles: {
					padding: '5px 10px',
					background: '#eee',
					border: '1px solid #ccc'
				}
			},
			{
				name: 'Compact table',
				element: 'table',
				attributes: {
					cellpadding: '5',
					cellspacing: '0',
					border: '1',
					bordercolor: '#ccc'
				},
				styles: {
					'border-collapse': 'collapse'
				}
			},
			{ name: 'Borderless Table',		element: 'table',	styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
			{ name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } },

			/* Widget Styles */
			// We use this one to style the brownie picture.
			{ name: 'Illustration', type: 'widget', widget: 'image', attributes: { 'class': 'image-illustration' } },
			// Media embed
			{ name: '240p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-240p' } },
			{ name: '360p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-360p' } },
			{ name: '480p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-480p' } },
			{ name: '720p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-720p' } },
			{ name: '1080p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-1080p' } }
		]
	} );
</script>
                                </div>
                            </div>
                        </div> <!-- End row -->


                                    </div>

                                    <button name="kaydet" type="submit" class="btn btn-primary waves-effect waves-light">
                                                            Bilgilerimi Güncelle
                                                        </button>                
                                </div> <!-- end panel -->

                            </div> <!-- end col -->

                        </div>
                        <!-- end row -->
                </div>
            </div>
            </form>


        </div>
    </div> <!-- container -->

</div> <!-- content -->

<?php include "vendor/parts/footer.php";?>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
<script src="vendor/assets/js/jquery.min.js"></script>
<script src="vendor/assets/js/bootstrap.min.js"></script>
<script src="vendor/assets/js/modernizr.min.js"></script>
<script src="vendor/assets/js/detect.js"></script>
<script src="vendor/assets/js/fastclick.js"></script>
<script src="vendor/assets/js/jquery.slimscroll.js"></script>
<script src="vendor/assets/js/jquery.blockUI.js"></script>
<script src="vendor/assets/js/waves.js"></script>
<script src="vendor/assets/js/wow.min.js"></script>
<script src="vendor/assets/js/jquery.nicescroll.js"></script>
<script src="vendor/assets/js/jquery.scrollTo.min.js"></script>

<script src="vendor/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- Datatables-->
<script src="vendor/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="vendor/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="vendor/assets/plugins/datatables/responsive.bootstrap.min.js"></script>

<script src="vendor/assets/pages/dashborad.js"></script>

<script src="vendor/assets/js/app.js"></script>
<!-- jQuery  -->
<script src="vendor/assets/js/jquery.min.js"></script>
<script src="vendor/assets/js/bootstrap.min.js"></script>
<script src="vendor/assets/js/modernizr.min.js"></script>
<script src="vendor/assets/js/detect.js"></script>
<script src="vendor/assets/js/fastclick.js"></script>
<script src="vendor/assets/js/jquery.slimscroll.js"></script>
<script src="vendor/assets/js/jquery.blockUI.js"></script>
<script src="vendor/assets/js/waves.js"></script>
<script src="vendor/assets/js/wow.min.js"></script>
<script src="vendor/assets/js/jquery.nicescroll.js"></script>
<script src="vendor/assets/js/jquery.scrollTo.min.js"></script>

<!-- Plugins js -->
<script src="vendor/assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="vendor/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="vendor/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="vendor/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script type="text/javascript" src="vendor/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="vendor/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<!-- Wysihtml js -->
<script type="text/javascript" src="vendor/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="vendor/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        
<<!--Summernote js-->
<script src="vendor/assets/plugins/summernote/summernote.min.js"></script>



        <script>

            jQuery(document).ready(function(){
                $('.wysihtml5').wysihtml5();

               
            });
        </script>

</body>
</html>
