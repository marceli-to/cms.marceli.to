<script setup>
import AppHeader from '@/components/layout/AppHeader.vue'
import AppSidebar from '@/components/layout/AppSidebar.vue'
import ToastContainer from '@/components/ui/ToastContainer.vue'
</script>

<template>
	<div class="min-h-screen flex flex-col">
		<AppHeader />
		<div class="bg-snow grid grid-cols-12 gap-x-20 flex-1">
			<AppSidebar />
			<main class="col-span-10 bg-snow relative pt-40">
				<ToastContainer />
				<slot />
			</main>
		</div>
	</div>
</template>
