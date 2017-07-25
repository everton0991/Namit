'use strict';
document.addEventListener('DOMContentLoaded', MainReady);
document.onreadystatechange = function () {
	if (document.readyState != "complete") {
		document.querySelector('.js-Header').style.height = '237px';
		setTimeout(function(){
			document.querySelector('html').classList.add('OverflowY');
		}, 1000);
	} else {
		document.querySelector('.js-LoaderInit').querySelector('.spinner').classList.add('spinnerChangeHeight');
		
	}
};

function MainReady() {
	var main = new Home();
	main.init();
}

function Home() {
	
}

Home.prototype = {
	constructor: Home,
	init: function () {
		'use strict';
		
		this._initSearchDomains();
		
		
	},
	
	_initSearchDomains: function () {
		'use strict';
		var searchDomains = new SearchDomains();
		searchDomains.init();
	}
};