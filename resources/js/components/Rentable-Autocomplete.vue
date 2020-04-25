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
                <label for="date_of_hire_filter">Date Filter:</label>
                <input
                    type="date"
                    id="date_of_hire_filter"
                    name="date_of_hire_filter"
                    :value="date_of_hire_filter"
                    class="form-control"
                    placeholder="Date"
                    @change="onDateFilter"
                />
            </div>
            <div class="filter-pair no-margin-right">
                <label for="postal_code_filter">Postal Code Filter:</label>
                <input
                    type="text"
                    id="postal_code_filter"
                    name="postal_code_filter"
                    :value="postal_code_filter"
                    class="form-control"
                    placeholder="Postal Code"
                    @input="onPostalCodeFilter"
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
            date_of_hire_filter: new Date(),
            postal_code_filter: ""
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
        onChange(value) {},
        onDateFilter(changeEvent) {
            console.log(changeEvent);
            console.log(changeEvent.data);
            this.date_of_hire_filter = changeEvent.data;
            axios
                .get("/web/api/all/rentables", {
                    params: {
                        date_of_hire_like: this.date_of_hire_filter,
                        postal_code_like: this.postal_code_filter
                    }
                })
                .then(response => {
                    console.log(response);
                    this.rentables = response.data;
                });
        },
        onPostalCodeFilter(changeEvent) {
            this.postal_code_filter = changeEvent.data;
            axios
                .get("/web/api/all/rentables", {
                    params: {
                        date_of_hire_like: this.date_of_hire_filter,
                        postal_code_like: this.postal_code_filter
                    }
                })
                .then(response => {
                    console.log(response);
                    this.rentables = response.data;
                });
        }
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
    z-index: 99;
    white-space: nowrap;
}
.filters .filter-pair input {
    height: 40px;
    min-width: 150px;
}
</style>
