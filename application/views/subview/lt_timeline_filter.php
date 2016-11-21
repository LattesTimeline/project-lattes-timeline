<div class="lt-container-filters row">
	<div class="lt-container-minimizer row">
		<img id="lt-image-minus" class="pull-right" 
		 alt="<?php echo lang('lt_alt_image_minimizer_minus'); ?>" 
		 title="<?php echo lang('lt_title_image_minimizer_minus'); ?>" 
		 src="<?php echo base_url(); ?>images/icon-minus.png"/>
		<img id="lt-image-plus" class="pull-right lt-hidden" 
		 alt="<?php echo lang('lt_alt_image_minimizer_plus'); ?>" 
		 title="<?php echo lang('lt_title_image_minimizer_plus'); ?>" 
		 src="<?php echo base_url(); ?>images/icon-plus.png"/>
	</div>
	<div id="lt-container-filters" class="row">
		<!-- ********************************** PRIMEIRA *********************************** -->
		<div class="lt-filter-column lt-filter-main col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<!-- PROJETOS DE PESQUISA -->
			<div class="lt-filter row">
				<input id="lt-filter-projects" type="checkbox" 
				 name="lt-container-year-content-projects" 
				 value="lt-container-year-content-projects" checked/>
				<label for="lt-filter-projects">
					<?php echo lang('lt_label_research_projects'); ?>
				</label>
			</div>
			<!-- PRODUCOES -->
			<div class="lt-filter row">
				<input id="lt-filter-productions" type="checkbox" 
				 name="lt-container-year-content-productions" 
				 value="lt-container-year-content-productions" checked/>
				<label for="lt-filter-productions">
					<?php echo lang('lt_label_productions'); ?>
				</label>
			</div>
			<!-- BANCAS -->
			<div class="lt-filter row">
				<input id="lt-filter-boards" type="checkbox" 
				 name="lt-container-year-content-boards" 
				 value="lt-container-year-content-boards" checked/>
				<label for="lt-filter-boards">
					<?php echo lang('lt_label_boards'); ?>
				</label>
			</div>
			<!-- ORIENTACOES -->
			<div class="lt-filter row">
				<input id="lt-filter-orientations" type="checkbox" 
				 name="lt-container-year-content-orientations" 
				 value="lt-container-year-content-orientations" checked/>
				<label for="lt-filter-orientations">
					<?php echo lang('lt_label_orientations'); ?>
				</label>
			</div>
		</div>
		<!-- ********************************** SEGUNDA *********************************** -->
		<div class="lt-filter-column col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<!-- BANCAS DE MESTRADO -->
			<div class="lt-filter row">
				<input id="lt-filter-master-boards" type="checkbox" 
				 name="lt-container-year-content-master-boards" 
				 value="lt-container-year-content-master-boards" checked/>
				<label for="lt-filter-master-boards">
					<?php echo lang('lt_label_master_boards'); ?>
				</label>
			</div>
			<!-- BANCA DE QUALIFICACAO -->
			<div class="lt-filter row">
				<input id="lt-filter-qualis-boards" type="checkbox" 
				 name="lt-container-year-content-qualis-boards" 
				 value="lt-container-year-content-qualis-boards" checked/>
				<label for="lt-filter-qualis-boards">
					<?php echo lang('lt_label_qualis_boards'); ?>
				</label>
			</div>
			<!-- BANCAS DE ESPECIALIZACAO -->
			<div class="lt-filter row">
				<input id="lt-filter-expertise-boards" type="checkbox" 
				 name="lt-container-year-content-expertise-boards" 
				 value="lt-container-year-content-expertise-boards" checked/>
				<label for="lt-filter-expertise-boards">
					<?php echo lang('lt_label_expertise_boards'); ?>
				</label>
			</div>
			<!-- BANCAS DE GRADUACAO -->
			<div class="lt-filter row">
				<input id="lt-filter-graduation-boards" type="checkbox" 
				 name="lt-container-year-content-graduation-boards" 
				 value="lt-container-year-content-graduation-boards" checked/>
				<label for="lt-filter-graduation-boards">
					<?php echo lang('lt_label_graduation_boards'); ?>
				</label>
			</div>
		</div>
		<!-- ********************************** TERCEIRA *********************************** -->
		<div class="lt-filter-column col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<!-- ORIENTACOES CONCLUIDAS DE MESTRADO -->
			<div class="lt-filter row">
				<input id="lt-filter-done-master-orientations" type="checkbox" 
				 name="lt-container-year-content-done-master-orientations" 
				 value="lt-container-year-content-done-master-orientations" checked/>
				<label for="lt-filter-done-master-orientations">
					<?php echo lang('lt_label_done_master_orientations'); ?>
				</label>
			</div>
			<!-- OUTRAS ORIENTACOES CONCLUIDAS -->
			<div class="lt-filter row">
				<input id="lt-filter-done-other-orientations" type="checkbox" 
				 name="lt-container-year-content-done-other-orientations" 
				 value="lt-container-year-content-done-other-orientations" checked/>
				<label for="lt-filter-done-other-orientations">
					<?php echo lang('lt_label_done_other_orientations'); ?>
				</label>
			</div>
			<!-- ORIENTACOES DE INICIACAO EM ANDAMENTO -->
			<div class="lt-filter row">
				<input id="lt-filter-goign-scientific-orientations" type="checkbox" 
				 name="lt-container-year-content-going-scientific-orientations" 
				 value="lt-container-year-content-going-scientific-orientations" checked/>
				<label for="lt-filter-goign-scientific-orientations">
					<?php echo lang('lt_label_going_scientific_orientations'); ?>
				</label>
			</div>
			<!-- ORIENTACOES DE MESTRADO EM ANDAMENTO -->
			<div class="lt-filter row">
				<input id="lt-filter-goign-master-orientations" type="checkbox" 
				 name="lt-container-year-content-going-master-orientations" 
				 value="lt-container-year-content-going-master-orientations" checked/>
				<label for="lt-filter-goign-master-orientations">
					<?php echo lang('lt_label_going_master_orientations'); ?>
				</label>
			</div>
		</div>
		<!-- ********************************** QUARTA *********************************** -->
		<div class="lt-filter-column col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<!-- PRODUCOES BIBLIOGRAFICAS DE LIVROS  -->
			<div class="lt-filter row">
				<input id="lt-filter-book-productions" type="checkbox" 
				 name="lt-container-year-content-productions-books" 
				 value="lt-container-year-content-productions-books" checked/>
				<label for="lt-filter-book-productions">
					<?php echo lang('lt_label_book_productions'); ?>
				</label>
			</div>
			<!-- PRODUCOES BIBLIOGRAFICAS DE CAPITULOS -->
			<div class="lt-filter row">
				<input id="lt-filter-book-chapter-productions" type="checkbox" 
				 name="lt-container-year-content-productions-book-chapters" 
				 value="lt-container-year-content-productions-book-chapters" checked/>
				<label for="lt-filter-book-chapter-productions">
					<?php echo lang('lt_label_book_chapter_productions'); ?>
				</label>
			</div>
			<!-- OUTRAS PRODUCOES BIBLIOGRAFICAS -->
			<div class="lt-filter row">
				<input id="lt-filter-other-productions" type="checkbox" 
				 name="lt-container-year-content-other-productions" 
				 value="lt-container-year-content-other-productions" checked/>
				<label for="lt-filter-other-productions">
					<?php echo lang('lt_label_other_productions'); ?>
				</label>
			</div>
			<!-- PRODUCOES BIBLIOGRAFICAS DE TRABALHOS EM EVENTOS E TRABALHOS TECNICOS -->
			<div class="lt-filter row">
				<input id="lt-filter-events-and-technical-productions" type="checkbox" 
				 name="lt-container-year-content-productions-in-events" 
				 value="lt-container-year-content-productions-in-events" checked/>
				<label for="lt-filter-events-and-technical-productions">
					<?php echo lang('lt_label_events_and_technical_productions'); ?>
				</label>
			</div>
		</div>
	</div>
</div>