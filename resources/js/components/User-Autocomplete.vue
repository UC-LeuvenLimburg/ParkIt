<template>
    <div>
        <Autocomplete
            :items="users"
            filterby="email"
            @change="onChange"
            outputkey="id"
            placeholder="Select User"
            @selected="userSelected"
        />
        <input
            type="number"
            id="user_id"
            name="user_id"
            :value="user_id"
            hidden
            required
        />
    </div>
</template>

<script>
import Autocomplete from "./Autocomplete";
export default {
    data() {
        return {
            users: [],
            user_id: 0
        };
    },
    mounted() {
        axios.get("/web/api/all/users").then(response => {
            console.log(response);
            this.users = response.data;
        });
    },
    methods: {
        userSelected(output) {
            console.log(output);
        },
        onChange(value) {}
    },
    components: {
        Autocomplete
    }
};
</script>

<style></style>
