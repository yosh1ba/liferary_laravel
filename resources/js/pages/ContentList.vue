<template>
<v-content>
    <v-container
			fill-height
			>
        <v-row
        	align="center"
				>
        
         <Post 
            v-for="post in posts"
            :key="post.id"
            :item="post"
          />

        </v-row>
        <div class="text-center mt-5 mx-auto">
          <v-pagination
            v-model="page"
            :length="lastPage"
            :total-visible="7"
            v-scroll-to="'header'"
          >
          </v-pagination>
        </div>
    </v-container>
</v-content>

</template>

<script>
	import Post from '../components/Post'
  import {OK} from "../util";
  export default {
    name: "ContentList",
    components: {
      // Postsコンポーネントを登録
      Post
    },
    data(){
        return {
          posts: [], // 投稿一覧を入れる
          page: 1,
          lastPage: 0
        }
    },
    methods: {
        async fetchPosts(){
          // /api/posts へGETリクエスストを送り、結果をresponseに代入する
          const response = await axios.get(`/api/posts/?page=${this.page}`)

          // レスポンスがNGであればエラーコードをストアにコミットする
          if(response.status !== OK){
            this.$store.commit('error/setCode', response.status)
            return false
          }

          this.lastPage = response.data.last_page

          // response.data で response のJSONが取得できる
          // JSON内の更に中にあるdata項目に取得した投稿一覧の情報が入っている
          this.posts = response.data.data
        }
    },
    watch: {
      // $route オブジェクトが変化したときに fetchPosts メソッドを読み出す
      $route: {
        async handler(){
          await this.fetchPosts()
        },
        immediate: true // 初期読み込み時にも呼び出す
      },
      page: function(){
        this.fetchPosts();
      }
    }
  }
</script>

<style scoped>

</style>
