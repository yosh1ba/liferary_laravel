<template>
  <v-col
    cols="12"
    lg="3"
    md="4"
    sm="6">
    <v-card class="mx-auto pt-3" min-height="380">
      <v-img
        max-height="200"
        contain
        
        :src="item.book.image"
      />
      <v-card-title primary-title>
        {{item.head}}
      </v-card-title>
      <v-card-subtitle class="pb-0">
        『{{item.book.title}}』
        {{item.book.author}}
      </v-card-subtitle>
      <v-card-actions>
        <v-btn
          text
          color="deep-purple accent-4"
          :to="`/posts/${item.id}`"
        >
          詳しく見る
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
