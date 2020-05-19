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
					cols="auto"
				>
					<v-card>
						<v-img
							:src="post.book.image"
						/>			
					</v-card>
				</v-col>
				<v-col cols="auto">
					<v-card-title primary-title>『{{post.book.title}}』</v-card-title>
					<v-card-text class="pl-5">
						<p>{{post.book.author}}　{{post.book.published_on}}</p>
						<p class="mb-0">投稿者：{{post.user.name}}</p>
					</v-card-text>
					<v-card-actions class="pl-3">
						<v-btn icon>
							<v-icon>mdi-heart</v-icon>
						</v-btn>
						10
					</v-card-actions>				
				</v-col>
			</v-row>
			<h3 class="mt-3">わたしにとってこんな本</h3>
			<p class="ml-3">{{post.head}}</p>
			<p class="ml-3">{{post.detail}}</p>
			<h3>
				<v-icon>mdi-comment-processing-outline</v-icon>
				<span class="text--primary">コメント</span>
			</h3>
			<div
			 v-if="post.comments.length > 0">
				<v-list
					two-line
					v-for="comment in post.comments"
					:key="comment.id"
				>
					<v-list-item>
						<v-list-item-content>

							<v-list-item-title class="mb-2">
								{{comment.comment}}
							</v-list-item-title>
							<v-list-item-subtitle>
								{{comment.user.name}}
							</v-list-item-subtitle>
						</v-list-item-content>			
					</v-list-item>
					<v-divider class="mb-3" light :inset="false"></v-divider>
					
				</v-list>

			</div>
			<p v-else class="mt-3">コメントはありません</p>
			<v-form
				v-if="isSignin"
			>
				<v-textarea
					label="コメント"
					v-model="commentContent"
					rows="1"
					auto-grow
				></v-textarea>
			</v-form>
			<v-row
				v-if="isSignin"
			>
				<v-col class="d-flex flex-row-reverse pt-0">
					<v-btn color="green" dark @click="addComment" v-scroll-to="'header'">送信</v-btn>
				</v-col>
			</v-row>
			<v-btn
				color="gray"
				light
			>
				<router-link
					tag="span" 
					style="cursor: pointer"
					:to="`${$store.state.route.from.fullPath}`"
				>
					一つ前に戻る
				</router-link>
			</v-btn>
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
			commentContent: ''
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

			console.log(response.data)

			if(response.status !== OK){
					this.$store.commit('error/setCode', response.status)
					return false
			}
			this.post = response.data
		},
		async addComment(){
			const response = await axios.post(`/api/posts/${this.id}/comments`, {
				comment: this.commentContent
			})
			this.commentContent = ''

			console.log(response.data)
			this.post.comments = [
				response.data,
				...this.post.comments
			]

			console.log(this.post.comments)
		}
	},
	computed: {
		isSignin(){
			return this.$store.getters['auth/check']
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