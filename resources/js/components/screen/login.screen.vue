<template>
  <div>
    <div class="auth">
      <div class="ano-effect"></div>
      <div class="back">
        <span>Kembali Ke</span>
        <button @click="clickRouter('home')" id="back">
          <i class="fas fa-arrow-left"></i>
          <span>Beranda</span>
        </button>
      </div>
      <form @submit.prevent="submit">
        <h4>Anjay</h4>
        <div class="field" id="field-input">
          <input
            type="text"
            name="name"
            id="name"
            class="name"
            placeholder="Nama Pengguna"
            required
            autocomplete="off"
            :value="uname"
            @input="changeName($event)"
          />
        </div>
        <div class="field" id="field-input">
          <input
            type="password"
            name="password"
            id="password"
            class="password"
            placeholder="Kata sandi"
            required
            autocomplete="off"
            :value="description"
            @input="changeDescription($event)"
          />
        </div>
        <div class="field" id="field-button">
          <button>
            <div v-if="message.loading" class="spin"></div>
            <span>Masuk</span>
          </button>
          <a href="#" @click="clickRouter('reset')">Lupa Kata Sandi?</a>
        </div>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import { Message } from "postcss";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
@Component({})
export default class LoginScreen extends Vue {
  // Prop
  @Prop(Object) message: Message;
  @Prop(String) uname: string;
  @Prop(String) description: string; // This is State Password
  // Prop bind
  @Emit()
  changeName(args: any) {
    this.$emit("changeName", args);
  }
  @Emit()
  changeDescription(args: any) {
    this.$emit("changeDescription", args);
  }
  @Emit()
  clearInput() {
    this.$emit("clearInput");
  }
  @Emit()
  clickRouter(args: string) {
    this.$emit("clickRouter", args);
  }
  // Bind

  submit() {
    const data = {
      name: this.uname,
      password: this.description,
    };
    this.$store.commit("message", { loading: true });
    this.$store
      .dispatch("login", data)
      .then((res: AxiosResponse<any>) => {
        this.clearInput();
        localStorage.setItem("token", res.data.token);
        window.location.reload();
      })
      .catch((err) => {
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
          loading: false,
        });
      });
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/form.scss";
</style>