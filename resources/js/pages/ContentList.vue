<template>
        <div>
            <v-content>
                <v-container
                    class="fill-height"
                    fluid
                >

                    <h1>Content List</h1>
                    <div class="text-center">
                        <v-btn
                            color="blue"
                            dark
                            @click="sheet = !sheet"
                        >
                            Open v-model
                        </v-btn>
                        <v-bottom-sheet v-model="sheet">
                            <v-sheet class="text-center" height="200px">
                                <v-btn
                                    class="mt-6"
                                    text
                                    color="red"
                                    @click="sheet = !sheet"
                                >close</v-btn>
                                <div class="py-3">This is a bottom sheet using the controlled by v-model instead of activator</div>
                            </v-sheet>
                        </v-bottom-sheet>
                    </div>

                </v-container>
            </v-content>
        </div>
</template>

<script>
    export default {
        name: "ContentList",
        data: () => ({
            sheet: false,
            tiles: [
                { img: 'keep.png', title: 'Keep' },
                { img: 'inbox.png', title: 'Inbox' },
                { img: 'hangouts.png', title: 'Hangouts' },
                { img: 'messenger.png', title: 'Messenger' },
                { img: 'google.png', title: 'Google+' },
            ],
        }),
    }
</script>

<style scoped>

</style>
