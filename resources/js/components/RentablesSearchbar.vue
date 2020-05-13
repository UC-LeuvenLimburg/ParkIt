<template>
    <div class="searchbar">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="adress_filter">Adress</label>
                <input
                    type="text"
                    name="adress_filter"
                    id="adress_filter"
                    v-model="adress_like"
                    class="form-control"
                />
            </div>
            <div class="form-group col-md-4">
                <label for="postcode_filter">Postal code</label>
                <input
                    type="text"
                    name="postal_code_filter"
                    id="postal_code_filter"
                    v-model="postal_code_like"
                    class="form-control"
                />
            </div>
            <div class="form-group col-md-2">
                <label for="date_filter">Date of hire</label>
                <input
                    type="date"
                    name="date_of_hire_filter"
                    id="date_of_hire_filter"
                    v-model="date_of_hire_like"
                    class="form-control"
                />
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
function initialState() {
    return {
        adress_like: "",
        postal_code_like: "",
        date_of_hire_like: ""
    };
}

export default {
    mounted() {
        let urlParams = new URLSearchParams(window.location.search);
        this.$data.adress_like = urlParams.get("adress_like") ?? "";
        this.$data.postal_code_like = urlParams.get("postal_code_like") ?? "";
        this.$data.date_of_hire_like = urlParams.get("date_of_hire_like") ?? "";
    },
    data() {
        return initialState();
    },
    methods: {
        search() {
            let currentUrl = window.location.origin + window.location.pathname;
            let queryString = "";
            for (let key in this.$data) {
                if (this.$data[key] == "") continue;
                if (queryString != "") {
                    queryString += "&";
                }
                queryString += key + "=" + encodeURIComponent(this.$data[key]);
            }
            if (queryString != "") {
                queryString = "?" + queryString;
            }

            window.location.href = currentUrl + queryString;
        },
        clear() {
            Object.assign(this.$data, initialState());
            this.search();
        }
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
