<script lang="ts" setup>

</script>

<template>
    <div class="f-main-container">
        <div class="f-rate-cotnainer d-flex algin-items-center">
            
            <b-container class="d-flex algin-items-center justify-content-between gap-10">
                <div class="d-flex gap-32">
                    <div><span>How our customers rate us:</span></div>
                    <div><img src="~assets/images/footer/trustpilot-ratings.png" height="25" alt=""></div>
                    <div><span>Based on 9,443 reviews</span></div>
                </div>
                <div class="w-trust-pilot d-flex">
                    <img src="~assets/images/footer/trustpilot.png" height="25" alt="">
                </div>
            </b-container>

        </div>

        <div class="f-menu-container">
            <b-container class="d-flex gap-16">
                <div class="w-100">
                    <span class="d-block title fw-bold mb-2">Pursue</span>
                    <ul class="no-bullet padding-left-0">
                        <li class="cursor-pointer mb-1">About WeltSparen</li>
                        <li class="cursor-pointer mb-1">Awards & Prizes</li>
                        <li class="cursor-pointer mb-1">Sustainability Disclosure</li>
                        <li class="cursor-pointer mb-1">Press</li>
                        <li class="cursor-pointer mb-1">Experiences with WeltSparen</li>
                        <li class="cursor-pointer mb-1">Career</li>
                        <li class="cursor-pointer mb-1">Raisin newsletter</li>
                        <li class="cursor-pointer mb-1">Raisin Bank</li>
                    </ul>
                </div>
                <div class="w-100">
                    <span class="d-block title fw-bold mb-2">Products</span>
                    <ul class="no-bullet padding-left-0">
                        <li class="cursor-pointer mb-1">Fixed deposit</li>
                        <li class="cursor-pointer mb-1">Sustainable fixed-term deposits</li>
                        <li class="cursor-pointer mb-1">Daily money comparison Stiftung Warentest</li>
                        <li class="cursor-pointer mb-1">Savings plan</li>
                        <li class="cursor-pointer mb-1">Investment products</li>
                        <li class="cursor-pointer mb-1">Digital asset management</li>
                        <li class="cursor-pointer mb-1">Rürup pension</li>
                        <li class="cursor-pointer mb-1">Riester pension</li>
                    </ul>
                </div>
                <div class="w-100">
                    <span class="d-block title fw-bold mb-2">Support & Information</span>
                    <ul class="no-bullet padding-left-0">
                        <li class="cursor-pointer mb-1">Contact</li>
                        <li class="cursor-pointer mb-1">Frequently Asked Questions</li>
                        <li class="cursor-pointer mb-1">Steer</li>
                        <li class="cursor-pointer mb-1">WeltSparen app</li>
                        <li class="cursor-pointer mb-1">Newsletter</li>
                        <li class="cursor-pointer mb-1">Financial Dictionary</li>
                        <li class="cursor-pointer mb-1">Conditions</li>
                        <li class="cursor-pointer mb-1">Complaint management</li>
                    </ul>
                </div>
                <div class="w-100">
                    <span class="d-block title fw-bold mb-2">For customers & partners</span>
                    <ul class="no-bullet padding-left-0">
                        <li class="cursor-pointer mb-1">Recruit customers</li>
                        <li class="cursor-pointer mb-1">Events</li>
                        <li class="cursor-pointer mb-1">Daily money comparison Stiftung Warentest</li>
                        <li class="cursor-pointer mb-1">Affiliate</li>
                    </ul>
                </div>
            </b-container>
        </div>

        <div class="f-apps-container d-flex align-items-center justify-content-between">
            <b-container class="f-main-container d-flex justify-content-between align-items-center">
                <div class="f-apps-left d-flex align-items-center gap-16">
                    <img src="~assets/images/footer/app-icon-80.svg" alt="">

                    <div class="max-width-700">
                        <span class="fw-bold mb-2 d-block">
                            Want to check your investments in the app while on the go?
                        </span>
                        <span>
                            With the WeltSparen app, you always have your WeltSpar account quickly at hand and can start new investments with just a few clicks.
                        </span>
                    </div>
                </div>


                <div class="f-apps-right">
                    <img src="~assets/images/footer/google-play.svg" :height="50" class="object-fit-contain" alt="">
                    <img src="~assets/images/footer/apple-store.svg" :height="50" class="object-fit-contain" alt="">
                </div>
            </b-container>
        </div>

        <div class="f-social-media-container">
            
            <b-container class=" d-flex justify-content-between align-items-center gap-16">
                <div class="f-sm-left d-flex alignt-items-center gap-10">
                    <img src="~assets/images/footer/climate-action.svg" :height="35" class="object-fit-contain" alt="">
                    <img src="~assets/images/footer/TK45015_Prüfzeichen_Raisin.svg" :height="35" class="object-fit-contain" alt="">
                </div>
                
                <div class="f-sm-left d-flex alignt-items-center gap-10">
                    <div>
                        <span>Follow us on</span>
                    </div>
                    <img src="~assets/images/social-media/facebook-logo.svg" :height="30" class="object-fit-contain" alt="">
                    <img src="~assets/images/social-media/indeed.svg" :height="30" class="object-fit-contain" alt="">
                    <img src="~assets/images/social-media/instagram.svg" :height="30" class="object-fit-contain" alt="">
                    <img src="~assets/images/social-media/youtube.svg" :height="30" class="object-fit-contain" alt="">
                </div>
            </b-container>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .f-main-container {
        .f-rate-cotnainer {
            padding: 27px 0;
            background-color: $gray1;
        }

        .f-apps-container {
            background-color: $gray1;
            padding: 40px 0;
            .f-apps-left {

            }
        }

        .f-social-media-container {
            padding: 27px 0;
        }

        .f-menu-container {
            padding: 40px 0;

            .title {
                font-size: 18px;
            }
        }

        .no-bullet {
            list-style-type: none;
        }
    }
</style>
