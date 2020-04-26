<template>
    <div ref="map"></div>
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
            markerPositions: [
                {
                    title: "UCLL Diepenbeek 390 free spaces",
                    position: { lat: 50.92906, lng: 5.39559 }
                }
            ],
            goup: {}
        };
    },
    created() {
        // Initialize the platform object:
        this.platform = new H.service.Platform({
            apikey: this.apikey
        });
    },
    mounted() {
        console.log("hello from map");
        // Obtain the default map types from the platform object
        this.defaultLayers = platform.createDefaultLayers();
        this.map = new H.Map(
            this.$refs.map,
            this.defaultLayers.vector.normal.map,
            {
                zoom: 10,
                center: { lng: this.lng, lat: this.lat }
            }
        );
        // // Add traffic
        // this.map.addLayer(this.defaultLayers.vector.normal.traffic);
        // // Enable the event system on the map instance:
        // this.mapEvents = new H.mapevents.MapEvents(map);
        // // Instantiate the default behavior, providing the mapEvents object:
        // this.behavior = new H.mapevents.Behavior(this.mapEvents);
        // // Create a marker icon from an image URL:
        // this.icon = new H.map.Icon("/images/logoParkSpace.png", {
        //     anchor: { x: 20, y: 20 }
        // });
        // // Create group and add markers
        // this.group = new H.map.Group();
        // this.map.addObject(this.group);
    }
};
</script>

<style></style>
