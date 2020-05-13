<template>
<v-content>
    <v-container
			fill-height
			>
        <v-row
        	align="center"
				>
          <Post />
        </v-row>
    </v-container>  
</v-content>

</template>

<script>
	import Post from '../components/Post'
  export default {
      name: "ContentList",
      components: {
        Post
      },
  }
</script>

<style scoped>

</style>
