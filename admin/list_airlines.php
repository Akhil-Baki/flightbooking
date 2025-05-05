<?php include_once 'header.php'; ?>
<?php include_once 'footer.php';
require '../helpers/init_conn_db.php';?>

<link rel="stylesheet" href="../assets/css/admin.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<?php
if(isset($_POST['del_airlines']) and isset($_SESSION['adminId'])) {
  $airline_id = $_POST['airline_id'];
  $sql = 'DELETE FROM airline WHERE airline_id=?';
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)) {
      header('Location: ../index.php?error=sqlerror');
      exit();            
  } else {  
    mysqli_stmt_bind_param($stmt,'i',$airline_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    // header('Location: list_airlines.php');
    echo("<script>location.href = 'list_airlines.php';</script>");
    exit();
  }
}
?>

<style>
  body {
    font-family: 'Inter', sans-serif;
    background-color: var(--primary-bg);
  }
  .airline-list {
    background-color: var(--secondary-bg);
    border-radius: 15px;
    padding: 20px;
    margin-top: 20px;
    box-shadow: var(--card-shadow);
    border: 1px solid var(--border-color);
  }
  .airline-list h2 {
    color: var(--text-primary);
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 1.75rem;
    letter-spacing: -0.5px;
  }
  .table {
    color: var(--text-primary);
    font-size: 0.95rem;
  }
  .table thead th {
    background-color: var(--secondary-bg);
    color: var(--text-secondary);
    border-bottom: 2px solid var(--border-color);
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
  }
  .table td {
    border-bottom: 1px solid var(--border-color);
    padding: 1rem;
    font-weight: 500;
    vertical-align: middle;
  }
  .btn-danger {
    background-color: var(--danger);
    border: none;
    transition: all 0.3s ease;
    font-weight: 500;
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
  }
  .btn-danger:hover {
    background-color: var(--danger-hover);
    transform: translateY(-2px);
  }
</style>

<main>
  <div class="container mt-0">
    <div class="row">
      <div class="airline-list col-md-12">
        <h2>List of Airlines</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Airline ID</th>
              <th>Name</th>
              <th>Seats</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = 'SELECT * FROM Airline';
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);         
            mysqli_stmt_execute($stmt);          
            $result = mysqli_stmt_get_result($stmt);
            
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>
                <td>'.$row['airline_id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['seats'].'</td>
                <td>
                  <form action="../includes/admin/airline.inc.php" method="post">
                    <input type="hidden" name="airline_id" value="'.$row['airline_id'].'">
                    <button type="submit" name="delete_airline" class="btn btn-danger">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
