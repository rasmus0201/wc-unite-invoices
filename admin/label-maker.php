<?php
require '../app/db.php';
require '../app/init.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
	header('Location: '.BASE_URL);
	exit;
}

if (isset($_POST['make_label'])) {
	require BASE_PATH.'/lib/tcpdf.php';

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Ulvemosens Handelsselskab ApS');
	$pdf->SetTitle('Fakturaer - Ulvemosens Handelsselskab ApS');
	$pdf->SetSubject('Fakturaer - Ulvemosens Handelsselskab ApS');
	$pdf->SetKeywords('Fakturaer, Ulvemosens Handelsselskab ApS');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetMargins(0, 0, 0, 0);
	$pdf->SetAutoPageBreak(false, 0);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	$pdf->setFontSubsetting(true);
	$pdf->SetFont('helvetica', '', 7, '', true);
	$pdf->setCellPaddings(1, 3, 1, 1);
	$pdf->setCellMargins(1, 3, 1, 1);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->AddPage();

	$y = $pdf->getY();
	$x = $pdf->getX();
	$cell = '<strong>'.$_POST['name'].'</strong><br>Ingredienser: '.$_POST['ingredients'];

	if ($_POST['format'] == '3by8') {
		if (strlen($_POST['name'].'Ingredienser: '.$_POST['ingredients']) > 750) {
			$pdf->SetFont('helvetica', '', 5, '', true);
			$pdf->setCellPaddings(1, 10, 1, 1);
		}

		if (strlen($_POST['name'].'Ingredienser: '.$_POST['ingredients']) > 1300) {
			$pdf->SetFont('helvetica', '', 3.5, '', true);
			$pdf->setCellPaddings(1, 15, 1, 1);
		}
		#New row

		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x, $y, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+69.25, $y, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+69.25, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+37, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+69.25, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+37, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+69.25, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+37, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+69.25, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+37, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+69.25, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+37, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+69.25, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+37, true, 0, true, true, 50, 'B', true);
	
		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+69.25, $y+37, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 50, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+37, true, 0, true, true, 50, 'B', true);

	} else if ($_POST['format'] == '3by7') {
		$pdf->setCellPaddings(2, 4, 2, 4);
		$pdf->setCellMargins(1, 4, 1, 1);

		if (strlen($_POST['name'].'Ingredienser: '.$_POST['ingredients']) > 750) {
			$pdf->SetFont('helvetica', '', 5, '', true);
			$pdf->setCellPaddings(2, 8, 2, 2);
		}

		if (strlen($_POST['name'].'Ingredienser: '.$_POST['ingredients']) > 1300) {
			$pdf->SetFont('helvetica', '', 3.5, '', true);
			$pdf->setCellPaddings(2, 12, 2, 2);
		}

		#New row

		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x, $y+0, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+69.25, $y+0, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+0, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+69.25, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+42, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+69.25, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+42, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+69.25, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+42, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+69.25, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+42, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+69.25, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+42, true, 0, true, true, 50, 'B', true);

		#New row
		$y = $pdf->getY();

		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+69.25, $y+42, true, 0, true, true, 50, 'B', true);
		$pdf->MultiCell(69.5, 40, $cell, 0, 'J', 1, 0, $x+(69.25*2), $y+42, true, 0, true, true, 50, 'B', true);
	}

	$pdf->lastPage();

	$pdf->Output($_POST['name'].'.pdf', 'I');

	exit;
}

require '../templates/admin/header.php';
?>

<div class="row">
	<?php require '../templates/admin/sidebar.php'; ?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h1 class="page-header"><?php echo $titles['admin/tools.php'].' / '.$global['site_title']; ?></h1>
		<form method="post">
			<div class="col-sm-7">
				<div class="form-group <?php echo (isset($form_error)) ? 'has-error' : '' ;?>">
					<label for="name" class="control-label">Produkt Navn (Overskrift):</label>
					<input required type="text" class="form-control" name="name" id="name" placeholder="Eks.: Bean Boozled 45gr." value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ''; ?>">
				</div>
				<div class="form-group <?php echo (isset($form_error)) ? 'has-error' : '' ;?>">
					<label for="ingredients" class="control-label">Ingredienser:</label>
					<textarea required class="form-control" name="ingredients" id="ingredients" cols="30" rows="10"><?php echo (isset($_POST['ingredients'])) ? $_POST['ingredients'] : '' ;?></textarea>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="form-group <?php echo (isset($form_error)) ? 'has-error' : '' ;?>">
					<label for="format" class="control-label">Vælg format</label>
					<select required class="form-control" name="format" id="format">
						<?php if(isset($_POST['format'])): ?>
							<option <?php echo ($_POST['format'] == '3by7') ? 'selected' : '' ;?> value="3by7">3 x 7</option>
							<option <?php echo ($_POST['format'] == '3by8') ? 'selected' : '' ;?> value="3by8">3 x 8</option>
						<?php else: ?>
							<option value="3by7">3 x 7</option>
							<option selected value="3by8">3 x 8</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="make_label" style="width:100%;">Lav label</button>
				</div>
				<div class="form-group">
					<?php echo message('Kode til tyk tekst: <code>'.htmlspecialchars('<strong> </strong>').'</code>', 'info', false); ?>
				</div>
			</div>
		</form>
	</div>
</div>

<?php

require '../templates/admin/footer.php';

?>