<div data-node="lt-container-year-content-boards" class="lt-container-year-academic-content row">
	<div class="lt-container-year-academic-node-title row lt-minor-title">
		<span>
			<?php echo lang('lt_label_boards'); ?>
		</span>
		<span id="lt-node-minimizer">+</span>
	</div>
	<div class="lt-container-year-academic-node-content row lt-hidden">
		<!-- ***************************** BANCAS DE MESTRADO ***************************** -->
		<?php if ( array_key_exists($year, $curriculum['master_boards']) ) { ?>
			<div data-node="lt-container-year-content-master-boards">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_master_boards'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['master_boards'][$year] as $board) { ?>
					<div class="lt-container-master-board row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- PARTICIPANTES -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo lang('lt_label_evaluators'); ?> : 
							</span>
							<?php foreach ($board['participantes'] as $evaluator) { ?>
								<span class="lt-academic-label-minor">
									<?php echo $evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE]; ?>
									<?php echo '; '; ?>
								</span>
							<?php } ?>
							<!-- CANDIDATO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo 'Participação em banca de '; ?>
								<?php echo $board[LABEL_NOME_DO_CANDIDATO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- ANO -->
							<span class="lt-academic-label-minor">
								<?php echo $board[LABEL_ANO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NOME DO CURSO -->
							<span class="lt-academic-label-minor">
								<?php echo '('; ?>
								<?php echo $board[LABEL_NOME_CURSO]; ?>
								<?php echo ')'; ?>
							</span>
							<!-- NOME DA INSTITUICAO -->
							<span class="lt-academic-label-minor">
								<?php echo ' - '; ?>
								<?php echo $board[LABEL_NOME_INSTITUICAO]; ?>
								<?php echo '.'; ?>
							</span>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-master-boards" value="<?php echo count($curriculum['master_boards'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- ******************** BANCAS DE QUALIFICACAO DE MESTRADO ********************** -->
		<?php if ( array_key_exists($year, $curriculum['qualification_boards']) ) { ?>
			<div data-node="lt-container-year-content-qualis-boards">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_qualis_boards'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['qualification_boards'][$year] as $board) { ?>
					<div class="lt-container-quali-board row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- PARTICIPANTES -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo lang('lt_label_evaluators'); ?> : 
							</span>
							<?php foreach ($board['participantes'] as $evaluator) { ?>
								<span class="lt-academic-label-minor">
									<?php echo $evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE]; ?>
									<?php echo '; '; ?>
								</span>
							<?php } ?>
							<!-- CANDIDATO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo 'Participação em banca de '; ?>
								<?php echo $board[LABEL_NOME_DO_CANDIDATO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- ANO -->
							<span class="lt-academic-label-minor">
								<?php echo $board[LABEL_ANO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NOME DO CURSO -->
							<span class="lt-academic-label-minor">
								<?php echo '('; ?>
								<?php echo $board[LABEL_NOME_CURSO]; ?>
								<?php echo ')'; ?>
							</span>
							<!-- NOME DA INSTITUICAO -->
							<span class="lt-academic-label-minor">
								<?php echo ' - '; ?>
								<?php echo $board[LABEL_NOME_INSTITUICAO]; ?>
								<?php echo '.'; ?>
							</span>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-quali-boards" value="<?php echo count($curriculum['qualification_boards'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- ************************** BANCAS DE ESPECIALIZACAO ************************** -->
		<?php if ( array_key_exists($year, $curriculum['expertise_boards']) ) { ?>
			<div data-node="lt-container-year-content-expertise-boards">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_expertise_boards'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['expertise_boards'][$year] as $board) { ?>
					<div class="lt-container-expertise-board row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- PARTICIPANTES -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo lang('lt_label_evaluators'); ?> : 
							</span>
							<?php foreach ($board['participantes'] as $evaluator) { ?>
								<span class="lt-academic-label-minor">
									<?php echo $evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE]; ?>
									<?php echo '; '; ?>
								</span>
							<?php } ?>
							<!-- CANDIDATO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo 'Participação em banca de '; ?>
								<?php echo $board[LABEL_NOME_DO_CANDIDATO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- ANO -->
							<span class="lt-academic-label-minor">
								<?php echo $board[LABEL_ANO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NOME DO CURSO -->
							<span class="lt-academic-label-minor">
								<?php echo '('; ?>
								<?php echo $board[LABEL_NOME_CURSO]; ?>
								<?php echo ')'; ?>
							</span>
							<!-- NOME DA INSTITUICAO -->
							<span class="lt-academic-label-minor">
								<?php echo ' - '; ?>
								<?php echo $board[LABEL_NOME_INSTITUICAO]; ?>
								<?php echo '.'; ?>
							</span>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-expert-boards" value="<?php echo count($curriculum['expertise_boards'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- ************************** BANCAS DE GRADUACAO ************************** -->
		<?php if ( array_key_exists($year, $curriculum['graduation_boards']) ) { ?>
			<div data-node="lt-container-year-content-graduation-boards">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_graduation_boards'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['graduation_boards'][$year] as $board) { ?>
					<div class="lt-container-graduation-board row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- PARTICIPANTES -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo lang('lt_label_evaluators'); ?> : 
							</span>
							<?php foreach ($board['participantes'] as $evaluator) { ?>
								<span class="lt-academic-label-minor">
									<?php echo $evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE]; ?>
									<?php echo '; '; ?>
								</span>
							<?php } ?>
							<!-- CANDIDATO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo 'Participação em banca de '; ?>
								<?php echo $board[LABEL_NOME_DO_CANDIDATO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- ANO -->
							<span class="lt-academic-label-minor">
								<?php echo $board[LABEL_ANO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NOME DO CURSO -->
							<span class="lt-academic-label-minor">
								<?php echo '('; ?>
								<?php echo $board[LABEL_NOME_CURSO]; ?>
								<?php echo ')'; ?>
							</span>
							<!-- NOME DA INSTITUICAO -->
							<span class="lt-academic-label-minor">
								<?php echo ' - '; ?>
								<?php echo $board[LABEL_NOME_INSTITUICAO]; ?>
								<?php echo '.'; ?>
							</span>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-graduat-boards" value="<?php echo count($curriculum['graduation_boards'][$year]); ?>"/>
			</div>
		<?php } ?>
	</div>
</div>