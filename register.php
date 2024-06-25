<?php require_once "lib/init_register.php"; ?>

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
			<section class="contact-section px-md-2 pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Регистрация</h2>
						</div>

					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">

							<form action="#" method="POST" class="bg-light p-5 contact-form">
								<div class="form-group" >                                
									<input type="text" <?php if (empty($user->validateName)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Your Name" name="name" value="<?=$user->name;?>">
                                    <div class="invalid-feedback">
										<?=$user->validateName?>
									</div>
								</div>
								<div class="form-group">
									<input type="text" <?php if (empty($user->validateSurname)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Your Surname" name="surname" value="<?=$user->surname;?>">
                                    <div class="invalid-feedback">
										<?=$user->validateSurname?>
									</div>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Your Patronymic"  name="patronymic" value="<?=$user->patronymic;?>">
								</div>
								<div class="form-group">
									<input type="text" <?php if (empty($user->validateLogin)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Your Login"
										name="login" value="<?=$user->login;?>">
									<div class="invalid-feedback">
										<?=$user->validateLogin?>
									</div>
								</div>
								<div class="form-group">
									<input type="email" <?php if (empty($user->validateEmail)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Your Email"
										name="email" value="<?=$user->email;?>">
									<div class="invalid-feedback">
										<?=$user->validateEmail?>
									</div>
								</div>
								<div class="form-group">
									<input type="password" <?php if (empty($user->validatePassword)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Password"
										name="password" value="<?=$user->password;?>">
									<div class="invalid-feedback">
										<?=$user->validatePassword?>
									</div>
								</div>
								<div class="form-group">
									<input type="password" <?php if (empty($user->validatePasswordRepeat)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Password repeat"
										name="password_repeat" value="<?=$user->password_repeat;?>">
									<div class="invalid-feedback">
										<?=$user->validatePasswordRepeat?>
									</div>
								</div>



								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input is-invalid" type="checkbox" value=""
											id="rules" aria-describedby="invalidCheck3Feedback" required>
										<label class="form-check-label" for="rules">
											Rules
										</label>
										<div id="rulesFeedback" class="invalid-feedback">
                                            Необходимо согласиться с правилами регистрации
										</div>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" value="Регистрация" class="btn btn-primary py-3 px-5">
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
	
	<script>
		$(document).ready(function(){
			$('#rules').click(function(e){
				$(this).toggleClass('is-invalid');
				$(this).toggleClass('is-valid');
				$('#rulesFeedback').toggleClass('d-none');				
			})
		})

	</script>

</body>

</html>