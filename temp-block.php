<?php require_once "lib/init_temp-block.php"; ?>

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
			<section class="contact-section px-md-2  pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<!--TEMPORARY BLOCK OF THE USER-->
							<h2 class="h3">Временная блокировка пользователя</h2>
							<div>
								Пользователь: <?php $id = $request->get('user'); echo $user->mysql->myQuery("SELECT login FROM $user->tableName WHERE id = $id")[0]['login']?>
							</div>
						</div>
					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">
							<form action="#" method = 'POST' class="bg-light p-5 contact-form">
								<div class="form-group">
									<label for="date-block">Дата временной блокировки</label>
									<input type="text" class="form-control" id="date-block" name="date_block" value=""
										required>
								</div>
								<div class="form-group">
									<input type="submit" value="Блокировать" class="btn btn-primary py-3 px-5">
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
		$(document).ready(function () {
			$(function () {
				$('#date-block').daterangepicker({
					singleDatePicker: true,
					showDropdowns: true,
					timePicker: true,
					timePicker24Hour: true,
					minYear: 2023,
					maxYear: parseInt(moment().format('YYYY'), 10),
					locale: {
						format: 'DD.MM.YYYY HH:mm'
					}
				});
			});
		})
		$('#date-block').on('apply.daterangepicker', function (ev, picker) {
			$(this).val(picker.startDate.format('DD.MM.YYYY HH:mm'))
		});
	</script>
</body>
</html>