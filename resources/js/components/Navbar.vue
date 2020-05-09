<template>
    <div>
        <v-navigation-drawer v-model="sidebar" app>
            <v-list nav dense>
                <v-list-item v-for="item in menuItems" :key="item.title" :to="item.path">
                    <v-list-item-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>{{ item.title }}</v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar color="green lighten-1" app dark>
            <span class="hidden-sm-and-up">
                <v-app-bar-nav-icon @click="sidebar = !sidebar"></v-app-bar-nav-icon>
            </span>
            <v-toolbar-title>
                <router-link to="/" tag="span" style="cursor: pointer">
                    {{ appTitle }}
                </router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-xs-only">
                <v-btn
                    text
                    v-for="item in menuItems"
                    :key="item.title"
                    :to="item.path">
                    <v-icon left dark>{{ item.icon }}</v-icon>
                    {{ item.title }}
                </v-btn>
            </v-toolbar-items>
        </v-app-bar>

    </div>
</template>

<script>
  export default {
    name: "Navbar",
    data() {
      return {
        appTitle: 'Liferary',
        sidebar: false,
        menuItems: [
            { title: '新規登録', path: '/signup', icon: 'mdi-face' },
            { title: 'サインイン', path: '/signin', icon: 'mdi-lock-open-outline' }
        ]
      }
    },
  };
</script>

<style scoped>

</style>
