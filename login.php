<?php require_once "lib/init_login.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Blog</title>
	<?php echo file_get_contents("lib/head.html");?>
</head>

<body>
	<div id="colorlib-page">
	<?php echo $menu->appear(basename(__FILE__)); ?>
		<div id="colorlib-main">
			<section class="contact-section px-md-2  pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Авторизация</h2>
						</div>
					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">
							<form action="#" method="POST" class="bg-light p-5 contact-form">
								<div class="form-group">
									<input type="text" <?php if (empty($user->validateLogin)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Your Login"
										name="login" value="<?=$user->login;?>">
                                    <div class="invalid-feedback">
										<?=$user->validateLogin?>
									</div>
								</div>
								<div class="form-group">
									<input type="password" <?php if (empty($user->validatePassword) && empty($user->validateBlock)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Password"
										name="password" value="<?=$user->password;?>">
									<div class="invalid-feedback">
										<?=$user->validatePassword?>
									</div>
									<div class="invalid-feedback">
										<?=$user->validateBlock?>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" value="Вход" class="btn btn-primary py-3 px-5">
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

	<!-- loader -->
	<?php echo file_get_contents("lib/preloader.html"); ?>

	<?php echo file_get_contents("lib/scripts.html"); ?>

</body>

</html>