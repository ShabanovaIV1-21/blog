<?php require_once "lib/init_users.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
<title></title>
	<?php echo file_get_contents("lib/head.html");?>
</head>

<body>
	<div id="colorlib-page">
	<?php echo $menu->appear(basename(__FILE__));?>
		<div id="colorlib-main">
			<section class="contact-section px-md-4 pt-5">
				<div class="container">
					<div class="row block-9">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-md-12 mb-1">
									<h3 class="h3">Пользователи</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-1">
									<!--LIST OF USERS-->
									<table class="table table-striped">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Name</th>
												<th scope="col">Surname</th>
												<th scope="col">Login</th>

												<th scope="col">E-mail</th>
												<th scope="col">Temp block</th>
												<th scope="col">Permanent block</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$mas = $user->mysql->myQuery("SELECT * FROM $user->tableName");
												foreach ($mas as $key => $val) {
													$n = $val['name']; $s = $val['surname']; $l = $val['login']; $e = $val['email'];
                                                    $href = $response->getLink('temp-block.php', ['token' => $user->token, 'user' => $val['id']]);
                                                    $h = $response->getLink('users.php', ['token' => $user->token, 'user' => $val['id']]);
													if ($key === 0 || $val['is_block']) {
														continue;
													}
													echo
													"<tr>
														<th scope='row'>$key</th>
														<td>$n</td>
														<td>$s</td>
														<td>$l</td>
														<td>$e</td>
														<td><a href='$href' class='btn btn-outline-warning px-4' >⏳ Block</a></td>
														<td><a href='$h' class='btn btn-outline-danger px-4'>📌 Block</a></td>
													</tr>";
												}
											?>

										</tbody>
									</table>
								</div>
							</div>
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