<?php
// Extend the base layout named 'Layout' and pass the 'mainContent' section fetched from the same layout
$this->layout('Layout', ['mainContent' => $this->fetch('Layout')]) ?>

<?php
// Start defining the content for the 'mainContent' section
$this->start('mainContent');
?>

<!-- Add your content here to be displayed in the browser -->

<head>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: #0000001a;
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em #0000001a, inset 0 .125em .5em #00000026
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8
        }

        .bd-mode-toggle {
            z-index: 1500
        }

        .bd-mode-toggle .bi {
            width: 1em;
            height: 1em
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important
        }
    </style>
</head>
<header data-bs-theme="dark">
    <div class="collapse text-bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4>About</h4>
                    <p class="text-body-secondary">Add some information about the album below, the author, or any
                        other background context. Make it a few sentences long so folks can pick up some informative
                        tidbits. Then, link them off to some social networking sites or contact information.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4>Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Follow on X</a></li>
                        <li><a href="#" class="text-white">Like on Facebook</a></li>
                        <li><a href="#" class="text-white">Email me</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container"> <a href="#" class="navbar-brand d-flex align-items-center"> <svg
                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2"
                    viewBox="0 0 24 24">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                    </path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg> <strong>Album</strong> </a> <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader"
                aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
            </button> </div>
    </div>
</header>
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Album example</h1>
                <p class="lead text-body-secondary">Something short and leading about the collection below—its
                    contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply
                    skip over it entirely.</p>
                <p> <button class="btn btn-primary my-2" data-bs-target="#formSection" data-bs-toggle="collapse">Add Memory</button> </p>
            </div>
        </div>
    </section>

    <!-- FORM SECTION -->
    <section class="container collapse" id="formSection">
        <form action="/album/create" method="POST" class="mb-3" enctype="multipart/form-data">
            <input type="file" class="form-control" name="image" accept="image/*" required="">
            <input type="text" name="desc" class="form-control" placeholder="album description..." required>
            <button type="submit" class="btn btn-success mt-2 w-100">Add Content</button>
        </form>
    </section>

    <!-- DISPLAY SECTION -->
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($album as $album): ?>
                    <?php
                    $image = $album['image'] ? 'uploads/' . $album['image'] : 'default_cover.jpg';
                    ?>
                    <div class="col-3">
                        <div class="card shadow-sm">
                            <img
                                src="<?= htmlspecialchars($image) ?>"
                                class="bd-placeholder-img card-img-top"
                                alt="Cover Image"
                                style="height:225px; object-fit:cover; width:100%;">

                            <div class="card-body">
                                <p class="card-text">
                                    <?= htmlspecialchars($album['description']) ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/album/update/<?= $album['id'] ?>" class="btn btn-sm btn-outline-secondary">Update</a>
                                        <a href="/album/delete/<?= $album['id'] ?>" class="btn btn-sm btn-outline-secondary">Delete</a>
                                    </div>
                                    <small class="text-body-secondary">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php
// End the 'mainContent' section
$this->stop();
?>