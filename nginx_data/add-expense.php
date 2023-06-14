<?php
session_start();
include ('connection.php');
$name = $_SESSION['user_name'];
$id = $_SESSION['id'];
if(empty($id))
{
    header("Location: index.php"); 
}
if(isset($_REQUEST['sbt-exps-btn']))
{
   
	$category_name = $_POST['category_name'];
    $expense_date = $_POST['expense_date'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $remark = $_POST['remarks'];
    if(!empty($expense_date))
    {
       $expense_date = date('Y-m-d', strtotime($_POST['expense_date']));
    }
    else 
    {
       $expense_date = NULL;
    }    
    
    $insert_expense = mysqli_query($conn,"insert into tbl_expenses set user_id='$id', category='$category_name', expense_date='$expense_date', item_name='$item_name', item_price='$item_price', remark='$remark'");

    if($insert_expense > 0)
    {
        ?>
<script type="text/javascript">
    alert("Expense added successfully.")
</script>
<?php
}
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
            <a href="#">Add Expense</a>
          </li>
          
        </ol>

  <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-info-circle"></i>
            Submit Your Details</div>
             
            <form method="post" class="form-valide">
          <div class="card-body">
                                       
                                      <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="leave-type">Category <span class="text-danger">*</span>
                                            </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="category_name" name="category_name" required>
                                        <option value="">Select Category</option>
                                        <?php 
                                         $fetch_category = mysqli_query($conn, "select * from tbl_category where status=1");
                                         while($row = mysqli_fetch_array($fetch_category)){
                                        ?>
                                        <option><?php echo $row['category_name']; ?></option>
                                    <?php } ?>
                                     </select>
                                </div>
                                  </div>    
                                      
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="leave-date">Date <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="expense_date" name="expense_date" placeholder="Select Expense Date" required>
                                            </div>
                                        </div>
                                       <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="item">Item <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <input type="text" name="item_name" id="item_name" class="form-control" placeholder="Enter Item Name" required>
                                       </div>
                                  </div>
                                   <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="price">Price <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <input type="text" name="item_price" id="item_price" class="form-control" placeholder="Enter Price" required>
                                       </div>
                                  </div>                                         
                                  <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="remarks">Remarks <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <textarea rows="3" name="remarks" id="remarks" class="form-control" placeholder="Enter a Remarks.." ></textarea>
                                       </div>
                                  </div>
                           
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" name="sbt-exps-btn" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    
                                </div>
                                </form>
                            </div>
                        
    </div>
         
        </div>
     
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 
 <?php include('include/footer.php'); ?>