<!DOCTYPE html>
<html lang="en" dir="ltr">

    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sign Up</title>

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

                <?php include 'top-navbar.php'; ?>

                <!-- // END Header -->

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->

                <!-- Page Content -->

                <div class="py-32pt navbar-submenu">
                    <div class="container page__container">
                        <div class="progression-bar progression-bar--active-accent">
                            <a href="pricing"
                               class="progression-bar__item progression-bar__item--complete">
                                <span class="progression-bar__item-content">
                                    <i class="material-icons progression-bar__item-icon">done</i>
                                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Pricing</span>
                                </span>
                            </a>
                            <a href="signup"
                               class="progression-bar__item progression-bar__item--complete progression-bar__item--active">
                                <span class="progression-bar__item-content">
                                    <i class="material-icons progression-bar__item-icon"></i>
                                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Account details</span>
                                </span>
                            </a>
                            <a href="signup-payment"
                               class="progression-bar__item">
                                <span class="progression-bar__item-content">
                                    <i class="material-icons progression-bar__item-icon"></i>
                                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Payment details</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="page-section container page__container">
                    <div class="col-lg-10 p-0 mx-auto">
                        <div class="row">
                            <div class="col-md-6 mb-24pt mb-md-0">
                                <form action="./">
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="name">Your first and last name:</label>
                                        <input id="name"
                                               type="text"
                                               class="form-control"
                                               placeholder="Your first and last name ...">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="email">Your email:</label>
                                        <input id="email"
                                               type="email"
                                               class="form-control"
                                               placeholder="Your email address ...">
                                    </div>
                                    <div class="form-group mb-24pt">
                                        <label class="form-label"
                                               for="password">Password:</label>
                                        <input id="password"
                                               type="password"
                                               class="form-control"
                                               placeholder="Your password ...">
                                    </div>
                                    <button class="btn btn-primary">Create account</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <h5>Purchase summary</h5>
                                        <div class="d-flex mb-8pt">
                                            <div class="flex"><strong class="text-70">Subscription</strong></div>
                                            <strong>Student</strong>
                                        </div>

                                        <div class="alert alert-soft-warning">
                                            <div class="d-flex flex-wrap align-items-start">
                                                <div class="mr-8pt">
                                                    <i class="material-icons">check</i>
                                                </div>
                                                <div class="flex"
                                                     style="min-width: 180px">
                                                    <small class="text-100">
                                                        Access to over 1.000 high quality courses. <strong>For individuals.</strong>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mb-16pt pb-16pt border-bottom">
                                            <div class="flex"><strong class="text-70">Price</strong></div>
                                            <strong>US &dollar;9 per month</strong>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   checked
                                                   id="topic-all">
                                            <label class="custom-control-label">Terms and conditions</label>
                                            <small class="form-text text-muted">By checking here and continuing, I agree to the Luma Terms of Use</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-separator justify-content-center m-0">
                    <div class="page-separator__text">or sign-in with</div>
                </div>
                <div class="page-section text-center">
                    <div class="container page__container">
                        <a href="#"
                           class="btn btn-secondary btn-block-xs">Facebook</a>
                        <a href="#"
                           class="btn btn-secondary btn-block-xs">Twitter</a>
                        <a href="#"
                           class="btn btn-secondary btn-block-xs">Google+</a>
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