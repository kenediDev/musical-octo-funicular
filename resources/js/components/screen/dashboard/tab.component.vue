<template>
  <div class="tab">
    <button>
      <icon :src="home" class="icon" fill="white" />
    </button>
    <button>
      <icon :src="note" class="icon" fill="white" />
    </button>
    <div class="button">
      <button>
        <icon :src="plus" class="icon" fill="white"/>
      </button>
      <div class="before">
        <div class="divider"></div>
      </div>
    </div>
    <button>
      <icon :src="paperplane" class="icon" fill="white" />
    </button>
    <button>
      <icon :src="bell" class="icon" fill="white" />
    </button>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";
import home from "../../media/home-icon-silhouette.svg";
import note from "../../media/notes.svg";
import plus from "../../media/plus.svg";
import bell from "../../media/bell (1).svg";
import paperplane from '../../media/paper-plane.svg'

@Component({})
export default class TabComponent extends Vue {
  // Media
  home = home;
  note = note;
  plus = plus;
  bell = bell;
  paperplane = paperplane
}
</script>

<style lang="scss" scoped>
@import "../../assets/navbar.scss";
</style>