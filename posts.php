<?php require_once "lib/init_posts.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Blog</title>
	<?php echo file_get_contents("lib/head.html");?>
</head>

<body>

	<div id="colorlib-page">
	<?php echo $menu->appear(basename(__FILE__));?>
		<div id="colorlib-main">
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row d-flex">
						<div class="col-xl-8 col-md-8 py-5 px-md-2">
							<div class="row">
								<div class="col-md-12 col-lg-12">
									<div>
										<?php $h = $response->getLink('post-action.php', ['token' => $user->token]); if (!$user->isGuest && !$user->isAdmin) {echo "<a href='$h' class='btn btn-outline-success'>📝 Создать пост</a>";} ?>
										
									</div>
								</div>
							</div>
							<div class="row pt-md-4">
								<!-- один пост/превью / ONE POST PREVIEW-->
                                <?php
											$mas = $post->postsList();
											foreach ($mas as $val) {
                                                $hh = ($user->token)?$response->getLink('post.php', ['token' => $user->token, 'post' => $val->id]):$response->getLink('post.php', ['post' => $val->id]);
												$href = $response->getLink('post.php', ['token' => $user->token, 'post' => $val->id, 'delete' => $val->id]);
												$h = $response->getLink('post-action.php', ['token' => $user->token, 'post' => $val->id]);
												$log = $val->user->login;
                                                $date = $val->changeDate($val->create_at);
												echo "<div class='col-md-12'>
														<div class='blog-entry ftco-animate d-md-flex'>
															<div class='text text-2 pl-md-4'>
																<h3 class='mb-2'><a href='$hh'>$val->title</a></h3>
																<div class='meta-wrap'>
																	<p class='meta'>
																		<span class='text text-3'>$log</span>
																		<span><i class='icon-calendar mr-2'></i>$date</span>
																		<span><i class='icon-comment2 mr-2'></i>$val->commentAmount Comment</span>
																	</p>
																</div>
																<p class='mb-4'>$val->preview</p>
																<div class='d-flex pt-1  justify-content-between'>
																	<div><p><a href='$hh' class='btn-custom'>Подробнее... <span class='ion-ios-arrow-forward'></span></a></p></div>
																	<div>";
																	if (!$user->isGuest && !$user->isAdmin && $user->id == $val->user->id) {echo "<a href='$h' class='text-warning' style='font-size: 1.8em;' title='Редактировать'>🖍</a>";}
                                                                    if (!$user->isGuest && $user->isAdmin) {echo "<a href='$href' class='text-danger' style='font-size: 1.8em;' title='Удалить'>🗑</a>";}
																	echo "</div>
																</div>
															</div>
														</div>
													</div>";

											}
										?>


							</div><!-- END-->

							<!-- 
								pagination
								<div class="row">
								<div class="col">
									<div class="block-27">
										<ul>
											<li><a href="#">&lt;</a></li>
											<li class="active"><span>1</span></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											<li><a href="#">&gt;</a></li>
										</ul>
									</div>
								</div>
							</div> -->

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