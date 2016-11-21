<div data-node="lt-container-year-content-productions" class="lt-container-year-academic-content row">
	<div class="lt-container-year-academic-node-title row lt-minor-title">
		<span>
			<?php echo lang('lt_label_productions'); ?>
		</span>
		<span id="lt-node-minimizer">+</span>
	</div>
	<div class="lt-container-year-academic-node-content row lt-hidden">
		<!-- ********************************* LIVROS ********************************* -->
		<?php if ( array_key_exists($year, $curriculum['produtcion_books']) ) { ?>
			<div data-node="lt-container-year-content-productions-books">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_book_productions'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['produtcion_books'][$year] as $book) { ?>
					<div class="lt-container-production-book row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- TITULO DO LIVRO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $book[LABEL_TITULO_DO_LIVRO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NUMERO DA EDICAO -->
							<span class="lt-academic-label-minor">
								<?php echo $book[LABEL_NUMERO_EDICAO_REVISAO]; ?>
								<?php echo '.ed. ,'; ?>
							</span>
							<!-- ANO -->
							<span class="lt-academic-label-minor">
								<?php echo $book[LABEL_ANO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NUMERO DE VOLUMES -->
							<span class="lt-academic-label-minor">
								<?php echo 'v.'; ?>
								<?php echo $book[LABEL_NUMERO_VOLUMES]; ?>
							</span>
						</div>
						<!-- AUTORES -->
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo lang('lt_label_authors'); ?> : 
							</span>
							<?php foreach ($book['autores'] as $autor) { ?>
								<span class="lt-academic-label-minor">
									<?php echo $autor[LABEL_NOME_PARA_CITACAO]; ?>
									<?php echo '; '; ?>
								</span>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-prod-books" value="<?php echo count($curriculum['produtcion_books'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- ******************************* CAPITULOS ******************************** -->
		<?php if ( array_key_exists($year, $curriculum['production_book_chapters']) ) { ?>
			<div data-node="lt-container-year-content-productions-book-chapters">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_book_chapter_productions'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['production_book_chapters'][$year] as $chapter) { ?>
					<div class="lt-container-production-book-chapter row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- TITULO DO CAPITULO LIVRO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $chapter[LABEL_TITULO_DO_CAPITULO_DO_LIVRO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- TITULO DO LIVRO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $chapter[LABEL_TITULO_DO_LIVRO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NUMERO DA EDICAO -->
							<span class="lt-academic-label-minor">
								<?php echo $chapter[LABEL_NUMERO_EDICAO_REVISAO]; ?>
								<?php echo '.ed. ,'; ?>
							</span>
							<!-- ANO -->
							<span class="lt-academic-label-minor">
								<?php echo $chapter[LABEL_ANO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- NUMERO DE VOLUMES -->
							<span class="lt-academic-label-minor">
								<?php echo 'v.'; ?>
								<?php echo $chapter[LABEL_NUMERO_VOLUMES]; ?>
							</span>
							<!-- PAGINA INICIAL -->
							<span class="lt-academic-label-minor">
								<?php echo 'p.'; ?>
								<?php echo $chapter[LABEL_PAGINA_INICIAL]; ?>
							</span>
							<!-- PAGINA FINAL -->
							<span class="lt-academic-label-minor">
								<?php echo ' - '; ?>
								<?php echo $chapter[LABEL_PAGINA_FINAL]; ?>
							</span>
						</div>
						<!-- AUTORES -->
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo lang('lt_label_authors'); ?> : 
							</span>
							<?php foreach ($chapter['autores'] as $autor) { ?>
								<span class="lt-academic-label-minor">
									<?php echo $autor[LABEL_NOME_PARA_CITACAO]; ?>
									<?php echo '; '; ?>
								</span>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-prod-chapters" value="<?php echo count($curriculum['production_book_chapters'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- *************************** OUTRAS PRODUCOES ***************************** -->
		<?php if ( array_key_exists($year, $curriculum['other_productions']) ) { ?>
			<div data-node="lt-container-year-content-other-productions">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_events_and_technical_productions'); ?>
					</span>
				</div>
				<?php foreach ($curriculum['other_productions'][$year] as $other) { ?>
					<div class="lt-container-other-production row">
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- TITULO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $other[LABEL_TITULO]; ?>
								<?php echo '. '; ?>
							</span>
							<!-- ANO -->
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo $other[LABEL_ANO]; ?>
								<?php echo ' ('; ?>
							</span>
							<!-- NATUREZA -->
							<span class="lt-academic-label-minor">
								<?php echo $other[LABEL_NATUREZA]; ?>
								<?php echo ')'; ?>
							</span>
						</div>
						<!-- AUTORES -->
						<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<span class="lt-academic-label-minor lt-academic-label-highlight">
								<?php echo lang('lt_label_authors'); ?> : 
							</span>
							<?php foreach ($other['autores'] as $autor) { ?>
								<span class="lt-academic-label-minor">
									<?php echo $autor[LABEL_NOME_PARA_CITACAO]; ?>
									<?php echo '; '; ?>
								</span>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<input type="hidden" name="chart-<?php echo $year ?>-prod-other" value="<?php echo count($curriculum['other_productions'][$year]); ?>"/>
			</div>
		<?php } ?>
		<!-- ************************* TRABALHOS EM EVENTOS *************************** -->
		<?php if ( array_key_exists($year, $curriculum['in_event_productions']) || array_key_exists($year, $curriculum['technical_productions']) ) { ?>
			<div data-node="lt-container-year-content-productions-in-events">
				<div class="lt-academic-label">
					<span class="lt-academic-label-major lt-academic-label-highlight">
						<?php echo lang('lt_label_events_and_technical_productions'); ?>
					</span>
				</div>
				<?php if ( array_key_exists($year, $curriculum['in_event_productions']) ) { ?>
					<?php foreach ($curriculum['in_event_productions'][$year] as $production) { ?>
						<div class="lt-container-production-in-event row">
							<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<!-- TITULO DO TRABALHO -->
								<span class="lt-academic-label-minor lt-academic-label-highlight">
									<?php echo $production[LABEL_TITULO_DO_TRABALHO]; ?>
									<?php echo '. In : '; ?>
								</span>
								<!-- TITULO DO EVENTO -->
								<span class="lt-academic-label-minor lt-academic-label-highlight">
									<?php echo $production[LABEL_TITULO_DO_EVENTO]; ?>
									<?php echo ', '; ?>
								</span>
								<!-- ANO DO TRABALHO -->
								<span class="lt-academic-label-minor">
									<?php echo $production[LABEL_ANO_DO_TRABALHO]; ?>
									<?php echo ', '; ?>
								</span>
								<!-- CIDADE DO EVENTO -->
								<span class="lt-academic-label-minor">
									<?php echo $production[LABEL_CIDADE_DO_EVENTO]; ?>
									<?php echo '. '; ?>
								</span>
								<!-- NOME DO EVENTO -->
								<span class="lt-academic-label-minor">
									<?php echo $production[LABEL_NOME_DO_EVENTO]; ?>
									<?php echo '.'; ?>
								</span>
							</div>
							<!-- AUTORES -->
							<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<span class="lt-academic-label-minor lt-academic-label-highlight">
									<?php echo lang('lt_label_authors'); ?> : 
								</span>
								<?php foreach ($production['autores'] as $autor) { ?>
									<span class="lt-academic-label-minor">
										<?php echo $autor[LABEL_NOME_PARA_CITACAO]; ?>
										<?php echo '; '; ?>
									</span>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<input type="hidden" name="chart-<?php echo $year ?>-prod-events" value="<?php echo count($curriculum['in_event_productions'][$year]); ?>"/>
				<?php } ?>
				<?php if ( array_key_exists($year, $curriculum['technical_productions']) ) { ?>
					<?php foreach ($curriculum['technical_productions'][$year] as $production) { ?>
						<div class="lt-container-technical-production row">
							<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<!-- TITULO DO TRABALHO -->
								<span class="lt-academic-label-minor lt-academic-label-highlight">
									<?php echo $production[LABEL_TITULO_DO_TRABALHO_TECNICO]; ?>
									<?php echo '. '; ?>
								</span>
								<!-- ANO DO TRABALHO -->
								<span class="lt-academic-label-minor">
									<?php echo $production[LABEL_ANO]; ?>
									<?php echo '.'; ?>
								</span>
							</div>
							<!-- AUTORES -->
							<div class="lt-academic-label col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<span class="lt-academic-label-minor lt-academic-label-highlight">
									<?php echo lang('lt_label_authors'); ?> : 
								</span>
								<?php foreach ($production['autores'] as $autor) { ?>
									<span class="lt-academic-label-minor">
										<?php echo $autor[LABEL_NOME_PARA_CITACAO]; ?>
										<?php echo '; '; ?>
									</span>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<input type="hidden" name="chart-<?php echo $year ?>-prod-technical" value="<?php echo count($curriculum['technical_productions'][$year]); ?>"/>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>