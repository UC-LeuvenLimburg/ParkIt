<template>
    <div class="map-holder">
        <HereMapSearchbar
            :apikey="apikey"
            class="searchbar"
            @search="handleSearch"
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
        clearMap() {
            this.map.removeObjects(this.map.getObjects());
        },
        addRentablesToMap(rentables) {
            this.clearMap();
            for (let i = 0; i < rentables.length; i++) {
                let startTime = new Date(
                    "01/01/1970 " + rentables[i].start_time
                );
                let startTimeString = moment(startTime).format("HH:mm");

                let endTime = new Date("01/01/1970 " + rentables[i].end_time);
                let endTimeString = moment(endTime).format("HH:mm");
                // Create a marker using the previously instantiated icon:
                this.marker = new H.map.Marker(
                    { lat: rentables[i].lat, lng: rentables[i].lng },
                    {
                        icon: this.icon,
                        data:
                            "<div style='width: 170px; font-size: 1.3em; font-weight: 600'>" +
                            rentables[i].adress +
                            "</div>" +
                            "Price: " +
                            rentables[i].price +
                            " &euro;/h" +
                            "<br>" +
                            "&#x1F554; " +
                            startTimeString +
                            " until " +
                            endTimeString +
                            "<a href='/rentables/" +
                            rentables[i].id +
                            "' class='btn btn-info btn-sm'>Show</a>"
                    }
                );

                // Add event listener:
                this.marker.addEventListener("tap", event => {
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

                this.group.addObject(this.marker);

                //   get geo bounding box for the group and set it to the map
                this.map.getViewModel().setLookAtData({
                    bounds: this.group.getBoundingBox()
                });
            }
            this.map.addObject(this.group);
        },
        handleSearch(event) {
            this.search_filter = event;
            this.searchForMatchingRentables();
        },
        searchForMatchingRentables() {
            console.log(this.search_filter);
            console.log(this.rentables[0].date_of_hire);
            console.log(moment(String(this.rentables[0].date_of_hire))._d);
            if (this.search_filter.date_of_hire == null) {
                this.filteredRentables = this.rentables
                    .filter(
                        rentable =>
                            rentable.lat <= this.search_filter.lat + 0.2 &&
                            rentable.lat >= this.search_filter.lat - 0.2
                    )
                    .filter(
                        rentable =>
                            rentable.lng <= this.search_filter.lng + 0.2 &&
                            rentable.lng >= this.search_filter.lng - 0.2
                    );
            } else {
                this.filteredRentables = this.rentables
                    .filter(
                        rentable =>
                            moment(String(rentable.date_of_hire))._d ==
                            this.search_filter.date_of_hire
                    )
                    .filter(
                        rentable =>
                            rentable.lat <= this.search_filter.lat + 0.5 &&
                            rentable.lat >= this.search_filter.lat - 0.5
                    )
                    .filter(
                        rentable =>
                            rentable.lng <= this.search_filter.lng + 0.5 &&
                            rentable.lng >= this.search_filter.lng - 0.5
                    );
            }
            this.addRentablesToMap(this.filteredRentables);
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
