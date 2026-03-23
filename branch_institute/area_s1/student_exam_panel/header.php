<style>
    .navbar-expand-xl .navbar-brand .navbar-brand-item{
        height: 90px;
    }
    
@media (min-width: 1200px) {
    header.navbar-sticky-on .navbar-brand .navbar-brand-item {
        height: 80px;
    }
}
</style>


<header class="navbar-light navbar-sticky header-static">
			<!-- Nav START -->
			<nav class="navbar navbar-expand-xl">
				<div class="container-fluid px-3 px-xl-5">
					<!-- Logo START -->
					<a class="navbar-brand py-3" href="./">
						<img class="light-mode-item navbar-brand-item" src="assets/images/exam-panel-logo.png" alt="logo">
						<img class="dark-mode-item navbar-brand-item" src="assets/images/exam-panel-logo.png" alt="logo">
					</a>
					<!-- Logo END -->

					<div class="position-relative d-inline d-xl-none ms-auto open_notification_canvas">
						<a class="btn bg-purple btn-round mb-0 me-2 bg-opacity-10" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-expanded="false">
							<i class="bi bi-bell-fill text-purple"></i>
						</a>
						<span class="position-absolute translate-middle rounded-pill bg-purple d-none align-items-center justify-content-center text-white noti_count__" style="right: -4px;top: 3px;width:18px;height:18px;font-size:0.85em;display:flex;">0</span>

					</div>

					<!-- Responsive navbar toggler -->
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-animation">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</button>

					<!-- Main navbar START -->
					<div class="navbar-collapse w-100 collapse" id="navbarCollapse">

						<!-- Nav category menu START -->
						<ul class="navbar-nav navbar-nav-scroll me-auto">
							<!-- Nav item 1 Demos -->
						<!--	<li class="nav-item dropdown dropdown-menu-shadow-stacked">-->
						<!--		<a class="nav-link bg-primary bg-opacity-10 rounded-3 text-primary px-3 py-3 py-xl-0" href="#" id="categoryMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-grid-3x3-gap-fill me-2"></i><span class="fw-bold">MCQs</span></a>-->
						<!--		<ul class="dropdown-menu" aria-labelledby="categoryMenu">-->


									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">Computer Basics</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/history">History</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/fundamental">Fundamental</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/computer-memory">Computer Memory</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/input-output-device">Input/Output Device</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/computer-software">Computer Software</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/microsoft-windows">Microsoft Windows</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/printer">Printer</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/linux-unix">Linux, Unix</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/abbreviation">Abbreviation</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/keyboard-shortcuts">Keyboard Shortcuts</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/number-system">Number System</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/programming-basics">Programming Basics </a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->

									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">MS Office</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/microsoft-word">MS Word</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/microsoft-excel">MS Excel</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/microsoft-powerpoint">MS Powerpoint</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/microsoft-access">MS Access</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/microsoft-outlook">MS Outlook</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->

									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="mcq/history">MS Office 365</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/office-365-word">Office 365 Word</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/office-365-excel">Office 365 Word Excel</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/office-365-powerpoint">Office 365 Powerpoint</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/office-365-access">Office 365 Outlook</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->
									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">Internet</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/internet-basics">Basics</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/computer-networks">Computer Networks</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/internet-protocols">Internet Protocols</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/e-mail">E-Mail</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/osi-tcp-ip">OSI, TCP/IP</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/socail-media">Social Media</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/e-commerce">E-Commerce</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/e-governance">E-governance</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/banking">Banking</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/web-technology">Web Technology</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->
									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">Computer Security</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/cyber-security">Cyber Security</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/firewall">Firewall</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->


									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">DBMS</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/fundamentals">Fundamentals</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/rdbms">RDBMS</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/sql">SQL</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/miscellaneous">Miscellaneous</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->

									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">Programming</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/c-language">C Language</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/c-plus-plus">C++</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/history">C#</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/python">Python</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/java">Java</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/vba">VBA</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/oops-concept">OOPS Concept</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/data-strcuture">Data Structure</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->


									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">Web Development</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/html">HTML</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/css">CSS</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/javascript">JavaScript</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/jquery">JQuery</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/xml">XML</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/php">PHP</a> </li>-->

						<!--				</ul>-->
						<!--			</li>-->

									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">Framework</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/bootstrap">Bootstrap</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="chapter/mcq/chapter/mcq/css-framework">W3.css</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="chapter/mcq/javascript-and-angular-js">Angular JS</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/asp-net">asp.net</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/django">Django</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/laravel">Laravel</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/cakephp">CakePHP</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->
									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">Taxation & Accounts</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/gst">GST</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/tally">Tally</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->

									<!-- Dropdown submenu -->
						<!--			<li class="dropdown-submenu dropend">-->
						<!--				<a class="dropdown-item dropdown-toggle" href="#">SDLC</a>-->
						<!--				<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
						<!--					<li> <a class="dropdown-item" href="mcq/sdlc-basics">SDLC Basics</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/testing">Testing</a> </li>-->
						<!--					<li> <a class="dropdown-item" href="mcq/sdlc-models">SDLC Models</a> </li>-->
						<!--				</ul>-->
						<!--			</li>-->

						<!--		</ul>-->
						<!--	</li>-->
						</ul>
						<!-- Nav category menu END -->

						<!-- Nav Main menu START -->
						<ul class="navbar-nav navbar-nav-scroll me-auto">


							<!--<li class="nav-item dropdown dropdown-fullwidth">-->
							<!--	<a class="nav-link dropdown-toggle fw-bold" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">O Level</a>-->
							<!--	<div class="dropdown-menu dropdown-menu-end" data-bs-popper="none">-->
							<!--		<div class="row p-4">-->
										<!-- Dropdown column item -->
							<!--			<div class="col-xl-3 col-xxl-3 mb-3">-->
							<!--				<h6 class="mb-0">Real Exam Interface</h6>-->
							<!--				<hr>-->
							<!--				<ul class="list-unstyled">-->
							<!--					<li> <a class="dropdown-item" href="old-paper/o-level-it-tools-paper-july-2024/online-practice">IT Tools</a> </li>-->
							<!--					<li> <a class="dropdown-item" href="old-paper/o-level-web-design-paper-july-2024/online-practice">Web Design</a> </li>-->
							<!--					<li> <a class="dropdown-item" href="old-paper/o-level-python-paper-july-2024/online-practice">Python Language</a> </li>-->
							<!--					<li> <a class="dropdown-item" href="old-paper/o-level-internet-of-things-paper-july-2024/online-practice">Internet of Things</a> </li>-->
							<!--					<li> <a class="dropdown-item" href="practical/o-level/Practical-PR1">Practical:M1-R5.1</a> </li>-->
							<!--					<li> <a class="dropdown-item" href="practical/o-level/Practical-PR2">Practical:M2-R5.1</a> </li>-->
							<!--					<li> <a class="dropdown-item" href="practical/o-level/Practical-PR3">Practical:M3-R5.1</a> </li>-->
							<!--					<li> <a class="dropdown-item" href="practical/o-level/Practical-PR4">Practical:M4-R5.1</a> </li>-->
							<!--				</ul>-->
							<!--			</div>-->

										<!-- Dropdown column item -->
							<!--			<div class="col-xl-3 col-xxl-3 mb-3">-->
							<!--				<h6 class="mb-0">Solved Practical</h6>-->
							<!--				<hr>-->
											<!-- Dropdown item -->
							<!--				<div class="mb-2 position-relative bg-primary-soft-hover rounded-2 transition-base p-3">-->
							<!--					<a class="stretched-link h6 mb-0" href="practical/o-level/Practical-PR1">Practical-PR1</a>-->
							<!--					<p class="mb-0 small text-truncate-2">M1-R5.1: IT Tools & Network Basics</p>-->
							<!--				</div>-->
											<!-- Dropdown item -->
							<!--				<div class="mb-2 position-relative bg-primary-soft-hover rounded-2 transition-base p-3">-->
							<!--					<a class="stretched-link h6 mb-0" href="practical/o-level/Practical-PR2">Practical-PR2</a>-->
							<!--					<p class="mb-0 small text-truncate-2">M2-R5.1: Web Designing & Publishing</p>-->
							<!--				</div>-->
											<!-- Dropdown item -->
							<!--				<div class="position-relative bg-primary-soft-hover rounded-2 transition-base p-3">-->
							<!--					<a class="stretched-link h6 mb-0" href="practical/o-level/Practical-PR3">Practical-PR3</a>-->
							<!--					<p class="mb-0 small text-truncate-2">M3-R5.1: Python Programming</p>-->
							<!--				</div>-->

							<!--				<div class="position-relative bg-primary-soft-hover rounded-2 transition-base p-3">-->
							<!--					<a class="stretched-link h6 mb-0" href="practical/o-level/Practical-PR4">Practical-PR4</a>-->
							<!--					<p class="mb-0 small text-truncate-2">M4-R5.1: Internet of Things (IOT)</p>-->
							<!--				</div>-->
							<!--			</div>-->

										<!-- Dropdown column item -->
							<!--			<div class="col-xl-3 col-xxl-3 mb-3">-->
							<!--				<h6 class="mb-0">Chapterwise MCQs</h6>-->
							<!--				<hr>-->
											<!-- Dropdown item -->
							<!--				<div class="d-flex mb-4 position-relative">-->
							<!--					<img src="public/assets/images/element/it-chapter-1.svg" class="h-47" alt="m1-r5">-->
							<!--					<div class="ms-2">-->
							<!--						<a class="stretched-link h6 mb-0" href="chapter/m1r5">M1-R5.1</a>-->
							<!--						<p class="mb-0 small">IT Tools & Network Basics</p>-->
							<!--					</div>-->
							<!--				</div>-->
											<!-- Dropdown item -->
							<!--				<div class="d-flex mb-4 position-relative">-->
							<!--					<h2 class="mb-0">-->
							<!--						<img src="public/assets/images/element/wd-chapter-3.svg" class="h-47" alt="m1-r5">-->
							<!--					</h2>-->
							<!--					<div class="ms-2">-->
							<!--						<a class="stretched-link h6 mb-0" href="chapter/m2r5">M2-R5.1</a>-->
							<!--						<p class="mb-0 small">Web Designing & Publishing</p>-->
							<!--					</div>-->
							<!--				</div>-->
											<!-- Dropdown item -->
							<!--				<div class="d-flex mb-4 position-relative">-->
							<!--					<h2 class="mb-0">-->
							<!--						<img src="public/assets/images/element/py-chapter-3.svg" class="h-47" alt="m1-r5">-->
							<!--					</h2>-->
							<!--					<div class="ms-2">-->
							<!--						<a class="stretched-link h6 mb-0" href="chapter/m3r5">M3-R5.1</a>-->
							<!--						<p class="mb-0 small">Python Programming</p>-->
							<!--					</div>-->
							<!--				</div>-->
											<!-- Dropdown item -->
							<!--				<div class="d-flex mb-4 position-relative">-->
							<!--					<h2 class="mb-0">-->
							<!--						<img src="public/assets/images/element/iot-chapter-2.svg" class="h-47" alt="m1-r5">-->
							<!--					</h2>-->
							<!--					<div class="ms-2">-->
							<!--						<a class="stretched-link h6 mb-0" href="chapter/m4r5">M4-R5.1</a>-->
							<!--						<p class="mb-0 small">Internet of Things (IOT)</p>-->
							<!--					</div>-->
							<!--				</div>-->
							<!--			</div>-->

										<!-- Dropdown column item -->
							<!--			<div class="col-xl-3 col-xxl-3 mb-3">-->
							<!--				<h6 class="mb-0">Other Links</h6>-->
							<!--				<hr>-->
											<!-- Image -->
							<!--				<div class="d-flex mb-4 position-relative">-->
							<!--					<h2 class="mb-0">-->
							<!--						<img src="public/assets/images/element/project.svg" class="h-47" alt="m1-r5">-->
							<!--					</h2>-->
							<!--					<div class="ms-2">-->
							<!--						<a class="stretched-link h6 mb-0" href="content/category/o-level-project/index">PJ-1</a>-->
							<!--						<p class="mb-0 small">Project</p>-->
							<!--					</div>-->
							<!--				</div>-->

							<!--				<div class="d-flex mb-4 position-relative">-->
							<!--					<h2 class="mb-0">-->
							<!--						<img src="public/assets/images/element/old-paper.svg" class="h-47" alt="m1-r5">-->
							<!--					</h2>-->
							<!--					<div class="ms-2">-->
							<!--						<a class="stretched-link h6 mb-0" href="old-paper">Prevoius Year Papers</a>-->
							<!--						<p class="mb-0 small">O Level Old Paper PDF</p>-->
							<!--					</div>-->
							<!--				</div>-->
							<!--				<div class="d-flex mb-4 position-relative">-->
							<!--					<h2 class="mb-0">-->
							<!--						<img src="public/assets/images/element/o-level-free-pdf.svg" class="h-47" alt="m1-r5">-->
							<!--					</h2>-->
							<!--					<div class="ms-2">-->
							<!--						<a class="stretched-link h6 mb-0" href="pdf-notes">Free PDFs</a>-->
							<!--						<p class="mb-0 small">All Free PDFs</p>-->
							<!--					</div>-->
							<!--				</div>-->
							<!--			</div>-->
							<!--		</div>-->

							<!--	</div>-->
							<!--</li>-->

							<!--<li class="nav-item dropdown ">-->
							<!--	<a class="nav-link dropdown-toggle fw-bold" href="#" id="demoMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">A Level</a>-->
							<!--	<ul class="dropdown-menu" aria-labelledby="demoMenu">-->
							<!--		<li> <a class="dropdown-item" href="content/nielit-a-level-books-a5-r5-data-structure/index">Data Structure Through Object Oriented Programming Language(A5)</a></li>-->
							<!--		<li> <a class="dropdown-item" href="content/a-level-a6-r5-book-pdf-download/index">Computer Organization and Operating System(A6)</a></li>-->
							<!--		<li> <a class="dropdown-item" href="content/a-level-books-database-technologies/index">Database Technologies(A7)</a></li>-->
							<!--		<li> <a class="dropdown-item" href="content/systems-analysis-design-and-testing-a-level/index">Systems Analysis, Design and Testing(A8)</a></li>-->
							<!--		<li> <a class="dropdown-item" href="content/web-application-development-using-php-a-level/index">Web Application Development Using PHP(A9.2)</a></li>-->
							<!--		<li> <a class="dropdown-item" href="content/a-level-a10-r5-book-pdf-download/index">Full Stack Web Development using-->
							<!--				MVC Framework(A10.2)</a></li>-->
							<!--		<li>-->
							<!--			<hr class="dropdown-divider">-->
							<!--		</li>-->
							<!--		<li> <a class="dropdown-item" href="content/category/a-level-practical/index">Practical PR5</a></li>-->
							<!--		<li>-->
							<!--			<hr class="dropdown-divider">-->
							<!--		</li>-->
							<!--		<li class="dropdown-submenu dropend">-->
							<!--			<a class="dropdown-item dropdown-toggle" href="#">Project</a>-->
							<!--			<ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">-->
											<!-- dropdown submenu open right -->
							<!--				<li> <a class="dropdown-item" href="content/category/o-level-project/index">Mini project</a> </li>-->
							<!--				<li> <a class="dropdown-item" href="content/nielit-a-level-project-full-information/index">Major project</a> </li>-->
							<!--			</ul>-->
							<!--		</li>-->
							<!--	</ul>-->
							<!--</li>-->
							<!-- Nav item 2 Pages -->
							<!--<li class="nav-item dropdown "><a class="nav-link fw-bold" href="courses"><i class="fas fa-store"></i> Store</a></li>-->
							<li class="nav-item dropdown "><a class="nav-link fw-bold" href="./"><i class="fas fa-list-alt"></i> Online Test</a></li>
							<!--<li class="nav-item dropdown "><a class="nav-link fw-bold" href="mcq"><i class="fas fa-th-list"></i> MCQs</a></li>-->
							<!--<li class="nav-item dropdown "><a class="nav-link fw-bold" href="content/index"><i class="fas fa-book"></i> Blog</a></li>-->

						</ul>
						<!-- Nav Main menu END -->

						<!-- Nav additonal START -->
						<!--<div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">-->
						<!--	<div class="nav-item w-100">-->
						<!--		<div class="position-relative d-none d-xl-inline open_notification_canvas">-->
						<!--			<a class="btn bg-purple btn-round mb-0 me-2 bg-opacity-10" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-expanded="false">-->
						<!--				<i class="bi bi-bell-fill text-purple"></i>-->
						<!--			</a>-->
						<!--			<span class="position-absolute translate-middle rounded-pill bg-purple d-none align-items-center justify-content-center text-white noti_count__" style="right: -1px;top: -3px;width:18px;height:18px;font-size:0.85em;display:flex;">0</span>-->
						<!--		</div>-->
								

						<!--			<a class="btn btn-primary btn-sm me-2 mb-0" id="open_login_tab" data-bs-toggle="modal" data-bs-target="#authmodal" href="#">Login</a>-->
						<!--			<a class="btn btn-success btn-sm mb-0" id="open_signup_tab" data-bs-toggle="modal" data-bs-target="#authmodal" href="#">Create Account</a>-->


						<!--									</div>-->
						<!--</div>-->
						
						<!-- Nav additional END -->
					</div>
					<!-- Main navbar END -->
				</div>
			</nav>
			<!-- Nav END -->
		</header>