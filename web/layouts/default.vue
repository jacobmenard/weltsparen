<script lang="ts" setup>

</script>

<template>
    <div class="default-layout-container">

        <layout-header></layout-header>

        <div class="main-default-container">
            <slot></slot>
        </div>


        <layout-footer></layout-footer>
        
    </div>
</template>

<style lang="scss" scoped>
    .main-default-container {
        min-height: 500px;
    }
</style>
