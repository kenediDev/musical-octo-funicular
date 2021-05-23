<template>
  <div>
    <div class="headers">
      <!-- Another -->
      <div class="ano-bor"></div>
      <div class="grids">
        <div class="cols">
          <div class="content">
            <div class="title">
              <h3>It's not just coffe</h3>
              <h3>It's Dua Arah</h3>
              <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book
              </p>
              <div class="group">
                <button>Pesan</button>
                <button>Buka Rute</button>
              </div>
            </div>
          </div>
        </div>
        <div class="cols">
          <div class="vertical">
            <img
              src="https://lh3.googleusercontent.com/proxy/bsPEBXxBUSquNwWplkGEtljPQ58TISdHz5lxdkXIrdTM_NPNixzZfdSg8B5pBBTwP-zVmKwpP9ntruQGdPY0gR_V_xfoL4hz3mdi6YWBDhfjCPhC-Z0h"
              alt=""
              class="coffe-icon"
            />
            <h5>Special Hari ini</h5>
            <span class="name">coffee latte ice</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";

@Component({})
export default class HomeScreen extends Vue {
  background: string = `http://${window.location.host}/images/185897306_1135617650252054_1164314287579690262_n.jpeg`;
}
</script>


<style lang="scss" scoped>
@import "../assets/home.scss";
</style>