<?php include_once 'header.php'; ?>
<?php include_once 'footer.php'; ?>
<?php require '../helpers/init_conn_db.php'; ?>

<link rel="stylesheet" href="../assets/css/admin.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<?php if(isset($_SESSION['adminId'])) { ?>

<style>
  body {
    font-family: 'Inter', sans-serif;
    background-color: var(--primary-bg);
  }
  input {
    border: 0px !important;
    border-bottom: 2px solid var(--border-color) !important;
    border-radius: 0px !important;
    font-weight: 500 !important;
    background-color: var(--secondary-bg) !important;
    color: var(--text-primary) !important;
    font-size: 0.95rem !important;
    padding: 0.5rem 0 !important;
  }
  *:focus {
    outline: none !important;
  }
  label {
    color: var(--text-secondary) !important;
    font-size: 0.9rem;
    font-weight: 500;
    letter-spacing: 0.5px;
  }
  h5.form-name {
    font-weight: 600;
    margin-bottom: 0px !important;
    margin-top: 10px;
    color: var(--text-secondary);
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  h1 {
    font-size: 2rem !important;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--text-primary);
    letter-spacing: -0.5px;
  }
  div.form-out {
    box-shadow: var(--card-shadow);
    background-color: var(--secondary-bg) !important;
    padding: 40px;
    margin-top: 30px;
    border-radius: 15px;
    border: 1px solid var(--border-color);
  }
  select.airline, select[name="dep_city"], select[name="arr_city"] {
    float: right;
    font-weight: 500 !important;
    background-color: var(--secondary-bg) !important;
    color: var(--text-primary) !important;
    font-size: 0.95rem !important;
    border: 0px !important;
    border-bottom: 2px solid var(--border-color) !important;
    border-radius: 0px !important;
    padding: 0.5rem 0 !important;
  }
  .btn-success {
    font-weight: 500;
    font-size: 1rem;
    padding: 0.75rem 2rem;
    letter-spacing: 0.5px;
  }
  @media screen and (max-width: 900px){
    div.form-out {
      padding: 20px;
      margin-top: 20px;
    }    
  }  
</style>
<main>
<div class="container mt-0">
  <div class="row">
    <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] === 'destless') {
            echo "<script>alert('Dest. date/time is less than src.');</script>";
        } else if($_GET['error'] === 'sqlerr') {
          echo "<script>alert('Database error');</script>";
        } else if($_GET['error'] === 'same') {
          echo "<script>alert('Same city specified in source and destination');</script>";
        }
    }
    ?>
      <div class="form-out col-md-12">
      <h1 class="text-center">ADD FLIGHT DETAILS</h1>

      <form method="POST" class="text-center" 
        action="../includes/admin/flight.inc.php">

        <div class="form-row mb-4">
          <div class="col-md-3 p-0">
            <h5 class="mb-0 form-name">DEPARTURE</h5>
          </div>
          <div class="col">           
            <input type="date" name="source_date" class="form-control"
            required>
          </div>
          <div class="col">         
            <input type="time" name="source_time" class="form-control"
              required>
          </div>
        </div>

        <div class="form-row mb-4">
        <div class="col-md-3 ">
            <h5 class="form-name mb-0">ARRIVAL</h5>
          </div>          
          <div class="col">
            <input type="date" name="dest_date" class="form-control"
            required>
          </div>
          <div class="col">
            <input type="time" name="dest_time" class="form-control"
            required>
          </div>
        </div>

        <div class="form-row mb-4">
          <div class="col">                
            <?php
            $sql = 'SELECT * FROM Cities ';
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);         
            mysqli_stmt_execute($stmt);          
            $result = mysqli_stmt_get_result($stmt);    
            echo '<select class="mt-4" name="dep_city" style="border: 0px; border-bottom: 
              2px solid var(--border-color); background-color: var(--secondary-bg) !important;
              font-weight: bold !important; color: var(--text-primary);
              width:80%">
              <option selected>From</option>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['city']}'>{$row['city']}</option>";
            }
            ?>
            </select>             
          </div>
          <div class="col">
              <?php
              $sql = 'SELECT * FROM Cities ';
              $stmt = mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt,$sql);         
              mysqli_stmt_execute($stmt);          
              $result = mysqli_stmt_get_result($stmt);    
              echo '<select class="mt-4" name="arr_city" style="border: 0px; border-bottom: 
                2px solid var(--border-color); background-color: var(--secondary-bg) !important;
                font-weight: bold !important; color: var(--text-primary);
                width:80%">
                <option selected>To</option>';
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['city']}'>{$row['city']}</option>";
              }
              ?>
              </select>                
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <div class="input-group">
                <label for="dura">Duration</label>
                <input type="text" name="dura" id="dura" required />
              </div>              
            </div>            
          <div class="col">
            <div class="input-group">
                <label for="price">Price</label>
                <input type="number" style="border: 0px; border-bottom: 2px solid var(--border-color);" 
                  name="price" id="price" required />
              </div>            
          </div>
          <?php
          $sql = 'SELECT * FROM Airline ';
          $stmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);         
          mysqli_stmt_execute($stmt);          
          $result = mysqli_stmt_get_result($stmt);    
          echo '<select class="airline col-md-3 mt-4" name="airline_name" style="border: 0px; border-bottom: 
            2px solid var(--border-color); background-color: var(--secondary-bg) !important;
            color: var(--text-primary);">
            <option selected>Select Airline</option>';
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value='. $row['airline_id']  .'>'. 
              $row['name'] .'</option>';
          }
        ?>
        </select>            
        </div>              

        <button name="flight_but" type="submit" 
          class="btn btn-success mt-5">
          <div style="font-size: 1.5rem;">
          <i class="fa fa-lg fa-arrow-right"></i> Proceed
          </div>
        </button>
      </form>
    </div>
    </div>
</div>
</main>
<script>
$(document).ready(function(){
  $('.input-group input').focus(function(){
    me = $(this) ;
    $("label[for='"+me.attr('id')+"']").addClass("animate-label");
  }) ;
  $('.input-group input').blur(function(){
    me = $(this) ;
    if ( me.val() == ""){
      $("label[for='"+me.attr('id')+"']").removeClass("animate-label");
    }
  }) ;
});
</script>
<?php } ?>
