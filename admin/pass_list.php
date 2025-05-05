<?php include_once 'header.php'; ?>
<?php include_once 'footer.php';
require '../helpers/init_conn_db.php';?>
<link rel="stylesheet" href="../assets/css/admin.css">
    <main>
        <?php if(isset($_SESSION['adminId'])) { ?>
          <div class="container-md mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h1 class="display-4 text-light">Passenger List</h1>
              <div class="d-flex gap-2">
                <button class="btn btn-primary" onclick="window.print()">
                  <i class="fas fa-print"></i> Print List
                </button>
                <button class="btn btn-secondary" onclick="exportToExcel()">
                  <i class="fas fa-file-excel"></i> Export
                </button>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Contact</th>
                        <th>D.O.B</th>
                        <th>Paid By</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $cnt=1;
                      $flight_id = $_GET['flight_id'];
                      $stmt_t = mysqli_stmt_init($conn);
                      $sql_t = 'SELECT * FROM Ticket WHERE flight_id=?';
                      $stmt_t = mysqli_stmt_init($conn);
                      if(!mysqli_stmt_prepare($stmt_t,$sql_t)) {
                          header('Location: ticket.php?error=sqlerror');
                          exit();            
                      } else {
                          mysqli_stmt_bind_param($stmt_t,'i',$flight_id);            
                          mysqli_stmt_execute($stmt_t);
                          $result_t = mysqli_stmt_get_result($stmt_t);
                          while($row_t = mysqli_fetch_assoc($result_t)) {                  
                            $sql = 'SELECT * FROM Passenger_profile WHERE passenger_id=?';  
                            $stmt = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt,$sql);  
                            mysqli_stmt_bind_param($stmt,'i',$row_t['passenger_id']);          
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);                
                            if ($row = mysqli_fetch_assoc($result)) {
                                $sql_p = 'SELECT * FROM PAYMENT WHERE flight_id=? AND user_id=?';  
                                $stmt_p = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt_p,$sql_p);  
                                mysqli_stmt_bind_param($stmt_p,'ii',$flight_id,$row['user_id']);          
                                mysqli_stmt_execute($stmt_p);
                                $result_p = mysqli_stmt_get_result($stmt_p);                
                                if ($row_p = mysqli_fetch_assoc($result_p)) {
                                  $sql_u = 'SELECT * FROM Users WHERE user_id=?';  
                                  $stmt_u = mysqli_stmt_init($conn);
                                  mysqli_stmt_prepare($stmt_u,$sql_u);  
                                  mysqli_stmt_bind_param($stmt_u,'i',$row['user_id']);          
                                  mysqli_stmt_execute($stmt_u);
                                  $result_u = mysqli_stmt_get_result($stmt_u);                
                                  if ($row_u = mysqli_fetch_assoc($result_u)) {
                                    echo "                  
                                    <tr>
                                      <td>".$cnt."</td>
                                      <td>".$row['f_name']."</td>
                                      <td>".$row['m_name']."</td>
                                      <td>".$row['l_name']."</td>
                                      <td>".$row['mobile']."</td>
                                      <td>".$row['dob']."</td>
                                      <td>".$row_u['username']."</td>
                                      <td>$ ".$row_p['amount']."</td>
                                    </tr>
                                    "; 
                                  }                       
                                }                    
                            }
                            $cnt++; }
                            }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
    </main>

<script>
function exportToExcel() {
  const table = document.querySelector('table');
  const html = table.outerHTML;
  const url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
  const link = document.createElement('a');
  link.download = 'passenger-list.xls';
  link.href = url;
  link.click();
}
</script>
