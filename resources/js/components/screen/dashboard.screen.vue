<template>
  <div>
    <!--  -->
    <!-- component -->
    <div id="dashboard" v-if="me.accounts">
      <div class="block-bg"></div>
      <div class="box-bg">
        <div
          class="bg"
          :style="'background-image:url(' + me.accounts.background + ')'"
        ></div>
      </div>
      <div class="section">
        <div class="bg-avatar">
          <div
            class="avatar"
            :style="
              message.soft_loading === 'avatar'
                ? ''
                : 'background-image: url(' + me.accounts.avatar + ');'
            "
          >
            <div class="upload-avatar">
              <div class="upload-btn-wrapper">
                <input
                  type="file"
                  name=""
                  id=""
                  ref="avatar"
                  @change="changeAvatar()"
                />
                <button>
                  <icon :src="camera" class="icon" />
                </button>
              </div>
            </div>
            <icon
              v-if="message.soft_loading === 'avatar'"
              :src="sync"
              class="sync"
              id="sync"
            />
            <div class="upload-background">
              <div class="upload-btn-wrapper">
                <input
                  type="file"
                  name=""
                  id=""
                  ref="background"
                  @change="changeBackground()"
                />
                <button class="cover">
                  <icon :src="gallery" class="icon" />
                  <span>Change</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <button
          class="cog"
          @click="
            updateField({
              name: me.accounts.first_name,
              description: me.accounts.last_name,
              gender: me.accounts.gender,
              calendar: me.accounts.brithday,
              modals: { type: 'dashboardDialog', open: 1 },
            })
          "
        >
          <i class="fas fa-cog"></i>
        </button>
        <div class="vertical">
          <a class="nickname" href=""> First Name And Last Name </a>
          <span class="status">Admin</span>
        </div>
      </div>
    </div>
    <!--  -->
    <button class="bars" @click="clickDrawer()">
      <icon :src="bars" class="icon" fill="#43966c" />
    </button>
    <tab />
    <!-- drawer -->
    <drawer
      :dashboard="dashboard"
      v-on:closeDrawer="closeDrawer()"
      :logo="logo"
    />
    <!-- Dialog -->
    <dialogs
      :dashboard="dashboard"
      :uname="uname"
      :gender_="gender"
      :description="description"
      :calendar_="calendar"
      v-on:changeCalendar="changeCalendar($event)"
      v-on:changeGender="changeGender($event)"
      v-on:changeName="changeName($event)"
      v-on:changeDescription="changeDescription($event)"
    />
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import Tab from "./dashboard/tab.component.vue";
import bars from "../media/menu (1).svg";
import camera from "../media/camera (2).svg";
import logo from "../media/148702861_172413527739423_1030808571604752175_n (3).svg";
import { mapGetters } from "vuex";
import { Update, User } from "../../store/types/interface";
import { AxiosResponse } from "axios";
import sync from "../media/sync.svg";
import gallery from "../media/gallery.svg";
import drawer from "./dashboard/drawer.component.vue";
import dialogs from "./dashboard/dialog.component.vue";

@Component({
  components: {
    tab: Tab,
    drawer,
    dialogs,
  },
  computed: {
    ...mapGetters(["dashboard", "message"]),
  },
})
export default class DashboardComponent extends Vue {
  sync = sync;
  bars = bars;
  camera = camera;
  logo = logo;
  gallery = gallery;
  // Prop
  @Prop(Object) me: User;
  @Prop(String) uname: string;
  @Prop(String) title: string;
  @Prop(String) description: string;
  @Prop(String) price: string;
  @Prop() photo: string;
  @Prop() photo_url: string;
  @Prop(String) gender: string;
  @Prop(String) calendar: string;
  // Props Bind
  @Emit()
  changeName(args: any) {
    this.$emit("changeName", args);
  }
  changeCalendar(args: any) {
    this.$emit("changeCalendar", args);
  }
  changeGender(args: any) {
    this.$emit("changeGender", args);
  }
  changeTitle(args: any) {
    this.$emit("changeTitle", args);
  }
  changeDescription(args: any) {
    this.$emit("changeDescription", args);
  }
  changePrice(args: any) {
    this.$emit("changePrice", args);
  }
  changePhoto(args: any) {
    this.$emit("changePhoto", args);
  }
  clearInput(args: any) {
    this.$emit("clearInput");
  }
  updateField(args: Update) {
    this.$emit("updateField", args);
  }
  // Bind
  clickDrawer() {
    this.$store.commit("Dashboarddrawer", 1);
  }
  closeDrawer() {
    this.$store.commit("Dashboarddrawer", 2);
  }
  changeAvatar() {
    const data = new FormData();
    data.append("avatar", (this.$refs.avatar as any).files[0]);
    this.$store.commit("message", { soft_loading: "avatar" });
    this.$store
      .dispatch("uploadAvatar", data)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", {
          message: res.data.message,
          valid: 1,
          soft_loading: "",
        });
        this.$store.commit("avatar", res.data.results);
      })
      .catch((err) => {
        if (!err.response.data) {
          localStorage.clear();
          window.location.reload();
        }
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
        });
      });
  }
  changeBackground() {
    const data = new FormData();
    data.append("background", (this.$refs.background as any).files[0]);
    this.$store.commit("message", { soft_loading: "background" });
    this.$store
      .dispatch("uploadBackground", data)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", {
          message: res.data.message,
          valid: 1,
          soft_loading: "",
        });
        this.$store.commit("background", res.data.results);
      })
      .catch((err) => {
        if (!err.response.data) {
          localStorage.clear();
          window.location.reload();
        }
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
        });
      });
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/dashboard.scss";
</style>