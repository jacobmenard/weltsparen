<script lang="ts" setup>

</script>

<template>
    <b-container class="main-header-container d-flex align-items-center">
        

        <b-navbar class="w-menu-container" toggleable="lg">
            <BNavbarBrand href="/" class="mr-5"><img src="~assets/images/company_logo.svg" alt=""></BNavbarBrand>
            <BNavbarToggle target="nav-collapse" />
            <BNavbarNav class="w-menu">

                <BNavItemDropdown text="Save" no-caret class="mx-3 fw-bold">
                    <BDropdownItem href="#">EN</BDropdownItem>
                    <BDropdownItem href="#">ES</BDropdownItem>
                    <BDropdownItem href="#">RU</BDropdownItem>
                    <BDropdownItem href="#">FA</BDropdownItem>
                </BNavItemDropdown>

                <BNavItemDropdown text="Invest" no-caret class="mx-3 fw-bold">
                    <BDropdownItem href="#">EN</BDropdownItem>
                    <BDropdownItem href="#">ES</BDropdownItem>
                    <BDropdownItem href="#">RU</BDropdownItem>
                    <BDropdownItem href="#">FA</BDropdownItem>
                </BNavItemDropdown>
                
                <BNavItemDropdown text="Financial knowledge" no-caret class="mx-3 fw-bold">
                    <BDropdownItem href="#">EN</BDropdownItem>
                    <BDropdownItem href="#">ES</BDropdownItem>
                    <BDropdownItem href="#">RU</BDropdownItem>
                    <BDropdownItem href="#">FA</BDropdownItem>
                </BNavItemDropdown>
                
                <BNavItemDropdown text="Help" no-caret class="mx-3 fw-bold">
                    <BDropdownItem href="#">EN</BDropdownItem>
                    <BDropdownItem href="#">ES</BDropdownItem>
                    <BDropdownItem href="#">RU</BDropdownItem>
                    <BDropdownItem href="#">FA</BDropdownItem>
                </BNavItemDropdown>
            </BNavbarNav>
        </b-navbar>
    </b-container>
</template>

<style lang="scss" scoped>
    .main-header-container {
        height: 60px;

        .w-menu-container {
            .w-menu {
                margin-left: 2rem;
            }
        }
    }
</style>
