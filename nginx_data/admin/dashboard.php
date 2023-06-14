<?php
session_start();
include '../connection.php';
$name = $_SESSION['name'];
$id = $_SESSION['id'];
if(empty($id))
{
    header("Location: index.php"); 
}

 $select_user = mysqli_query($conn,"select count(*) from tbl_users where role=2");
 $total_user = mysqli_fetch_row($select_user);

 $select_category = mysqli_query($conn,"select count(*) from tbl_category where status=1");
 $total_category = mysqli_fetch_row($select_category);

?>
<?php include('include/header.php'); ?>

  <div id="wrapper">

    <?php include('include/side-bar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          
        </ol>
<div class="row">
  <div class="col-sm-4">
    <section class="panel panel-featured-left panel-featured-primary">
      <div class="panel-body">
        <div class="widget-summary">
          <div class="widget-summary-col widget-summary-col-icon">
            <div class="summary-icon bg-secondary">
              <i class="fa fa-user"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">Total Users</h4>
              <div class="info">
                <strong class="amount"><?php echo $total_user[0]; ?></strong><br>
                 
              </div>
            </div>
            <div class="summary-footer">
              <a class="text-muted text-uppercase"></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="col-sm-4">
    <section class="panel panel-featured-left panel-featured-primary">
      <div class="panel-body">
        <div class="widget-summary">
          <div class="widget-summary-col widget-summary-col-icon">
            <div class="summary-icon bg-secondary">
              <i class="fa fa-inbox"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">Total Category</h4>
              <div class="info">
                <strong class="amount"><?php echo $total_category[0]; ?></strong><br>
                 
              </div>
            </div>
            <div class="summary-footer">
              <a class="text-muted text-uppercase"></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</div>
</div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <?php include('include/footer.php'); ?>
