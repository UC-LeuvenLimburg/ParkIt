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
        axios.get("/web/api/users").then(response => {
            this.users = response.data.data;
        });
    },
    methods: {
        userSelected(output) {
            console.log(output);
        },
        onChange(value) {
            console.log("refreshing data");
            axios
                .get("/web/api/users", { params: { email_like: value } })
                .then(response => {
                    console.log("data received");
                    this.users = response.data.data;
                });
        }
    },
    components: {
        Autocomplete
    }
};
</script>

<style></style>
