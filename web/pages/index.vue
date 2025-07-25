<script lang="ts" setup>
    import img1 from '@/assets/images/icons/festgeld.svg'
    import img2 from '@/assets/images/icons/tagesgeld.svg'
    import img3 from '@/assets/images/icons/Vermogensverwaltung.svg'
    import img4 from '@/assets/images/icons/rurup.svg'
    const jetzt = ref([
        {
            title: 'Festgeld',
            description: 'Attraktive Zinsen sichern mit bis zu 3,00 % p. a.',
            img: img1,
            buttonLabel: 'sparen'
        },
        {
            title: 'Tagesgeld',
            description: 'Flexibel sparen und bis zu 2,06 % p. a. erhalten. Für viele Angebote ist ein Sparplan verfügbar.',
            img: img2,
            buttonLabel: 'sparen'
        },
        {
            title: 'Vermögensverwaltung',
            description: 'Global diversifiziert anlegen in über 8.000 Aktien und mit bis zu 7,40 % p. a. Zielrendite.',
            img: img3,
            buttonLabel: 'investieren'
        },
        {
            title: 'ETF Rürup',
            description: 'Kosteneffizient für das Alter vorsorgen und dieses Jahr noch über 29.000 € von der Steuer absetzen.',
            img: img4,
            buttonLabel: 'investieren'
        }
    ])
</script>

<template>
    <div class="landing-page-container">
        <div class="landing-header-container d-flex flex-column justify-content-center padding-top-60 padding-bottom-50">
            <b-container class="d-flex align-items-center justify-content-between">
                <div class="left max-width-680">
                    <h1>Die einfach bessere Lösung für Spar- und Investmentziele</h1>
                    <p>Gestalten Sie Ihre finanzielle Zukunft mit unseren kostenlosen Tages- und Festgeldkonten sowie unserem ausgezeichneten Investmentangebot.</p>
                    <p>Als neuer Hauptsponsor von Union Berlin blicken wir auf eine starke Saison – im Fußball und stets für Ihre Finanzen.</p>

                    <div class="d-flex gap-16 margin-top-24">
                        <b-button variant="w-primary">Kostenloses Konto eröffnen</b-button>
                        <b-button variant="w-default">Zum Festgeld-Vergleich</b-button>
                    </div>
                </div>

                <div class="right">
                    <nuxt-img src="/robo-advisor-performance.png" height="400" densities="x1 x2"></nuxt-img>
                </div>
            </b-container>

            <b-container class="mt-4">
                <p>Bitte beachten Sie unsere 
                    <a href="/Risikohinweise">Risikohinweise</a>
                </p>
            </b-container>
        </div>

        <b-container class="jetzt d-flex justify-content-center gap-30">
            <card-jetzt v-for="(item, i) in jetzt" :key="`jetzt-${i}`" :info="item"></card-jetzt>
        </b-container>

        <div class="section-third">
            <b-container class=" d-flex justify-content-center align-items-center gap-30">
                <card-third-section>
                    <template #img>
                        <img src="~assets/images/icons/customers.svg" height="48" alt="">
                    </template>
                    <template #description>
                        > 1.000.000<br>aktive Anleger weltweit
                    </template>
                </card-third-section>

                <div class="trustpilot-container d-flex justify-content-center align-items-center flex-column gap-10 p-3">
                    <div>
                        <img src="~assets/images/footer/trustpilot.png" height="48" alt="">
                    </div>
                    <div>
                        <img src="~assets/images/footer/trustpilot-ratings.png" height="30" alt="">
                    </div>
                    <p class="fw-bold">Basierend auf 9.445 Bewertungen</p>
                </div>
                
                <card-third-section>
                    <template #img>
                        <img src="~assets/images/icons/location-pin.svg" height="48" alt="">
                    </template>
                    <template #description>
                        In 10 Ländern<br>in Europa und den USA aktiv
                    </template>
                </card-third-section>

                <card-third-section>
                    <template #img>
                        <img src="~assets/images/icons/savings.svg" height="48" alt="">
                    </template>
                    <template #description>
                        > 1.000.000<br>aktive Anleger weltweit
                    </template>
                </card-third-section>

            </b-container>
        </div>

        <b-container class="section-fourth">
            <h2 class="fw-bold gray3">Top Angebote bei WeltSparen</h2>
        </b-container>
    </div>
</template>

<style lang="scss">
    .landing-page-container {

        .landing-header-container {
            min-height: 508px;
            background-color: $bg_landing;
        }
        .jetzt {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .section-third {
            background-color: $gray1;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .section-fourth {
            padding-top: 60px;
            padding-bottom: 60px;
        }
    }
</style>
