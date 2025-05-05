<?php include_once 'header.php'; ?>
<?php include_once 'footer.php';
require '../helpers/init_conn_db.php';?>

<link rel="stylesheet" href="../assets/css/admin.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<?php
if(isset($_POST['del_flight']) and isset($_SESSION['adminId'])) {
  $flight_id = $_POST['flight_id'];
  $sql = 'DELETE FROM Flight WHERE flight_id=?';
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)) {
      header('Location: ../index.php?error=sqlerror');
      exit();            
  } else {  
    mysqli_stmt_bind_param($stmt,'i',$flight_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo("<script>location.href = 'all_flights.php';</script>");
    exit();
  }
}
?>

<style>
  body {
    background-color: var(--primary-bg);
    font-family: 'Inter', sans-serif;
  }
  .flights-list {
    background-color: var(--secondary-bg);
    border-radius: 15px;
    padding: 20px;
    margin-top: 20px;
    box-shadow: var(--card-shadow);
    border: 1px solid var(--border-color);
  }
  .flights-list h2 {
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
  .flight-link {
    color: var(--accent-blue);
    text-decoration: none;
    transition: color 0.3s ease;
    font-weight: 600;
  }
  .flight-link:hover {
    color: var(--accent-blue-hover);
    text-decoration: none;
  }
  .price {
    font-weight: 600;
    color: var(--accent-blue);
  }
</style>

<main>
  <div class="container mt-0">
    <div class="row">
      <div class="flights-list col-md-12">
        <h2>Flight List</h2>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Arrival</th>
              <th>Departure</th>
              <th>Source</th>
              <th>Destination</th>
              <th>Airline</th>
              <th>Seats</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = 'SELECT * FROM Flight ORDER BY flight_id DESC';
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);                
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>
                <td>
                  <a href="pass_list.php?flight_id='.$row['flight_id'].'" class="flight-link">
                    '.$row['flight_id'].'
                  </a>
                </td>
                <td>'.$row['arrivale'].'</td>
                <td>'.$row['departure'].'</td>
                <td>'.$row['source'].'</td>
                <td>'.$row['Destination'].'</td>
                <td>'.$row['airline'].'</td>
                <td>'.$row['Seats'].'</td>
                <td><span class="price">$ '.$row['Price'].'</span></td>
                <td>
                  <form action="all_flights.php" method="post">
                    <input type="hidden" name="flight_id" value="'.$row['flight_id'].'">
                    <button type="submit" name="del_flight" class="btn btn-danger">
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
	
