<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useBlogStore } from '../../stores/blog'

const router = useRouter()
const store = useBlogStore()

onMounted(() => {
	store.fetchPosts()
})

async function handleDelete(post) {
	if (!confirm(`Delete "${post.title}"?`)) return
	await store.deletePost(post.id)
}
</script>

<template>
	<div class="grid grid-cols-10 gap-20 w-full">
    <div class="col-span-9">
      
      <div class="flex items-center justify-between mb-20">
        <h2 class="text-lg font-semibold text-black">Blog Posts</h2>
        <button
          class="bg-black text-white text-sm font-semibold px-16 py-8"
          @click="router.push({ name: 'blog.create' })"
        >
          New Post
        </button>
      </div>

      <div v-if="store.loading" class="text-sm text-gray">
        Loading...
      </div>

      <div v-else-if="store.posts.length === 0" class="text-sm text-gray">
        No posts yet.
      </div>

      <table v-else class="w-full text-sm">
        <thead>
          <tr class="border-b border-silver text-left">
            <th class="py-8 font-semibold text-gray">Title</th>
            <th class="py-8 font-semibold text-gray w-80">Status</th>
            <th class="py-8 font-semibold text-gray w-128">Created</th>
            <th class="py-8 font-semibold text-gray w-128 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="post in store.posts"
            :key="post.id"
            class="border-b border-snow"
          >
            <td class="py-8 text-black">{{ post.title }}</td>
            <td class="py-8">
              <span
                class="text-sm"
                :class="post.publish ? 'text-lime' : 'text-gray'"
              >
                {{ post.publish ? 'Published' : 'Draft' }}
              </span>
            </td>
            <td class="py-8 text-gray">
              {{ new Date(post.created_at).toLocaleDateString('de-CH') }}
            </td>
            <td class="py-8 text-right">
              <button
                class="text-black font-semibold mr-12"
                @click="router.push({ name: 'blog.edit', params: { id: post.id } })"
              >
                Edit
              </button>
              <button
                class="text-red font-semibold"
                @click="handleDelete(post)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
	</div>
</template>
