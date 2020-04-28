<template>
    <div>
        <div class="form-group">
            <rentable-autocomplete @selected="rentableSelected" />
        </div>
        <div v-if="rentable" class="form-row">
            <div class="form-group col-md-4">
                <label for="date">Date</label>
                <input
                    type="date"
                    :value="rentable.date_of_hire"
                    class="form-control"
                    placeholder="Date"
                    readonly
                />
            </div>
            <div class="form-group col-md-4">
                <label for="start_time">Start Time</label>
                <input
                    type="time"
                    id="start_time"
                    name="start_time"
                    :value="rentable.start_time"
                    class="form-control"
                    placeholder="Start Time"
                    readonly
                />
            </div>
            <div class="form-group col-md-4">
                <label for="end_time">End Time</label>
                <input
                    type="time"
                    id="end_time"
                    name="end_time"
                    :value="rentable.end_time"
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
