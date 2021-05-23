<template>
  <div>
    <navbar />
    <router-view></router-view>
    <div class="block"></div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";
import navbar from "./navbar.component.vue";

@Component({
  components: {
    navbar,
  },
})
export default class BaseComponent extends Vue {}
</script>

<style lang="scss" scoped>
@import url("https://use.fontawesome.com/releases/v5.15.3/css/all.css");
@import url("https://fonts.googleapis.com/css2?family=Carter+One&family=Kanit&family=Open+Sans&display=swap");
// font-family: 'Carter One', cursive;
// font-family: 'Kanit', sans-serif;
// font-family: 'Open Sans', sans-serif;
.block {
  height: 300px;
}
</style>