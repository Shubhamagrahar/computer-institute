<?php  
include('session.php');




if(isset($_GET['get_user_userid12'])){
    $pass=VerifyData($_GET['get_user_userid12']);
    $sql=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$_SESSION[userid]'"));
   
    if($sql['pass']==$pass){
        ?>
        <span style="color:Green;">Old Password Match.</span>
        <?php
    }else{
        ?>
        <span style="color:red;">Old Password Not Match.</span>
        <?php
    }
    
}



if(isset($_GET['get_user_id'])){
    $mobile=VerifyData($_GET['get_user_id']);
    if(!$mobile==""){
    $sql=mysqli_query($con,"select * from user where mobile='$mobile'");
    if(mysqli_num_rows($sql)==1){
       $result=mysqli_fetch_array($sql) ;
       echo $result['id'];
    }else{
        echo "NO";
    }
    }else{
        echo "NO";
    }
    
}


if(isset($_GET['name_id'])){
    $userid=VerifyData($_GET['name_id']);
    $sql=mysqli_fetch_array(mysqli_query($con,"select * from user where id='$userid'"));
    echo $sql['name'];
    
}

if(isset($_GET['fee_id'])){
    $userid=VerifyData($_GET['fee_id']);
    $sql=mysqli_fetch_array(mysqli_query($con,"select * from wallet where userid='$userid'"));
    echo $sql['fee'];
    
}

?>
<?php  mysqli_close($con); ?>