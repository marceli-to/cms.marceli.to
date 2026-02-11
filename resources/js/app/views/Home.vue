<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import {
	PhArticle,
	PhImage,
	PhFileText,
	PhCloudArrowUp,
	PhArrowRight,
	PhCircle,
} from '@phosphor-icons/vue'
import api from '../api/axios'
import PageHeader from '../components/layout/PageHeader.vue'

const router = useRouter()
const data = ref(null)
const loading = ref(true)

onMounted(async () => {
	try {
		const response = await api.get('/')
		data.value = response.data
	} finally {
		loading.value = false
	}
})

function formatSize(bytes) {
	if (!bytes) return '0 B'
	if (bytes < 1024) return bytes + ' B'
	if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB'
	if (bytes < 1024 * 1024 * 1024) return (bytes / (1024 * 1024)).toFixed(1) + ' MB'
	return (bytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB'
}

function timeAgo(dateStr) {
	const now = new Date()
	const date = new Date(dateStr)
	const diff = Math.floor((now - date) / 1000)

	if (diff < 60) return 'gerade eben'
	if (diff < 3600) return `vor ${Math.floor(diff / 60)} Min.`
	if (diff < 86400) return `vor ${Math.floor(diff / 3600)} Std.`
	if (diff < 604800) return `vor ${Math.floor(diff / 86400)} Tagen`
	return date.toLocaleDateString('de-CH')
}
</script>

<template>
	<div>
		<PageHeader title="Dashboard" />

		<div v-if="loading" class="text-sm text-neutral-400">Laden...</div>

		<template v-else-if="data">

			<!-- Stats -->
			<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-32">
				<div class="bg-white border border-neutral-200 p-20 group hover:border-neutral-400 transition-colors">
					<div class="flex items-center justify-between mb-12">
						<span class="text-[10px] font-medium text-neutral-400 uppercase tracking-[0.15em]">Beiträge</span>
						<PhArticle :size="16" class="text-neutral-300" />
					</div>
					<div class="text-2xl font-light text-neutral-900 tracking-tight">{{ data.stats.posts_total }}</div>
					<div class="text-[10px] text-neutral-400 mt-4">
						{{ data.stats.posts_published }} publiziert · {{ data.stats.posts_draft }} Entwürfe
					</div>
				</div>

				<div class="bg-white border border-neutral-200 p-20 group hover:border-neutral-400 transition-colors">
					<div class="flex items-center justify-between mb-12">
						<span class="text-[10px] font-medium text-neutral-400 uppercase tracking-[0.15em]">Publiziert</span>
						<PhFileText :size="16" class="text-neutral-300" />
					</div>
					<div class="text-2xl font-light text-emerald-600 tracking-tight">{{ data.stats.posts_published }}</div>
					<div class="text-[10px] text-neutral-400 mt-4">
						{{ data.stats.posts_total > 0 ? Math.round(data.stats.posts_published / data.stats.posts_total * 100) : 0 }}% aller Beiträge
					</div>
				</div>

				<div class="bg-white border border-neutral-200 p-20 group hover:border-neutral-400 transition-colors">
					<div class="flex items-center justify-between mb-12">
						<span class="text-[10px] font-medium text-neutral-400 uppercase tracking-[0.15em]">Medien</span>
						<PhImage :size="16" class="text-neutral-300" />
					</div>
					<div class="text-2xl font-light text-neutral-900 tracking-tight">{{ data.stats.media_total }}</div>
					<div class="text-[10px] text-neutral-400 mt-4">Bilder in der Bibliothek</div>
				</div>

				<div class="bg-white border border-neutral-200 p-20 group hover:border-neutral-400 transition-colors">
					<div class="flex items-center justify-between mb-12">
						<span class="text-[10px] font-medium text-neutral-400 uppercase tracking-[0.15em]">Speicher</span>
						<PhCloudArrowUp :size="16" class="text-neutral-300" />
					</div>
					<div class="text-2xl font-light text-neutral-900 tracking-tight">{{ formatSize(data.stats.media_size) }}</div>
					<div class="text-[10px] text-neutral-400 mt-4">Gesamtgrösse aller Medien</div>
				</div>
			</div>

			<!-- Two columns: Recent posts + Recent media -->
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

				<!-- Recent Posts -->
				<div class="bg-white border border-neutral-200">
					<div class="flex items-center justify-between px-20 py-16 border-b border-neutral-100">
						<h2 class="text-xs font-medium text-neutral-900 uppercase tracking-[0.1em]">Letzte Beiträge</h2>
						<button
							class="text-[10px] text-neutral-400 hover:text-neutral-900 flex items-center gap-4 transition-colors cursor-pointer"
							@click="router.push({ name: 'blog.index' })"
						>
							Alle anzeigen
							<PhArrowRight :size="10" />
						</button>
					</div>

					<div v-if="data.recent_posts.length === 0" class="px-20 py-24 text-sm text-neutral-400">
						Noch keine Beiträge.
					</div>

					<div v-else>
						<div
							v-for="(post, index) in data.recent_posts"
							:key="post.id"
							class="flex items-center gap-12 px-20 py-12 hover:bg-neutral-50 transition-colors cursor-pointer"
							:class="{ 'border-t border-neutral-100': index > 0 }"
							@click="router.push({ name: 'blog.edit', params: { id: post.id } })"
						>
							<PhCircle
								:size="8"
								weight="fill"
								:class="post.publish ? 'text-emerald-500' : 'text-neutral-300'"
							/>
							<div class="flex-1 min-w-0">
								<div class="text-sm text-neutral-900 truncate">{{ post.title }}</div>
							</div>
							<div class="text-[10px] text-neutral-400 whitespace-nowrap">{{ timeAgo(post.updated_at) }}</div>
						</div>
					</div>
				</div>

				<!-- Recent Media -->
				<div class="bg-white border border-neutral-200">
					<div class="flex items-center justify-between px-20 py-16 border-b border-neutral-100">
						<h2 class="text-xs font-medium text-neutral-900 uppercase tracking-[0.1em]">Letzte Uploads</h2>
						<button
							class="text-[10px] text-neutral-400 hover:text-neutral-900 flex items-center gap-4 transition-colors cursor-pointer"
							@click="router.push({ name: 'media.index' })"
						>
							Alle anzeigen
							<PhArrowRight :size="10" />
						</button>
					</div>

					<div v-if="data.recent_media.length === 0" class="px-20 py-24 text-sm text-neutral-400">
						Noch keine Medien.
					</div>

					<div v-else class="p-12">
						<div class="grid grid-cols-4 gap-6">
							<div
								v-for="media in data.recent_media"
								:key="media.uuid"
								class="group relative aspect-square overflow-hidden bg-neutral-50 cursor-pointer"
								@click="router.push({ name: 'media.index' })"
							>
								<img
									:src="media.thumbnail_url"
									:alt="media.original_name"
									class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
								/>
								<div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-150" />
							</div>
						</div>
					</div>
				</div>

			</div>

		</template>
	</div>
</template>
