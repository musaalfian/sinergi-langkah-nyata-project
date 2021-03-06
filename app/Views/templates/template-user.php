<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- SEO Meta Tags -->
    <meta name="description" content="We are a company that is engaged in innovation in the health sector to increase public awareness of the importance of technology in health and facilitate access to health services for the community to help achieve the third goal of the SDGs.">
    <meta name="author" content="Sinergi Langkah Nyata">
    <meta name="keywords" content="sinergilangkahnyata,SinergiLangkahNyata,SLN,sinergi,langkah,nyata,sinergilangkah">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="Sinergi Langkah Nyata" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="Sinergi Langkah Nyata" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="We are a company that is engaged in innovation in the health sector to increase public awareness of the importance of technology in health and facilitate access to health services for the community to help achieve the third goal of the SDGs." />
    <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/tim-style.css" />
    <link rel="stylesheet" href="/assets/css/innovation-style.css" />

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <title><?= $title; ?></title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bgdarkgreen sticky-top">
        <div class="container container-fluid d-flex justify-content-between">
            <a class="navbar-brand d-flex align-items-center" href="/user/index">
                <img src="/assets/img/logo-sln.png" height="50px" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon d-inline"><i class="fa-solid fa-bars text-white"></i></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-end">
                    <li class="nav-item">
                        <a class="nav-link" id="home" aria-current="page" href="<?= base_url('user/index'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-5" id="team" href="<?= base_url('user/team'); ?>">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-5" id="innovation" href="<?= base_url('user/innovation'); ?>">Innovation</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End navbar -->

    <?= $this->renderSection('content'); ?>

    <!-- Footer -->
    <footer class="bgdarkgreen pt40 mt80 text-white">
        <div class="container">
            <div class="row mb40 justify-content-between">
                <div class="col-md-6 col-12">
                    <h2 class="mb10 fw-bold">Sinergi Langkah Nyata</h2>
                    <div class="desc darklight">
                        <h3>This website has been produced with the assistance of the <a href="https://www.indonesia2030.id" class="fw-bold" target="_blank">Indonesia2030</a> and <a href="https://indonesiamaju.or.id/" class="fw-bold" target="_blank">Indonesia Maju Foundation</a>.
                        </h3>
                    </div>
                    <div class="logo__indo">
                        <a href="https://indonesiamaju.or.id/" target="_blank">
                            <img src="<?= base_url('assets/img/logo-2030.png'); ?>" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="nav__footer d-flex justify-content-start">
                        <div class="item me-5">
                            <h3 class="mb10 fw-bold">Innovation</h3>
                            <?php foreach ($innovation as $innovation_footer) : ?>
                                <a href="/user/innovation">
                                    <h3 class="mb-2 darklight"><?= $innovation_footer['name_innovation']; ?></h3>
                                </a>
                            <?php endforeach ?>
                        </div>
                        <div class="item">
                            <h3 class="mb10 fw-bold">About</h3>
                            <a href="/user/team">
                                <h3 class="mb-2 darklight">Our Team</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sosmed mb20">
                <div class="content d-flex">
                    <a href="https://www.instagram.com/sinergilangkahnyata/?hl=id" target="_blank">
                        <div class="d-flex justify-content-center align-items-center icon">
                            <i class="fa-brands fa-instagram" id="insta"></i>
                        </div>
                    </a>
                    <!-- <a href="" class="ms-3">
                        <div class="d-flex justify-content-center align-items-center icon">
                            <i class="fa-brands fa-facebook" id="facebook"></i>
                        </div>
                    </a> -->
                    <a href="mailto:Sinergilangkahnyata@gmail.com" class="ms-3">
                        <div class="d-flex justify-content-center align-items-center icon">
                            <i class="fa-solid fa-envelope" id="twitter"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="copyright text-center">
                <h3><i class="fa-solid fa-copyright me-2"></i>2022. Sinergi Langkah Nyata. All Right Reserved.</h3>
            </div>
        </div>
    </footer>
    <!-- End footer -->

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- JS Custom -->
    <script src="<?= base_url('/assets/js/main.js'); ?>"></script>
    <script src="https://kit.fontawesome.com/55f12d8286.js" crossorigin="anonymous"></script>
</body>

</html>