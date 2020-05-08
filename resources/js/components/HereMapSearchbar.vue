<template>
    <div class="searchbar">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="adress_filter">Adress Filter</label>
                <input
                    type="text"
                    name="adress_filter"
                    id="adress_filter"
                    v-model="adress_filter"
                    class="form-control"
                    placeholer="Adress"
                />
            </div>
            <div class="form-group col-md-2">
                <label for="postal_code_filter">Postal code Filter</label>
                <input
                    type="text"
                    name="postal_code_filter"
                    id="postal_code_filter"
                    v-model="postal_code_filter"
                    class="form-control"
                    placeholer="Postal code"
                />
            </div>
            <div class="form-group col-md-2">
                <label for="date_of_hire_filter">Date Filter:</label>
                <datepicker
                    id="date_of_hire_filter"
                    name="date_of_hire_filter"
                    :value="date_of_hire_filter"
                    @selected="onDateFilter"
                    :bootstrap-styling="true"
                    :typeable="true"
                    format="yyyy-MM-dd"
                ></datepicker>
            </div>
            <div>
                <div @click="search" class="search-btn ml-1 btn btn-primary">
                    Search
                </div>
                <div @click="clear" class="search-btn ml-2 btn btn-warning">
                    Clear
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";

export default {
    data() {
        return {
            adress_filter: "",
            postal_code_filter: "",
            date_of_hire_filter: null
        };
    },
    methods: {
        search() {},
        clear() {},
        onDateFilter() {}
    },
    components: {
        Datepicker
    }
};
</script>

<style scoped>
.searchbar {
    width: 100%;
}
.search-btn {
    height: 2.3rem;
    margin-top: 1.85rem;
}
</style>
