<template>
    <div ref="map" class="map"></div>
</template>

<script>
export default {
    name: "heremap",
    props: {},
    data() {
        return {
            apikey: "wIrLYhE1R2UaGWbY369VpRZHSKDrPLD_SXOsnOpK-1A",
            map: {},
            platform: {},
            defaultLayers: {},
            lat: 50.92906,
            lng: 5.39559,
            mapEvents: {},
            behaviour: {},
            icon: {},
            group: {},
            ui: {},
            marker: {},
            position: {},
            mapdata: {},
            bubble: {},
            rentables: {}
        };
    },
    created() {
        axios.get("/web/api/all/rentables").then(response => {
            this.rentables = response.data;
            this.addRentablesToMap();
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
                zoom: 13,
                center: { lng: this.lng, lat: this.lat }
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
        this.map.addObject(this.group);
    },
    methods: {
        addRentablesToMap() {
            for (let i = 0; i < this.rentables.length; i++) {
                // Create a marker using the previously instantiated icon:
                this.marker = new H.map.Marker(
                    { lat: this.rentables[i].lat, lng: this.rentables[i].long },
                    {
                        icon: this.icon,
                        data:
                            this.rentables[i].adress +
                            "<br>" +
                            "price:" +
                            this.rentables[i].price +
                            "<br>" +
                            this.rentables[i].start_time +
                            " until " +
                            this.rentables[i].end_time
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
        },
        handleMarkerTapEvent() {}
    }
};
</script>

<style scoped>
.map {
    width: 102%;
    height: 350px;
    margin: 0 -1rem;
}
</style>
