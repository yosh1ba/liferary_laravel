<template>
    <v-app>
        <Navbar />
        <RouterView />
        <Footer />
    </v-app>
</template>
<script>
  import Navbar from "./components/Navbar";
  import Footer from "./components/Footer";
  import { INTERNAL_SERVER_ERROR} from "./util";

  export default {
    components: {
      Footer,
      Navbar
    },
    computed: {
      errorCode () {
        return this.$store.state.error.code
      }
    },
    watch: {
      errorCode: {
        handler (val) {
          if (val === INTERNAL_SERVER_ERROR) {
            this.$router.push('/500')
          }
        },
        immediate: true
      },
      $route () {
        this.$store.commit('error/setCode', null)
      }
    }
  }
</script>
