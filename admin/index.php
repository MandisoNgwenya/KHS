    <?php
  session_start();
ob_start();
include 'ini/header.ini';
include 'ini/nav.ini';

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: ../login.php');
    exit;
}
 
 
/**
 * Print out something that only logged in users can see.
 */
 
echo 'Congratulations! You are logged in!';
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
    <?php
ob_start();
include 'ini/footer.ini';
include 'ini/sidebar.ini';
?>