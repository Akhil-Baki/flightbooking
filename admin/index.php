<?php include_once 'header.php'; 
require '../helpers/init_conn_db.php';?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="../assets/css/admin.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Inter', sans-serif;
  }
  .dashboard-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
  }
  .dashboard-card {
    background-color: var(--secondary-bg);
    border-radius: 15px;
    padding: 20px;
    box-shadow: var(--card-shadow);
    border: 1px solid var(--border-color);
    transition: transform 0.3s ease;
  }
  .dashboard-card:hover {
    transform: translateY(-5px);
  }
  .card-icon {
    font-size: 2rem;
    color: var(--accent-blue);
    margin-bottom: 10px;
  }
  .card-title {
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
  }
  .card-value {
    color: var(--text-primary);
    font-size: 1.75rem;
    font-weight: 600;
    letter-spacing: -0.5px;
  }
  .table-container {
    background-color: var(--secondary-bg);
    border-radius: 15px;
    padding: 20px;
    margin: 20px;
    box-shadow: var(--card-shadow);
    border: 1px solid var(--border-color);
  }
  .filter-section h3 {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 1.5rem;
    margin-bottom: 15px;
    letter-spacing: -0.5px;
  }
  .filter-buttons .btn {
    font-weight: 500;
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    margin-right: 10px;
    margin-bottom: 10px;
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
  .status-badge {
    font-weight: 500;
    font-size: 0.85rem;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
  }
  .dropdown-menu {
    background-color: var(--secondary-bg);
    border: 1px solid var(--border-color);
    padding: 10px;
  }
  .dropdown-menu .form-control {
    background-color: var(--primary-bg);
    border: 1px solid var(--border-color);
    color: var(--text-primary);
    font-size: 0.9rem;
  }
  .dropdown-menu .btn {
    font-weight: 500;
    font-size: 0.85rem;
    padding: 0.4rem 0.8rem;
  }
</style>

<main>
    <?php if(isset($_SESSION['adminId'])) { ?>
    <div class="dashboard-container">
        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-title">Total Passengers</div>
            <div class="card-value">
                <?php 
                    $sql = "SELECT COUNT(*) FROM passenger_profile";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    echo $row[0];
                ?>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="card-title">Total Revenue</div>
            <div class="card-value">
                $<?php 
                    $sql = "SELECT SUM(amount) FROM payment";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    echo number_format($row[0] ?? 0, 2);
                ?>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fas fa-plane"></i>
            </div>
            <div class="card-title">Total Flights</div>
            <div class="card-value">
                <?php 
                    $sql = "SELECT COUNT(*) FROM flight";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    echo $row[0];
                ?>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="card-title">Available Airlines</div>
            <div class="card-value">
                <?php 
                    $sql = "SELECT COUNT(*) FROM airline";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    echo $row[0];
                ?>
            </div>
        </div>
    </div>

    <div class="table-container">
        <div class="filter-section">
            <h3>Flights</h3>
            <div class="filter-buttons">
                <a href="?filter=all" class="btn btn-primary <?php echo $filter === 'all' ? 'active' : ''; ?>">All Flights</a>
                <a href="?filter=today" class="btn btn-primary <?php echo $filter === 'today' ? 'active' : ''; ?>">Today's Flights</a>
                <a href="?filter=issue" class="btn btn-primary <?php echo $filter === 'issue' ? 'active' : ''; ?>">Issues</a>
                <a href="?filter=dep" class="btn btn-primary <?php echo $filter === 'dep' ? 'active' : ''; ?>">Departed</a>
                <a href="?filter=arr" class="btn btn-primary <?php echo $filter === 'arr' ? 'active' : ''; ?>">Arrived</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Flight ID</th>
                        <th>Arrival</th>
                        <th>Departure</th>
                        <th>Destination</th>
                        <th>Source</th>
                        <th>Airline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
                    $sql = "SELECT * FROM Flight WHERE 1=1";
                    
                    switch($filter) {
                        case 'today':
                            $curr_date = (string)date('y-m-d');
                            $curr_date = '20'.$curr_date;
                            $sql .= " AND DATE(departure)=?";
                            $params = ['s', $curr_date];
                            break;
                        case 'issue':
                            $sql .= " AND status='issue'";
                            $params = [];
                            break;
                        case 'dep':
                            $sql .= " AND status='dep'";
                            $params = [];
                            break;
                        case 'arr':
                            $sql .= " AND status='arr'";
                            $params = [];
                            break;
                        default:
                            $params = [];
                    }
                    
                    $sql .= " ORDER BY departure DESC";
                    
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    
                    if(!empty($params)) {
                        mysqli_stmt_bind_param($stmt, $params[0], $params[1]);
                    }
                    
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        $status_class = '';
                        $status_text = '';
                        
                        switch($row['status']) {
                            case 'issue':
                                $status_class = 'status-issue';
                                $status_text = 'Delayed';
                                break;
                            case 'dep':
                                $status_class = 'status-departed';
                                $status_text = 'Departed';
                                break;
                            case 'arr':
                                $status_class = 'status-arrived';
                                $status_text = 'Arrived';
                                break;
                            default:
                                $status_class = 'status-scheduled';
                                $status_text = 'Scheduled';
                        }
                        
                        echo '<tr>
                            <td><a href="pass_list.php?flight_id='.$row['flight_id'].'" class="flight-link">'.$row['flight_id'].'</a></td>
                            <td>'.$row['arrivale'].'</td>
                            <td>'.$row['departure'].'</td>
                            <td>'.$row['Destination'].'</td>
                            <td>'.$row['source'].'</td>
                            <td>'.$row['airline'].'</td>
                            <td><span class="status-badge '.$status_class.'">'.$status_text.'</span></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <form action="../includes/admin/admin.inc.php" method="post">
                                            <input type="hidden" name="flight_id" value="'.$row['flight_id'].'">
                                            <div class="form-group p-2">
                                                <input type="number" class="form-control" name="issue" placeholder="Delay (minutes)">
                                            </div>
                                            <button type="submit" name="issue_but" class="btn btn-danger btn-sm w-100">Report Issue</button>
                                            <button type="submit" name="dep_but" class="btn btn-warning btn-sm w-100 mt-1">Mark Departed</button>
                                            <button type="submit" name="arr_but" class="btn btn-success btn-sm w-100 mt-1">Mark Arrived</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</main>

<?php include_once 'footer.php'; ?>
