<?php


require '../app/db.php';
require '../app/init.php';


if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: '.ADMIN_URL);
	exit;
}

if (isset($_POST['change_user_details'])) {
	$result = change_user_details($_SESSION['user_id'], $_POST['email'], $_POST['name'], $_POST['role']);

	if ($result === true) {
		unset($_POST);
		$message = message('Ændringer blev gemt succesfuldt.', 'success');
	} else {
		$message = $result;
	}

	if (isset($_SESSION['user_email_error'])) {
		$user_email_error = true;
		unset($_SESSION['user_email_error']);
	}
	if (isset($_SESSION['user_name_error'])) {
		$user_name_error = true;
		unset($_SESSION['user_name_error']);
	}
	if (isset($_SESSION['user_role_error'])) {
		$user_role_error = true;
		unset($_SESSION['user_role_error']);
	}
}

if (isset($_POST['change_user_password'])) {
	$result = change_user_password($_SESSION['user_id'], $_POST['password'], $_POST['password_again']);

	if ($result === true) {
		unset($_POST);
		$message = message('Ændringer blev gemt succesfuldt.', 'success');
	} else {
		$message = $result;
	}

	if (isset($_SESSION['user_password_error'])) {
		$user_password_error = true;
		unset($_SESSION['user_password_error']);
	}
}

require '../templates/admin/header.php';

?>



<div class="row">
	<?php require '../templates/admin/sidebar.php'; ?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<?php echo $message; ?>
		<?php echo (check_user_abilities_superadmin()) ? message('Halløj. Du er "superadmin". Tillykke med det!', 'info') : '' ;?>
		<h1 class="page-header"><?php echo $global['site_title']; ?></h1>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2"><h2 class="sub-header">Skift informationer</h2></div>
		<form class="form-horizontal" method="post">
			<div class="form-group <?php echo (isset($user_email_error)) ? 'has-error' : '' ;?>">
				<label for="email" class="col-sm-2 control-label">E-mail</label>
				<div class="col-sm-10">
					<input required type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : $_SESSION['user_email']; ?>">
				</div>
			</div>
			<div class="form-group <?php echo (isset($user_name_error)) ? 'has-error' : '' ;?>">
				<label for="name" class="col-sm-2 control-label">Navn</label>
				<div class="col-sm-10">
					<input required type="text" class="form-control" name="name" id="name" placeholder="Fulde navn" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : $_SESSION['user_name']; ?>">
				</div>
			</div>
			<div class="form-group <?php echo (isset($user_role_error)) ? 'has-error' : '' ;?>">
				<label for="role" class="col-sm-2 control-label">Rolle</label>
				<div class="col-sm-10">
					<?php
						if ($_SESSION['user_role'] == 'superadmin') {
							$role = 'Superadministrator';
						} else if($_SESSION['user_role'] == 'admin'){
							$role = 'Administrator';
						} else if($_SESSION['user_role'] == 'accountant'){
							$role = 'Bogholder / Revisor';
						} else if($_SESSION['user_role'] == 'viewer'){
							$role = 'Seer';
						} else {
							$role = 'Ukendt';
						}
					?>
					<?php if(check_user_abilities_superadmin()): ?>
						<select class="form-control" name="role" id="role">
							<?php if (isset($_POST['role'])): ?>
								<option <?php echo ($_POST['role'] == 'viewer') ? 'selected' : '' ; ?> value="viewer">Seer</option>
								<option <?php echo ($_POST['role'] == 'accountant') ? 'selected' : '' ; ?> value="accountant">Bogholder / Revisor</option>
								<option <?php echo ($_POST['role'] == 'admin') ? 'selected' : '' ; ?> value="admin">Administrator</option>
								<option <?php echo ($_POST['role'] == 'superadmin') ? 'selected' : '' ; ?> value="superadmin">Superadministrator</option>
							<?php else: ?>
								<option value="viewer">Seer</option>
								<option value="accountant">Bogholder / Revisor</option>
								<option value="admin">Administrator</option>
								<option selected value="superadmin">Superadministrator</option>
							<?php endif; ?>
						</select>
					<?php else: ?>
						<input type="hidden" name="role" value="<?php echo $_SESSION['user_role']; ?>">
						<input type="text" disabled class="form-control" id="role" placeholder="Rolle" value="<?php echo $role; ?>">
					<?php endif; ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary" name="change_user_details">Gem</button>
				</div>
			</div>
		</form>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2"><h2 class="sub-header">Skift password</h2></div>
		<form class="form-horizontal" method="post">
			<div class="form-group <?php echo (isset($user_password_error)) ? 'has-error' : ''; ?>">
				<label for="password" class="col-sm-2 control-label">Nyt password</label>
				<div class="col-sm-10">
					<input type="password" required class="form-control" name="password" id="password" placeholder="Password">
				</div>
			</div>
			<div class="form-group <?php echo (isset($user_password_error)) ? 'has-error' : ''; ?>">
				<label for="password-again" class="col-sm-2 control-label">Bekræft password</label>
				<div class="col-sm-10">
					<input type="password" required class="form-control" name="password_again" id="password-again" placeholder="Bekræft password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-danger" name="change_user_password">Skift</button>
				</div>
			</div>
		</form>
	</div>
</div>



<?php


require '../templates/admin/footer.php';

?>