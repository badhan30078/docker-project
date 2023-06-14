<?php
session_start();
include ('connection.php');
$name = $_SESSION['user_name'];
$id = $_SESSION['id'];
if(empty($id))
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
            <a href="#">View Expense</a>
          </li>
          
        </ol>

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
                                                <th>Date</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Remark</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
                    if(isset($_GET['ids'])){
                      $id = $_GET['ids'];
                      $delete_query = mysqli_query($conn, "delete from tbl_expenses where id='$id'");
                      }
										$select_query = mysqli_query($conn, "select * from tbl_expenses where user_id='$id'");
										$sn = 1;
										while($row = mysqli_fetch_array($select_query))
										{ 
										    
											$date = date('d M Y', strtotime($row['expense_date']));
											
										?>
                                            <tr>
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $row['category']; ?></td>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['item_price']; ?></td>
                                                <td><?php echo $row['remark']; ?></td>
                                                <td>
                                                  <a href="edit-expense.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                  <a href="view-expense.php?ids=<?php echo $row['id'];?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                  </td>
                                            </tr>
										<?php $sn++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                   
                        </div>
                    </div>
                </div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php include('include/footer.php'); ?>
 <script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to delete this Expense?');
}
</script>