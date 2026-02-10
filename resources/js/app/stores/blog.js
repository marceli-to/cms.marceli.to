import { defineStore } from 'pinia'
import blogApi from '../api/blog'

export const useBlogStore = defineStore('blog', {
	state: () => ({
		posts: [],
		current: null,
		loading: false,
		errors: {},
	}),

	actions: {
		async fetchPosts() {
			this.loading = true
			try {
				const { data } = await blogApi.index()
				this.posts = data.data
			} finally {
				this.loading = false
			}
		},

		async fetchPost(id) {
			this.loading = true
			try {
				const { data } = await blogApi.show(id)
				this.current = data.data
			} finally {
				this.loading = false
			}
		},

		async savePost(form, id = null) {
			this.errors = {}
			try {
				if (id) {
					await blogApi.update(id, form)
				} else {
					await blogApi.store(form)
				}
				return true
			} catch (error) {
				if (error.response?.status === 422) {
					this.errors = error.response.data.errors
				}
				return false
			}
		},

		async deletePost(id) {
			await blogApi.destroy(id)
			this.posts = this.posts.filter(p => p.id !== id)
		},
	},
})
