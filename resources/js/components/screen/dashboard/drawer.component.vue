<template>
  <div
    :class="
      dashboard.drawer === 1
        ? 'drawers'
        : dashboard.drawer === 2
        ? 'drawers-close'
        : 'hidden'
    "
  >
    <div class="drawer">
      <div class="drawer-logo">
        <icon :src="logo" class="logo" />
        <button @click="closeDrawer()">
          <icon :src="left" class="icon" fill="#2b6d4c" />
        </button>
      </div>
      <div class="drawer-author">
        <div class="drawer-profile">
          <img
            src="https://i.pinimg.com/originals/4d/8a/cb/4d8acb3d351a127cc823135ff3c3d421.jpg"
            alt=""
            class="avatar"
          />
          <div class="vertical">
            <a href="" class="nickname"> First Name and last name </a>
            <div class="status">Admin</div>
          </div>
        </div>
      </div>
      <div class="drawer-content">
        <div class="drawer-list">
          <div class="drawer-list-title">general</div>
          <button class="active">
            <icon :src="time" class="icon" fill="#2b6d4c" />
            <span>App</span>
          </button>
          <button>
            <icon :src="shop" class="icon" fill="rgb(99, 115, 129)" />
            <span>E-Ecommerce</span>
          </button>
          <button>
            <icon :src="analytics" class="icon" fill="rgb(99, 115, 129)" />
            <span>E-Analytics</span>
          </button>
        </div>
        <div class="drawer-list" id="management">
          <div class="drawer-list-title">Management</div>
          <button>
            <div class="group">
              <icon :src="user" class="icon" fill="#2b6d4c" />
              <span>User</span>
            </div>
            <icon :src="right" class="icon" id="arrows" />
          </button>
          <button>
            <div class="group">
              <icon :src="cart" class="icon" fill="#2b6d4c" />
              <span>E-Commerce</span>
            </div>
            <icon :src="right" class="icon" id="arrows" />
          </button>
        </div>
        <div class="drawer-list">
          <div class="drawer-list-title">App</div>
          <button>
            <icon :src="mail" class="icon" fill="rgb(99, 115, 129)" />
            <span>Mail</span>
          </button>
          <button>
            <icon :src="chat" class="icon" fill="rgb(99, 115, 129)" />
            <span>Chat</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import time from "../../media/dashboard (3).svg";
import shop from "../../media/shopping-bag.svg";
import analytics from "../../media/dashboard (2).svg";
import user from "../../media/user.svg";
import cart from "../../media/shopping-cart.svg";
import mail from "../../media/email (1).svg";
import chat from "../../media/chat.svg";
import down from "../../media/chevron-arrow-down.svg";
import right from "../../media/right-chevron.svg";
import left from "../../media/chevron-pointing-to-the-left.svg";

@Component({})
export default class DrawerComponent extends Vue {
  // Props
  @Prop(Object) dashboard: any;
  @Prop() logo: any;
  //   Props Bind
  @Emit()
  closeDrawer() {
    this.$emit("closeDrawer");
  }
  // Media
  left = left;
  down = down;
  right = right;
  user = user;
  cart = cart;
  mail = mail;
  chat = chat;
  analytics = analytics;
  time = time;
  shop = shop;
}
</script>


<style lang="scss" scoped>
@import "../../assets/dashboard.scss";
</style>