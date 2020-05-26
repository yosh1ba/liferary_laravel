<template>
	<v-content>
		<v-container>
				<v-row
					justify="center"
					align="center"
				>
					<v-col
						cols="12"
						sm="8"
					>
						<v-card outline>
							<v-toolbar
								color="white"
								flat
								class="justify-center"
							>
              <v-layout justify-center>
                <v-toolbar-title class="headline font-weight-bold green--text text--darken-3">書籍登録</v-toolbar-title>
              </v-layout>
            	</v-toolbar>
								<div v-if="registerErrors" class="">
									<ul v-if="registerErrors.book">
										<li v-for="msg in registerErrors.book" :key="msg" class="body-1 red--text">{{ msg }}</li>
									</ul>
									<ul v-if="registerErrors.head">
										<li v-for="msg in registerErrors.head" :key="msg" class="body-1 red--text">{{ msg }}</li>
									</ul>
									<ul v-if="registerErrors.detail">
										<li v-for="msg in registerErrors.detail" :key="msg" class="body-1 red--text">{{ msg }}</li>
									</ul>
									<ul v-if="registerErrors.age_id">
										<li v-for="msg in registerErrors.age_id" :key="msg" class="body-1 red--text">{{ msg }}</li>
									</ul>
								</div>

							<v-card-text class="pb-0">
								<v-form v-if="!registerd">
									<v-row
										align="baseline">
										<v-col
											cols="auto">
											<v-text-field
												name="isbn"
												label="ISBNコード"
												rows="1"
												v-model="searchISBN"
											></v-text-field>
											
										</v-col>
										<v-col
										 cols="auto">
											<v-btn @click="search" color="green darken-2 white--text">検索</v-btn>
										</v-col>
									</v-row>
								</v-form>
								<v-card flat>
									<v-row v-if="book" class="flex-nowrap">
										<v-col
											cols="3">
											<v-card>
												<v-img v-if="registerd"
													:src="book.image"
												/>
												<v-img v-else
													:src="book.imageLinks.thumbnail"
												/>

											</v-card>
										</v-col>
										<v-col>
												<v-card-title primary-title>『{{book.title}}』</v-card-title>
												<v-card-text class="pl-5">
												<p v-if="registerd">{{book.author}}　{{book.published_on}}</p>
												<p v-else>{{book.authors[0]}}　{{book.publishedDate}}</p>
											</v-card-text>
										</v-col>
									</v-row>
									<v-row v-else>
										<v-col>
											<v-card-title primary-title>
												書籍情報がありません
											</v-card-title>
										</v-col>
									</v-row>
								</v-card>
								<v-spacer class="mb-3"></v-spacer>
								<v-form v-if="registerd">
									<v-text-field
										name="head"
										label="この本はあなたにとってどんな本ですか？（○○な本）"
										v-model="registerForm.head"
										counter="30"
										rows="1"
										filled
										disabled
									></v-text-field>
									<v-textarea
										name="detail"
										label="その理由"
										v-model="registerForm.detail"
										counter="500"
										rows="10"
										filled
										disabled
									></v-textarea>
									<v-select
										name="age"
										label="この本を読んだ年代"
										v-model="registerForm.age_id"
										:items="ages"
										item-text="age"
										item-value="id"
										filled
										disabled
									></v-select>
								</v-form>
								<v-form v-else>
									<v-text-field
										name="head"
										label="この本はあなたにとってどんな本ですか？（○○な本）"
										v-model="registerForm.head"
										counter="30"
										rows="1"
										filled
									></v-text-field>
									<v-textarea
										name="detail"
										label="その理由"
										v-model="registerForm.detail"
										counter="500"
										rows="10"
										filled
									></v-textarea>
									<v-select
										name="age"
										label="この本を読んだ年代"
										v-model="registerForm.age_id"
										:items="ages"
										item-text="age"
										item-value="id"
										filled
									></v-select>
								</v-form>
							</v-card-text>
							<v-card-actions
								class="justify-end pa-4 pt-0">
								<v-btn v-if="registerd" @click="confirm" color="red white--text">削除</v-btn>
								<v-btn v-else @click="register" color="green darken-2 white--text">登録</v-btn>
							</v-card-actions>
						</v-card>
					</v-col>
				</v-row>
				<v-snackbar
					v-model="snackbar"
					:timeout="timeout"
	      >
  	      {{ snackbarText }}
        <v-btn
          color="blue"
          text
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </v-snackbar>
		</v-container>
	</v-content>
</template>

<script>
import {OK, UNPROCESSABLE_ENTITY, CREATED} from "../util";
export default {
		name: 'BookPost',
		data() {
			return {
				ages: [],
				book:null,
				searchISBN:'',
				isbnErrors:null,
				registerErrors:[],
				registerd:false,
				registerForm:{
					head:'',
					detail:'',
					age_id:''
				},
				snackbar:false,
				snackbarText:'',
				timeout:2000
			}
		},
		methods: {
			async fetchPost(){
				this.age();

				this.registerd = false
				this.book = null

				const response = await axios.get(`/api/posts/registerd/${this.$store.getters['auth/userid']}`)

				console.log(response)

				if(response.data){
					this.registerd = true

					this.book = response.data.book
					this.registerForm.head = response.data.head
					this.registerForm.detail = response.data.detail
					this.registerForm.age_id = response.data.age_id

				}
		},
		async age(){
			const response = await axios.get(`/api/ages`)

			if(response.status !== OK){
					this.$store.commit('error/setCode', response.status)
					return false
			}
			this.ages = response.data
		},
		async search(){

			const response = await axios.post(`/api/book`, {isbn:this.searchISBN})

			if(response.status !== OK){
				this.$store.commit('error/setCode', response.status)
				return false
			}

			// バリデーションエラーがあった場合、エラー文をプロパティにセットする
			if(response.status === UNPROCESSABLE_ENTITY){
				this.isbnErrors = response.data.errors
				return false
			}

			this.book = response.data

			this.book.isbn =this.searchISBN
		},
		async register(){

			this.registerForm.book = this.book

			const response = await axios.post(`/api/posts/register`, this.registerForm)

			// バリデーションエラーがあった場合、エラー文をプロパティにセットする
			if(response.status === UNPROCESSABLE_ENTITY){
				this.registerErrors = response.data.errors
				return false
			}
			
			// 成功ではない場合、ステータスをストアする
			if(response.status !== OK){
				this.$store.commit('error/setCode', response.status)
				return false
			}

			this.snackbarText = '登録しました'
			this.snackbar = true

			this.$router.push('/')

		},
		async confirm(){

			const result = window.confirm('削除してよろしいですか？');

			if(result){
				
				const response = await axios.delete(`/api/posts/registerd/${this.$store.getters['auth/userid']}`)

				// 成功ではない場合、ステータスをストアする
				if(response.status !== OK){
					this.$store.commit('error/setCode', response.status)
					return false
				}

				this.$router.push('/')

			}
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
	},
}
</script>

<style>

</style>