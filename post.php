<?php require_once "lib/init_post.php";
require_once "lib/init_comment.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Blog</title>
	<?php echo file_get_contents("lib/head.html");?>
</head>

<body>
	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<?php echo $menu->appear(basename(__FILE__));?>
		<div id="colorlib-main">
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 px-md-3 py-5">
							<div>
							<?php $h = $response->getLink('post-action.php', ['token' => $user->token, 'post' => $post->id]); if (!$user->isGuest && !$user->isAdmin && $user->id == $post->user_id) {echo "<a href='$h' class='text-warning' style='font-size: 1.8em;' title='Редактировать'>🖍</a>";} ?>
							<?php $h = $response->getLink('post.php', ['token' => $user->token, 'post' => $post->id, 'delete' => $post->id,]); if ((!$user->isGuest && $user->id == $post->user_id)|| $user->isAdmin) {echo "<a href='$h' class='text-danger' style='font-size: 1.8em;' title='Удалить'>🗑</a>";} ?>
							</div><?=$post->delete?>

							<div class="post">
								<h1 class="mb-3"><?=$post->title?></h1>
								<div class="meta-wrap">
									<p class="meta">
										<!-- <img src='avatar.jpg' /> -->
										<span class="text text-3"><?=$post->user->mysql->myQuery("SELECT login FROM user WHERE id=$post->user_id")[0]['login']?></span>
										<span><i class="icon-calendar mr-2"></i><?=$post->changeDate($post->create_at)?></span>
										<span><i class="icon-comment2 mr-2"></i><?=$post->commentAmount?> Comment</span>
									</p>
								</div>
								<p>
									<?=$post->content?>
								</p>
								<p>
									<!--<img src="images/image_1.jpg" alt="" class="img-fluid">-->
								</p>
								<div>
								<?php $h = $response->getLink('post-action.php', ['token' => $user->token, 'post' => $post->id]); if (!$user->isGuest && !$user->isAdmin  && $user->id == $post->user_id) {echo "<a href='$h' class='text-warning' style='font-size: 1.8em;' title='Редактировать'>🖍</a>";} ?>
								<?php $href=$response->getLink('post.php', ['token' => $user->token, 'post' => $post->id, 'delete' => $post->id,]); if ((!$user->isGuest && $user->id == $post->user_id)|| $user->isAdmin) {echo "<a href='$href' class='text-danger' style='font-size: 1.8em;' title='Удалить'>🗑</a>";} ?>
								</div>

							</div>
							<!--LIST OF COMMENTS-->
							<div class="comments pt-5 mt-5">
								<h3 class="mb-5 font-weight-bold"><?=$post->commentAmount?> Comment</h3>
								<ul class="comment-list">
									<?php $mas = $comment->commentList($post->id); 
									foreach ($mas as $val) {
                                        $h = $response->getLink('post.php', ['token' => $user->token, 'post' => $post->id, 'commentdelete' => $val->id,]);
										$d = $val->changeDate($val->create_at); $n = $val->post->user->name; $s = $val->post->user->surname; $p = $val->post->user->patronymic;
										echo 
										"<li class='comment'>
											<div class='comment-body'>
												<div class='d-flex justify-content-between'>
													<h3>$n $s $p</h3>";
                                                    if (!$user->isGuest && $user->isAdmin) {echo "<a href='$h' class='text-danger' style='font-size: 1.8em;' title='Удалить'>🗑</a>";}
												echo 
												"</div>
												<div class='meta'>$d</div>
												<p>$val->comment</p>
											</div>
										</li>";
									}

									?>
								</ul>
								<!-- END comment-list -->
								<?php //LEAVE THE COMMENT
								$c = ($comment->comment)?$comment->brReplace($comment->comment):'';
								if (!$user->isGuest && !$user->isAdmin && $user->id !== $post->user_id) {echo 
								"<div class='comment-form-wrap pt-5'>
									<h3 class='mb-5'>Оставьте комментарий</h3>
									<form action='#' method='POST' class='p-3 p-md-5 bg-light'>
										<div class='form-group'>
												<label for='message'>Сообщение</label>
												<textarea name='comment' id='comment' cols='30' rows='10'class='form-control'>". $c. "</textarea>
										</div>
												$comment->validateComment
										<div class='form-group'>
											<input type='submit' value='Отправить' name='send_comment'class='btn py-3 px-4 btn-primary'>
										</div>
									</form>
								</div>";}?>

							</div>
						</div>
					</div><!-- END-->
				</div>
			</section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

	<!-- loader -->
	<?php echo file_get_contents("lib/preloader.html"); ?>

	<?php echo file_get_contents("lib/scripts.html"); ?>

</body>

</html>