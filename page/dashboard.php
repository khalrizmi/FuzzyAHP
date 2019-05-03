	
	<?php if (@$_SESSION['logged'] == true): ?>
		
        <div class="callout callout-info">
          <h4>Selamat datang <?= $_SESSION['name'] ?></h4>

          <p>Sistem penunjang keputusan varietas bibit cabai kriting terbaik dengan menerapkan metode Fuzzy AHP</p>
        </div>
    <?php else: ?>

		<div class="callout callout-info">
          <h4>Fuzzy AHP</h4>

          <p>Sistem penunjang keputusan varietas bibit cabai kriting terbaik dengan menerapkan metode Fuzzy AHP</p>
        </div>
    <?php endif; ?>

        