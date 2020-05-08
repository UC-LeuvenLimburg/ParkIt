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
            <div class="form-group col-md-4">
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
export default {};
</script>

<style></style>
