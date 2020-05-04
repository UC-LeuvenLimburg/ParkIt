<template>
    <div class="searchbar">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name_filter">Name Filter</label>
                <input
                    type="text"
                    name="name_filter"
                    id="name_filter"
                    v-model="name_like"
                    class="form-control"
                    placeholer="Name"
                />
            </div>
            <div class="form-group col-md-4">
                <label for="email_filter">Email Filter</label>
                <input
                    type="text"
                    name="email_filter"
                    id="email_filter"
                    v-model="email_like"
                    class="form-control"
                    placeholer="Email"
                />
            </div>
            <div class="form-group col-md-2">
                <label for="role_filter">Role Filter</label>
                <input
                    type="text"
                    name="role_filter"
                    id="role_filter"
                    v-model="role_like"
                    class="form-control"
                    placeholer="Role"
                />
            </div>
            <div @click="search" class="search-btn ml-1 btn btn-primary">
                Search
            </div>
            <div @click="clear" class="search-btn ml-2 btn btn-warning">
                Clear
            </div>
        </div>
    </div>
</template>

<script>
function initialState() {
    return {
        name_like: "",
        email_like: "",
        role_like: ""
    };
}

export default {
    mounted() {
        let urlParams = new URLSearchParams(window.location.search);
        this.$data.name_like = urlParams.get("name_like");
        this.$data.email_like = urlParams.get("email_like");
        this.$data.role_like = urlParams.get("role_like");
    },
    data() {
        return initialState();
    },
    methods: {
        search() {
            let newUrl = window.location.origin + window.location.pathname;
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

            window.location.href = newUrl + queryString;
        },
        clear() {
            Object.assign(this.$data, initialState());
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
