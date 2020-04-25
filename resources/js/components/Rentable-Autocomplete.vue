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
            <div class="filter-pair">
                <label for="date_of_hire">Date Filter:</label>
                <input
                    type="date"
                    id="date_of_hire"
                    name="date_of_hire"
                    :value="date_of_hire"
                    class="form-control"
                    placeholder="Date"
                />
            </div>
            <div class="filter-pair no-margin-right">
                <label for="postal_code">Postal Code Filter:</label>
                <input
                    type="text"
                    id="postal_code"
                    name="postal_code"
                    :value="postal_code"
                    class="form-control"
                    placeholder="Postal Code"
                />
            </div>
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
            postal_code: ""
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
    width: 100%;
    position: relative;
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
    margin-left: 0.5em;
}
.filter-pair {
    position: relative;
    margin: 0 0.5em;
}
.no-margin-right {
    margin-right: 0;
}
.filters .filter-pair label {
    position: absolute;
    left: 0;
    bottom: 100%;
    z-index: 999;
    white-space: nowrap;
}
.filters .filter-pair input {
    height: 40px;
    min-width: 150px;
}
</style>
