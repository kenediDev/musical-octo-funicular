<template>
  <div>
    <!-- Navbar Top -->
    <div class="nav">
      <icon :src="logo" class="icon" />
      <div class="group" id="web">
        <a href="" class="active">
          <icon :src="home" class="icon" />
          <span>Home</span>
        </a>
        <a href="">
          <icon :src="menu" class="icon" />
          <span>Menu</span>
        </a>
        <a href="">
          <icon :src="newspaper" class="icon" />
          <span>What's New</span>
        </a>
        <a href="">
          <icon :src="contact" class="icon" />
          <span>Contact Us</span>
        </a>
        <a href="" class="login">
          <span>Log in</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="block-nav"></div>
    <!-- Notification -->
    <div
      :class="
        notice === 1 ? 'nav-paper' : notice === 2 ? 'nav-paper-close' : 'hidden'
      "
    >
      <div class="group">
        <span>Ikuti Kami</span>
        <button class="box" id="box-mr">
          <icon :src="facebook" class="icon" />
        </button>
        <div class="box" id="box-mr">
          <icon :src="instagram" class="icon" />
        </div>
        <div class="box">
          <icon :src="twitter" class="icon" />
        </div>
      </div>
      <i class="fas fa-times" @click="clickNotice()"></i>
    </div>
    <!-- Navbar Bottom -->
    <div class="nav-bottom">
      <button
        :class="choice === 'home' ? 'active' : ''"
        @click="clickChoice('home')"
      >
        <icon :src="home" class="icon" />
        <span v-if="choice === 'home'">Home</span>
      </button>
      <button
        :class="choice === 'menu' ? 'active' : ''"
        @click="clickChoice('menu')"
      >
        <icon :src="menu" class="icon" />
        <span v-if="choice === 'menu'"> menu </span>
      </button>
      <button
        :class="choice === 'news' ? 'active' : ''"
        @click="clickChoice('news')"
      >
        <icon :src="newspaper" class="icon" />
        <span v-if="choice === 'news'"> news </span>
      </button>
      <button
        :class="choice === 'contact' ? 'active' : ''"
        @click="clickChoice('contact')"
      >
        <icon :src="contact" class="icon" />
        <span v-if="choice === 'contact'"> contact </span>
      </button>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";
import logo from "./media/148702861_172413527739423_1030808571604752175_n (3).svg";
import home from "./media/house (1).svg";
import menu from "./media/menu.svg";
import newspaper from "./media/newspaper.svg";
import contact from "./media/complain.svg";
import Instgram from "./media/instagram.svg";
import Facebook from "./media/facebook.svg";
import Twitter from "./media/twitter.svg";

@Component({})
export default class NavbarComponent extends Vue {
  // Media
  logo = logo;
  home = home;
  menu = menu;
  newspaper = newspaper;
  contact = contact;
  facebook = Facebook;
  instagram = Instgram;
  twitter = Twitter;
  // State
  choice: string = "home";
  notice: number = 1;
  // bind
  clickChoice(args: string) {
    this.choice = args;
  }

  clickNotice() {
    if (!this.notice) {
      this.notice = 1;
    } else if (this.notice === 1) {
      localStorage.setItem("notice", "hidden");
      this.notice = 2;
    } else this.notice = 1;
  }
  beforeMount() {
    if (localStorage.getItem("notice")) {
      this.notice = 0;
    }
  }
}
</script>

<style lang="scss" scoped>
@import "./assets/navbar.scss";
</style>