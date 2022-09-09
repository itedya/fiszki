<script setup>
import AppNavbar from "./components/AppNavbar.vue";
import ErrorModal from "./components/ErrorModal.vue";
</script>

<template>
    <error-modal />
    <app-navbar></app-navbar>
    <router-view></router-view>
</template>
