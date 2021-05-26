<template>
  <div>
    <navbar v-if="navbar" v-on:clickRouter="clickRouter($event)" />
    <router-view
      :title="title"
      :description="description"
      :uname="name"
      :price="price"
      :photo="photo"
      :photo_url="photo_url"
      :gender="gender"
      :message="message"
      v-on:changeName="changeName($event)"
      v-on:changeTitle="changeTitle($event)"
      v-on:changeDescription="changeDescription($event)"
      v-on:changePrice="changePrice($event)"
      v-on:changePhoto="changePhoto($event)"
      v-on:clearInput="reset()"
      v-on:clickRouter="clickRouter($event)"
      v-on:changeGender="changeGender($event)"
      :me="me"
      v-on:updateField="updateField($event)"
      :calendar="calendar"
      v-on:changeCalendar="changeCalendar($event)"
    ></router-view>
    <message :message="message" />
    <!-- <div class="block"></div> -->
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";
import { mapGetters } from "vuex";
import navbar from "./navbar.component.vue";
import message from "./context/message.context.vue";
import { Update } from "../store/types/interface";

@Component({
  components: {
    navbar,
    message,
  },
  computed: {
    ...mapGetters(["message", "me"]),
  },
})
export default class BaseComponent extends Vue {
  // Disabled
  navbar: boolean = true;
  // State
  name: string = "";
  title: string = "";
  description: string = "";
  price: string = "";
  photo: any = "";
  photo_url: string = "";
  gender: string = "";
  calendar: Date = new Date();

  // Clear
  reset() {
    this.name = "";
    this.title = "";
    this.description = "";
    this.price = "";
    this.photo = "";
    this.photo_url = "";
    this.gender = "";
    this.calendar = new Date();
    this.$store.commit("message", { loading: false });
  }
  // Bind
  changeName(args: any) {
    this.name = args.target.value;
  }
  changeTitle(args: any) {
    this.title = args.target.value;
  }
  changeDescription(args: any) {
    this.description = args.target.value;
  }
  changePrice(args: any) {
    this.price = args.target.value;
  }
  changePhoto(args: any) {
    this.photo = args;
    this.photo_url = URL.createObjectURL(args);
  }
  changeCalendar(args: any) {
    this.calendar = args.target.value;
  }
  changeGender(args: any) {
    this.gender = args;
  }

  // Bind Update
  updateField(args: Update) {
    this.name = args.name;
    this.title = args.title;
    this.description = args.description;
    this.price = args.price;
    this.photo = args.photo;
    this.gender = args.gender;
    this.calendar = args.calendar;
    if (args.photo) {
      this.photo = URL.createObjectURL(args.photo);
    }
    switch (args.modals.type) {
      case "profile":
        this.$store.commit("modalsProfile", args.modals.open);
        break;
      case "dashboardDialog":
        this.$store.commit("dashboardDialog", args.modals.open);
      default:
        break;
    }
  }

  // Bind Router
  clickRouter(args: string) {
    this.$router.push({ name: args });
  }

  beforeUpdate() {
    if (
      this.$route.name === "login" ||
      this.$route.name === "reset" ||
      this.$route.name === "dashboard"
    ) {
      this.navbar = false;
    } else {
      this.navbar = true;
    }
  }

  beforeMount() {
    if (localStorage.getItem("token")) {
      this.$store.dispatch("me");
    }
    if (
      this.$route.name === "login" ||
      this.$route.name === "reset" ||
      this.$route.name === "dashboard"
    ) {
      this.navbar = false;
    } else {
      this.navbar = true;
    }
    this.$router.push({ name: "dashboard" });
  }
}
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