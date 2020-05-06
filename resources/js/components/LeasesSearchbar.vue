<template>
    <div class="searchbar">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="start_time_filter">Start Time Filter</label>
                <input
                    type="text"
                    name="start_time_filter"
                    id="start_time_filter"
                    v-model="start_time_like"
                    class="form-control"
                />
            </div>
            <div class="form-group col-md-4">
                <label for="start_time_filter">End Time Filter</label>
                <input
                    type="text"
                    name="end_time_filter"
                    id="start_time_filter"
                    v-model="end_time_like"
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
        start_time_like: "",
        end_time_like: ""
    };
}

export default {
    mounted() {
        let urlParams = new URLSearchParams(window.location.search);
        this.$data.start_time_like = urlParams.get("start_time_like") ?? "";
        this.$data.end_time_like = urlParams.get("end_time_like") ?? "";
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
