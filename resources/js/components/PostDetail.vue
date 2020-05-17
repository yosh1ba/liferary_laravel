<template>
<v-content>
	<v-container 
		v-if="post.book"
		align-start
		class="mx-auto"
		>
		<v-card flat>
		<v-row
		>
			<v-col
				cols="auto">
			<v-card>
				<v-img
					:src="post.book.image"
				/>			
			</v-card>

			</v-col>
			<v-col cols="auto">
				<v-card-title primary-title>『{{post.book.title}}』</v-card-title>
				<v-card-text>
					<p>　{{post.book.author}}　{{post.book.published_on}}</p>
					<p>　投稿者：{{post.user.name}}</p>
				</v-card-text>				
			</v-col>
		</v-row>
		<h3 class="mt-3">わたしにとってこんな本</h3>
		<p>{{post.head}}</p>
		<p>{{post.detail}}</p>

		<v-chip
      class="ma-2"
      color="green"
      text-color="white"
    >
			<router-link
				tag="span" 
				style="cursor: pointer"
		 		:to="`${$store.state.route.from.fullPath}`"
			>
				一つ前に戻る
			</router-link>
		</v-chip>
		</v-card>
	</v-container>
</v-content>
</template>

<script>
import {OK} from "../util";
export default {
	name: 'PostDetail',
	data(){
		return {
			post: [],
		}
	},
	props: {
		id: {
			type: String,
				required: true
			}
	},
	methods: {
		async fetchPost(){

			const response = await axios.get(`/api/posts/${this.id}`)

			if(response.status !== OK){
					this.$store.commit('error/setCode', response.status)
					return false
			}
			this.post = response.data
		}
	},
	watch: {
			$route: {
					async handler(){
							await this.fetchPost()
					},
					immediate: true
			},
			page: function(){
				this.fetchPost();
			}
	}
}
</script>

<style>

</style>