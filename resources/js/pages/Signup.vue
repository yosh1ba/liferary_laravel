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
                  <div v-if="registerErrors" class="">
                    <ul v-if="registerErrors.name">
                      <li v-for="msg in registerErrors.name" :key="msg" class="body-1 red--text">{{ msg }}</li>
                    </ul>
                    <ul v-if="registerErrors.email">
                      <li v-for="msg in registerErrors.email" :key="msg" class="body-1 red--text">{{ msg }}</li>
                    </ul>
                    <ul v-if="registerErrors.password">
                      <li v-for="msg in registerErrors.password" :key="msg" class="body-1 red--text">{{ msg }}</li>
                    </ul>
                  </div>
                  <v-text-field
                    label="ユーザー名"
                    name="name"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="registerForm.name"
                  />
                  <v-text-field
                    label="メールアドレス"
                    name="email"
                    prepend-icon="mdi-email"
                    type="text"
                    v-model="registerForm.email"
                  />
                  <v-text-field
                    id="password"
                    label="パスワード"
                    name="password"
                    prepend-icon="mdi-lock"
                    v-model="registerForm.password"
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPassword ? 'text' : 'password'"
                    counter
                    @click:append="showPassword = !showPassword"
                  />
                  <v-text-field
                    id="password_confirmation"
                    label="パスワード確認"
                    name="password_confirmation"
                    prepend-icon="mdi-lock"
                    v-model="registerForm.password_confirmation"
                    :append-icon="showPasswordConfirm ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPasswordConfirm ? 'text' : 'password'"
                    counter
                    @click:append="showPasswordConfirm = !showPasswordConfirm"
                  />
                </v-form>
              </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn @click="register" color="green darken-2 white--text">登録</v-btn>
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
    name: "Signup",
    data() {
      return {
        registerForm: {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
        },
        showPassword: false,
        showPasswordConfirm: false
      }
    },
    computed: {
      ...mapState({
        apiStatus: state => state.auth.apiStatus,
        registerErrors: state => state.auth.registerErrorMessages
      })
    },
    methods:{
      async register() {
        // authストアのresigterアクションを呼び出す
        await this.$store.dispatch('auth/register', this.registerForm)

        if (this.apiStatus) {
          // トップページに移動する
          this.$router.push('/')
        }
      },
      clearError(){
        this.$store.commit('auth/setRegisterErrorMessages', null)
      }
    },
    created() {
      this.clearError()
    }
  }
</script>

<style scoped>

</style>
