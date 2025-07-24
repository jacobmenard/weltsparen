<script lang="ts" setup>

</script>

<template>
    <div class="default-layout-container">

        <layout-header></layout-header>

        <b-container class="main-default-container">
            <slot></slot>
        </b-container>


        <layout-footer></layout-footer>
        
    </div>
</template>

<style lang="scss" scoped>
    .main-default-container {
        min-height: 500px;
    }
</style>
