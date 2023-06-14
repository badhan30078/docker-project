<?php
session_start();
include ('connection.php');
$name = $_SESSION['user_name'];
$id = $_SESSION['id'];
if(empty($name))
{
    header("Location: index.php"); 
}
?>

<?php include('include/header.php'); ?>
  <div id="wrapper">

    <?php include('include/side-bar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">View Reports</a>
          </li>
          
        </ol>
<form method="post">
<div class="form-group row">
  <label class="col-lg-0 col-form-label-report" for="from">From</label>
  <div class="col-lg-3">
      <input type="text" class="form-control" id="from_date" name="from_date" placeholder="Select Date" required>
  </div>

  <label class="col-lg-0 col-form-label" for="from">To</label>
  <div class="col-lg-3">
      <input type="text" class="form-control" id="to_date" name="to_date" placeholder="Select Date" required>
  </div>

  <div class="col-lg-3">
      <select class="form-control" id="category_name" name="category_name" required>
          <option value="">Select Category</option>
          <?php 
           $fetch_category = mysqli_query($conn, "select * from tbl_category");
           while($row = mysqli_fetch_array($fetch_category)){
          ?>
          <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
      <?php } ?>
       </select>
  </div>
<div class="col-lg-3">
    <button type="submit" name="srh-btn" class="btn btn-primary search-button">Search</button>
</div>
</div>
</form>
  <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-info-circle"></i>
            View Your Details</div>
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Category</th>
                                                <th>Expense Date</th>
                                                <th>Item Name</th>
                                                <th>Item Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
                     if(isset($_REQUEST['srh-btn']))
                     {
                       //print_r($_POST);
                       $from_date = $_POST['from_date'];
                       $to_date = $_POST['to_date'];
                       $cat = $_POST['category_name'];
                       $from_date = date('Y-m-d', strtotime($from_date));
                       $to_date = date('Y-m-d', strtotime($to_date));

                       $search_query = mysqli_query($conn, "select * from tbl_expenses where expense_date>='$from_date' and expense_date<='$to_date' and category='$cat' and user_id='$id'");
                        // print_r($search_query);
                       $sn = 1;
                       while($rows = mysqli_fetch_array($search_query))
                    { ?>
                       <tr>
                          <td><?php echo $sn; ?></td>
                          <td><?php echo $rows['category']; ?></td>
                          <td><?php echo $rows['expense_date']; ?></td>
                          <td><?php echo $rows['item_name']; ?></td>
                          <td><?php echo $rows['item_price']; ?></td>
                          
                      </tr>
                <?php $sn++; } 
                     }
                     else{

										$select_query = mysqli_query($conn, "select * from tbl_expenses where user_id='$id' order by id");
										$sn = 1;
										while($row = mysqli_fetch_array($select_query))
										{ 
										   ?>
                                            <tr>
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $row['category']; ?></td>
                                                <td><?php echo $row['expense_date']; ?></td>
                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['item_price']; ?></td>
                                                
                                            </tr>
										<?php $sn++; } }?>
                                           
                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>                   
                            </div>
                        
    </div>
         
        </div>
  

    </div>
   
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 
 <?php include('include/footer.php'); ?>