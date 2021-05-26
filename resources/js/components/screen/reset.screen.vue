<template>
  <div>
    <div class="auth">
      <div class="ano-effect"></div>
      <form @submit.prevent="submit">
        <div class="field" id="field-text">
          <h4>Forgot your password?</h4>
          <p>
            Please enter the email address associated with your account and We
            will email you a link to reset your password.
          </p>
        </div>
        <div class="field" id="field-input">
          <input
            type="text"
            name="name"
            id="name"
            class="name"
            placeholder="Cari akun"
            required
            autocomplete="off"
            :value="uname"
            @input="changeName($event)"
          />
        </div>
        <div class="field" id="field-button">
          <button
            :type="message.loading ? 'button' : 'submit'"
            :id="message.loading ? 'disabled' : ''"
          >
            <div v-if="message.loading" class="spin"></div>
            Reset Kata Sandi
          </button>
          <a
            href="#"
            @click="message.loading ? '' : clickRouter('login')"
            :id="message.loading ? 'disabled' : ''"
            >Back</a
          >
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
export default class ResetScreen extends Vue {
  // Prop
  @Prop(Object) message: Message;
  @Prop(String) uname: string;
  // Prop Bind
  @Emit()
  clickRouter(args: string) {
    this.$emit("clickRouter", args);
  }
  @Emit()
  changeName(args: any) {
    this.$emit("changeName", args);
  }
  @Emit()
  clearInput() {
    this.$emit("clearInput");
  }
  //   Bind
  submit() {
    this.$store.commit("message", { loading: true });
    this.$store
      .dispatch("reset", { token: this.uname })
      .then((res: AxiosResponse<any>) => {
        this.clearInput();
        this.$store.commit("message", { message: res.data.message, valid: 1 });
      })
      .catch((err) => {
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
        });
      });
  }
}
</script>


<style lang="scss" scoped>
@import "../assets/form.scss";
</style>