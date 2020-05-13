<template>
  <v-col
    cols="12"
    lg="3"
    md="4"
    sm="6">
    <v-card class="mx-auto">
      <v-img
        height="200"
        src="https://encrypted.google.com/books/content?id=6juLZwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api"
      />
      <v-card-title primary-title>
        楽しく、考えるための本
      </v-card-title>
      <v-card-subtitle class="pb-0">
        『ソフィーの世界上』
        ヨースタイン・ゴルデル
      </v-card-subtitle>
      <v-card-actions>
        <v-btn
          text
          color="deep-purple accent-4"
        >
          Learn More
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-col>
</template>

<script>
    export default {
        name: "Post",
        props: {
          item: {
            type: Object,
            required: true
          }
        }
    }
</script>

<style scoped>

</style>
