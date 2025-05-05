<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">
<style>
.main-col {
    padding: 30px;
    background-color: #2d2d2d;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4), 0 6px 20px 0 rgba(0, 0, 0, 0.3);  
    margin-top: 50px;   
}
.pass-form {
    background-color: #1a1a1a;
    border: 2px;
    border-style: dotted;
    border-color: #4a4a4a;
    padding: 20px;
    margin-top: 30px;
}

body {
  background-color: #1a1a1a;
}
@font-face {
  font-family: 'product sans';
  src: url('assets/css/Product Sans Bold.ttf');
}
h1 {
    font-size: 42px !important;
    margin-bottom: 20px;  
    font-family: 'product sans' !important;
    font-weight: bolder;
    color: #ffffff;
}
input {
    border: 0px !important;
    border-bottom: 2px solid #4a4a4a !important;
    color: #ffffff !important;
    border-radius: 0px !important;
    font-weight: bold !important;   
    margin-bottom: 10px;
    background-color: #2d2d2d !important;
}
label {
    color: #ffffff !important;
    font-size: 19px;
}  
@media screen and (max-width: 900px){
    body {
        background-color: #1a1a1a;
    }  
}
.text-secondary {
    color: #ffffff !important;
}
.btn-primary {
    background-color: #4a4a4a !important;
    border-color: #4a4a4a !important;
}
</style>
<?php
    if(isset($_GET['error'])) {
        if($_GET['error'] === 'invdate') {
          echo '<script>alert("Invalid date of birth")</script>';
      } else if($_GET['error'] === 'moblen') {
          echo '<script>alert("Invalid contact info")</script>';
      } else if($_GET['error'] === 'sqlerror') {
          echo"<script>alert('Database error')</script>";
      }
      echo"<script>location.replace(document.referer)</script>";
    }
    ?>
<?php if(isset($_SESSION['userId']) && isset($_POST['book_but'])) {   
    $flight_id = $_POST['flight_id'];
    $passengers = $_POST['passengers']; 
    $price = $_POST['price'];
    $class = $_POST['class'];
    $type = $_POST['type'];
    $ret_date = $_POST['ret_date'];
?>    
<main>
    <div class="container mb-5">
    <div class="col-md-12 main-col">
        <h1 class="text-center text-secondary">PASSENGER DETAILS</h1>  
        <form action="includes/pass_detail.inc.php" class="needs-validation mt-4" 
            method="POST">

            <input type="hidden" name="type" value=<?php echo $type; ?>>   
            <input type="hidden" name="ret_date" value=<?php echo $ret_date; ?>>   
            <input type="hidden" name="class" value=<?php echo $class; ?>>   
            <input type="hidden" name="passengers" value=<?php echo $passengers; ?>>   
            <input type="hidden" name="price" value=<?php echo $price; ?>>   
            <input type="hidden" name="flight_id" value=<?php echo $flight_id; ?>>   
        <?php for($i=1;$i<=$passengers;$i++) {
            echo'   
            <div class="pass-form">  
            <div class="form-row">
                <div class="col-md">
                    <div class="input-group">
                        <label for="firstname'.$i.'">Firstname</label>
                        <input type="text" name="firstname[]" id="firstname'.$i.'" class="pl-0 pr-0" 
                            required style="width: 100%;">
                    </div>
                </div>
                <div class="col-md">
                    <div class="input-group">
                        <label for="midname'.$i.'">Middlename</label>
                        <input type="text" name="midname[]" id="midname'.$i.'" class="pl-0 pr-0"
                            required style="width: 100%;">
                    </div>
                </div>

                <div class="col-md">
                    <div class="input-group">
                        <label for="lastname'.$i.'">Lastname</label>
                        <input type="text" name="lastname[]" id="lastname'.$i.'" class="pl-0 pr-0"
                             required style="width: 100%;">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md">
                    <div class="input-group">
                        <label for="mobile'.$i.'">Contact No</label>
                        <input type="number" name="mobile[]" min="0" id="mobile'.$i.'" 
                            required>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group mt-3"> 
                        <label for="dob">DOB</label>
                        <input id="date" name="date[]" type="date"
                             required>
                    </div>
                </div>
            </div>
            </div>'; }  ?>    
            <div class="col text-center">
                <button name="pass_but" type="submit" 
                class="btn btn-primary mt-4">
                <div>
                <i class="fa fa-lg fa-arrow-right"></i> Proceed  
                </div>
                </button>
            </div>         
        </form>              
    </div>
    </div>
    <?php subview('footer.php'); ?> 
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
</main>
<?php } ?>
