
 <nav class="navbar navbar-expand-lg mb-20 navbar-light px-4 px-lg-5 py-3 py-lg-0 " style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white !important; z-index: 999999999;">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-search me-2"></i><img src="images/mylogo4.png" style="background: purple; border-radius: 50%;" > <span class="fs-5" style="color: white !important;"> TECHLOG</span></h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse" style="color: white !important;">
                    <div class="navbar-nav ms-auto py-0">
                        <a style="color: white !important;" href="../index.php" class="nav-item nav-link active">Accueil</a>
                        <a style="color: white !important;" href="about.html" class="nav-item nav-link">About</a>
                        <a style="color: white !important;" href="service.html" class="nav-item nav-link">Service</a>
                        <a style="color: white !important;" href="project.html" class="nav-item nav-link">Project</a>
                        <div class="nav-item dropdown">
                            <a style="color: white !important;" href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a  href="team.html" class="dropdown-item">Our Team</a>
                                <a  href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a  href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a style="color: white !important;" href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <button type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button><?php if(empty($_SESSION['profil'])){ ?>
                    <a style="color: white !important;" href="indexcon" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">SE CONNECTER</a> <?php } ?>
                </div>
            </nav>
