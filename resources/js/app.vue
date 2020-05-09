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
    export default {
        components: {Footer, Navbar}
    }
</script>
