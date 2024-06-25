<?php require_once "lib/init_post-action.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Blog</title>
	<?php echo file_get_contents("lib/head.html");?>
</head>

<body>

	<div id="colorlib-page">

	<?=$menu->appear(basename(__FILE__));?>
		<div id="colorlib-main">
			<section class="contact-section px-md-2 pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Создание/Редактирование поста</h2>
						</div>

					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">
							<!--FORM FOR ADDING AND EDITING THE POST-->
							<form action="#" method="POST" class="bg-light p-5 contact-form">
								<div class="form-group">
									<input type="text" <?php if (empty($post->validateTitle)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Post title" name="title" value="<?=$post->title;?>">
									<div class="invalid-feedback">
										<?=$post->validateTitle?>
									</div>
								</div>
								<div class="form-group">
									<input type="text" <?php if (empty($post->validatePreview)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Post preview" name="preview" value="<?=$post->preview;?>">
									<div class="invalid-feedback">
										<?=$post->validatePreview?>
									</div>
								</div>
								<div class="form-group">
									<textarea name="content" id="content" cols="30" rows="10" <?php if (empty($post->validateContent)) echo 'class="form-control"';?> class="form-control is-invalid" placeholder="Post content"
									><?=($post->content)?$post->brReplace($post->content):'';?></textarea> 
										<div class="invalid-feedback">
										<?=$post->validateContent?>
										</div>
									</div>
								
								<div class="form-group">
									<input type="submit" value="Загрузить" class="btn btn-primary py-3 px-5">
								</div>
								<div class="form-group">
									<a href="<?=$response->getLink('post.php', ['token' => $user->token, 'post' => $post->id, 'delete' => $post->id,])?>" class="btn btn-primary py-3 px-5">Удалить</a>
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