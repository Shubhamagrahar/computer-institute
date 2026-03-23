<!DOCTYPE html>
<html lang="en" dir="ltr">

    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Billing</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots" content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&amp;display=swap" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css" href="public/vendor/perfect-scrollbar.css" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
        <!-- Material Icons from Google Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="public/css/preloader.css" rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css" href="public/css/app.css" rel="stylesheet">

    </head>

    <body class="layout-app ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <!-- Navbar -->

                <?php include 'top-navbar.php'; ?>

                <!-- // END Navbar -->

                <!-- // END Header -->

                <div class="pt-32pt">
                    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                        <div class="flex d-flex flex-column flex-sm-row align-items-center">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0">Billing</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="./">Home</a></li>

                                    <li class="breadcrumb-item">

                                        <a href="#">Account</a>

                                    </li>

                                    <li class="breadcrumb-item active">

                                        Billing

                                    </li>

                                </ol>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->

                <!-- Page Content -->

                <div class="page-section container page__container">
                    <div class="page-separator">
                        <div class="page-separator__text">Outstanding Payments</div>
                    </div>

                    <div class="alert alert-soft-warning mb-lg-32pt">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="mr-8pt">
                                <i class="material-icons">access_time</i>
                            </div>
                            <div class="flex"
                                 style="min-width: 180px">
                                <small class="text-100">
                                    Please pay your amount due of
                                    <strong>&dollar;9.00</strong> for invoice <a href="billing-invoice"
                                       class="text-underline">10002331</a>
                                </small>
                            </div>
                            <a href="billing-payment"
                               class="btn btn-sm btn-link">Pay Now</a>
                        </div>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">Payment History</div>
                    </div>

                    <div class="card table-responsive">
                        <table class="table table-flush table-nowrap">
                            <thead>
                                <tr>
                                    <th>Invoice no.</th>
                                    <th>Date</th>
                                    <th class="text-center">Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><a href="billing-invoice"
                                           class="text-underline">10002331</a></td>
                                    <td>26 Sep 2018</td>
                                    <td class="text-center">&dollar;9</td>
                                    <td class="text-right">
                                        <div class="d-inline-flex align-items-center">
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary mr-16pt">View invoice <i class="icon--right material-icons">keyboard_arrow_right</i></a>
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary">Download <i class="icon--right material-icons">file_download</i></a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><a href="billing-invoice"
                                           class="text-underline">10003815</a></td>
                                    <td>29 Apr 2018</td>
                                    <td class="text-center">&dollar;9</td>
                                    <td class="text-right">
                                        <div class="d-inline-flex align-items-center">
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary mr-16pt">View invoice <i class="icon--right material-icons">keyboard_arrow_right</i></a>
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary">Download <i class="icon--right material-icons">file_download</i></a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><a href="billing-invoice"
                                           class="text-underline">10007382</a></td>
                                    <td>31 Mar 2018</td>
                                    <td class="text-center">&dollar;9</td>
                                    <td class="text-right">
                                        <div class="d-inline-flex align-items-center">
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary mr-16pt">View invoice <i class="icon--right material-icons">keyboard_arrow_right</i></a>
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary">Download <i class="icon--right material-icons">file_download</i></a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><a href="billing-invoice"
                                           class="text-underline">10004876</a></td>
                                    <td>30 May 2018</td>
                                    <td class="text-center">&dollar;9</td>
                                    <td class="text-right">
                                        <div class="d-inline-flex align-items-center">
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary mr-16pt">View invoice <i class="icon--right material-icons">keyboard_arrow_right</i></a>
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary">Download <i class="icon--right material-icons">file_download</i></a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><a href="billing-invoice"
                                           class="text-underline">10009392</a></td>
                                    <td>30 Apr 2018</td>
                                    <td class="text-center">&dollar;9</td>
                                    <td class="text-right">
                                        <div class="d-inline-flex align-items-center">
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary mr-16pt">View invoice <i class="icon--right material-icons">keyboard_arrow_right</i></a>
                                            <a href="billing-invoice"
                                               class="btn btn-sm btn-outline-secondary">Download <i class="icon--right material-icons">file_download</i></a>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- // END Page Content -->

                <!-- Footer -->

                <?php include 'footer.php'; ?>

                <!-- // END Footer -->

            </div>

            <!-- // END drawer-layout__content -->

            <!-- Drawer -->

            <?php include 'left-navbar.php';?>

            <!-- // END Drawer -->

        </div>

        <!-- // END Drawer Layout -->

        <!-- jQuery -->
        <script src="public/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="public/vendor/popper.min.js"></script>
        <script src="public/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="public/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="public/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="public/vendor/material-design-kit.js"></script>

        <!-- App JS -->
        <script src="public/js/app.js"></script>

        <!-- Preloader -->
        <script src="public/js/preloader.js"></script>

    </body>

</html>