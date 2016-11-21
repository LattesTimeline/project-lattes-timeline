<div data-node="lt-container-year-content-projects" class="lt-container-year-academic-content row">
	<div class="lt-container-year-academic-node-title row lt-minor-title">
		<span>
			<?php echo lang('lt_label_research_projects'); ?>
		</span>
		<span id="lt-node-minimizer">+</span>
	</div>
	<div class="lt-container-year-academic-node-content row lt-hidden">
		<?php if ( array_key_exists($year, $curriculum['projects']) ) { ?>
			<?php foreach ($curriculum['projects'][$year] as $project) { ?>
			<div class="lt-container-project row">
				<!-- ANO DE INICIO -->
				<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="lt-academic-label-minor lt-academic-label-highlight">
						<?php echo $project[LABEL_ANO_INICIO]; ?>
						<?php echo '-'; ?>
						<?php echo ( !empty($project[LABEL_ANO_FIM]) ? $project[LABEL_ANO_FIM] : lang('lt_label_until_today') ); ?>
					</span>
				</div>
				<!-- NOME DO PROJETO -->
				<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="lt-academic-label-minor lt-academic-label-highlight">
						<?php echo $project[LABEL_NOME_DO_PROJETO]; ?>
					</span>
				</div>
				<!-- DESCRICAO DO PROJETO -->
				<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="lt-academic-label-minor lt-academic-label-highlight">
						<?php echo lang('lt_label_description'); ?> : 
					</span>
					<span class="lt-academic-label-minor">
						<?php echo $project[LABEL_DESCRICAO_PROJETO]; ?>
					</span>
				</div>
				<!-- SITUACAO DO PROJETO -->
				<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="lt-academic-label-minor lt-academic-label-highlight">
						<?php echo lang('lt_label_situation'); ?> : 
					</span>
					<span class="lt-academic-label-minor">
						<?php echo $project[LABEL_SITUACAO]; ?>
					</span>
				</div>
				<!-- NATUREZA DO PROJETO -->
				<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="lt-academic-label-minor lt-academic-label-highlight">
						<?php echo lang('lt_label_nature'); ?> : 
					</span>
					<span class="lt-academic-label-minor">
						<?php echo $project[LABEL_NATUREZA]; ?>
					</span>
				</div>
				<!-- ALUNOS ENVOLVIDOS -->
				<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="lt-academic-label-minor lt-academic-label-highlight">
						<?php echo lang('lt_label_students_involved'); ?> : 
					</span>
					<?php if (!empty($project[LABEL_NUMERO_DOUTORADO])) { ?>
						<span class="lt-academic-label-minor lt-academic-label-item">
							<?php echo $project[LABEL_NUMERO_DOUTORADO]; ?>
						</span>
					<?php } ?>
					<?php if (!empty($project[LABEL_NUMERO_MESTRADO_ACADEMICO])) { ?>
						<span class="lt-academic-label-minor lt-academic-label-item">
							<?php echo $project[LABEL_NUMERO_MESTRADO_ACADEMICO]; ?>
						</span>
					<?php } ?>
					<?php if (!empty($project[LABEL_NUMERO_MESTRADO_PROF])) { ?>
						<span class="lt-academic-label-minor lt-academic-label-item">
							<?php echo $project[LABEL_NUMERO_MESTRADO_PROF]; ?>
						</span>
					<?php } ?>
					<?php if (!empty($project[LABEL_NUMERO_ESPECIALIZACAO])) { ?>
						<span class="lt-academic-label-minor lt-academic-label-item">
							<?php echo $project[LABEL_NUMERO_ESPECIALIZACAO]; ?>
						</span>
					<?php } ?>
					<?php if (!empty($project[LABEL_NUMERO_GRADUACAO])) { ?>
						<span class="lt-academic-label-minor lt-academic-label-item">
							<?php echo $project[LABEL_NUMERO_GRADUACAO]; ?>
						</span>
					<?php } ?>
				</div>
				<!-- INTEGRANTES DO PROJETO -->
				<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="lt-academic-label-minor lt-academic-label-highlight">
						<?php echo lang('lt_label_members'); ?> : 
					</span>
					<?php foreach ($project['integrantes'] as $integrante) { ?>
						<span class="lt-academic-label-minor lt-academic-label-item">
							<?php echo $integrante[LABEL_NOME_COMPLETO]; ?>
							<?php echo $integrante[LABEL_RESPONSAVEL] ? ' - ' . lang('lt_label_responsible') : ''; ?>
						</span>
					<?php } ?>
				</div>
				<!-- FINANCIADORES DO PROJETO -->
				<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="lt-academic-label-minor lt-academic-label-highlight">
						<?php echo lang('lt_label_financiers'); ?> : 
					</span>
					<?php foreach ($project['financiadores'] as $financiador) { ?>
						<span class="lt-academic-label-minor lt-academic-label-item">
							<?php echo $financiador[LABEL_NOME_INSTITUICAO]; ?>
							 - 
							<?php echo $financiador[LABEL_NATUREZA]; ?>
						</span>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			
			<input type="hidden" name="chart-<?php echo $year ?>-projects" value="<?php echo count($curriculum['projects'][$year]); ?>"/>
		<?php } ?>
	</div>
</div>