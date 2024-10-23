<template>
    <Head title="Home">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
    </Head>

    <body class="bg-gray-100">
        <Navigation />

        <main
            class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen"
        >
            <slot></slot>
        </main>

        <Footer />
    </body>
</template>

<script setup>
import Footer from "@/Shared/Footer.vue";
import Navigation from "@/Shared/Nav.vue";
import { Head } from "@inertiajs/vue3";
</script>
