<script setup>
import Cross from '@/components/icons/Cross.vue'

defineProps({
	toast: {
		type: Object,
		required: true,
	},
})

defineEmits(['close'])

const colors = {
	success: 'bg-lime',
	error: 'bg-red',
}
</script>

<template>
	<div
		class="flex items-center justify-between gap-x-15 text-white text-sm py-6 pl-8 pr-20 cursor-pointer"
		:class="colors[toast.type]"
    @click="$emit('close')">
		<span>
      {{ toast.message }}
    </span>
    <span>
      <Cross class="w-8 h-8" />
    </span>
	</div>
</template>
