const $ = require('jquery');

$(document).ready(function() {
	document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem) {

		everyitem.addEventListener('mouseover', function(e) {

			let elLink = this.querySelector('a[data-bs-toggle]');

			if(elLink != null) {
				let nextEl = elLink.nextElementSibling;
				elLink.classList.add('show');
				nextEl.classList.add('show');
			}

		});
		everyitem.addEventListener('mouseleave', function(e){
			let elLink = this.querySelector('a[data-bs-toggle]');

			if(elLink != null) {
				let nextEl = elLink.nextElementSibling;
				elLink.classList.remove('show');
				nextEl.classList.remove('show');
			}
		})
	});
});