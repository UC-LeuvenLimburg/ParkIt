<template>
    <div>
        <input
            type="number"
            id="rentable_id"
            name="rentable_id"
            :value="rentable_id"
            hidden
            required
        />
        <Autocomplete
            :items="rentables"
            filterby="adress"
            @change="onChange"
            outputkey="id"
            placeholder="Select Place"
            @selected="rentableSelected"
        />
    </div>
</template>

<script>
import Autocomplete from "./Autocomplete";
export default {
    data() {
        return {
            rentables: [],
            rentable_id: 0
        };
    },
    mounted() {
        axios.get("/web/api/all/rentables").then(response => {
            console.log(response);
            this.rentables = response.data;
        });
    },
    methods: {
        rentableSelected(output) {
            console.log(output);
            this.rentable_id = output;
        },
        onChange(value) {}
    },
    components: {
        Autocomplete
    }
};
</script>

<style></style>
