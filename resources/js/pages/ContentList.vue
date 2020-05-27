<template>
<v-content class="pa-0">
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
        <div class="text-center mt-5 mx-auto" :class="{move:minWidth}">
          <v-pagination
            v-model="page"
            :length="lastPage"
            :total-visible="totalVisible"
            v-scroll-to="'header'"
          >
          </v-pagination>
        </div>
    </v-container>
</v-content>

</template>

<script>
	import Post from '../components/Post'
  import {OK} from "../util"
  export default {
    name: "ContentList",
    components: {
      // Postsコンポーネントを登録
      Post
    },
    data(){
        return {
          posts: [], // 投稿一覧を入れる
          lastPage: 0,
          totalVisible: 0,
          minWidth:false
        }
    },
    methods: {
        async fetchPosts(){

          // /api/posts へGETリクエスストを送り、結果をresponseに代入する
          //const response = await axios.get(`/api/posts/?page=${this.page}`)
          const response = await axios.get(`/api/posts`, 
          {
            params: {
              page: this.page
            }
          }
          )

          // レスポンスがNGであればエラーコードをストアにコミットする
          if(response.status !== OK){
            this.$store.commit('error/setCode', response.status)
            return false
          }

          this.lastPage = response.data.last_page

          // response.data で response のJSONが取得できる
          // JSON内の更に中にあるdata項目に取得した投稿一覧の情報が入っている
          this.posts = response.data.data
        },
        handleResize: function() {
          // 幅320pxの端末でページネーションがはみだすため、全体を左に寄せる
          // 画面サイズを検知し、320pxならminWidthプロパティをtrueにする
          // minWidthがtrueの場合のみ、translateXが適用される
          if(window.innerWidth == 320){
            this.minWidth=true
          } else {
            this.minWidth=false
          }

          if(window.innerWidth < 600){
            this.totalVisible = 5;

          } else{
            this.totalVisible = 7;
          }
       }
    },
    computed: {
      // v-modelに指定したpageについて、Vuexを用いた双方向データバインディングを実現
      // Vuexで現在のページを保持することで、投稿詳細ページから戻る際に直前のページネーションを指定できる
      page: {
        get(){
          return this.$store.getters['page/currentPage']
        },
        set(val) {
          return this.$store.commit('page/setPage',val)
        }
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
    },
    created() {
      window.addEventListener('resize', this.handleResize)
      this.handleResize()
    },
    Destroyed() {
      window.removeEventListener('resize', this.handleResize)
    }
  }
</script>

<style scoped>
.move{
  transform: translateX(-10px);
}
</style>
