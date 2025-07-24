// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  app: {
    pageTransition: { name: 'fade', mode: 'out-in' },
    layoutTransition: { name: 'layout', mode: 'out-in' },
    head: {
      charset: 'utf-8',
      viewport: 'width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0',
      script: [{
          src: '//dist.eventscalendar.co/embed.js',
          type: 'text/javascript'
        }
    ]
    },
    title: 'WeltSparen'
  },
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@bootstrap-vue-next/nuxt', '@nuxt/image'],
  css: [
    '@/assets/scss/global.scss',
    'bootstrap/dist/css/bootstrap.min.css'
  ],
  vite: {
    css: {
      preprocessorOptions: {
        scss: {
          
          api: 'modern',
          silenceDeprecations: ['mixed-decls'],
          additionalData: `@use "~/assets/scss/_media-queries.scss" as *; 
                            @use "~/assets/scss/_colors.scss" as *;
                            @use "~/assets/scss/_fonts.scss" as *;`,
        },
      },
    },
  },
})