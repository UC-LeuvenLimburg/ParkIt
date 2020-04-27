<template>
    <div class="rentable-form">
        <input
            type="number"
            id="rentable_id"
            name="rentable_id"
            :value="rentableId"
            hidden
            required
        />
        <Autocomplete
            :items="rentables"
            filterby="adress"
            @change="onChange"
            placeholder="Select Place"
            @selected="rentableSelected"
        />
        <div class="filters">
            <div class="filter-pair">
                <label for="date_of_hire_filter">Date Filter:</label>
                <datepicker
                    id="date_of_hire_filter"
                    name="date_of_hire_filter"
                    :value="date_of_hire_filter"
                    @selected="onDateFilter"
                    :bootstrap-styling="true"
                    :typeable="true"
                    format="yyyy-MM-dd"
                    placeholder="Date"
                ></datepicker>
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
import Datepicker from "vuejs-datepicker";
export default {
    data() {
        return {
            rentables: [],
            rentable: {},
            date_of_hire_filter: null,
            postal_code_filter: ""
        };
    },
    mounted() {
        axios.get("/web/api/all/rentables").then(response => {
            this.rentables = response.data;
        });
    },
    methods: {
        rentableSelected(output) {
            this.rentable = output;
            this.$emit("selected", this.rentable);
        },
        onChange(value) {},
        onDateFilter(changeEvent) {
            this.date_of_hire_filter = changeEvent;
            let queryDateParam = null;
            if (this.date_of_hire_filter != null) {
                queryDateParam = this.date_of_hire_filter
                    .toISOString()
                    .substring(0, 10);
            }
            axios
                .get("/web/api/all/rentables", {
                    params: {
                        date_of_hire_like: queryDateParam,
                        postal_code_like: this.postal_code_filter
                    }
                })
                .then(response => {
                    this.rentables = response.data;
                });
        },
        onPostalCodeFilter(changeEvent) {
            this.postal_code_filter = changeEvent.data;
            let queryDateParam = null;
            if (this.date_of_hire_filter != null) {
                queryDateParam = this.date_of_hire_filter
                    .toISOString()
                    .substring(0, 10);
            }

            axios
                .get("/web/api/all/rentables", {
                    params: {
                        date_of_hire_like: queryDateParam,
                        postal_code_like: this.postal_code_filter
                    }
                })
                .then(response => {
                    this.rentables = response.data;
                });
        }
    },
    computed: {
        rentableId() {
            return this.rentable != null ? this.rentable.id : null;
        }
    },
    components: {
        Autocomplete,
        Datepicker
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
    height: 37px;
    min-width: 150px;
}
</style>
