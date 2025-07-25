<script lang="ts" setup>
    interface Props {
        info: any
    }
    const props = defineProps<Props>()
</script>

<template>
    <div class="card-jetzt-container position-relative p-3">
        <img :src="info.img" alt="">
        <div class="title mt-3">
            <span class="fw-bold">{{ info.title }}</span>
        </div>
        <p class="truncate truncate--4">{{ info.description }}</p>

        <div class="jetzt-button position-absolute">
            <a href="#">Jetzt {{ info.buttonLabel }}</a>
            <img src="~assets/images/icons/arrow-right.svg" height="18px" alt="">
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .card-jetzt-container {
        height: 258px;
        border-radius: 4px;
        border: 1px solid $gray2;
        max-width: 300px;

        .title {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .jetzt-button {
            bottom: 1rem;
            a {
                text-decoration: none;
            }
        }
    }
</style>
