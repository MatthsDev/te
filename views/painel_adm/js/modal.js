
		function limparParametrosURL() {
			window.location.href = window.location.href.split('?')[0];
		}

		document.addEventListener('DOMContentLoaded', function () {
			var modal = document.getElementById('myModal');
			var openModalBtn = document.getElementById('openModalBtn');
			var closeModalBtn = document.getElementById('closeModalBtn');

			// Abrir modal
			openModalBtn.addEventListener('click', function () {
				modal.style.display = 'block';
			});

			// Fechar modal ao clicar no botão "Fechar"
			closeModalBtn.addEventListener('click', function () {
				modal.style.display = 'none';
				window.location.href = window.location.href.split('?')[0];
			});
		});
	