<!DOCTYPE html>
<html lang="en" dir="ltr">

    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>

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

                <?php include 'top-nav.php'; ?>

                <!-- // END Header -->

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->

                <!-- Page Content -->

                <div class="pt-32pt pt-sm-64pt pb-32pt">
                    <div class="container page__container">
                        <form action="./"
                              class="col-md-5 p-0 mx-auto">
                            <div class="form-group">
                                <label class="form-label"
                                       for="email">Email:</label>
                                <input id="email"
                                       type="text"
                                       class="form-control"
                                       placeholder="Your email address ...">
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="password">Password:</label>
                                <input id="password"
                                       type="password"
                                       class="form-control"
                                       placeholder="Your first and last name ...">
                                <p class="text-right"><a href="reset-password"
                                       class="small">Forgot your password?</a></p>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="page-separator justify-content-center m-0">
                    <div class="page-separator__text">or sign-in with</div>
                </div>
                <div class="bg-body pt-32pt pb-32pt pb-md-64pt text-center">
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

            <?php include 'left-navbar.php'; ?>

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