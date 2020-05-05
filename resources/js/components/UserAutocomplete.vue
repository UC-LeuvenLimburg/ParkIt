<template>
    <div>
        <input
            type="number"
            id="user_id"
            name="user_id"
            :value="user_id"
            hidden
            required
        />
        <Autocomplete
            :items="users"
            filterby="email"
            @change="onChange"
            outputkey="id"
            placeholder="Select User"
            @selected="userSelected"
        />
    </div>
</template>

<script>
import Autocomplete from "./Autocomplete";
export default {
    data() {
        return {
            users: [],
            user_id: null
        };
    },
    mounted() {
        axios.get("/web/api/all/users").then(response => {
            this.users = response.data;
        });
    },
    methods: {
        userSelected(output) {
            this.user_id = output;
        },
        onChange(value) {}
    },
    components: {
        Autocomplete
    }
};
</script>

<style></style>
