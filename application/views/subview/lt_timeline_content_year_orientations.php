<div data-node="lt-container-year-content-orientations" class="lt-container-year-academic-content row">
	<div class="lt-container-year-academic-node-title row lt-minor-title">
		<span>
			<?php echo lang('lt_label_orientations'); ?>
		</span>
		<span id="lt-node-minimizer">+</span>
	</div>
	<div class="lt-container-year-academic-node-content row lt-hidden">
		<!-- ********************* ORIENTACOES DE MESTRADO CONCLUIDAS ********************* -->
		<?php if ( array_key_exists($year, $curriculum['done_master_orientations']) ) { ?>
			<div data-node="lt-container-year-content-done-master-orientations">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_done_master_orientations'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['done_master_orientations'][$year] as $orientation) { ?>
					<div class="lt-container-done-master-orientation row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- ORIENTADO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $orientation[LABEL_NOME_DO_ORIENTADO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- TITULO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_TITULO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NOME DO CURSO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_NOME_DO_CURSO]; ?>
								<?php echo ' - '; ?>
							</span>
							<!-- NOME DA INSTITUICAO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_NOME_DA_INSTITUICAO]; ?>
								<?php echo '.'; ?>
							</span>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-done-master-orientations" value="<?php echo count($curriculum['done_master_orientations'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- ************************ OUTRAS ORIENTACOES CONCLUIDAS *********************** -->
		<?php if ( array_key_exists($year, $curriculum['done_other_orientations']) ) { ?>
			<div data-node="lt-container-year-content-done-other-orientations">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_done_other_orientations'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['done_other_orientations'][$year] as $orientation) { ?>
					<div class="lt-container-done-other-orientation row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- ORIENTADO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $orientation[LABEL_NOME_DO_ORIENTADO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- TITULO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_TITULO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NOME DO CURSO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_NOME_DO_CURSO]; ?>
								<?php echo ' - '; ?>
							</span>
							<!-- NOME DA INSTITUICAO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_NOME_DA_INSTITUICAO]; ?>
								<?php echo '.'; ?>
							</span>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-done-other-orientations" value="<?php echo count($curriculum['done_other_orientations'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- ******************* ORIENTACOES CIENTIFICAS EM ANDAMENTO ********************* -->
		<?php if ( array_key_exists($year, $curriculum['going_scientific_orientations']) ) { ?>
			<div data-node="lt-container-year-content-going-scientific-orientations">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_going_scientific_orientations'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['going_scientific_orientations'][$year] as $orientation) { ?>
					<div class="lt-container-going-scientific-orientation row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- ORIENTADO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $orientation[LABEL_NOME_DO_ORIENTADO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- TITULO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_TITULO_DO_TRABALHO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NOME DO CURSO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_NOME_CURSO]; ?>
								<?php echo ' - '; ?>
							</span>
							<!-- NOME DA INSTITUICAO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_NOME_INSTITUICAO]; ?>
								<?php echo '.'; ?>
							</span>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-going-scient-orientations" value="<?php echo count($curriculum['going_scientific_orientations'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- ******************* ORIENTACOES DE MESTRADO EM ANDAMENTO ********************* -->
		<?php if ( array_key_exists($year, $curriculum['going_mater_orientations']) ) { ?>
			<div data-node="lt-container-year-content-going-master-orientations">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_going_master_orientations'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['going_mater_orientations'][$year] as $orientation) { ?>
					<div class="lt-container-going-master-orientation row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- ORIENTADO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $orientation[LABEL_NOME_DO_ORIENTANDO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- TITULO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_TITULO_DO_TRABALHO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NOME DO CURSO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_NOME_CURSO]; ?>
								<?php echo ' - '; ?>
							</span>
							<!-- NOME DA INSTITUICAO -->
							<span class="lt-academic-label-minor">
								<?php echo $orientation[LABEL_NOME_INSTITUICAO]; ?>
								<?php echo '.'; ?>
							</span>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-going-master-orientations" value="<?php echo count($curriculum['going_mater_orientations'][$year]); ?>"/>
			</div>
		<?php } ?>
	</div>
</div>