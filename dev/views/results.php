<?php if (!empty($searchResult)):
	foreach ($searchResult as $dominio):
		$availability = ($dominio->available) ? true : false;
		?>
		<div class="Form-InputText js-InputText">
			<div class="Form-InputText-FormatDomain">.com.br</div>
			<input  type="text"
                    name="field"
                    value="<?php echo str_replace('.com.br', '', $dominio->fqdn); ?>"
                    spellcheck="false">
			<?php if ($availability): ?>

                <div class="Form-InputText-Result Available js-Result">
					<p>
						<a href="<?php echo $this->finder->registerNameLink($dominio->fqdn); ?>" target="_blank">
							Disponível
						</a>
					</p>
				</div>

                <div class="Form-ValidateField js-Form-ValidateField hidden">
					<p>
						O domínio pode ter até <strong>23 caracteres</strong>
						e não pode conter <strong>espaços</strong> ou <strong>carateres especiais</strong>
					</p>
				</div>
			
			<?php else: ?>
				
				<div class="Form-InputText-Result Unavailable js-Result">
					<p>
						Indisponível.
					</p>
				</div>
				
				<div class="Form-ValidateField js-Form-ValidateField hidden">
					<p>
						O domínio pode ter até <strong>23 caracteres</strong>
						e não pode conter <strong>espaços</strong> ou <strong>carateres especiais</strong>
					</p>
				</div>
			
			<?php endif; ?>
			<a href="#" class="Button-RemoveItem js-Remove-Item">
				<i class="material-icons">delete_forever</i>
			</a>
		</div>
		<?php
	endforeach;
endif;
?>


