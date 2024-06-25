
<?php require_once "lib/init_index.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Blog</title>
	<?php echo file_get_contents("lib/head.html");?>
</head>



<body>
	<div id="colorlib-page">
	<? echo $menu->appear(basename(__FILE__));?>
		<div id="colorlib-main">
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row d-flex">
						<div class="col-xl-8 py-5 px-md-2">
							<div class="row pt-md-4">
								<!-- один пост/превью one post/preview-->
										<?php
											$mas = $post->list10();
											foreach ($mas as $val) {
												$href = ($user->token)? $response->getLink('post.php', ['token' => $user->token, 'post' => $val->id]) : $response->getLink('post.php', ['post' => $val->id]);
												$log = $val->user->login;
                                                $date = $val->changeDate($val->create_at);
                                                echo "<div class='col-md-12'><div class='blog-entry ftco-animate d-md-flex'><div class='text text-2 pl-md-4'><h3 class='mb-2'><a href='$href'>$val->title</a></h3>
												<div class='meta-wrap'>
													<p class='meta'>
														<span class='text text-3'>$log</span>
														<span><i class='icon-calendar mr-2'></i>$date</span>
														<span><i class='icon-comment2 mr-2'></i>$val->commentAmount Comment</span>
													</p>
												</div>
												<p class='mb-4'>$val->preview</p>
												<p><a href='$href' class='btn-custom'>Подробнее... <span class='ion-ios-arrow-forward'></span></a></p></div></div></div>";

											}
										?>


							</div><!-- END-->

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