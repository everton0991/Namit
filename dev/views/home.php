<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Domínios BR</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/assets/css/views/global.css?<?php echo strtotime('now') ?>">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/assets/css/views/home.css?<?php echo strtotime('now') ?>">
</head>
<body>
<header class="Header js-Header">
	<div class="Container">
		<h1>
			Está procurando nomes para a sua marca e não quer perder tempo?
			Verifique a disponibilidade de vários domínios simultaneamente.
		</h1>
		<span class="LoaderInit js-LoaderInit">
			<div class="spinner">
			  <div class="rect1"></div>
			  <div class="rect2"></div>
			  <div class="rect3"></div>
			  <div class="rect4"></div>
			  <div class="rect5"></div>
			</div>
		</span>
	</div>
</header>

<!--<div class="Ads hidden">-->
<!--	<div class="Container">-->
<!--		<img src="/dist/assets/images/original_166506_2hcj99lj4qajzh4vduk6ppwom.jpg" alt="">-->
<!--	</div>-->
<!--</div>-->

<main class="Main">
	<div class="Container">
		<div class="Choose js-Choose">
			<div class="Choose-Actions">
				<div id="uploader" class="js-Uploader" data-upload="<?php echo BASE_URL; ?>home/upload"
				     data-delete="<?php echo BASE_URL; ?>home/index"
				     data-upload-treatment="<?php echo BASE_URL; ?>home/treatment"></div>
				<a href="#" class="Choose-ButtonInfo Tooltip">
					<i class="material-icons">help</i>
					<span class="Tooltip-Text Right">Faça o upload de sua lista de domínios separados por vírgulas (máximo 20 domínios).</span>
				</a>
			</div>
			<p>OU</p>
		</div>
		<div class="Form js-Form" data-url="<?php echo BASE_URL; ?>home/search">
			<div class="Loading js-Loading hidden">
				<div class="spinner">
					<div class="rect1"></div>
					<div class="rect2"></div>
					<div class="rect3"></div>
					<div class="rect4"></div>
					<div class="rect5"></div>
				</div>
			</div>
			<div class="js-Form-OriginTemplate hidden">
				
				<div class="Form-InputText js-InputText">
					<div class="Form-InputText-FormatDomain">.com.br</div>
					<input type="text" name="field" placeholder="Digite um domínio" spellcheck="false" tabIndex="2">
					<div class="Form-ValidateField js-Form-ValidateField hidden">
						<p>
							O domínio pode ter até <strong>23 caracteres</strong>
							e não pode conter <strong>espaços</strong> ou <strong>carateres especiais</strong>
						</p>
					</div>
					<a href="#" class="Button-RemoveItem hidden js-Remove-Item">
						<i class="material-icons">delete_forever</i>
					</a>
				</div>
			
			</div>
			<form action="<?php echo BASE_URL; ?>home/search" method="post">
				<div class="js-Form-AddTemplate">
					
					<div class="Form-InputText js-InputText">
						<div class="Form-InputText-FormatDomain">.com.br</div>
						<input type="text" name="field" placeholder="Digite um domínio" spellcheck="false" tabIndex="1">
						<div class="Form-ValidateField js-Form-ValidateField hidden">
							<p>
								O domínio pode ter até <strong>23 caracteres</strong>
								e não pode conter <strong>espaços</strong> ou <strong>carateres especiais</strong>
							</p>
						</div>
						<a href="#" class="Button-RemoveItem hidden js-Remove-Item">
							<i class="material-icons">delete_forever</i>
						</a>
					</div>
				
				</div>
				<a href="#" class="Button GhostButton AddNewField js-AddNewField">
					<i class="material-icons">plus_one</i>
				</a>
			</form>
			
			<div class="Form-Actions js-Form-Actions">
				<a href="#" class="Button GhostButton GhostButton-Inverted js-Send-Form">
					PESQUISAR
				</a>
				<br>
				<a href="#" class="Button GhostButton hidden js-GhostButton ButtonDownload">
					<i class="material-icons">file_download</i> DOWNLOAD PESQUISA
				</a>
				<a href="#" class="Button GhostButton hidden js-GhostButton js-NewResearch ButtonResearch">
					<i class="material-icons">autorenew</i> NOVA PESQUISA
				</a>
				<br/>
				<a href="#" class="Button ButtonDoubt">
					<i class="material-icons">announcement</i> Dúvidas ou Sugestões
				</a>
			</div>
		
		</div>
	</div>
</main>
<footer class="Footer">
	<div class="Container">
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
			in tempus turpis, quis lacinia nulla. Integer auctor.
		</p>
		<h2>
			<a href="#">
				<img src="<?php echo BASE_URL; ?>dist/assets/images/logo/logo-aliens.svg" alt="Aliens Design Comunicação"
				     title="Aliens Design Comunicação">
			</a>
		</h2>
	</div>
</footer>
<script src="<?php echo BASE_URL; ?>dist/assets/js/vendors/vendors.min.js?<?php echo strtotime('now') ?>"></script>
<script
		src="<?php echo BASE_URL; ?>dist/assets/js/controllers/controllers.min.js?<?php echo strtotime('now') ?>"></script>
<script src="<?php echo BASE_URL; ?>dist/assets/js/views/home.js?<?php echo strtotime('now') ?>"></script>
<script type="text/template" id="qq-template">
	<div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
		<div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
			<div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
			     class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
		</div>
		<div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
			<span class="qq-upload-drop-area-text-selector"></span>
		</div>
		<div class="qq-upload-button-selector qq-upload-button">
			<div>
				<i class="material-icons">file_upload</i>
				ENVIE SUA LISTA DE NOMES
			</div>
		</div>
		<span class="qq-drop-processing-selector qq-drop-processing">
      <span>Processing dropped files...</span>
      <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
    </span>
		<ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite"
		    aria-relevant="additions removals">
			<li>
				<span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
				<div class="qq-progress-bar-container-selector qq-progress-bar-container">
					<div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
					     class="qq-progress-bar-selector qq-progress-bar"></div>
				</div>
				<span class="qq-upload-spinner-selector qq-upload-spinner"></span>
				<div class="qq-thumbnail-wrapper">
					<img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
				</div>
				<button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
				<button type="button" class="qq-upload-retry-selector qq-upload-retry">
					<span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
					Retry
				</button>
				
				<div class="qq-file-info">
					<div class="qq-file-name">
						<span class="qq-upload-file-selector qq-upload-file"></span>
						<span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>
					</div>
					<input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
					<span class="qq-upload-size-selector qq-upload-size"></span>
					<button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
						<span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
					</button>
					<button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
						<span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
					</button>
					<button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
						<span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
					</button>
				</div>
			</li>
		</ul>
		
		<dialog class="qq-alert-dialog-selector">
			<div class="qq-dialog-message-selector"></div>
			<div class="qq-dialog-buttons">
				<button type="button" class="qq-cancel-button-selector">Ok</button>
			</div>
		</dialog>
		
		<dialog class="qq-confirm-dialog-selector">
			<div class="qq-dialog-message-selector"></div>
			<div class="qq-dialog-buttons">
				<button type="button" class="qq-cancel-button-selector">No</button>
				<button type="button" class="qq-ok-button-selector">Yes</button>
			</div>
		</dialog>
		
		<dialog class="qq-prompt-dialog-selector">
			<div class="qq-dialog-message-selector"></div>
			<input type="text">
			<div class="qq-dialog-buttons">
				<button type="button" class="qq-cancel-button-selector">Cancel</button>
				<button type="button" class="qq-ok-button-selector">Ok</button>
			</div>
		</dialog>
	</div>
</script>

</body>
</html>
