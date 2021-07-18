<?php

use App\Core\Auth;
use App\Core\Request;

require 'layouts/head.php'; ?>

<style>
    .wlcm-link {
        text-decoration: underline !important;
        color: inherit;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="d-flex flex-row align-items-center">
            <img src="<?= public_url('/storage/images/sprnva-logo.png') ?>" alt="sprnva-logo" style="width: 65px; height: 65px;">
            <h1 class="pl-2 mb-0" style="color: #00551f;font-weight: 600;">Sprnva</h1>
        </div>
        <div class="card mt-3">
            <!-- <h5 class="card-header">Welcome to your Sprnva application!</h5> -->
            <div class="card-body">
                <p class="card-text">Sprnva will provide you experience and expand your vision for a better understanding of the basics. We'll help you take your first steps as a web developer or give you a boost as you take your expertise to the next level. Featuring Model-view-controller software design pattern, debugging, secure and organized routing, expressive database builder, built-in authentication and more.</p>
            </div>

            <div class="col-12">
                <div class="row p-2">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a class="wlcm-link" href="https://sprnva.000webhostapp.com/" target="_blank">Documentation</a></h5>
                                <p class="card-text pt-1 text-muted">Sprnva has also a dedicated documentation covering every aspect of the framework. Newbies or have previous experience with Sprnva, we recommend reading all documenataion.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a class="wlcm-link" href="https://github.com/sprnva" target="_blank">Github</a></h5>
                                <p class="card-text pt-1 text-muted">Visit Sprnva repository and explore other projects like migration, file uploads, dumper also known as dd() and also the flavoured templates of sprnva.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a class="wlcm-link" href="https://github.com/jagwarthegreat/jagwarthegreat/blob/main/README.md" target="_blank">The Author</a></h5>
                                <p class="card-text pt-1 text-muted">Meet the creator and the mastermind behind the blast! the author of this fun is happy to see you. You might also want to follow him and send a feedback.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a class="wlcm-link" href="#">Why Sprnva?</a></h5>
                                <p class="card-text pt-1 text-muted">Simple codebase yet powerful, embraces your basic knowledge of creating a web application. Small scale file structure but packed with securities and protection from unwanted attacks.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'layouts/footer.php'; ?>