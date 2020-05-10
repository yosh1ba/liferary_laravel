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
                <div v-if="loginErrors" class="">
                  <ul v-if="loginErrors.email">
                    <li v-for="msg in loginErrors.email" :key="msg" class="body-1 red--text">{{ msg }}</li>
                  </ul>
                  <ul v-if="loginErrors.password">
                    <li v-for="msg in loginErrors.password" :key="msg" class="body-1 red--text">{{ msg }}</li>
                  </ul>
                </div>
                <v-text-field
                  label="メールアドレス"
                  name="email"
                  prepend-icon="mdi-email"
                  type="text"
                  v-model="signinForm.email"
                />
                <v-text-field
                  id="password"
                  label="パスワード"
                  name="password"
                  prepend-icon="mdi-lock"
                  v-model="signinForm.password"
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
  import { mapState } from 'vuex'
  export default {
    name: "Signin",
    data() {
      return {
        signinForm:{
          email: '',
          password: '',
        },
        showPassword: false
      }
    },
    computed: {
      ...mapState({
        apiStatus: state => state.auth.apiStatus,
        loginErrors: state => state.auth.loginErrorMessages
      })
    },
    methods: {
      async signin() {
        await this.$store.dispatch('auth/signin', this.signinForm)

        if(this.apiStatus){
          // トップページに移動する
          this.$router.push('/')
        }
      },
      clearError(){
        this.$store.commit('auth/setLoginErrorMessages', null)
      }
    },
    created() {
      this.clearError()
    }
  }
</script>

<style scoped>

</style>
