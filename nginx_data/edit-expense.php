<?php
session_start();
include ('connection.php');
$id = $_SESSION['id'];
$name = $_SESSION['user_name'];
if(empty($id))
{
    header("Location: index.php"); 
}
$id = $_GET['id'];
$fetch_query = mysqli_query($conn, "select * from tbl_expenses where id='$id'");
$row = mysqli_fetch_array($fetch_query);
if(isset($_REQUEST['save-exps-btn']))
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
        
    $update_expense = mysqli_query($conn,"update tbl_expenses set category='$category_name', expense_date='$expense_date', item_name='$item_name', item_price='$item_price', remark='$remark' where id='$id'");

    if($update_expense > 0)
    {
?>
<script type="text/javascript">
    alert("Expense updated successfully.");
    window.location.href='view-expense.php';
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
            <a href="#">Edit Expense</a>
          </li>
          
        </ol>

  <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-info-circle"></i>
            Edit Details</div>
             
            <form method="post" class="form-valide">
          <div class="card-body">
                                       
                                      <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="leave-type">Category <span class="text-danger">*</span>
                                            </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="category_name" name="category_name" required>
                                        <option value="">Select Category</option>
                                        <?php 
                                         $fetch_category = mysqli_query($conn, "select * from tbl_category");
                                         while($rows = mysqli_fetch_array($fetch_category)){
                                        ?>
                            <option <?php if($rows['category_name']==$row['category']){ ?>
                                selected="selected"; <?php } ?>><?php echo $rows['category_name'];?>
                            </option>
                                    <?php } ?>
                                     </select>
                                </div>
                                  </div>    
                                      
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="leave-date">Date <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="expense_date" name="expense_date" placeholder="Select Expense Date" required value="<?php echo $row['expense_date']; ?>">
                                            </div>
                                        </div>
                                       <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="item">Item <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <input type="text" name="item_name" id="item_name" class="form-control" placeholder="Enter Item Name" required value="<?php echo $row['item_name']; ?>">
                                       </div>
                                  </div>
                                   <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="price">Price <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <input type="text" name="item_price" id="item_price" class="form-control" placeholder="Enter Item Price" required value="<?php echo $row['item_price']; ?>"> 
                                       </div>
                                  </div>                                         
                                  <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="remarks">Remarks <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <textarea rows="3" name="remarks" id="remarks" class="form-control" placeholder="Enter a Remarks.." ><?php echo $row['remark']; ?></textarea>
                                       </div>
                                  </div>
                           
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" name="save-exps-btn" class="btn btn-primary">Save</button>
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