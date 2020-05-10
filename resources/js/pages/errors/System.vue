<template>
  <div>
    <v-content>
      <v-container
        class="text-center fill-height"
        fluid
      >
        <v-row
          justify="center"
          align="center"
        >
          <v-col>
            <h1 class="display-2 green--text">Whoops, 500</h1>
            <v-spacer/>
            <p class="mt-3">システムエラーが発生しました</p>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </div>
</template>

<script>
    export default {
        name: "System"
    }
</script>

<style scoped>

</style>
