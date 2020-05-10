<template>
    <div class="searchbar">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="adress_filter">Find Place</label>
                <input
                    type="text"
                    name="place_filter"
                    id="place_filter"
                    v-model="place_filter"
                    @keydown.enter.prevent="search"
                    class="form-control"
                    placeholer="Place"
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

function initialState() {
    return {
        platform: {},
        place_filter: "",
        date_of_hire_filter: null,
        lat: null,
        lng: null,
        range: 0.1
    };
}

export default {
    props: {
        apikey: {
            type: String,
            default: ""
        }
    },
    data() {
        return initialState();
    },
    created() {
        // Initialize the platform object:
        this.platform = new H.service.Platform({
            apikey: this.apikey
        });
    },
    methods: {
        search() {
            if (this.place_filter == "") {
                this.returnDefaultSearch();
                return;
            }
            this.geocode(this.place_filter);
        },
        clear() {
            Object.assign(this.$data, initialState());
            this.$emit("clear");
        },
        onDateFilter(changeEvent) {
            this.date_of_hire_filter = changeEvent;
            this.search();
        },
        /**
         * Calculates and displays the address details based on a free-form text
         *
         * A full list of available request parameters can be found in the Geocoder API documentation.
         * see: http://developer.here.com/rest-apis/documentation/geocoder/topics/resource-geocode.html
         *
         * @param {H.service.Platform} platform    A stub class to access HERE services
         */
        geocode(query) {
            let geocoder = this.platform.getGeocodingService(),
                geocodingParameters = {
                    searchText: query,
                    jsonattributes: 1
                };
            geocoder.geocode(
                geocodingParameters,
                result => {
                    let locations = result.response.view[0].result;
                    this.lat = locations[0].location.displayPosition.latitude;
                    this.lng = locations[0].location.displayPosition.longitude;
                    this.$emit("search", {
                        lat: this.lat,
                        lng: this.lng,
                        range: this.range,
                        date_of_hire: this.date_of_hire_filter
                    });
                },
                error => {}
            );
        },
        returnDefaultSearch() {
            this.$emit("search", {
                lat: null,
                lng: null,
                range: this.range,
                date_of_hire: this.date_of_hire_filter
            });
        }
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
