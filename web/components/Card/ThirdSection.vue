<script lang="ts" setup>

</script>

<template>
    <div class="third-section-container d-flex align-items-center justify-content-center flex-column gap-20">
        <slot name="img">
            <img src="~assets/images/icons/customers.svg" height="48" alt="">
        </slot>
        <p class="description text-center truncate truncate--2">
            <slot name="description">> 1.000.000 aktive Anleger weltweit</slot>
        </p>
    </div>
</template>

<style lang="scss" scoped>
    .third-section-container {
        max-width: 300px;

        .description {
            padding: 0 20px;
            font-weight: 700;
        }
    }
</style>
