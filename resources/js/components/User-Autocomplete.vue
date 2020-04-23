<template>
    <Autocomplete
        :items="users"
        filterby="email"
        @change="onChange"
        outputkey="id"
        title="Look for a user"
        @selected="userSelected"
    />
</template>

<script>
import Autocomplete from "./Autocomplete";
export default {
    data() {
        return {
            users: []
        };
    },
    methods: {
        userSelected(user) {
            console.log(user);
        },
        onChange(value) {
            // do something with the current value
        }
    },
    components: {
        Autocomplete
    }
};
</script>

<style></style>
