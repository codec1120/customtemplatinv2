<div>
@inject('Templates', 'App\Helpers\Templates')
@inject('Obituaries', 'App\Helpers\Obituaries')
<x-guest-layout>
   <x-header/>
      <x-container>
            <div>
                  <div>
                        <x-title>Select Template</x-template>
                        <h3 class="text-sm md:text-base flex justify-center mt-5">Welcome to Director's Advantage, Please select template that you love.</h3>
                  </div>
                  <div class="flex justify-center mt-24">
                        <div id="photos" class="grid grid-cols-3 md:grid-cols-3 gap-x-3 gap-y-12">
                              @foreach (
                                    $Templates->templates as $templatesItem
                              )
                                    <div>
                                          @if(($templatesItem['img-directory'] && $templatesItem['img-filename']) && file_exists($_SERVER['DOCUMENT_ROOT'].'/images/'.$templatesItem['img-directory'].'/'.$templatesItem['img-filename']))
                                          <x-image :src="url('/images/'.$templatesItem['img-directory'].'/'.$templatesItem['img-filename'])" >
                                                {{$templatesItem['title']}}
                                          </x-image>
                                          <div class="flex justify-center">
                                                <x-button class="template-selection-btn" onclick="openModal('{{$templatesItem['img-filename']}}')">
                                                      <p class="text-sm font-thin">Select Template</p>
                                                </x-button>
                                          </div>
                                          @else
                                          <x-image>
                                          {{$templatesItem['title']}}
                                          </x-image>
                                          <div class="flex justify-center">
                                                <x-button class="template-selection-btn" onclick="openModal('{{$templatesItem['img-filename']}}')">
                                                      <p class="text-sm font-thin">Select Template</p>
                                                </x-button>
                                          </div>
                                          @endif
                                    </div>
                              @endforeach
                        </div>
                  </div>
            </div>
      </x-container>
</x-guest-layout>
<div>
<input type="hidden" id="selectedTemplateHolder"/>
@if ($displaySecondModal)
<x-hero-slider-modal>
      <div>
            <div class="w-full bg-white p-5">
                  <div class="flex justify-center w-full text-center p-4">
                        <div class="w-full text-center">
                              <h2 class="font-extrabold text-5xl tracking-wide">
                                    Additional Information
                              </h2>
                        </div>
                  </div>
            </div>
            <div class="w-full text-center mt-20">
                  <span class="font-semibold text-2xl">
                        Template Selected
                  </span>
            </div>
            <div id="sliders" class="container mx-auto pl-48 pr-48">
                  <div id="selectedTemplateImgDiv">
                        <x-image class="object-cover object-top h-96" id="selectedTemplateImg"/>
                  </div>
            </div>
            <div class="w-full text-center mt-24">
                  <h2 class="font-extrabold text-2xl tracking-wide">
                        Select an Obituary Layout
                  </h2>
            </div>
            <div id="photos" class="grid grid-cols-3 md:grid-cols-3 gap-x-3 gap-y-12 mt-10 pl-96 pr-96">
                  @foreach (
                        $Obituaries->obituaries as $obituaryItem
                  )
                        <div>
                              @if(($obituaryItem['img-directory'] && $obituaryItem['img-filename']) && file_exists($_SERVER['DOCUMENT_ROOT'].'/images/'.$obituaryItem['img-directory'].'/'.$obituaryItem['img-filename']))
                                    <label class="inline-flex items-center">
                                          <input type="radio" class="form-radio" name="selectedObituary"/>
                                          <span class="ml-2">{{$obituaryItem['title']}}</span>
                                    </label>
                                    <div class="rounded-lg border border-opacity-25 border-black">
                                          <x-image :src="url('/images/'.$obituaryItem['img-directory'].'/'.$obituaryItem['img-filename'])" />
                                    </div>
                              @else
                                    <x-image>
                                          {{$obituaryItem['title']}}
                                    </x-image>
                              @endif
                        </div>
                  @endforeach
            </div>
            <div class="w-full text-center mt-24">
                  <h2 class="font-extrabold text-2xl tracking-wide">
                        Select Hero Image(s) Options
                  </h2>
            </div>
            <div class="w-full text-center block">
                  <x-tabs class="w-2/3">
                        <div x-show="activeTab===0" class="h-full">
                              <x-uploader class="w-full"/>
                        </div>
                        <div x-show="activeTab===1" class="h-full">
                              <div class="w-full mt-5 pl-24 pr-24">
                                    <div class="m-4 md:w-full px-3 mb-6 md:mb-0">
                                          <p class="font-extrabold text-left text-base tracking-wide">
                                                Image Options
                                          </p>
                                    </div>
                                    <div class="md:w-full mt-5 px-3 mb-6 md:mb-0" id="urls">
                                          <div class="m-4 flex" id="form-url1">
                                                <input class="appearance-none inline-block w-full bg-grey-lighter text-grey-darker border border-opacity-25 border-red  rounded py-3 px-4 mb-3" 
                                                      id="url1" 
                                                      type="text" 
                                                      placeholder="Enter URL here.">
                                                <span class="h-12 cursor-pointer" onclick="removeURL('form-url1')">
                                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mt-3 ml-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                      </svg>
                                                </span>
                                          </div>
                                          <div class="m-4 flex" id="form-url2">
                                                <input class="appearance-none inline-block w-full bg-grey-lighter text-grey-darker border border-opacity-25 border-red  rounded py-3 px-4 mb-3" 
                                                      id="url2" 
                                                      type="text" 
                                                      placeholder="Enter URL here.">
                                                <span class="h-12 cursor-pointer" onclick="removeURL('form-url2')">
                                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mt-3 ml-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                      </svg>
                                                </span>
                                          </div>
                                          <div class="m-4 flex" id="form-url3">
                                                <input class="appearance-none inline-block w-full bg-grey-lighter text-grey-darker border border-opacity-25 border-red  rounded py-3 px-4 mb-3" 
                                                      id="url3" 
                                                      type="text" 
                                                      placeholder="Enter URL here.">
                                                <span class="h-12 cursor-pointer" onclick="removeURL('form-url3')">
                                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mt-3 ml-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                      </svg>
                                                </span>
                                          </div>
                                          <div class="m-4 flex" id="form-url4">
                                                <input class="appearance-none inline-block w-full bg-grey-lighter text-grey-darker border border-opacity-25 border-red  rounded py-3 px-4 mb-3" 
                                                      id="url4" 
                                                      type="text" 
                                                      placeholder="Enter URL here.">
                                                <span class="h-12 cursor-pointer" onclick="removeURL('form-url4')">
                                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mt-3 ml-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                      </svg>
                                                </span>
                                          </div>
                                    </div>
                                    <div class="m-4 flexw w-full flex justify-center" id="addUrl">
                                          <span class="cursor-pointer" onclick="addURL()">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                          </span>
                                    </div>
                              </div>
                        </div>
                  </x-tabs>
            </div>
            <div class="w-full text-center mt-24">
                  <h2 class="font-extrabold text-2xl tracking-wide">
                        Other Details
                  </h2>
            </div>
            <div id="photos" class="w-full grid grid-cols-1 md:grid-cols-1 mt-10 pl-96 pr-96">
                  
                  <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Business Name
                        </label>
                        <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-opacity-25 border-red  rounded py-3 px-4 mb-3" id="business-name" type="text" placeholder="Website Title">
                  </div>
                  <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Business Phone Number
                        </label>
                        <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-opacity-25 border-red rounded py-3 px-4 mb-3" id="business-phone-number" type="tel" placeholder="E.g (12) 345 678">
                  </div>
                  <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Business Email Address
                        </label>
                        <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red border-opacity-25 rounded py-3 px-4 mb-3" id="business-email" type="email" placeholder="E.g email@email.com">
                  </div>
                  <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Note
                        </label>
                        <textarea class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none border-opacity-25 block w-full border rounded focus:outline-none bg-white focus:border-gray-500"
                          id="note" type="text" placeholder=""></textarea>
                  </div>
                  <div class="w-full bg-white p-5">
                        
                        <div class="flex justify-end">
                              <x-button class="template-selection-btn" onclick="displaySecondCard()">
                                    <p class="text-sm font-thin">Submit</p>
                              </x-button>
                        </div>
                  </div>
            </div>
            
      </div>
</x-hero-slider-modal>
@else
<x-hero-slider-modal>
      <div class="flex justify-between overflow-hidden p-24">

            <div class="flext justify-start md:2/3 lg:w-3/6">
                  <div >
                        <h3 class="font-semibold text-4xl tracking-wide">
                        Choose Color Scheme
                        </h3>
                  <div class="pl-5 pr-5 mt-5">
                        <div class="color-button-blue-div bg-opacity-50 focus:bg-opacity-100 mb-2 p-4 w-2/3">
                              <button id="color-button-blue" onclick="enableSlider('slider1','color-button-blue')" class="focus:outline-none" >
                                          <span class="inline-block align-middle bg-blue-700 bg-opacity-50 focus:bg-opacity-100 rounded-full  h-7 w-7 "></span>      
                                          <span class="inline-block align-middle text-center font-thin bg-opacity-50 focus:bg-opacity-100 ml-5">BLUE AND GREY</span>
                              </button>
                        </div>
                        <div class="color-button-orange-div bg-opacity-50 focus:bg-opacity-100 mb-2 p-4 w-2/3">
                              <button id="color-button-orange" onclick="enableSlider('slider2','color-button-orange')" class="focus:outline-none" >
                                          <span class="inline-block align-middle bg-yellow-500 bg-opacity-50 focus:bg-opacity-100 rounded-full  h-7 w-7 "></span>      
                                          <span class="inline-block align-middle text-center font-thin bg-opacity-50 focus:bg-opacity-100 ml-5">ORANGE AND RED</span>
                              </button>
                        </div>
                        <div class="color-button-green-div bg-opacity-50 focus:bg-opacity-100 mb-2 p-4 w-2/3">
                              <button id="color-button-green" onclick="enableSlider('slider3','color-button-green')" class="focus:outline-none" >
                                          <span class="inline-block align-middle bg-green-500 bg-opacity-50 focus:bg-opacity-100 rounded-full  h-7 w-7 "></span>      
                                          <span class="inline-block align-middle text-center font-thin bg-opacity-50 focus:bg-opacity-100 ml-5">GREEN AND TEAL</span>
                              </button>
                        </div>
                        <div class="color-button-red-div bg-opacity-50 focus:bg-opacity-100 mb-2 p-4 w-2/3">
                              <button id="color-button-red" onclick="enableSlider('slider4','color-button-red') " class="focus:outline-none" >
                                          <span class="inline-block align-middle bg-yellow-900 bg-opacity-50 focus:bg-opacity-100 rounded-full  h-7 w-7 "></span>      
                                          <span class="inline-block align-middle text-center font-thin bg-opacity-50 focus:bg-opacity-100 ml-5">BROWN AND TAN</span>
                              </button>
                        </div>
                  </div>
                  <div class="ml-5 mt-5">
                        <x-button class="template-selection-btn" wire:click="$set('displaySecondModal', true)">
                              <p class="text-sm font-thin">Next Step</p>
                        </x-button>
                  </div>
                  </div>
            </div>

            <div class="justify-end ml-5">
                  <div id="sliders" class="pl-24 pr-24">
                        <div id="slider1">
                              <x-image/>
                        </div>
                        <div id="slider2">
                              <x-image/>
                        </div>
                        <div id="slider3">
                              <x-image/>
                        </div>
                        <div id="slider4">
                              <x-image/>
                        </div>
                  </div>
            </div>

      </div>
</x-hero-slider-modal>
@endif
</div>

</div>
<script>
const removeURL = (elemId) => {
      const URLInput = document.getElementById(elemId),
            parent = document.getElementById('urls').children.length;

      // Display button add.
      if (!$('#addUrl').is(':visible')) {
            document.getElementById('addUrl').classList.remove('hidden');
      }
            
      if (parent > 1) {
            URLInput.parentNode.removeChild(URLInput);
      }
}

const addURL = () => {
      const parentDivLength = document.getElementById('urls').children.length,
            parentElement = document.getElementById(`urls`),
            lastChildrenId = parentElement.children[parentDivLength - 1].id,
            newIndex = lastChildrenId.replace( /^\D+/g, '');

            $('#urls').append(`
            <div class="m-4 flex" id="form-url${newIndex}">
                  <input class="appearance-none inline-block w-full bg-grey-lighter text-grey-darker border border-opacity-25 border-red  rounded py-3 px-4 mb-3" 
                        id="url${newIndex}" 
                        type="text" 
                        placeholder="Enter URL here.">
                  <span class="h-12 cursor-pointer" onclick="removeURL('form-url${newIndex}')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mt-3 ml-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                  </span>
            </div>`);

            // Hide button add, This will re-count parent div's
            if (document.getElementById('urls').children.length == 8) {
                  document.getElementById('addUrl').classList.add('hidden');
            }

            
}
</script>