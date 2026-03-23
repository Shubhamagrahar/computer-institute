<?php
include 'con.php';
include 'assets.php';


$query = mysqli_query($con, "SELECT  bread_img FROM website_data LIMIT 1");
$website_data = mysqli_fetch_assoc($query);

$bread_img = $website_data['bread_img'] ?? 'img/background/Learning-bg.png'; // Default fallback

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $brand_name ?> | Branch List </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">

   <?php include 'head.php'; ?>
   
   
   <style>
    .exam_container {
        width: 100%;
        max-width: 1200px;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        /*overflow: auto;*/
        margin: 0 auto;
    }
    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #2980b9;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #d1ecf1;
        transform: scale(1.02);
        transition: all 0.3s ease;
    }
    @media (max-width: 768px) {
        table, th, td {
            /*display: block;*/
            width: 100%;
        }
        thead tr {
            /*display: none;*/
        }
        tr {
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            background-color: white;
        }
        td::before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            color: #2980b9;
        }
    }
    .table {
        overflow: auto;
    }
    .animated-heading {
        font-size: 2rem;
    }
    .text-white a{
        color:white;
    }
</style>
   
</head>

<body>


    <!-- Navbar Start -->
    <?php include 'header.php'; ?>
   
   
   
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header"
         style="background: linear-gradient(rgba(24, 29, 56, 0.7), rgba(24, 29, 56, 0.7)), url('<?php echo $bread_img; ?>');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Branch List</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class=""><a class="text-white" href="./"> Home / </a></li>
                            <li class=""><a class="text-white" href="#">  Branch / </a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"> Branch List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>  
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-xxxl py-5">
        
        <div class="exam_container">
    <h2 class="animated-heading">Branch List</h2>
    <div class="table">
    <table>
        <thead>
            <tr>
                <th>SR. NO.</th>
                <th>CENTRE NAME</th>
                <th>CENTRE HEAD</th>
                <th>ADDRESS</th>
                <th>DETAILS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $branch_list = mysqli_query($con, "select * from user where type='1' and status='1' order by id");
                $sr = 1;
            while($row = mysqli_fetch_array($branch_list)){
            ?>
            <tr>
                <td><?php echo $sr++; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['father_name']; ?></td>
                <td><i class="fa-solid fa-location-dot"></i> <?php echo $row['full_add']; ?><br>
                                          <a href="mailto:<?php echo $row['email']; ?>"><i class="fa-regular fa-envelope"></i>  <?php echo $row['email']; ?></a></td>
                <td>
                <button class="btn btn-info text-white">
                    <a href="branch_details?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-globe"></i> View Details </a>
                </button>
            </td>
            </tr>
            
           <?php } ?>
          
        </tbody>
    </table>
    </div>
</div>
        
    </div>
    <!-- Team End -->
        

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->




    <!-- JavaScript Libraries -->
    <script src="code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>