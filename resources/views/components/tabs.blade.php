<!-- component -->
<!--
Author: Mostafa Ahangarha
License: MIT
Version: v1.1
-->

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="flex justify-center items-center block w-full">
	<!--actual component start-->
	<div x-data="{activeTab: 0, tabs: ['Image Options (URL)', 'Attach Images']}" class="w-full">
		<ul class="flex justify-center items-center my-4">
			<template x-for="(tab, index) in tabs" :key="index">
				<li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
					:class="activeTab===index ? 'text-green-500 border-green-500' : ''" @click="activeTab = index"
					x-text="tab"></li>
			</template>
		</ul>

		<div {{ $attributes->merge(['class' => 'bg-white text-center mx-auto']) }}">
			    {{$slot}}
		</div>
	</div>
	<!--actual component end-->
</div>
<!--
# Changelog:

## [1.1] - 2021-05-01
### Added
 - Back/Next buttons

## [1.0] - 2021-05-01
### Added
 - Nav bar with two styles
 - Set tabs title dynamically and render on page
-->