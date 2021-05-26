<template>
  <div
    :class="
      dashboard.dropdown === 1
        ? 'dropdown'
        : dashboard.dropdown === 2
        ? 'dropdown-close'
        : 'hidden'
    "
  >
    <span class="close" @click="closeDropdown()">
      <i class="fas fa-times"></i>
    </span>
    <button>
      <icon :src="edit" class="icon" />
      <span>Edit</span>
    </button>
    <button>
      <icon :src="garbage" class="icon" />
      <span>Delete</span>
    </button>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import edit from "../../media/edit.svg";
import garbage from "../../media/garbage.svg";

@Component({})
export default class DropdownProduct extends Vue {
  // Media
  edit = edit;
  garbage = garbage;
  //   Props
  @Prop(Object) dashboard: any;
  //   Props Bind
  @Emit()
  closeDropdown() {
    this.$emit("closeDropdown");
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/product.scss";
</style>