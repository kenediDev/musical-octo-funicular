<template>
  <div
    :class="
      message.valid === 1
        ? 'message-success'
        : message.valid === 2
        ? 'message-error'
        : 'hidden'
    "
  >
    <div class="block">
      <button @click="clickClose(message.message)">
        <i class="fas fa-minus"></i>
      </button>
    </div>
    <span>
      {{ message.message }}
    </span>
  </div>
</template>

<script lang="ts">
import { Message } from "postcss";
import Vue from "vue";
import { Component, Prop } from "vue-property-decorator";

@Component({})
export default class MessageContext extends Vue {
  // Prop
  @Prop(Object) message: Message;

  // Bind
  clickClose(args: string) {
    this.$store.commit("message", { message: args, valid: 3 });
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/message.scss";
</style>