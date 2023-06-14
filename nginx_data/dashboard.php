<?php
session_start();
$name = $_SESSION['user_name'];
$id = $_SESSION['id'];
include 'connection.php';
if(empty($name))
{
    header("Location: index.php"); 
}

$total_expense = mysqli_query($conn,"select sum(item_price) as expense from tbl_expenses where user_id='$id'");
$total_expense = mysqli_fetch_row($total_expense);

$today_expense = mysqli_query($conn,"select sum(item_price) as expense from tbl_expenses where user_id='$id' and expense_date=CURDATE()");
$today_expense = mysqli_fetch_assoc($today_expense);

$yesterday_expense = mysqli_query($conn,"select sum(item_price) as expense from tbl_expenses where user_id='$id' and expense_date=CURDATE()-1");
$yesterday_expense = mysqli_fetch_assoc($yesterday_expense);

$week_expense = mysqli_query($conn,"select sum(item_price) as expense from tbl_expenses where week(expense_date)=week(now()) and user_id='$id'");
$week_expense = mysqli_fetch_assoc($week_expense);

$month_expense = mysqli_query($conn,"select sum(item_price) as expense from tbl_expenses where MONTH(expense_date) = MONTH(CURRENT_DATE())
AND YEAR(expense_date) = YEAR(CURRENT_DATE()) and user_id='$id'");
$month_expense = mysqli_fetch_assoc($month_expense);

$year_expense = mysqli_query($conn,"select sum(item_price) as expense from tbl_expenses where year(expense_date) = YEAR(CURDATE()) and user_id='$id'");
$year_expense = mysqli_fetch_assoc($year_expense);


include('include/header.php'); ?>

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
              <i class="fa fa-usd"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">Total Expenses</h4>
              <div class="info">
                <strong class="amount"><?php echo $total_expense[0]; ?></strong><br>
                 
              </div>
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
              <i class="fa fa-usd"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">Future Expense</h4>
              <div class="info">
                <strong class="amount"><?php echo $today_expense['expense']; ?></strong><br>
                 
              </div>
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
              <i class="fa fa-usd"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">Yesterday's Expense</h4>
              <div class="info">
                <strong class="amount"><?php echo $yesterday_expense['expense']; ?></strong><br>
                 
              </div>
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
              <i class="fa fa-usd"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">This Week Expense</h4>
              <div class="info">
                <strong class="amount"><?php echo $week_expense['expense']; ?></strong><br>
                 
              </div>
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
              <i class="fa fa-usd"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">This Month Expense</h4>
              <div class="info">
                <strong class="amount"><?php echo $month_expense['expense']; ?></strong><br>
                 
              </div>
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
              <i class="fa fa-usd"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">This Year Expense</h4>
              <div class="info">
                <strong class="amount"><?php echo $year_expense['expense']; ?></strong><br>
                 
              </div>
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
