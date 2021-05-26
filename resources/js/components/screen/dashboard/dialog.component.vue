<template>
  <div
    :class="
      dashboard.dialog === 1
        ? 'dialog'
        : dashboard.dialog === 2
        ? 'dialog-close'
        : 'hidden'
    "
  >
    <div class="dialog-content">
      <button class="close" type="button" @click="closeDialog()">
        <i class="fas fa-times"></i>
      </button>
      <div class="title">Edit Profil</div>
      <div class="dialog-body">
        <form @submit.prevent="submit">
          <div class="vertical">
            <label for="First Name">First Name</label>
            <div class="field" id="field-input">
              <input
                type="text"
                name="first_name"
                id="first_name"
                class="first_name"
                placeholder="First Name"
                required
                autocomplete="off"
                :value="uname"
                @input="changeName($event)"
              />
            </div>
          </div>
          <div class="vertical">
            <label for="Last Name">Last Name</label>
            <div class="field" id="field-input">
              <input
                type="text"
                name="last_name"
                id="last_name"
                class="last_name"
                placeholder="Last Name"
                required
                autocomplete="off"
                :value="description"
                @input="changeDescription($event)"
              />
            </div>
          </div>
          <div class="vertical">
            <label for="Gender">Gender</label>
            <div class="field" id="field-checked">
              <div class="group">
                <div class="radio">
                  <input
                    type="radio"
                    name="male"
                    id="male"
                    value="Male"
                    v-model="gender"
                    @change="changeGender()"
                  />
                </div>
                <label for="male">Male</label>
              </div>
              <div class="group">
                <div class="radio">
                  <input
                    type="radio"
                    name="female"
                    id="female"
                    value="Female"
                    v-model="gender"
                    @change="changeGender()"
                  />
                </div>
                <label for="female">Female</label>
              </div>
            </div>
          </div>
          <div class="vertical">
            <label for="Brithday">Brithday</label>
            <div class="field" id="field-date">
              <div id="calendar">
                <input
                  type="date"
                  name="date"
                  id="date"
                  :value="calendar_"
                  @input="changeCalendar($event)"
                />
                <div class="box">
                  <icon :src="calendar" class="icon" fill="white" />
                </div>
              </div>
            </div>
          </div>
          <div class="field" id="field-button">
            <button>Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import calendar from "../../media/calendar (2).svg";

@Component({})
export default class DialogComponent extends Vue {
  // Media
  calendar = calendar;
  // Prop
  @Prop(Object) dashboard: any;
  @Prop(String) uname: string;
  @Prop(String) description: string;
  @Prop(String) gender_: string;
  @Prop(String) calendar_: string;
  // Props Bind

  @Emit()
  changeName(args: any) {
    this.$emit("changeName", args);
  }
  changeGender() {
    this.$emit("changeGender", this.gender);
  }
  changeCalendar(args: any) {
    this.$emit("changeCalendar", args);
  }
  changeDescription(args: any) {
    this.$emit("changeDescription", args);
  }
  // State
  gender: string = "";
  //   Bind
  closeDialog() {
    this.$store.commit("dashboardDialog", 2);
  }
  submit() {
    const data = {
      first_name: this.uname,
      last_name: this.description,
      gender: this.gender,
      brithday: this.calendar_,
    };
    this.$store
      .dispatch("updateProfile", data)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
        this.$store.commit("dashboardDialog", 2);
        this.$store.commit("profile", res.data.results)
      })
      .catch((err) => {
        if (!err.response.data) {
          localStorage.clear();
          window.location.reload();
        }
        this.$store.commit("message", {
          mesage: err.response.data.message,
          valid: 2,
        });
      });
  }

  beforeUpdate() {
    this.gender = this.gender_;
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/dashboard.scss";
@import "../../assets/form.scss";
</style>