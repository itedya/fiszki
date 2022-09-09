<script setup>
import AppNavbar from "./components/AppNavbar.vue";
import ErrorModal from "./components/ErrorModal.vue";
import InfoModal from "./components/InfoModal.vue";
</script>

<template>
    <info-modal/>
    <error-modal/>
    <app-navbar></app-navbar>
    <router-view></router-view>
</template>
