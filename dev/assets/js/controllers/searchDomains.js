function SearchDomains() {
	'use strict';
	var _this = this;
	this.formContainer = document.querySelector('.js-Form');
	this.formOriginTemplate = this.formContainer.querySelector('.js-Form-OriginTemplate');
	this.formSend = this.formContainer.querySelector('.js-Send-Form');
	this.formAddTemplate = this.formContainer.querySelector('.js-Form-AddTemplate');
	this.formActionButtons = this.formContainer.querySelectorAll('.js-GhostButton');
	
	this.listenerAddNewField = function (event) {
		if (event.keyCode == 9) {
			_this._addNewField();
		}
	};
	
	this.listenerRemoveItem = function (event) {
		event.preventDefault();
		_this._removeField(this);
	}
	
}

SearchDomains.prototype = {
	constructor: SearchDomains,
	init: function () {
		'use strict';
		var _this = this;
		
		this.formContainer.querySelector('form').setAttribute('onsubmit', 'return false');
		window.addEventListener('keydown', this.listenerAddNewField);
		
		this.formSend.addEventListener('click', function (e) {
			e.preventDefault();
			_this._onSendAjax(this);
			_this._scrollTop(800);
		});
		
		document.querySelector('.Tooltip').addEventListener('click', function (e) {
			e.preventDefault();
		});
		
		var buttonAddNewField = this.formContainer.querySelector('.js-AddNewField');
		buttonAddNewField.addEventListener('click', function (e) {
			e.preventDefault();
			_this._addNewField();
		});
		
		this._ListenerRemoveField();
		this._initUploader();
		
	},
	
	_scrollTop: function (scrollDuration) {
		'use strict';
		var cosParameter = window.scrollY / 2,
				scrollCount = 0,
				oldTimestamp = performance.now();
		
		function step(newTimestamp) {
			scrollCount += Math.PI / (scrollDuration / (newTimestamp - oldTimestamp));
			if (scrollCount >= Math.PI) window.scrollTo(0, 0);
			if (window.scrollY === 0) return;
			window.scrollTo(0, Math.round(cosParameter + cosParameter * Math.cos(scrollCount)));
			oldTimestamp = newTimestamp;
			window.requestAnimationFrame(step);
		}
		
		window.requestAnimationFrame(step);
	},
	
	_addNewField: function () {
		'use strict';
		var addNew = this.formOriginTemplate.querySelector('.js-InputText').cloneNode(true);
		this.formAddTemplate.appendChild(addNew);
		addNew.setAttribute('tabIndex', '0');
		
		var items = this.formAddTemplate.querySelectorAll('.js-Remove-Item');
		for (var i = 0; i < items.length; i++) {
			items[i].classList.remove('hidden');
		}
		
		this._ListenerRemoveField();
	},
	
	_ListenerRemoveField: function () {
		var buttonDelete = this.formAddTemplate.querySelectorAll('.js-InputText .js-Remove-Item');
		for (var i = 0; i < buttonDelete.length; i++) {
			buttonDelete[i].addEventListener('click', this.listenerRemoveItem);
		}
	},
	
	_removeField: function (elem) {
		elem.parentElement.remove();
		elem = this.formAddTemplate.querySelectorAll('.js-Remove-Item');
		for (var i = 0; i < elem.length; i++) {
			if (elem.length == 1) {
				elem[i].classList.add('hidden');
			}
		}
	},
	
	_initUploader: function () {
		'use strict';
		var _this = this;
		var upload = new FineUploader({
			responseSearchDomains: function () {
				_this._renewItems();
			},
			onLoading: function () {
				_this._showLoader();
			},
			onLoaded: function () {
				_this._hideLoader();
			},
			addListenerToDelete: function () {
				_this._ListenerRemoveField();
			}
		});
		upload.init();
		var titleInput = document.querySelector('.qq-upload-button input');
		titleInput.setAttribute('title', 'Envie sua lista de nomes');
	},
	
	_removeItemOnSendAjax: function () {
		'use strict';
		var items = this.formAddTemplate.querySelectorAll('.js-InputText');
		for (var i = 0; i < items.length; i++) {
			items[i].remove();
		}
	},
	
	_onSendAjax: function (el) {
		'use strict';
		var _this = this;
		var i, n, obj, url;
		var fieldsList = [];
		this.loader = this.formContainer.querySelector('.js-Loading');
		
		el = this.formAddTemplate.querySelectorAll('.js-InputText input');
		url = this.formContainer.getAttribute('data-url');
		obj = new RegExp(/[^a-z0-9]/gi, '');
		
		for (i = 0; i < el.length; i++) {
			n = obj.test(el[i].value.toLowerCase());
			if ((n == true) || (el[i].value.length > 23) || (el[i].value.length == '')) {
				_this._onError(el[i]);
				return false;
			} else {
				_this._onSuccess(el[i]);
				fieldsList.push(el[i].value);
			}
		}
		
		var xhr = new XMLHttpRequest();
		var fields = {
			field: fieldsList
		};
		
		xhr.open('post', url);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.onloadstart = function () {
			_this._showLoader();
		};
		xhr.onloadend = function () {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				_this._hideLoader();
				_this._renewItems();
				_this.formSend.style.marginBottom = '20px';
				_this.formAddTemplate.innerHTML = this.responseText;
				
				var items = _this.formAddTemplate.querySelectorAll('.js-Remove-Item');
				if (items.length == 1) {
					items[0].classList.add('hidden');
				} else {
					for (var i = 0; i < items.length; i++) {
						items[i].classList.remove('hidden');
					}
					_this._ListenerRemoveField();
				}
			}
		};
		xhr.send(JSON.stringify(fields));
	},
	
	_onError: function (el) {
		'use strict';
		el.parentElement.querySelector('.js-Form-ValidateField').classList.add('js-Form-Error');
		el.parentElement.querySelector('.js-Form-ValidateField').classList.add('OnError');
		el.parentElement.querySelector('.js-Form-Error').classList.remove('hidden');
	},
	
	_onSuccess: function (el) {
		'use strict';
		var item = el.parentElement.querySelector('.js-Form-ValidateField');
		if (item.classList.contains('js-Form-Error')) {
			el.parentElement.querySelector('.js-Form-ValidateField').classList.remove('js-Form-Error');
			el.parentElement.querySelector('.js-Form-ValidateField').classList.remove('OnError');
			el.parentElement.querySelector('.js-Form-ValidateField').classList.add('hidden');
		}
	},
	
	_newResearch: function () {
		'use strict';
		var _this = this;
		var buttonResearch = this.formContainer.querySelector('.js-NewResearch');
		buttonResearch.addEventListener('click', function (e) {
			e.preventDefault();
			window.addEventListener('keydown', _this.listenerAddNewField);
			_this._enableItem();
			_this._hideButtons();
			_this.formSend.classList.remove('hidden');
			_this.formSend.style.marginBottom = '0px';
			_this.formAddTemplate.querySelector('.js-Result').classList.add('hidden');
			_this.formAddTemplate.querySelector('.js-Remove-Item').classList.add('hidden');
			_this.formContainer.querySelector('.js-Loading').classList.remove('Hide-Loader');
			
			var success = _this.formAddTemplate.querySelector('.js-Form-ValidateField');
			if (success.classList.contains('Available')) {
				_this._available();
			} else {
				_this._unavailable();
			}
		});
	},
	
	_renewItems: function () {
		'use strict';
		this._newResearch();
		this._showElems();
	},
	
	_hideElems: function () {
		'use strict';
		this.formContainer.querySelector('.js-Form-AddTemplate').classList.add('Hide');
		this.formContainer.querySelector('.js-Form-Actions').classList.add('hidden');
		document.querySelector('.js-Choose p').classList.add('hidden');
	},
	
	_hideButtons: function () {
		for (var i = 0; i < this.formActionButtons.length; i++) {
			this.formActionButtons[i].classList.add('hidden');
		}
	},
	
	_showElems: function () {
		'use strict';
		for (var i = 0; i < this.formActionButtons.length; i++) {
			this.formActionButtons[i].classList.remove('hidden');
		}
		this.formContainer.querySelector('.js-Form-Actions').classList.remove('hidden');
		document.querySelector('.js-Choose p').classList.remove('hidden');
	},
	
	_hideLoader: function () {
		'use strict';
		var _this = this;
		setTimeout(function () {
			_this.formAddTemplate.classList.remove('Blur');
			_this.formContainer.querySelector('.js-Loading').classList.remove('Show-Loader');
			_this.formContainer.querySelector('.js-Loading').classList.add('hidden');
		}, 200);
	},
	
	_showLoader: function () {
		'use strict';
		this.formAddTemplate.classList.add('Blur');
		this.formContainer.querySelector('.js-Loading').classList.remove('hidden');
		this.formContainer.querySelector('.js-Loading').classList.add('Show-Loader');
	},
	
	_available: function () {
		'use strict';
		this.formAddTemplate.querySelector('.js-Form-ValidateField').classList.remove('Available');
		this.formAddTemplate.querySelector('.js-Form-ValidateField').classList.add('hidden');
		this.formAddTemplate.querySelector('.js-Form-ValidateField').querySelector('p').classList.remove('hidden');
	},
	
	_unavailable: function () {
		'use strict';
		this.formAddTemplate.querySelector('.js-Form-ValidateField').classList.remove('Form-Error');
		this.formAddTemplate.querySelector('.js-Form-ValidateField').classList.add('hidden');
		this.formAddTemplate.querySelector('.js-Form-ValidateField').querySelector('p').classList.remove('hidden');
	},
	
	_enableItem: function () {
		'use strict';
		var i;
		var field = this.formAddTemplate.querySelectorAll('.js-InputText');
		for (i = 0; i < field.length - 1; i++) {
			field[i].remove();
		}
		for (i = 0; i < field.length; i++) {
			field[i].querySelector('input').value = '';
		}
	}
};