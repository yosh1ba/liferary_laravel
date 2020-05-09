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
                <v-toolbar-title class="headline font-weight-bold green--text text--darken-3">新規登録</v-toolbar-title>
              </v-layout>
            </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="ユーザー名"
                    name="username"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="name"
                  />
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
                  <v-text-field
                    id="password_confirm"
                    label="パスワード確認"
                    name="password_confirm"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="password_confirm"
                    :append-icon="showPasswordConfirm ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPasswordConfirm ? 'text' : 'password'"
                    counter
                    @click:append="showPasswordConfirm = !showPasswordConfirm"
                  />
                </v-form>
              </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn @click="signup" color="green darken-2 white--text">登録</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-content>
</template>

<script>
  export default {
    name: "Signup",
    data() {
      return {
        name: '',
        email: '',
        password: '',
        showPassword: false,
        password_confirm: '',
        showPasswordConfirm: false
      }
    },
    methods:{
      signup(){
        console.log(this.name);
        console.log(this.email);
        console.log(this.password);
        console.log(this.password_confirm);
      }
    }
  }
</script>

<style scoped>

</style>
