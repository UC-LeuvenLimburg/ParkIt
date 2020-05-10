<template>
    <div class="map-holder">
        <HereMapSearchbar
            :apikey="apikey"
            class="searchbar"
            @search="handleSearch"
            @clear="handleClear"
        >
        </HereMapSearchbar>
        <div ref="map" class="map"></div>
    </div>
</template>

<script>
import HereMapSearchbar from "./HereMapSearchbar";
import moment from "moment";
export default {
    name: "heremap",
    props: {},
    data() {
        return {
            apikey: "wIrLYhE1R2UaGWbY369VpRZHSKDrPLD_SXOsnOpK-1A",
            map: {},
            platform: {},
            defaultLayers: {},
            mapEvents: {},
            behaviour: {},
            icon: {},
            group: {},
            ui: {},
            marker: {},
            position: {},
            mapdata: {},
            bubble: {},
            rentables: {},
            search_filter: {},
            filteredRentables: {}
        };
    },
    created() {
        axios.get("/web/api/all/rentables").then(response => {
            this.rentables = response.data;
            this.addRentablesToMap(this.rentables);
        });
        // Initialize the platform object:
        this.platform = new H.service.Platform({
            apikey: this.apikey
        });
    },
    mounted() {
        // Obtain the default map types from the platform object
        this.defaultLayers = this.platform.createDefaultLayers();
        this.map = new H.Map(
            this.$refs.map,
            this.defaultLayers.vector.normal.map,
            {
                zoom: 13
            }
        );
        // Add traffic
        this.map.addLayer(this.defaultLayers.vector.normal.traffic);
        // Enable the event system on the map instance:
        this.mapEvents = new H.mapevents.MapEvents(this.map);
        // Instantiate the default behavior, providing the mapEvents object:
        this.behavior = new H.mapevents.Behavior(this.mapEvents);
        // Create a marker icon from an image URL:
        this.icon = new H.map.Icon("/images/parkitMapIcon.png", {
            anchor: { x: 20, y: 20 }
        });
        // Create the default UI:
        this.ui = H.ui.UI.createDefault(this.map, this.defaultLayers);
        // Create group and add markers
        this.group = new H.map.Group();
    },
    methods: {
        getUserCoordinates() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    this.lat = position.coords.latitude;
                    this.lng = position.coords.longitude;
                });
            } else {
                console.warn(
                    "geolocation is disabled or not supported on this browser"
                );
            }
        },
        clearMap() {
            this.map.removeObjects(this.map.getObjects());
            this.group.removeObjects(this.group.getObjects());
        },
        addRentablesToMap(rentables) {
            this.clearMap();
            for (let i = 0; i < rentables.length; i++) {
                this.addRentableMarkerToMap(rentables[i]);
            }
            this.CenterMapByGroup();
            this.map.addObject(this.group);
        },
        convertRenatbleTimeToMomentJS(time) {
            let newTime = new Date("01/01/1970 " + time);
            return moment(newTime).format("HH:mm");
        },
        addRentableMarkerToMap(rentable) {
            let marker = this.createMarkerFromRentable(rentable);
            this.addMarkerEventListeners(marker);
            this.group.addObject(marker);
        },
        createMarkerFromRentable(rentable) {
            // Conver Time formats
            let startTimeString = this.convertRenatbleTimeToMomentJS(
                rentable.start_time
            );
            let endTimeString = this.convertRenatbleTimeToMomentJS(
                rentable.end_time
            );

            // Create a marker using the previously instantiated icon:
            return new H.map.Marker(
                { lat: rentable.lat, lng: rentable.lng },
                {
                    icon: this.icon,
                    data:
                        "<div style='width: 170px; font-size: 1.3em; font-weight: 600'>" +
                        rentable.adress +
                        "</div>" +
                        "Price: " +
                        rentable.price +
                        " &euro;/h" +
                        "<br>" +
                        "&#x1F554; " +
                        startTimeString +
                        " until " +
                        endTimeString +
                        "<a href='/rentables/" +
                        rentable.id +
                        "' class='btn btn-info btn-sm'>Show</a>"
                }
            );
        },
        addMarkerEventListeners(marker) {
            // Add event listener:
            marker.addEventListener("tap", event => {
                let position = event.target.getGeometry(); //marker zelf op deze plaats

                let mapdata = event.target.getData();
                // Create an info bubble object at a specific geographic location:
                //var bubble = new H.ui.InfoBubble(markerPosities[i].position, { content: markerPosities[i].title });
                let bubble = new H.ui.InfoBubble(position, {
                    content: mapdata
                });

                // Add info bubble to the UI:
                this.ui.addBubble(bubble);
            });
        },
        CenterMapByGroup() {
            //   get geo bounding box for the group and set it to the map
            this.map.getViewModel().setLookAtData({
                bounds: this.group.getBoundingBox()
            });
        },
        CenterMapBySearch() {
            //   Center map around the search request
            this.map.setCenter({
                lat: this.search_filter.lat,
                lng: this.search_filter.lng
            });
            this.map.setZoom(12);
        },
        handleSearch(event) {
            this.search_filter = event;
            this.searchForMatchingRentables();
        },
        handleClear() {
            this.addRentablesToMap(this.rentables);
        },
        searchForMatchingRentables() {
            if (this.search_filter.date_of_hire == null) {
                this.filteredRentables = this.rentables
                    .filter(
                        rentable =>
                            rentable.lat <=
                                this.search_filter.lat +
                                    this.search_filter.range &&
                            rentable.lat >=
                                this.search_filter.lat -
                                    this.search_filter.range
                    )
                    .filter(
                        rentable =>
                            rentable.lng <=
                                this.search_filter.lng +
                                    this.search_filter.range &&
                            rentable.lng >=
                                this.search_filter.lng -
                                    this.search_filter.range
                    );
            } else {
                this.filteredRentables = this.rentables
                    .filter(rentable =>
                        moment(String(rentable.date_of_hire)).isSame(
                            this.search_filter.date_of_hire,
                            "day"
                        )
                    )
                    .filter(
                        rentable =>
                            rentable.lat <=
                                this.search_filter.lat +
                                    this.search_filter.range &&
                            rentable.lat >=
                                this.search_filter.lat -
                                    this.search_filter.range
                    )
                    .filter(
                        rentable =>
                            rentable.lng <=
                                this.search_filter.lng +
                                    this.search_filter.range &&
                            rentable.lng >=
                                this.search_filter.lng -
                                    this.search_filter.range
                    );
            }
            this.addRentablesToMap(this.filteredRentables);
            this.CenterMapBySearch();
        }
    },
    components: {
        HereMapSearchbar
    }
};
</script>

<style scoped>
.map-holder {
    position: relative;
}
.map {
    width: 102%;
    height: 350px;
    margin: 0 -1rem;
}
</style>
