<template>
    <div class="searchbar">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name_filter">Name Filter</label>
                <input
                    type="text"
                    name="name_filter"
                    id="name_filter"
                    v-model="name_filter"
                    class="form-control"
                    placeholer="Name"
                />
            </div>
            <div class="form-group col-md-4">
                <label for="email_filter">Email Filter</label>
                <input
                    type="email"
                    name="email_filter"
                    id="email_filter"
                    v-model="email_filter"
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
                    v-model="role_filter"
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
        name_filter: "",
        email_filter: "",
        role_filter: ""
    };
}

export default {
    data() {
        return initialState();
    },
    methods: {
        search() {},
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
