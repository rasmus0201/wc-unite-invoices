<?php

require '../app/db.php';
require '../app/init.php';


if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: '.BASE_URL);
	exit;
}
if (isset($_POST['export_csv'])) {
	$res = download_csv_orders($_POST['invoices']);

	if ( !$res ) {
		header('Location: '.BASE_URL.'/'.$global['current_url']);
		exit;
	}

	header('Content-type: text/csv');
	header('Content-disposition: attachment; filename=Export '.date('Y-m-d H:i:s').'.csv');
	header('Pragma: no-cache');
	header('Expires: 0');

	$csvs = explode("\s", $res);

	foreach ($csvs as $csv => $value) {
		$csv = json_decode($value, true);

		$joins = array_filter(explode("\n", json_decode($csv['export_csv'], true)['joined']));

		foreach ($joins as $join) {
			if (!is_null($join) && !empty($join)) {
				echo $join."\n";
			}
		}
	}

	exit;
} else {
	$invoices = get_invoices();
}

require '../templates/admin-header.php';

?>

<div class="row">
	<?php require '../templates/admin-sidebar.php'; ?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h1 class="page-header"><?php echo $titles['admin/index.php'].' / '.$global['site_title']; ?><span class="pull-right"><a class="btn btn-success" href="orders.php?action=add" role="button">Tilføj ordre</a><a class="btn btn-success" href="orders.php?action=pull" role="button">Importér ordrer</a></span></h1>
		<?php if(!empty($invoices)): ?>
			<form class="form-horizontal" method="post">
				<input class="btn btn-default" type="submit" name="export_csv" value="Eksportér CSV">
				<input class="btn btn-default" type="submit" name="export_pdf" value="Eksportér PDF">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th><div class="checkbox"><label><input type="checkbox" id="select_all"></label></div></th>
								<th>Faktura nr.</th>
								<th>Website</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($invoices as $invoice) : ?>
								<tr>
									<td>
										<div class="checkbox"><label><input type="checkbox" name="invoices[invoice_<?php echo $invoice['invoice_id']; ?>]"></label></div>
									</td>
									<td><?php echo $invoice['invoice_id']; ?></td>
									<td><a href="<?php echo $invoice['owner_site_url']; ?>" target="_blank"><?php echo $invoice['owner_site_name']; ?></a></td>
									<td><a href="orders.php?invoice_id=<?php echo $invoice['invoice_id']; ?>&action=view" class="btn btn-default">Vis</a></td>
								</tr>	
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</form>
		<?php else: ?>
			<?php echo message('Du har ingen fakturaer endnu.', 'warning', false); ?>
		<?php endif; ?>
	</div>
</div>



<?php

require '../templates/admin-footer.php';

?>