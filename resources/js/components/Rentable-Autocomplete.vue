<template>
    <div class="rentable-form">
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
        <div class="filters">
            <label for="date_of_hire">Date Filter:</label>
            <input
                type="date"
                id="date_of_hire"
                name="date_of_hire"
                :value="date_of_hire"
                class="form-control"
                placeholder="Date"
            />
            <label for="postal_code">Postal Code Filter:</label>
            <input
                type="number"
                id="postal_code"
                name="postal_code"
                :value="postal_code"
                class="form-control"
                placeholder="Postal Code"
            />
        </div>
    </div>
</template>

<script>
import Autocomplete from "./Autocomplete";
export default {
    data() {
        return {
            rentables: [],
            rentable_id: 0,
            date_of_hire: null,
            postal_code: 0
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

<style scoped>
.rentable-form {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
}
.filters {
    display: inherit;
    flex-direction: inherit;
    justify-content: inherit;
    align-items: inherit;
    min-width: 50%;
}
.filters label {
    white-space: nowrap;
    margin: 0 0.5em;
}
</style>
