<template>
    <div>
        <div class="form-group">
            <rentable-autocomplete @selected="rentableSelected" />
        </div>
        <div v-if="rentable" class="form-row">
            <div class="form-group col-md-4">
                <label for="date">Available Date</label>
                <input
                    type="text"
                    :value="rentable.date_of_hire | formatDate"
                    class="form-control"
                    placeholder="Date"
                    readonly
                />
            </div>
            <div class="form-group col-md-4">
                <label for="start_time">Available Start Time</label>
                <input
                    type="time"
                    id="start_time"
                    :value="rentable.start_time | formatTime"
                    class="form-control"
                    placeholder="Start Time"
                    readonly
                />
            </div>
            <div class="form-group col-md-4">
                <label for="end_time">Available End Time</label>
                <input
                    type="time"
                    id="end_time"
                    :value="rentable.end_time | formatTime"
                    class="form-control"
                    placeholder="Start Time"
                    readonly
                />
            </div>
        </div>
    </div>
</template>

<script>
import RentableAutocomplete from "./RentableAutocomplete";
import moment from "moment";

Vue.filter("formatDate", function(value) {
    if (value) {
        return moment(String(value)).format("DD-MM-YYYY");
    }
});

Vue.filter("formatTime", function(value) {
    if (value) {
        value = new Date("01/01/1970 " + value);
        return moment(value).format("HH:mm");
    }
});

export default {
    data() {
        return {
            rentable: null
        };
    },
    methods: {
        rentableSelected(output) {
            this.rentable = output;
        }
    },
    components: {
        RentableAutocomplete
    }
};
</script>

<style></style>
