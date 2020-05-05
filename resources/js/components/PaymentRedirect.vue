<template>
    <div class="col-xl">
        <h4>
            Please wait a moment. You will be redirected in
            <span>{{ timerCount }}</span> Seconds
        </h4>
        <p>Wan't to go to the page now? Click <a href="/myleases"> here </a></p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            timerCount: 5
        };
    },

    watch: {
        timerCount: {
            handler(value) {
                if (value > 0) {
                    setTimeout(() => {
                        this.timerCount--;
                    }, 1000);
                }
            },
            immediate: true // This ensures the watcher is triggered upon creation
        }
    }
};
</script>

<style></style>
