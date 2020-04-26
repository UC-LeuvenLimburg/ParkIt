<template>
    <div ref="map" style="width: 1100px; height: 350px"></div>
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
            group: {},
            ui: {},
            marker: {},
            position: {},
            mapdata: {},
            bubble: {}
        };
    },
    created() {
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
                zoom: 10,
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
        this.icon = new H.map.Icon("/images/logoParkSpace.png", {
            anchor: { x: 20, y: 20 }
        });
        // Create group and add markers
        this.group = new H.map.Group();
        this.map.addObject(this.group);

        // Create the default UI:
        this.ui = H.ui.UI.createDefault(this.map, this.defaultLayers);

        for (let i = 0; i < this.markerPositions.length; i++) {
            // Create a marker using the previously instantiated icon:
            this.marker = new H.map.Marker(this.markerPositions[i].position, {
                icon: this.icon,
                data: this.markerPositions[i].title
            });

            // Add event listener:
            this.marker.addEventListener("tap", function(event) {
                this.position = event.target.getGeometry(); //marker zelf op deze plaats

                this.mapdata = event.target.getData();
                // Create an info bubble object at a specific geographic location:
                //var bubble = new H.ui.InfoBubble(markerPosities[i].position, { content: markerPosities[i].title });
                this.bubble = new H.ui.InfoBubble(position, {
                    content: this.mapdata
                });

                // Add info bubble to the UI:
                this.ui.addBubble(this.bubble);

                this.map.setCenter(event.target.getPosition());
            });

            this.group.addObject(this.marker);
        }

        //   get geo bounding box for the group and set it to the map
        this.map.getViewModel().setLookAtData({
            bounds: this.group.getBoundingBox()
        });
    }
};
</script>

<style></style>
