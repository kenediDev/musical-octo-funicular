<template>
  <div>
    <div class="product-list">
      <div v-for="(items, index) in listProduct" :key="index">
        <div class="product-card">
          <img :src="items.image" alt="" />
          <div class="product-card-content">
            <div class="product-card-title">
              {{ items.name }}
              <button
                @click="
                  updateField({
                    id: items.id,
                    modals: { type: 'productDropdown', open: 1 },
                  })
                "
              >
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <dropdown
                v-if="id === items.id"
                :dashboard="dashboard"
                v-on:closeDropdown="closeDropdown($event)"
              />
            </div>
            <div class="product-card-description">{{ items.description }}</div>
            <div class="product-card-rate">
              <div class="group">
                <div class="product-card-box">
                  <icon :src="coffe" class="icon" />
                </div>
                <div class="product-card-rate-x">4.9 (149 Rating)</div>
              </div>
              <button>
                <span>Buy</span>
                <icon :src="shopping" class="icon" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import { mapGetters } from "vuex";
import { Update } from "../../../store/types/interface";
import coffe from "../../media/coffee.svg";
import shopping from "../../media/shopping-cart (1).svg";
import dropdown from "./dropdown.product.vue";

@Component({
  components: {
    dropdown,
  },
  computed: {
    ...mapGetters(["listProduct", "dashboard"]),
  },
})
export default class ContentComponent extends Vue {
  // Props
  @Prop(Number) id: number;
  // Media
  coffe = coffe;
  shopping = shopping;
  //   Props BInd
  @Emit()
  updateField(args: Update) {
    this.$emit("updateField", args);
  }
  changeId(args: number) {
    this.$emit("changeId", args);
  }

  closeDropdown() {
    this.changeId(0);
    this.$store.commit("productDropdown", 2);
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/product.scss";
</style>