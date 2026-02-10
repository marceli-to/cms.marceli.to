<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useBlogStore } from '../../stores/blog'

const route = useRoute()
const router = useRouter()
const store = useBlogStore()

const isEdit = computed(() => !!route.params.id)

const form = ref({
	title: '',
	content: '',
	publish: false,
})

onMounted(async () => {
	if (isEdit.value) {
		await store.fetchPost(route.params.id)
		if (store.current) {
			form.value.title = store.current.title
			form.value.content = store.current.content || ''
			form.value.publish = store.current.publish
		}
	}
})

async function handleSubmit() {
	const success = await store.savePost(form.value, isEdit.value ? route.params.id : null)
	if (success) {
		router.push({ name: 'blog.index' })
	}
}
</script>

<template>
	<div class="p-20">
		<div class="flex items-center justify-between mb-20">
			<h2 class="text-lg font-semibold text-black">
				{{ isEdit ? 'Edit Post' : 'New Post' }}
			</h2>
		</div>

		<div v-if="store.loading" class="text-sm text-gray">
			Loading...
		</div>

		<form v-else class="max-w-600" @submit.prevent="handleSubmit">
			<div class="mb-16">
				<label class="block text-sm font-semibold text-black mb-4">Title</label>
				<input
					v-model="form.title"
					type="text"
					class="w-full border border-silver px-8 py-8 text-sm text-black focus:outline-none focus:border-black"
				/>
				<p v-if="store.errors.title" class="text-sm text-red mt-4">
					{{ store.errors.title[0] }}
				</p>
			</div>

			<div class="mb-16">
				<label class="block text-sm font-semibold text-black mb-4">Content</label>
				<textarea
					v-model="form.content"
					rows="8"
					class="w-full border border-silver px-8 py-8 text-sm text-black focus:outline-none focus:border-black"
				></textarea>
				<p v-if="store.errors.content" class="text-sm text-red mt-4">
					{{ store.errors.content[0] }}
				</p>
			</div>

			<div class="mb-24">
				<label class="flex items-center gap-8 text-sm text-black">
					<input
						v-model="form.publish"
						type="checkbox"
						class="w-12 h-12"
					/>
					Publish
				</label>
			</div>

			<div class="flex gap-12">
				<button
					type="submit"
					class="bg-black text-white text-sm font-semibold px-16 py-8"
				>
					{{ isEdit ? 'Update' : 'Create' }}
				</button>
				<button
					type="button"
					class="border border-black text-black text-sm font-semibold px-16 py-8"
					@click="router.push({ name: 'blog.index' })"
				>
					Cancel
				</button>
			</div>
		</form>
	</div>
</template>
