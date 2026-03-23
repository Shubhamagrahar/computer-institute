<?php
session_start();
include 'session.php';


$stmt_school = $con->prepare("SELECT * FROM website_data WHERE id = 1");
$stmt_school->execute();
$row_school = $stmt_school->get_result()->fetch_assoc();



if (isset($_GET['userid']) && isset($_GET['session_id'])) {
    $userid = mysqli_real_escape_string($con, $_GET['userid']);
    $student_session_id = mysqli_real_escape_string($con, $_GET['session_id']);
    $selectedTemplate = mysqli_real_escape_string($con, $_GET['template']);
    
    $session_details = mysqli_fetch_array(mysqli_query($con, "select session from session_details where status='RUN' and id='$student_session_id'"));
    $session_name = $session_details['session'];
    
    
    $query = "SELECT * FROM user WHERE id = '$userid'";
    $result = mysqli_query($con, $query);
    
    $student_admission_details = mysqli_fetch_array(mysqli_query($con, "select class_id, class_section, transportation from student_admission_details where userid='$userid'"));
    $class_id = $student_admission_details['class_id'];
    $section_id = $student_admission_details['class_section'];
    $transport = $student_admission_details['transportation'];
    
    $class_name = mysqli_fetch_array(mysqli_query($con, "select name from class_details where id='$class_id'"));
    $section_name = mysqli_fetch_array(mysqli_query($con, "select name from section_details where id='$section_id'"));
if ($row = mysqli_fetch_assoc($result)) {
    
    $dobFormatted = date("d M Y", strtotime($row['dob']));
    
    $trimmedAddress = strlen($row['full_add_permanent']) > 20
    ? substr($row['full_add_permanent'], 0, 20) . '...' .$row['pin']
    : $row['full_add_permanent'].$row['pin'];
    // Create the HTML for the ID card with the desired structure
$id_card_html = "
<html>
    <head>
        <title>Student ID Card</title>
<style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        body {
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            gap: 30px;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 18px;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }

        .id-card {
            width:6cm;
            height:8.6cm;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            text-align: center;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.5);
            margin: 10px;
            
        }
        .id-header {
            display: flex;
            padding: 10px;
            background: url('uploads/idCardTemplate/idCard1.png') no-repeat center/cover;
            height: 130px;
        }
        .id-header1 {
            display: flex;
            padding: 10px;
            background: url('uploads/idCardTemplate/idCard34.png') no-repeat center/cover;
            height: 130px;
        }
        .id-header4 {
            display: flex;
            padding: 10px;
            background: linear-gradient(45.1deg, rgb(43, 51, 120) 8.35%, rgb(78, 185, 101) 102.02%) no-repeat;
            height: 130px;
        }
        .id-header img, .id-header1 img, .id-header4 img {
            width: 50px;
            height: 50px;
            margin-right: 5px;
            border-radius:50%;
        }
        .id-header h1, .id-header1 h1, .id-header4 h1 {
            font-size: 11px;
            font-weight:800;
            color: #ffffff;
            margin-top:8px;
        }
        .id-body {
            padding: 10px;
            margin-top:-85px;
        }
        .id-body h2 {
            font-size: 11px;
            color: #0015a2;
            margin-bottom: 0px;
        }
        .id-body p {
            font-size: 9px;
            margin: 3px 0;
            color: #555;
        }
        .id-body .label {
            font-weight: bold;
            color: #000;
            left: 46.5rem;
        }
        .id-footer {
            margin-top: -10px;
            padding: 7px 0;
            background:#ffffff;
            border-top: 1px solid #000000;
            font-size: 11px;
            color: #000000;
            font-weight: bold;
        }
        .principal-sign {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .principal-sign p {
            font-size: 12px;
            color: #0015a2;
        }
        .principal-sign img {
            width: 50px;
            height: 20px;
            margin-bottom:-5px;
        }
        .student-photo {
            display: block;
            width: 70px;
            height: 70px;
            margin: 0px auto;
            border: 2px solid #ccc;
            border-radius:11%;
        }
        .session{
            font-size:9px !important;
        }
        .adm, .dob, .phone, .fname, .address{
            display:flex;
            font-size: 10px;
            justify-content: center;
            line-height:15px;
            justify-content: space-between;
        }
        .header{
            display: flex;
        }
        .colon{
            position: absolute;
            margin-left: 45px;
        }
        .content{
            position: absolute;
            margin-left: 55px;
        }
        
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
        .button{
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        .option {
            text-align: center;
            margin: 10px 0;
        }
        
        .option label {
            display: inline-block;
            font-size: 16px;
            margin-bottom: 20px;
        } 
        
        /*Design-3*/
        
        
        .card-1{
            display:flex;
            flex-direction:column;
        }
        
        .id-card-1{
            width:321px;
            height:197px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            text-align: center;
            background: #fff;
            border: 1px solid lightgrey;
            background: url('uploads/idCardTemplate/idCard5.png') no-repeat center/cover;
        }
        .logo-img img{
            width: 50px;
            height: 50px;
            margin-right: 5px;
            border-radius: 50%;
        }
        .scl-name h1{
            font-size: 12px;
            font-weight: 800;
            color: #ffffff;
            margin-top: 4px;
            }
        .scl-name2 h1 {
            font-size: 13px;
            font-weight: 800;
            color: #ffffff;
            margin-top: 4px;
        }
        .scl-name h2, .scl-name2 h2{
            font-size:9px;
            color: white;
            margin-top:-17px;
        }
        .id-header2, .id-header3, .id-header9{
            display: flex;
            gap: 35px;
            margin-top: 2px;
            margin-left: 5px;
            }
            
        .css-tuxzvu {
            box-sizing: border-box;
            display: flex;
            flex-flow: wrap;
            margin-top: -8px;
            width: calc(100% + 8px);
            margin-left: -8px;
        }
        .css-tuxzvu > .MuiGrid-item {
        padding-left: 8px;
        }
        .css-tuxzvu > .MuiGrid-item {
            padding-top: 8px;
        }
@media (min-width: 1200px) {
    .css-y4pdto {
        flex-basis: 66.6667%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 66.6667%;
    }
}
@media (min-width: 900px) {
    .css-y4pdto {
        flex-basis: 66.6667%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 66.6667%;
    }
}
@media (min-width: 600px) {
    .css-y4pdto {
        flex-basis: 66.6667%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 66.6667%;
    }
}
.css-y4pdto {
    box-sizing: border-box;
    flex-direction: row;
    flex-basis: 66.6667%;
    -webkit-box-flex: 0;
    flex-grow: 0;
    max-width: 66.6667%;
    margin: 8px;
}
.css-1d3bbye {
    box-sizing: border-box;
    display: flex;
    flex-flow: wrap;
    width: 100%;
}
@media (min-width: 1200px) {
    .css-4xkoi8 {
        flex-basis: 25%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 25%;
    }
}
.bvWiBK .heading {
    font-weight: 700;
    font-size: 10px;
    text-transform: uppercase;
}
.css-8va9ha {
    margin: 0px;
    font-family: Inter, sans-serif;
    font-weight: 400;
    font-size: 10px;
    line-height: 1.5;
    text-align: left !important;
    
}
@media (min-width: 1200px) {
    .css-14ybvol {
        flex-basis: 75%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 75%;
    }
}
@media (min-width: 900px) {
    .css-14ybvol {
        flex-basis: 75%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 75%;
    }
}
@media (min-width: 600px) {
    .css-14ybvol {
        flex-basis: 75%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 75%;
    }
}
.css-14ybvol {
    box-sizing: border-box;
    margin: 0px;
    flex-direction: row;
    flex-basis: 75%;
    -webkit-box-flex: 0;
    flex-grow: 0;
    max-width: 75%;
}
.css-tuxzvu > .MuiGrid-item {
    padding-left: 8px;
}
.css-tuxzvu > .MuiGrid-item {
    padding-top: 8px;
}

.bold{
    font-weight:600;
}
.css-1d3bbye {
    box-sizing: border-box;
    display: flex;
    flex-flow: wrap;
    width: 100%;
}
.css-15j76c0{
    margin: 0 auto;
}
@media (min-width: 1200px) {
    .css-15j76c0 {
        flex-basis: 100%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 100%;
    }
}
@media (min-width: 900px) {
    .css-15j76c0 {
        flex-basis: 100%;
        -webkit-box-flex: 0;
        flex-grow: 0;
        max-width: 100%;
    }
}
.css-9a11r8 {
    margin: 0px;
    font-family: Inter, sans-serif;
    margin-top:-10px !important;
    color: rgb(255, 0, 0);
    font-size: 9px;
    text-align: center;
    font-weight: 700;
}
.sec p{
    font-size:9px;
    color:black;
    font-weight:bolder;
    
}
.sect{
    margin-top:-20px;
}
.css-j7qwjs {
    display: flex;
    flex-direction: column;
}
.sign {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-top: -21px;
    margin-left: 10px;
    color: blue;
    font-weight: 600;
}
.full{
    display: flex;
    flex-direction: row;
    width: 100%;
}
/*Design-4*/
    .id-header3{
        margin:0;
        background: linear-gradient(45.1deg, rgb(43, 51, 120) 8.35%, rgb(78, 185, 101) 102.02%) no-repeat;
        height: 55px;
        color: white;
        position: relative;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        }
    .id-card-2{
            width:321px;
            height:197px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            text-align: center;
            background: #fff;
            border: 1px solid lightgrey;
            margin-top: 15px;
            /*background: url('assets/images/studentIdCard5.39f82ae3ad715e99aef8.png') no-repeat center/cover;*/
            /*filter: drop-shadow(2px 4px 6px black);*/
        }
        .school{
            padding-left:15px;
            padding-top: 5px;
        }
        .studet{
            margin-top:-12px !important;
        }
        
        /*DESIGN-9*/
        
        .id_card_header {
            height: 55px;
            background-color: rgb(37, 59, 101);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            position: relative;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            padding: 0px 10px;
        }
        .id_card_header .white_strip {
            position: absolute;
            top: 0px;
            left: 60px;
            object-fit: cover;
            height: 55px;
            overflow: hidden;
        }
        
        .school_logo{
            background: white;
        }
        
        .id_card_header .school_logo {
            height: 50px;
            width: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
        .id_card_header .name_container {
            padding-left: 56px;
            color: white;
        }
        .id_card_header .school_name {
            font-size: 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 195px;
            line-height: 15px;
            font-weight: 500;
            text-align: center !important;
        }
        .id_card_header .address_name1 {
            font-size: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 200px;
            line-height: 15px;
            text-align: center !important;
        }
        .sessions{
            display: flex;
            justify-content: space-evenly;
            background-color: rgb(230, 234, 237);
        }
        .ml-5{
            margin-left: 20px;
        }     
    </style>
    
    </head>
    <body> " ?>
    
    <?php if($selectedTemplate == 8){
    $id_card_html .="
    <div class='card-1'>
    <!-- ID Card 6 -->
    
    <div class='id-card-2'>
        
        <div class='id_card_header'>
            <img src='uploads/idCardTemplate/idCard8.png' class='white_strip'>
            <div class='MuiBox-root css-0'>
                <img src='$brand_logo' class='school_logo' class='school_logo'>
            </div>
            <div class='name_container'>
                <p class='MuiTypography-root MuiTypography-body1 school_name css-8va9ha'>$brand_name</p>
                <p class='MuiTypography-root MuiTypography-body1 address_name1 css-8va9ha'>$brand_add</p>
            </div>
        </div>
        
        <div class='sessions'>
        <div style='padding-left: 10px; padding-top: 1px; height: 14px; '>
            <h6>Identity Card : 2024-2025</h6>
        </div>
        <div class='trans'>
            <h6>Transport : $transport</h6>
        </div>
        </div>
        
        <!--<div class='MuiGrid-root MuiGrid-container css-1d3bbye'>-->
        <!--    <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 css-15j76c0'>-->
        <!--        <p class='MuiTypography-root MuiTypography-body1 css-9a11r8'>Cont : 9876543210,123456789</p>-->
        <!--    </div>-->
        <!--</div>-->
        
        <div class='MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1 css-tuxzvu studet'>
            
            <div class='MuiStack-root css-19m7kbw sec'>
                        <!--<div class='sect'>-->
                        <!--<p>SESSION : $session_name</p> -->
                        
                        <!--</div>-->
                        <br>
                        <img alt='' width='65px' height='65px' style='border: 1px solid black; margin-top:10px; margin-left: 20px;' src='{$web_link}{$row['photo']}'>
                        <!--<p class='MuiTypography-root MuiTypography-body1 mobile css-8va9ha'>Mob: {$row['mobile']}</p>-->
                    </div>
                    
            <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-8 css-y4pdto'>
                <div class='MuiGrid-root MuiGrid-container css-1d3bbye'>
                    <div class='full' style='margin-top:8px;'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>NAME </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$row['name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>FATHER'S </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$row['father_name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>CLASS </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-5.5 css-1tqxarj'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> :{$class_name['name']} - {$section_name['name']}</p>
                        </div>
                    <!--</div>-->
                    <!--<div class='full'>-->
                        <!--<div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-1.5 css-1chpm7x'>-->
                        <!--    <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'> SEC </p>-->
                        <!--</div>-->
                        <!--<div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-2 css-o0rlmm'>-->
                        <!--    <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : A</p>-->
                        <!--</div>-->
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>DOB </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : $dobFormatted</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>ADDRESS </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : $trimmedAddress</p>
                        </div>
                    </div>
                </div>
            </div>
        <div class='sign'>
            <div class='MuiStack-root css-j7qwjs' style='margin-top:-12px;'>
                <img src='{$web_link}{$principal_sign}' alt='sig' style='width: 40px; height: 40px; object-fit: contain; margin-left: 17px; margin-bottom: 5px;'>
            </div>
            <div class='MuiStack-root css-j7qwjs'>
                <p class='MuiTypography-root MuiTypography-body1 sign css-8va9ha'>PRINCIPAL SIGN</p>
            </div>
        </div>
        </div>
        
    </div></div>";
        
    }
    else if($selectedTemplate == 7){
         $id_card_html .="<div class='card-1'>
    <!-- ID Card 6 -->
    
    <div class='id-card-2'>
        <div class='id-header3'>
            <div class='logo-img'>
            </div>
            <div class='scl-name2 '>
                    <h1>$brand_name</h1>
                    <h2>$brand_add</h2>
            </div>
            
        </div>
        
        <div style='padding-left: 10px; padding-top: 1px; height: 14px; background-color: rgb(230, 234, 237);'><h6>Identity Card : $session_name</h6></div>
        
        
        <!--<div class='MuiGrid-root MuiGrid-container css-1d3bbye'>-->
        <!--    <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 css-15j76c0'>-->
        <!--        <p class='MuiTypography-root MuiTypography-body1 css-9a11r8'>Cont : 9876543210,123456789</p>-->
        <!--    </div>-->
        <!--</div>-->
        
        <div class='MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1 css-tuxzvu studet'>
            
            <div class='MuiStack-root css-19m7kbw sec'>
                        <!--<div class='sect'>-->
                        <!--<p>SESSION : $session_name</p> -->
                        
                        <!--</div>-->
                        <br>
                        <img alt='' width='65px' height='65px' style='border: 1px solid black; margin-top:10px; margin-left: 20px;' src='{$web_link}{$row['photo']}'>
                        <!--<p class='MuiTypography-root MuiTypography-body1 mobile css-8va9ha'>Mob: {$row['mobile']}</p>-->
                    </div>
                    
            <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-8 css-y4pdto'>
                <div class='MuiGrid-root MuiGrid-container css-1d3bbye'>
                    <div class='full' style='margin-top:8px;'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>NAME </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$row['name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>FATHER'S </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$row['father_name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>CLASS </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-5.5 css-1tqxarj'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> :{$class_name['name']} - {$section_name['name']}</p>
                        </div>
                    <!--</div>-->
                    <!--<div class='full'>-->
                        <!--<div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-1.5 css-1chpm7x'>-->
                        <!--    <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'> SEC </p>-->
                        <!--</div>-->
                        <!--<div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-2 css-o0rlmm'>-->
                        <!--    <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : A</p>-->
                        <!--</div>-->
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>DOB </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : $dobFormatted</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>ADDRESS </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> :$trimmedAddress</p>
                        </div>
                    </div>
                </div>
            </div>
        <div class='sign'>
            <div class='MuiStack-root css-j7qwjs' style='margin-top:-12px;'>
                <img src='{$web_link}{$principal_sign}' alt='sig' style='width: 40px; height: 40px; object-fit: contain; margin-left: 17px; margin-bottom: 5px;'>
            </div>
            <div class='MuiStack-root css-j7qwjs'>
                <p class='MuiTypography-root MuiTypography-body1 sign css-8va9ha'>PRINCIPAL SIGN</p>
            </div>
        </div>
        </div>
        
    </div></div>";
    }
    else if($selectedTemplate == 6){
    $id_card_html .="<div class='card-1'>
    <div class='id-card-2'>
        <div class='id-header3'>
            <div class='logo-img'>
                <img src='$brand_logo' class='school_logo'>
            </div>
            <div class='scl-name2 '>
                    <h1>$brand_name</h1>
                    <h2>$brand_add</h2>
            </div>
            
        </div>
        
        <div style='padding-left: 10px; padding-top: 1px; height: 14px; background-color: rgb(230, 234, 237);'><h6>Identity Card : $session_name</h6></div>
        
        
        <!--<div class='MuiGrid-root MuiGrid-container css-1d3bbye'>-->
        <!--    <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 css-15j76c0'>-->
        <!--        <p class='MuiTypography-root MuiTypography-body1 css-9a11r8'>Cont : 9876543210,123456789</p>-->
        <!--    </div>-->
        <!--</div>-->
        
        <div class='MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1 css-tuxzvu studet'>
            
            <div class='MuiStack-root css-19m7kbw sec'>
                        <!--<div class='sect'>-->
                        <!--<p>SESSION : 2024-25</p> -->
                        
                        <!--</div>-->
                        <br>
                        <img alt='' width='65px' height='65px' style='border: 1px solid black; margin-top:10px; margin-left: 20px;' src='{$web_link}{$row['photo']}'>
                        <!--<p class='MuiTypography-root MuiTypography-body1 mobile css-8va9ha'>Mob: {$row['mobile']}</p>-->
                    </div>
                    
            <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-8 css-y4pdto'>
                <div class='MuiGrid-root MuiGrid-container css-1d3bbye'>
                    <div class='full' style='margin-top:8px;'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>NAME </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$row['name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>FATHER'S </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$row['father_name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>CLASS </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-5.5 css-1tqxarj'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> :{$class_name['name']} - {$section_name['name']} </p>
                        </div>
                    <!--</div>-->
                    <!--<div class='full'>-->
                        <!--<div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-1.5 css-1chpm7x'>-->
                        <!--    <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'> SEC </p>-->
                        <!--</div>-->
                        <!--<div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-2 css-o0rlmm'>-->
                        <!--    <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> :{$row['class_section']}</p>-->
                        <!--</div>-->
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>DOB </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : $dobFormatted</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>ADDRESS </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : $trimmedAddress</p>
                        </div>
                    </div>
                </div>
            </div>
        <div class='sign'>
            <div class='MuiStack-root css-j7qwjs' style='margin-top:-12px;'>
                <img src='{$web_link}{$principal_sign}' alt='sig' style='width: 40px; height: 40px; object-fit: contain; margin-left: 17px; margin-bottom: 5px;'>
            </div>
            <div class='MuiStack-root css-j7qwjs'>
                <p class='MuiTypography-root MuiTypography-body1 sign css-8va9ha'>PRINCIPAL SIGN</p>
            </div>
        </div>
        </div>
    </div></div>";
    }
    else if($selectedTemplate == 5){$id_card_html .="    <div class='id-card-1'>
        <div class='id-header2'>
            <div class='logo-img'>
                <img src='$brand_logo' class='school_logo'>
            </div>
            <div class='scl-name2'>
                    <h1>$brand_name</h1>
                    <h2>$brand_add</h2>
            </div>
            
        </div>
        
        <div class='MuiGrid-root MuiGrid-container css-1d3bbye'>
            <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 css-15j76c0'>
                <p class='MuiTypography-root MuiTypography-body1 css-9a11r8'>Cont : {$row['mobile']}</p>
            </div>
        </div>
        
        <div class='MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1 css-tuxzvu '>
            <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-8 css-y4pdto'>
                <div class='MuiGrid-root MuiGrid-container css-1d3bbye'>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>NAME </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$row['name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>FATHER'S </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$row['father_name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>CLASS </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-5.5 css-1tqxarj'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$class_name['name']} </p>
                        </div>
                    <!--</div>-->
                    <!--<div class='full'>-->
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-1.5 css-1chpm7x'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'> SEC </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-2 css-o0rlmm'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : {$section_name['name']}</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>DOB </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : $dobFormatted</p>
                        </div>
                    </div>
                    <div class='full'>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3 css-4xkoi8'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha bold'>ADDRESS </p>
                        </div>
                        <div class='MuiGrid-root MuiGrid-item MuiGrid-grid-xs-9 css-14ybvol'>
                            <p class='MuiTypography-root MuiTypography-body1 heading css-8va9ha'> : $trimmedAddress</p>
                        </div>
                    </div>
                </div>
            </div>
                    <div class='MuiStack-root css-19m7kbw sec'>
                        <div class='sect'>
                        <p>SESSION : </p> 
                        <p>$session_name</p>
                        </div>
                        <br>
                        <img alt='' width='75px' height='90px' style='border: 2px solid black; margin-top:-7px;' src='{$row['photo']}'>
                        <p class='MuiTypography-root MuiTypography-body1 mobile css-8va9ha'>Mob: '{$row['mobile']}'</p>
                    </div>
        <div class='sign'>
            <div class='MuiStack-root css-j7qwjs'>
                <img src='{$web_link}{$principal_sign}' alt='sig' style='width: 40px; height: 40px; object-fit: contain; margin-left: 17px; margin-bottom: 5px;'>
            </div>
            <div class='MuiStack-root css-j7qwjs'>
                <p class='MuiTypography-root MuiTypography-body1 sign css-8va9ha'>PRINCIPAL SIGN</p>
            </div>
        </div>
        </div>
        
    </div>";}
    else if($selectedTemplate == 4){$id_card_html .="<div class='card-1'>
    <!-- ID Card 2.1 -->
    <div class='id-card'>
        <div class='id-header1'>
            <div class='header'>
                <div class='header-img'>
                    <img src='$brand_logo' class='school_logo' alt='School Logo'>
                </div>
                <div class='scl-name'>
                    <h1>$brand_name</h1>
                </div>
            </div>
        </div>
        <div class='id-body'>
            <img src='{$web_link}{$row['photo']}' alt='Student Photo' class='student-photo'>
            <p class='session'>ID Card: $session_name</p>
            <h2>{$row['name']}</h2>
            <p>{$class_name['name']} - {$section_name['name']}</p>
            <div class='info'>
                <div class='adm'>
                    <div class='label'>Adm. No</div>
                    <div class='colon'> <strong>:</strong> </div>
                    <div class='content'>{$row['admission_no']}</div>
                </div>
                <div class='dob'>
                    <div class='label'>DOB</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>$dobFormatted</div>
                </div>
                <div class='phone'>
                    <div class='label'>Phone</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>{$row['mobile']}</div>
                </div>
                <div class='fname'>
                    <div class='label'>F Name</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>{$row['father_name']}</div>
                </div>
                <div class='address'>
                    <div class='label'>Address</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>$trimmedAddress</div>
                </div>
            </div>
            <div class='principal-sign'>
                <div class='principle'>
                    <img src='{$web_link}{$principal_sign}'>
                    <p>Principal</p>
                </div>
                <p style='margin-bottom:-16px;'>Transport : $transport</p>
            </div>
        </div>
        <div class='id-footer'>
            $brand_add
        </div>
    </div></div>";}
    else if($selectedTemplate == 3){$id_card_html .="<div class='card-1'>
    <!-- ID Card 2.1 -->
    <div class='id-card'>
        <div class='id-header1'>
            <div class='header'>
                <div class='header-img'>
                    <img src='$brand_logo' class='school_logo' alt='School Logo'>
                </div>
                <div class='scl-name'>
                    <h1>$brand_name</h1>
                </div>
            </div>
        </div>
        <div class='id-body'>
            <img src='{$web_link}{$row['photo']}' alt='Student Photo' class='student-photo' style='border-radius:50%;'>
            <p class='session'>ID Card: $session_name</p>
            <h2>{$row['name']}</h2>
            <p>{$class_name['name']} - {$section_name['name']}</p>
            <div class='info'>
                <div class='adm'>
                    <div class='label'>Adm. No</div>
                    <div class='colon'> <strong>:</strong> </div>
                    <div class='content'>{$row['admission_no']}</div>
                </div>
                <div class='dob'>
                    <div class='label'>DOB</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>$dobFormatted</div>
                </div>
                <div class='phone'>
                    <div class='label'>Phone</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>{$row['mobile']}</div>
                </div>
                <div class='fname'>
                    <div class='label'>F Name</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>{$row['father_name']}</div>
                </div>
                <div class='address'>
                    <div class='label'>Address</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>$trimmedAddress</div>
                </div>
            </div>
            <div class='principal-sign'>
                <div class='principle'>
                    <img src='{$web_link}{$principal_sign}'>
                    <p>Principal</p>
                </div>
                <p style='margin-bottom:-16px;'>Transport : $transport</p>
            </div>
        </div>
        <div class='id-footer'>
            $brand_add
        </div>
    </div>
</div>";}
    else if($selectedTemplate == 2){$id_card_html .="    <div class='card-1'>
    <!-- ID Card 1.1 -->
    <div class='id-card'>
        <div class='id-header'>
            <div class='header'>
                <div class='header-img'>
                    <img src='$brand_logo' class='school_logo' alt='School Logo'>
                </div>
                <div class='scl-name'>
                    <h1>$brand_name</h1>
                </div>
            </div>
        </div>
        <div class='id-body'>
            <img src='{$web_link}{$row['photo']}' alt='Student Photo' class='student-photo' style='border-radius:50%;'>
            <p class='session'>ID Card: $session_name</p>
            <h2>{$row['student_name']}</h2>
            <p>{$class_name['name']} - {$section_name['name']}</p>
            <div class='info'>
                <div class='adm'>
                    <div class='label'>Adm. No</div>
                    <div class='colon'> <strong>:</strong> </div>
                    <div class='content'>{$row['admission_no']}</div>
                </div>
                <div class='dob'>
                    <div class='label'>DOB</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>$dobFormatted</div>
                </div>
                <div class='phone'>
                    <div class='label'>Phone</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>{$row['mobile']}</div>
                </div>
                <div class='fname'>
                    <div class='label'>F Name</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>{$row['father_name']}</div>
                </div>
                <div class='address'>
                    <div class='label'>Address</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>$trimmedAddress</div>
                </div>
            </div>
            <div class='principal-sign'>
                <div class='principle'>
                    <img src='{$web_link}{$principal_sign}'>
                    <p>Principal</p>
                </div>
                <p style='margin-bottom:-16px;'>Transport : $transport</p>
            </div>
        </div>
        <div class='id-footer'>
            $brand_add
        </div>
    </div>
    
    </div>
";}
    else if($selectedTemplate == 1){$id_card_html .="   <div class='card-1'>
           <div class='card-1 id-card-container'>
    <div class='id-card'>
        <div class='id-header'>
            <div class='header'>
                <div class='header-img'>
                    <img src='$brand_logo' class='school_logo' alt='School Logo'>
                </div>
                <div class='scl-name'>
                    <h1>$brand_name</h1>
                </div>
            </div>
        </div>
        <div class='id-body'>
            <img src='{$web_link}{$row['photo']}' alt='Student Photo' class='student-photo'>
            <p class='session'>ID Card: $session_name</p>
            <h2>{$row['name']}</h2>
            <p>{$class_name['name']} - {$section_name['name']}</p>
            <div class='info'>
                <div class='adm'>
                    <div class='label'>Adm. No</div>
                    <div class='colon'> <strong>:</strong> </div>
                    <div class='content'>{$row['admission_no']}</div>
                </div>
                <div class='dob'>
                    <div class='label'>DOB</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>$dobFormatted</div>
                </div>
                <div class='phone'>
                    <div class='label'>Phone</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>{$row['mobile']}</div>
                </div>
                <div class='fname'>
                    <div class='label'>F Name</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>{$row['father_name']}</div>
                </div>
                <div class='address'>
                    <div class='label'>Address</div>
                    <div class='colon'><strong>:</strong></div>
                    <div class='content'>$trimmedAddress</div>
                </div>
            </div>
            <div class='principal-sign'>
                <div class='principle'>
                    <img src='{$web_link}{$principal_sign}'>
                    <p>Principal</p>
                </div>
                <p style='margin-bottom:-16px;'>Transport :$transport</p>
            </div>
        </div>
        <div class='id-footer'>
           $brand_add
        </div>
    </div>
</div></div>
";}
    
    $id_card_html .="</body></html>";
    echo $id_card_html;
    } else {
        echo "Error: Student not found.";
    }
}


if (isset($_GET['staff_id'])) {
    $staff_id = mysqli_real_escape_string($con, $_GET['staff_id']);

    $query = "SELECT * FROM staff WHERE id = '$staff_id'";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $id_card_html = "
        <html>
            <head>
                <title>Staff ID Card</title>
                <style>
                    .id-card {
                        width: 50mm;
                        height: 85mm;
                        border: 1px solid black;
                        border-radius: 10px;
                        padding: 8px;
                        background-color: #fff;
                        text-align: center;
                        position: relative;
                        overflow: hidden;
                        page-break-inside: avoid;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: space-between;
                    }
                    
                    .id-card-header img {
                        width: 80px;
                        height: 80px;
                        border-radius: 50%;
                        margin: 5px auto;
                        border: 1px solid black;
                    }
                    
                    .id-card-header h3 {
                        font-size: 16px;
                        color: black;
                        margin: 4px 0;
                    }
                    
                    .id-card-header p {
                        font-size: 12px;
                        color: #555;
                        margin: 2px 0;
                    }
                    
                    .id-card-body {
                        font-size: 15px;
                        text-align: left;
                        padding: 8px;
                    }
                    
                    .id-card-body p {
                        margin: 4px 0;
                        
                        font-weight: 500;
                        color: #333;
                    }
                    
                    .id-card-body .label {
                        font-weight: bold;
                        color: black;
                    }
                    
                    .page {
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: space-between;
                        page-break-after: always; /* Ensures three cards per page */
                    }
                    
                        /* Background Green design */
                    .id-card::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: linear-gradient(135deg, rgba(40, 167, 69, 0.08) 20%, rgba(40, 167, 69, 0.25) 80%);
                        clip-path: polygon(0% 10%, 100% 0%, 90% 100%, 10% 90%);
                        z-index: 0;
                    }
                    
                        /* School Information */
                    .school-info {
                        width: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 12px;
                        font-weight: bold;
                        color: #333;
                        margin-bottom: 5px;
                        padding: 5px;
                        background: rgba(255, 255, 255, 0.7);
                    }
                    .school-info img {
                        height: 25px;
                        width: 25px;
                        margin-right: 5px;
                    }
                    
                    @media print {
                        .id-card-container {
                            display: block;
                        }
                        .page {
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: center;
                        }
                        .page{
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: center;
                        }
                    }
                    
                </style>
            </head>
            <body>
                <div class='id-card'>
                    <!-- School Information -->
                    <div class='school-info'>
                        <img src='{$row_school['logo']}' alt='School Logo'>
                        {$row_school['name']}
                    </div>
                    
                    <!-- Header Section -->
                    <div class='id-card-header'>
                        <img src='{$row['staff_image']}' alt='Staff Photo'>
                        <h3>{$row['name']}</h3>
                        <p>Designation: {$row['designation']}</p>
                    </div>
                    
                    <!-- Body Section -->
                    <div class='id-card-body'>
                        <p><span class='label'>Mobile:</span> {$row['mobile']}</p>
                        <p><span class='label'>Gender:</span> {$row['gender']}</p>
                        <p><span class='label'>DOB:</span> {$row['dob']}</p>
                        <p><span class='label'>Address:</span> {$row['address']}</p>
                        <p><span class='label'>Joining Date:</span> {$row['joining_date']}</p>
                    </div>
                </div>
            </body>
        </html>";
        echo $id_card_html;
    } else {
        echo "Error: Staff member not found.";
    }
}


if (isset($_GET['trans_id'])) {
    
    // Function to make the amount from numbers to words
    function convertNumberToWords($number, $isFirst = true) {
        $words = array(
            0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
            6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten',
            11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty',
            30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy',
            80 => 'Eighty', 90 => 'Ninety'
        );
        
        if ($number == 0 && $isFirst) {
            return "Zero";
        }
        
        if ($number < 21) {
            return $words[$number];
        }
        
        if ($number < 100) {
            return $words[$number - $number % 10] . " " . $words[$number % 10];
        }
        
        if ($number < 1000) {
            return $words[floor($number / 100)] . " Hundred " . convertNumberToWords($number % 100, false);
        }
        
        if ($number < 100000) {
            return convertNumberToWords(floor($number / 1000), false) . " Thousand " . convertNumberToWords($number % 1000, false);
        }
        
        if ($number < 10000000) {
            return convertNumberToWords(floor($number / 100000), false) . " Lakh " . convertNumberToWords($number % 100000, false);
        }
        
        return convertNumberToWords(floor($number / 10000000), false) . " Crore " . convertNumberToWords($number % 10000000,false);
    }

    
    $trans_id = mysqli_real_escape_string($con, $_GET['trans_id']);
    $query = "SELECT * FROM transaction WHERE id = ?";
    $query_stmt = $con->prepare($query);
    $query_stmt->bind_param("i", $trans_id);
    $query_stmt->execute();
    $query_res = $query_stmt->get_result();
    
    if ($query_row = $query_res->fetch_assoc()) { ?>
<!DOCTYPE html>
<html>
<head>
    <title>Fee Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .receipt-container {
            width: 100%;
            max-width: 1000px;
            max-height: 170mm;
            margin: 20px auto;
            background: #fff;
            /*border: 1px solid #000;*/
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }
        .receipt {
            width: 48%;
            border: 1px solid #000;
            max-height: 190mm;
            padding: 3px;
            box-sizing: border-box;
        }
        .receipt-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .receipt-header {
            text-align: center;
            margin: 2px 0; /* Reduce space between paragraphs */
            line-height: 1.2; /* Adjust line height for tighter spacing */
        }
        .receipt-table, .payment-details {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt-table th, .receipt-table td, .payment-details th, .payment-details td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        .signature {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    <!-- Check the role, and show details accordingly-->
    <?php

        $role = $query_row['role'];
        // If role = student, show the class and father name
        $stmt_student = $con->prepare("SELECT admission_class, class_section, father_name FROM students WHERE student_id = ?");
        $stmt_student->bind_param("i", $query_row['user_id']);
        $stmt_student->execute();
        $row_student = $stmt_student->get_result()->fetch_assoc();
    ?>
    
    <div class="receipt-container">
        <div class="receipt">
            <div class="receipt-title">(FEE PAYMENT - RECEIPT) (Office Copy)</div>
            <div class="receipt-header">
                <h3><?= $row_school['name'] ?></h3>
                <p><?= $row_school['full_address'] ?></p>
                <p>Mobile: <?= $row_school['phone'] ?>, Email: <?= $row_school['email'] ?></p>
            </div>
            <p>
                REC NO.: <?php echo htmlspecialchars($query_row['id']); ?> 
                <span style="display: inline-block; width: 160px;"></span> 
                DATE: <?php echo $query_row['date_time']; ?>
            </p>
            <p>Reg. No.: <?php echo htmlspecialchars($query_row['user_id']); ?></p>
            <p><?= $role ?> Name: <?php echo htmlspecialchars($query_row['user_name']); ?> </p>
            <?php if($role == "Student"){ ?>
            <p> Father's Name:- <?= $row_student['father_name'] ?></p>
            <p>Class:- <?= $row_student['admission_class'] ?> Section:- <?= $row_student['class_section'] ?> </p>
            <?php }
            ?>
            <table class="receipt-table">
                <tr><th>S.N.</th><th>Particular</th><th>Amount</th></tr>
                <tr><td>1</td><td><?php echo htmlspecialchars($query_row['description']); ?>
                </td><td><?php echo '₹' . number_format($query_row['amt'], 2); ?></td></tr>
            </table>
            <?php
                $payment_json = $query_row['payment_details'] ?? ''; // Use empty string if null
                $payment_details = json_decode($payment_json ?: '{}', true);
            ?>
            <table class="payment-details">
                <tr>
                    <td>
                        <p>PAYMENT MODE:- <?= htmlspecialchars($query_row['method']) ?></p>
                        
                        <?php if ($query_row['method'] === "QR Payment" && !empty($payment_details)): ?>
                            <p>UPI App: <?= htmlspecialchars($payment_details['upi_app'] ?? '-') ?></p>
                            <p>Transaction ID: <?= htmlspecialchars($payment_details['transaction_id'] ?? '-') ?></p>
                        
                        <?php elseif ($query_row['method'] === "Bank Transfer" && !empty($payment_details)): ?>
                            <p>Bank Name: <?= htmlspecialchars($payment_details['bank_name'] ?? '-') ?></p>
                            <p>Transaction ID: <?= htmlspecialchars($payment_details['transaction_id'] ?? '-') ?></p>
                            <p>Account Name: <?= htmlspecialchars($payment_details['account_name'] ?? '-') ?></p>
            
                        <?php elseif ($query_row['method'] === "By Cheque" && !empty($payment_details)): ?>
                            <p>Bank Name: <?= htmlspecialchars($payment_details['bank_name'] ?? '-') ?></p>
                            <p>Cheque No.: <?= htmlspecialchars($payment_details['cheque_number'] ?? '-') ?></p>
                            <p>Cheque Date: <?= htmlspecialchars($payment_details['cheque_date'] ?? '-') ?></p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <p>TOTAL AMOUNT: ₹<?php echo number_format($query_row['amt'], 2); ?></p>
                        <!--<p>(+) Late Fees: -</p>-->
                        <p>(-) Concession: -</p>
                    </td>
                </tr>
            </table>
            <p style="font-size: small">Amount in Words: - <?php echo convertNumberToWords($query_row['amt']) . " Rupees Only"; ?></p>
            <div class="signature">Auth. Signature</div>
        </div>
        <div class="receipt">
            
            <div class="receipt-title">(FEE PAYMENT - RECEIPT) (<?= $role ?> Copy)</div>
            <div class="receipt-header">
                <h3><?= $row_school['name'] ?></h3>
                <p><?= $row_school['full_address'] ?></p>
                <p>Mobile: <?= $row_school['phone'] ?>, Email: <?= $row_school['email'] ?></p>
            </div>
            <p>
                REC NO.: <?php echo htmlspecialchars($query_row['id']); ?> 
                <span style="display: inline-block; width: 160px;"></span> 
                <?php
                $dateTime = new DateTime($query_row['date_time']);
                echo "DATE: " . $dateTime->format('Y-m-d') . "<br>";
                ?>
                
            </p>
            <p>Reg. No.: <?php echo htmlspecialchars($query_row['user_id']); ?><span style="display: inline-block; width: 160px;"></span> 
                <?php
                    $dateTime = new DateTime($query_row['date_time']);
                    echo "TIME: " . $dateTime->format('H:i:s');
                    ?>
            </p>
            <p><?= $role ?> Name: <?php echo htmlspecialchars($query_row['user_name']); ?> </p>
            <?php if($role == "Student"){ ?>
            <p> Father's Name:- <?= $row_student['father_name'] ?></p>
            <p>Class:- <?= $row_student['admission_class'] ?> Section:- <?= $row_student['class_section'] ?> </p>
            <?php } 
            ?>
            <table class="receipt-table">
                <tr><th>S.N.</th><th>Particular</th><th>Amount</th></tr>
                <tr><td>1</td><td><?php echo htmlspecialchars($query_row['description']); ?></td>
                <td><?php echo '₹' . number_format($query_row['amt'], 2); ?></td></tr>
            </table>
            <?php
            $payment_details = json_decode($query_row['payment_details'], true);
            ?>
            
            <table class="payment-details">
                <tr>
                    <td>
                        <p>PAYMENT MODE:- <?= htmlspecialchars($query_row['method']) ?></p>
                        <?php if ($query_row['method'] === "QR Payment" && !empty($payment_details)): ?>
                            <p>UPI App: <?= htmlspecialchars($payment_details['upi_app'] ?? '-') ?></p>
                            <p>Transaction ID: <?= htmlspecialchars($payment_details['transaction_id'] ?? '-') ?></p>
                        
                        <?php elseif ($query_row['method'] === "Bank Transfer" && !empty($payment_details)): ?>
                            <p>Bank Name: <?= htmlspecialchars($payment_details['bank_name'] ?? '-') ?></p>
                            <p>Transaction ID: <?= htmlspecialchars($payment_details['transaction_id'] ?? '-') ?></p>
                            <p>Account Name: <?= htmlspecialchars($payment_details['account_name'] ?? '-') ?></p>
                            
                        <?php elseif ($query_row['method'] === "By Cheque" && !empty($payment_details)): ?>
                            <p>Bank Name: <?= htmlspecialchars($payment_details['bank_name'] ?? '-') ?></p>
                            <p>Cheque No.: <?= htmlspecialchars($payment_details['cheque_number'] ?? '-') ?></p>
                            <p>Cheque Date: <?= htmlspecialchars($payment_details['cheque_date'] ?? '-') ?></p>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <p>TOTAL AMOUNT: ₹<?= number_format($query_row['amt'], 2); ?></p>
                        <!--<p>(+) Late Fees: -</p>-->
                        <p>(-) Concession: -</p>
                    </td>
                </tr>
            </table>
            
            <p style="font-size: small">Amount in Words:- <?php echo convertNumberToWords($query_row['amt']) . " Rupees Only"; ?></p>
            <div class="signature">Auth. Signature</div>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Transaction not found.";
    }
} $con->close();
?>
