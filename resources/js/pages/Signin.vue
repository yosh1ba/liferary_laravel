<template>
  <v-content>
    <v-container
      class="fill-height"
      fluid
    >
      <v-row
        justify="center"
        align="center"
      >
        <v-col
          cols="12"
          sm="8"
          md="4"
        >
          <v-card outline>
            <v-toolbar
              color="white"
              flat
              class="justify-center"
            >
              <v-layout justify-center>
                <v-toolbar-title class="headline font-weight-bold green--text text--darken-3">サインイン</v-toolbar-title>
              </v-layout>
            </v-toolbar>
            <v-card-text>
              <v-form>
                <v-text-field
                  label="メールアドレス"
                  name="email"
                  prepend-icon="mdi-email"
                  type="text"
                  v-model="email"
                />
                <v-text-field
                  id="password"
                  label="パスワード"
                  name="password"
                  prepend-icon="mdi-lock"
                  type="password"
                  v-model="password"
                  :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="showPassword ? 'text' : 'password'"
                  counter
                  @click:append="showPassword = !showPassword"
                />
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn @click="signin" color="green darken-2 white--text">サインイン</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-content>
</template>

<script>
  export default {
    name: "Signin",
    data() {
      return {
        email: '',
        password: '',
        showPassword: false
      }
    },
    methods: {
      signin(){
        console.log(this.email);
        console.log(this.password);
      }
    }
  }
</script>

<style scoped>

</style>
