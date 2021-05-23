import Vue from "vue";

declare module "vue/types/vue" {
    // 3. Declare augmentation for Vue
    interface Vue {}
}

declare module "vue/types/vue" {
    // Global properties can be declared
    // on the `VueConstructor` interface
    interface VueConstructor {}
}

// ComponentOptions is declared in types/options.d.ts
declare module "vue/types/options" {
    interface ComponentOptions<V extends Vue> {
        myOption?: string;
    }
}
