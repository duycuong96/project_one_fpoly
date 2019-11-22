<?php
require_once './app/views/frontend/master/master.php';
?>
<?php
require_once './app/views/frontend/master/header.php';
?>
<?php
require_once './app/views/frontend/master/nav.php';
?>

<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-top-lg padding-bottom-lg">

    <div class="container">
        <div class="col-md-12">

            <div class="row justify-content-md-center" style="height:400px">

                <div class="card">
                    <article class="card-body" style="width:400px">
                        <a href="" class="float-right btn btn-outline-primary">Sign up</a>
                        <h4 class="card-title mb-4 mt-1">Sign in</h4>
                        <form action="<?php echo BASE_URL . 'post-login' ?>" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" class="form-control" placeholder="Email" type="email">
                                <?php if (isset($_GET['err_email'])) : ?>
                                    <span style="color: red"><?= $_GET['err_email'] ?></span>
                                <?php endif ?>
                            </div> <!-- form-group// -->

                            <div class="form-group">
                                <a class="float-right" href="#">Forgot?</a>
                                <label>Mật khẩu</label>
                                <input name="password" class="form-control" placeholder="******" type="password">
                                <?php if (isset($_GET['err_password'])) : ?>
                                    <span style="color: red"><?= $_GET['err_password'] ?></span>
                                <?php endif ?>
                            </div> <!-- form-group// -->
                            <!-- <div class="form-group">
                                <div class="checkbox">
                                    <label> <input type="checkbox"> Save password </label>
                                </div>
                            </div> -->
                            <div class="text-center">
                                <?php if (isset($_GET['err_login'])) : ?>
                                    <span style="color: red"><?= $_GET['err_login'] ?></span>
                                <?php endif ?>
                                <hr>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="submit"> Login </button>
                            </div> <!-- form-group// -->
                        </form>
                    </article>
                </div> <!-- card.// -->

            </div>

        </div>

    </div> <!-- container .//  -->
</section>

<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg2">
    <div class="container">
        <section class="footer-bottom row">
            <div class="col-sm-6">
                <p> Thiết kế <3 <br> bởi Duy Cường</p>
            </div>
            <div class="col-sm-6">
                <p class="text-sm-right">
                    Copyright &copy 2019
                </p>
            </div>
        </section> <!-- //footer-top -->
    </div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->



</body>

</html>