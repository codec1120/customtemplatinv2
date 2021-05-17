	<div class="main-modal fixed w-full h-screen inset-0 z-50 overflow-hidden items-center animated fadeIn faster"
		style="background: rgba(0,0,0,.7);">
		
		<div
			class="border border-teal-500 shadow-lg modal-container bg-white w-full h-screen mx-auto rounded shadow-lg z-50 overflow-y-auto">
			<x-loading-screen> Wait a moment while we load all the assets.</x-loading-screen>
			<div class="modal-content py-4 text-left px-6">
				<!--Title-->
				<div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">{{$title?? ''}}</p>
					<div class="modal-close cursor-pointer z-50">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
							viewBox="0 0 18 18">
							<path
								d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
							</path>
						</svg>
					</div>
				</div>
				<!--Body-->
				<div class="my-5">
					{{$slot}}
				</div>
			</div>
		</div>
	</div>

	<script>
		const modal = document.querySelector('.main-modal');
		const closeButton = document.querySelectorAll('.modal-close');
		let selecetedTemplateSRC = null;

		const modalClose = () => 
		{
			modal.classList.remove('fadeIn');
			modal.classList.add('fadeOut');
			setTimeout(() => {
				modal.style.display = 'none';
				window.location.href = window.location.href; 
			}, 500);
		}

		const openModal = (file) => 
		{
			// Enable Loading Screen
			document.getElementById('loading-screen').classList.remove('hidden');

			const filename = file.split('.')[0];

			// Partially display image
			const imgSource = `${window.location.href}images/${filename}/${filename}-colored-1.jpg`;

			document.querySelectorAll('#sliders div').forEach( (item, index) => {
				if (index > 0) 
					$(`#${item.id}`).hide();
			});

			getBase64Image( imgSource , 'jpg', function (base64Url) {
				document.querySelectorAll(`#slider1 img`)[0].src = base64Url;

				modal.classList.remove('fadeOut');
				modal.classList.add('fadeIn');
				modal.style.display = 'flex';

				$('#color-button-blue').removeClass('bg-opacity-50');
				$('#color-button-blue').addClass('bg-opacity-100');
				$('.color-button-blue-div').css('background-color', 'rgba(243, 244, 246, var(--tw-bg-opacity))');
			});
			

			// Display all available sliders
			document.querySelectorAll('#sliders div').forEach( (item, index) => {
				// will jump up on the next index
				if (index > 0) {
					const imgSource = `${window.location.href}images/${filename}/${filename}-colored-${index+1}.jpg`;

					getBase64Image( imgSource , 'jpg', function (base64Url) {
						// Set base url
						item.children[1].src = base64Url;

						selecetedTemplateSRC = document.querySelectorAll(`#slider1 img`)[0].src;
						
						if ( (index+1) === document.querySelectorAll('#sliders div').length) {
							// Disable Loading Screen
							document.getElementById('loading-screen').classList.add('hidden');
						}
					});
				}
			});

			
		}

		const enableSlider  = (sliderDivId, buttonId) => 
		{
			$('#color-button-blue').removeClass('bg-opacity-100');
			$('#color-button-blue').addClass('bg-opacity-50');
			$('.color-button-blue-div').css('background-color', '');
			// Disable all sliders
			document.querySelectorAll('#sliders div').forEach( item => $(`#${item.id}`).hide());

			// Display selected slider
			$(`#${sliderDivId}`).show();
			selecetedTemplateSRC = document.querySelectorAll(`#${sliderDivId} img`)[0].src;
		}

		const imgChecker = setInterval(() => {
			if (document.getElementById('selectedTemplateImg')) {
				const imgExtension = selecetedTemplateSRC.split(/[#?]/)[0].split('.').pop().trim(); 
				getBase64Image( selecetedTemplateSRC, imgExtension, function (base64Url) {
					document.getElementById('selectedTemplateImg').src = base64Url;
				});
				clearInterval( imgChecker );
			}
		}, 50);
		

		const displaySecondCard = () => 
		{
			$('#main-card').hide();
			(`#second-card`).delay(200).fadeIn(200);
		}

		const displayMainCard = () => 
		{
			$('#second-card').hide();
			$('#main-card').show();
		}

		for (let i = 0; i < closeButton.length; i++) {

			const elements = closeButton[i];

			elements.onclick = (e) => modalClose();

			modal.style.display = 'none';

			window.onclick = function (event) {
				if (event.target == modal) modalClose();
			}
		}

		function getBase64Image(url, imgExtension = 'jpg', callback) 
		{
			var canvas = document.createElement('CANVAS');
				var ctx = canvas.getContext('2d');
				var img = new Image;
				img.crossOrigin = 'Anonymous';
				img.onload = function(){
					canvas.height = img.height;
					canvas.width = img.width;
					ctx.drawImage(img,0,0);
					var dataURL = canvas.toDataURL( `image/${imgExtension}` );
					callback.call(this, dataURL);
					// Clean up
					canvas = null; 
				};

				img.src = url;
		}
	</script>