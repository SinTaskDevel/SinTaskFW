<div class="contentArea">
	Hanya contoh untuk halaman Dinamis
	<br>
	Parameter Segmen URL &mdash; <b><?php echo $__SEGMEN_PURE__[3];?></b>
	<div class="bLineSpace"></div>
	<?php
		$timing2 = microTimeStamp();
		$resultTime = $timing2-$timing1;

		echo "Loaded in <b>".$resultTime."</b>ms";
	?>
</div>