function FineUploader(options) {
	'use strict';
	this.options = options;
}

FineUploader.prototype = {
	constructor: FineUploader,
	init: function () {
		'use strict';
		var _this = this;
		var divWrapper = document.querySelector('.js-Form-AddTemplate');
		var url = document.querySelector('.js-Choose .js-Uploader').getAttribute('data-upload');
		var urlReturn = document.querySelector('.js-Choose .js-Uploader').getAttribute('data-upload-treatment');
		
		var uploader = new qq.FineUploader({
			element: document.getElementById('uploader'),
			debug: false,
			customHeaders: {
				'Content-Type': 'text/plain'
			},
			sizeLimit: 1024 * 1024 * 2.5,
			messages: {
				'typeError': 'O tipo de arquivo é inválido. Por favor, insira apenas  arquivos do tipo ".txt", ".rtf", ".xlsx" ou "xls"'
			},
			request: {
				endpoint: url
			},
			classes: {
				success: 'alert alert-success',
				fail: 'alert alert-error'
			},
			validation: {
				allowedExtensions: ['txt', 'rtf', 'xls', 'xlsx']
			},
			callbacks: {
				onComplete: function (id, filename, responseJSON, xhr) {
					xhr = new XMLHttpRequest();
					xhr.open('post', urlReturn);
					xhr.onloadstart = function () {
						_this.options.onLoading();
					};
					xhr.onloadend = function () {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							document.querySelector('.js-Form').querySelector('.js-Loading').classList.add('Hide');
							divWrapper.innerHTML = this.responseText;
							_this.options.responseSearchDomains();
							_this.options.onLoaded();
							_this.options.addListenerToDelete();
							document.querySelector('.js-Send-Form').style.marginBottom = '20px';
							var fileItem = document.querySelector('.qq-upload-list');
							fileItem.innerHTML = '';
						}
					};
					xhr.send(JSON.stringify(responseJSON));
				}
			}
		});
	}
};